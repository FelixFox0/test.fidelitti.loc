<?php

/**
 * Zitec_Dpd – shipping carrier extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Zitec
 * @package    Zitec_Dpd
 * @authod     george.babarus
 * @copyright  Copyright (c) 2014 Zitec COM
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ControllerDpdPostcode extends Controller
{
    protected $_data = array();


    public function preDispatch()
    {
        $this->load->url = $this->url;
        $this->load->config = $this->config;
        $this->load->session = $this->session;

        $result = $this->db->query("SELECT * FROM `" . DB_PREFIX . "extension` WHERE `code` = 'zitec_dpd' AND `type` = 'shipping' ");

        if ($result->num_rows) {
            //extension installed it's ok
        } else {
            $this->session->data['success'] = $this->language->get('DPD - shipping module is not installed. Please install it by pressing the install button in shipping extensions list.');
            $this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
        }

    }

    /**
     * print the form with 2 options:
     * -upload a file and run the install script
     * -run import with an existing CSV file
     */
    public function updateForm()
    {
        $this->preDispatch();

        $this->language->load('shipping/zitec_dpd');

        $this->applyGeneralFeatures();
        $this->_data['breadcrumbs'] = array();

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_shipping'),
            'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('DPD Postcode - database update manager'),
            'href'      => $this->url->link('dpd/postcode/updateForm', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );


        $this->_data['importAction']          = $this->url->link('dpd/postcode/import', 'token=' . $this->session->data['token'], 'SSL');
        $this->_data['uploadAndImportAction'] = $this->url->link('dpd/postcode/uploadAndImport', 'token=' . $this->session->data['token'], 'SSL');

        $this->_data['uploaded_files'] = $this->getUploadedImportFiles();


        $this->_data['header'] = $this->load->controller('common/header');
        $this->_data['column_left'] = $this->load->controller('common/column_left');
        $this->_data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('shipping/zitec_dpd/postcode/form.tpl', $this->_data));
    }


    private function getUploadedImportFiles()
    {
        $this->load->model('module/dpd/postcode');
        $path  = $this->model_module_dpd_postcode->getPathToDatabaseUpgradeFiles();
        $files = array();

        if (is_dir($path) && $handle = opendir($path)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry == '.' || $entry == '..') {
                    continue;
                }
                $ext = pathinfo($entry, PATHINFO_EXTENSION);
                if (strtolower($ext) !== 'csv') {
                    continue;
                }
                $files[$entry] = filemtime($path . $entry);
            }
            closedir($handle);
        }
        asort($files);

        return $files;
    }

    /**
     * upload the postcode CSV file and then run the process script
     */
    public function uploadAndImport()
    {
        set_time_limit(0);

        $this->language->load('shipping/zitec_dpd');
        $this->load->model('module/dpd/postcode');

        $status = array();


        if (!empty($this->request->files['csv']['name'])) {
            $filename = basename(html_entity_decode($this->request->files['csv']['name'], ENT_QUOTES, 'UTF-8'));

            if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
                $status['error'] = $this->language->get('The filename is probably wrong. ');
            }

            // Allowed file extension types
            $allowed = array('csv');
            $ext     = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                $status['error'] = $this->language->get('File extension is wrong, please provide a csv file.');
            }

            // Allowed file mime types
            $allowed = array('csv', 'application/vnd.ms-excel');

            if (!in_array($this->request->files['csv']['type'], $allowed)) {
                //skip mime type validation
                //$json['error'] = $this->language->get('error_filetype');
            }

            if(!empty($this->request->files['csv']['tmp_name'])) {
                // Check to see if any PHP files are trying to be uploaded
                $content = file_get_contents($this->request->files['csv']['tmp_name']);

                if (preg_match('/\<\?php/i', $content)) {
                    $status['error'] = $this->language->get('File content is wrong. Please check your CSV content.');
                }
            }

            if ($this->request->files['csv']['error'] != UPLOAD_ERR_OK) {
                $status['error'] = $this->language->get( $this->getUploadCodeMessage($this->request->files['csv']['error']) );
            }
        } else {
            $status['error'] = $this->language->get('File was not uploaded. Please check the upload_max_filesize setting of your server. upload_max_filesize: '.ini_get('upload_max_filesize'));
        }


        if (!isset($status['error'])) {
            if (is_uploaded_file($this->request->files['csv']['tmp_name']) && file_exists($this->request->files['csv']['tmp_name'])) {
                $status['filename'] = $filename;
                $status['mask']     = $filename;

                $path = $this->model_module_dpd_postcode->getPathToDatabaseUpgradeFiles();
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                move_uploaded_file($this->request->files['csv']['tmp_name'], $path . $filename);
            }

            $status['success'] = $this->language->get('Postcode database was successfully updated.');
        }

        if (!isset($status['error'])) {
            try {
                $this->model_module_dpd_postcode->updateDatabase($path . $filename);
            } catch (Exception $e) {
                $this->session->data['error'] = $e->getMessage();

                $this->response->redirect($this->url->link('dpd/postcode/updateForm', 'token=' . $this->session->data['token'], 'SSL'));

                return;
            }
        }


        if (isset($status['success'])) {
            $this->session->data['success'] = $status['success'];
        } else {
            $this->session->data['error'] = $status['error'];
        }

        $this->response->redirect($this->url->link('dpd/postcode/updateForm', 'token=' . $this->session->data['token'], 'SSL'));
    }



    /**
     *
     * @param $code
     *
     * @return string
     */
    private function getUploadCodeMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "File upload stopped by extension";
                break;

            default:
                $message = "Unknown upload error";
                break;
        }

        return $message;
    }


    /**
     * import an existing CSV file for postcode database
     */
    public function import()
    {
        set_time_limit(0);

        $this->language->load('shipping/zitec_dpd');
        $this->load->model('module/dpd/postcode');

        try {
            $file = $this->request->post['csv_path'];
            if (empty($file)) {
                throw new Exception($this->language->get('Provide a file name from the list below to be used as a DPD postcode database.'));
            }

            $file = basename($file);
            $path = $this->model_module_dpd_postcode->getPathToDatabaseUpgradeFiles();
            if (!is_file($path . $file)) {
                throw new Exception($this->language->get('The file does not exit in the specified path: download/dpd/postcode_updates'));
            }

            // Allowed file extension types
            $allowed = array('csv');
            $ext     = pathinfo($file, PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                throw new Exception($this->language->get('Wrong file extension, please provide a csv file.'));
            }

            $this->model_module_dpd_postcode->updateDatabase($path . $file);


        } catch (Exception $e) {
            $this->session->data['error'] = $e->getMessage();
            $this->response->redirect($this->url->link('dpd/postcode/updateForm', 'token=' . $this->session->data['token'], 'SSL'));

            return;
        }

        $this->session->data['success'] = $this->language->get('Postcode database was successfully updated.');
        $this->response->redirect($this->url->link('dpd/postcode/updateForm', 'token=' . $this->session->data['token'], 'SSL'));
    }


    /**
     *  add to all actions in this controller a basic behavior
     *  for example add the basic breadcrumbs information
     *  init some models needed in all places
     */
    private function applyGeneralFeatures()
    {

        $this->_data['breadcrumbs'] = array();

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_shipping'),
            'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('dpd_text_shipping'),
            'href'      => $this->url->link('shipping/zitec_dpd', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('shipping/zitec_dpd/shipping_settings', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->_data['heading_title'] = $this->language->get('heading_title');

        //ERROR handling
        if (isset($this->session->data['success'])) {
            $this->_data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->_data['success'] = '';
        }


        if (isset($this->session->data['error'])) {
            $this->_data['error'] = $this->session->data['error'];

            unset($this->session->data['error']);
        } else {
            $this->_data['error'] = '';
        }

        //Models init
        $this->_data['language'] = $this->language;

        $this->load->model('setting/store');

        $this->_data['stores'] = $this->model_setting_store->getStores();

        //partials and templates
        $this->_data['header'] = $this->load->controller('common/header');
        $this->_data['column_left'] = $this->load->controller('common/column_left');
        $this->_data['footer'] = $this->load->controller('common/footer');

    }

}
