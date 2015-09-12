<?php

namespace info\mapper;

class SelectionFactory {
	private $query;
	private $page;
	private $type;
	private $from;
	private $to;
	private $pdo;
	
	function __construct(\PDO $pdo, $page = null, $type = null, $from = null, $to = null) {
		$this->pdo = $pdo;
		$this->page = $page;
		$this->type = $this->check("|^[\d]+$|", $type);
		
		$datePattern = "/\d{4}-(?:[1-9]|1[0-2])-(?:3[0-1]|[1-2]\d|[1-9]$)/";
		$this->from = $this->check($datePattern, $from);
		$this->to = $this->check($datePattern, $to);
	}
	
	function selectData() {
		$this->query = "SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y в %H:%i') AS date FROM news";
		$stmt = $this->buildStatement();
		return $stmt;
	}
	
	function selectCount() {
		$this->query = "SELECT COUNT(*) AS count FROM news";
		$stmt = $this->buildStatement();
		return $stmt;
	}
	
	private function buildStatement() {
		if (!is_null($this->type) && $this->type <= 0) {
			$this->type = null;
		}
		if (!is_null($this->type) || !is_null($this->from)) {
			$this->query .= " WHERE";
		}
		if (!is_null($this->type)) {
			$and = true;
			$this->query .= " type = ?";
		}
		if (!is_null($this->from)) {
			$tmp = $this->from;
			$this->from .= " 00:00:00";
			if ($and) {
				$this->query .= " AND";
			}
			$this->query .= " date >= ?";
			if (!is_null($this->to)) {
				$this->to .= " 23:59:59";
			} else {
				$this->to = $tmp." 23:59:59";
			}
			$this->query .= " AND date <= ?";
		}
		if (!is_null($this->page)) {
			$this->query .= " ORDER BY date DESC LIMIT ?, 10";
		}
		$stmt = $this->pdo->prepare($this->query);
		$i = 1;
		if (!is_null($this->type)) {
			$stmt->bindValue($i++, (int)$this->type, \PDO::PARAM_INT);
		}
		if (!is_null($this->from)) {
			$stmt->bindValue($i++, $this->from);
			$stmt->bindValue($i++, $this->to);
		}
		if (!is_null($this->page)) {
			$stmt->bindValue($i, $this->page * 10, \PDO::PARAM_INT);
		}
		return $stmt;
	}
	
	private function check($pattern, $param) {
		if (!is_null($param) && !preg_match($pattern, $param)) {
			return null;
		}
		return $param;
	}
}

?>