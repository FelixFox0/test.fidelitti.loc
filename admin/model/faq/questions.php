<?php
class ModelFaqQuestions extends Model {

    public function getTotalQuestions($data = array()) {
        $sql = "SELECT COUNT(DISTINCT f.id) AS total FROM " . DB_PREFIX . "faq f LEFT JOIN " . DB_PREFIX . "faq_description fd ON (f.id = fd.question_id)";

        $sql .= " WHERE fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND f.status = '" . (int)$data['filter_status'] . "'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getQuestions($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "faq f LEFT JOIN " . DB_PREFIX . "faq_description fd ON (f.id = fd.question_id) WHERE fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND f.status = '" . (int)$data['filter_status'] . "'";
        }

        $sql .= " GROUP BY f.id";

        $sql .= " ORDER BY f.sort_order ASC, f.create DESC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getQuestion($question_id) {
        $sql = "SELECT * FROM " . DB_PREFIX . "faq f
                    LEFT JOIN " . DB_PREFIX ."faq_description fd
                        ON f.id = fd.question_id
                    WHERE f.id = '" . (int)$question_id . "' AND
                    fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function getFaqDescriptions($question_id) {
        $faq_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_description WHERE question_id = '" . (int)$question_id . "'");

        foreach ($query->rows as $result) {
            $faq_description_data[$result['language_id']] = array(
                'title'            => $result['title'],
                'description'      => $result['description']
            );
        }

        return $faq_description_data;
    }

    public function addFaq($data) {

        $this->db->query("INSERT INTO " . DB_PREFIX . "faq SET `sort_order` = '" . (int)$data['sort_order'] . "', `status` = '" . (int)$data['status'] . "', `create` = NOW()");

        $question_id = $this->db->getLastId();

        foreach ($data['faq_question'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "faq_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "'");
        }

        $this->cache->delete('question');

       return $question_id;
    }

    public function editFaq($question_id, $data) {

        $this->db->query("UPDATE " . DB_PREFIX . "faq SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE id = '" . (int)$question_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "faq_description WHERE question_id = '" . (int)$question_id . "'");

        foreach ($data['faq_question'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "faq_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "'");
        }

        $this->cache->delete('question');
    }

    public function deleteFaq($question_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "faq WHERE id = '" . (int)$question_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "faq_description WHERE question_id = '" . (int)$question_id . "'");
        $this->cache->delete('question');
    }
}
