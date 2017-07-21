<?php
class ModelagooLangmarkLangmark extends Model
{
	public function getLangmark($data) {

		$query = $this->db->query("
		SELECT DISTINCT *
		FROM " . DB_PREFIX . "product p
		LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
		WHERE
		pd.tag LIKE '%".$this->db->escape($data['filter_name'])."%'
		AND
		pd.language_id = '" . (int)$data['language_id'] . "'
		LIMIT ".$data['start'].", ".$data['limit']."
		"

		);

		return $query->rows;
	}

	public function getRecordLangmarkProduct($record_id)
	{
		$record_tag_data = array();
		$query           = $this->db->query("
			SELECT *
			FROM `" . DB_PREFIX . "record` r
			LEFT JOIN " . DB_PREFIX . "record_description rd ON (r.record_id = rd.record_id)
			WHERE
			r.record_id = '" . (int) $record_id . "'"
		);

		$tag_data        = array();
		foreach ($query->rows as $result) {
			$tag_data[$result['language_id']][] = $result['tag_product'];
		}
		foreach ($tag_data as $language => $tags) {
			$record_tag_data[$language] = implode(',', $tags);
		}
		return $record_tag_data;
	}

	public function getRecordLangmarkSearch($record_id)
	{
		$keys  = array();
		$query           = $this->db->query("
			SELECT rd.tag_search, rd.language_id
			FROM `" . DB_PREFIX . "record` r
			LEFT JOIN " . DB_PREFIX . "record_description rd ON (r.record_id = rd.record_id)
			WHERE
			r.record_id = '" . (int) $record_id . "'"
		);

		foreach ($query->rows as $num => $row) {
			$keys[$row['language_id']] = $row['tag_search'];
		}
		return $keys;
	}



}
