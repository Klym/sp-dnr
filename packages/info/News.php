<?php

namespace info;

class News extends Data {
	private $author;
	private $type;
	private $date;
	
	function __construct(\PDO $db) {
		parent::__construct($db);
		// Запрос на выборку самых новых данных каждого типа
		$this->selectLatestStmt = $this->db->prepare("SELECT * FROM news WHERE date IN (SELECT MAX(date) FROM news GROUP BY type) ORDER BY type");
	}
	
	function getLatestData() {
		$result = $this->selectLatestStmt()->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку данных не прошел");
		}
		$array = $this->selectLatestStmt()->fetchAll();
		// do create obj
		return $array;
	}

	private function selectLatestStmt() {
		return $this->selectLatestStmt;
	}
}

?>