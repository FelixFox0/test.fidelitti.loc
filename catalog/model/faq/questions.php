<?php
class ModelFaqQuestions extends Model {

    public function getAnswer()
    {
        $query = $this->db->query("SELECT * FROM ". DB_PREFIX . "faq f
            LEFT JOIN " . DB_PREFIX . "faq_description fd
	            ON f.id = fd.question_id
            WHERE f.status = 1 AND
	            fd.language_id = " . (int)$this->config->get('config_language_id') . "
            ORDER BY f.sort_order ASC");

        return $query->rows;
    }
}