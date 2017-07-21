<?php
/**
* Extended common Simple SQL Storage
* @author qooaen@gmail.com
* @version 1.1
*/

class ECSimpleSQLStorage {

	static protected $instance;

	protected $db;

	static public function instance($db) {

		if (empty(self::$instance)) {
			self::$instance = new self($db);
		}
		return self::$instance;

	}

	private function __construct($db) {

		$this->db = $db;

	}

	private function _escape($string) {

		return $this->db->escape($string);

	}

	private function _prepareQuery($query, $arguments) {

		foreach ($arguments as $key => $value) {
			if (is_array($value)) {
				$set = array();
				foreach ($value as $v) {
					$set[] = $this->_escape($v);
				}
				$value = "('" . implode("', '", $set) . "')";
			} else {
				$value = "'{$this->_escape($value)}'";
			}
			$query = preg_replace("/:$key:/", $value, $query, 1);
		}
		return $query;

	}

	private function _prepareSet($arguments) {

		$query = array();
		foreach ($arguments as $key => $value) {
			if ('!' == substr($key, 0, 1)) {
				$query[] = "`" . $this->_escape(substr($key, 1)) . "` = $value";
			} else {
				$query[] = "`" . $this->_escape($key) . "` = '" . $this->_escape($value) . "'";
			}
		}
		return $query;

	}

	public function query($query, $arguments = array()) {

		$query = $this->_prepareQuery($query, $arguments);
		$query = $this->db->query($query);

	}

	public function select($query, $arguments = array(), $key = '') {

		$query = $this->_prepareQuery($query, $arguments);
		$query = $this->db->query($query);
		if ($key) {
			$result = array();
			foreach ($query->rows as $row) {
				$result[$row[$key]] = $row;
			}
			return $result;
		}
		return $query->rows;

	}

	public function column($query, $arguments, $value, $key = null) {

		$query = $this->_prepareQuery($query, $arguments);
		$query = $this->db->query($query);
		$result = array();
		if ($key) {
			foreach ($query->rows as $row) {
				$result[$row[$key]] = $row[$value];
			}
		} else {
			foreach ($query->rows as $row) {
				$result[] = $row[$value];
			}
		}
		return $result;

	}

	public function row($query, $arguments = array()) {

		$query = $this->_prepareQuery($query, $arguments);
		$query = $this->db->query($query);
		return $query->row;

	}

	public function cell($query, $arguments = array()) {

		$query = $this->_prepareQuery($query, $arguments);
		$query = $this->db->query($query);
		foreach ($query->row as $value) {
			return $value;
		}
		return null;

	}

	public function insert($table, $data, $replace = false) {

		$query = ($replace ? 'REPLACE' : 'INSERT') . ' INTO `' . $this->_escape($table) . '` SET ' . implode(', ', $this->_prepareSet($data));
		$this->db->query($query);
		return $this->db->getLastId();

	}

	public function update($table, $data, $where, $arguments = array()) {

		$where = $this->_prepareQuery($where, $arguments);
		$query = 'UPDATE `' . $this->_escape($table) . '` SET ' . implode(', ', $this->_prepareSet($data)) . " WHERE $where";
		$this->db->query($query);
		return $this->db->countAffected();

	}

	public function delete($table, $where, $arguments = array()) {

		$where = $this->_prepareQuery($where, $arguments);
		$query = 'DELETE FROM `' . $this->_escape($table) . "` WHERE $where";
		$this->db->query($query);
		return $this->db->countAffected();

	}

}

?>