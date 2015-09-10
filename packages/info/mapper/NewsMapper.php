<?php

namespace info\mapper;
require_once("DataMapper.php");

class NewsMapper extends DataMapper {

	function __construct(\PDO $pdo) {
		parent::__construct($pdo);
		
		// Запрос на выборку самых новых данных каждого типа
		$this->selectLatestStmt = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d,%m,%Y') AS date FROM news WHERE date IN (SELECT MAX(date) FROM news GROUP BY type) ORDER BY type");
		$this->selectLimitStmt = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d,%m,%Y в %H,%i') AS date FROM news LIMIT 0, 10");
		//$this->selectStmt = $this->pdo->prepare("SELECT * FROM news WHERE id = ?");
	}
	
	function getLatestData() {
		$result = $this->selectLatestStmt()->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку новостей не прошел");
		}
		$array = $this->selectLatestStmt()->fetchAll();
		for ($i = 0; $i < count($array); $i++) {
			$data[] = $this->createObject($array[$i]);
		}
		return $data;
	}
	
	function getLmitData() {
		$result = $this->selectLimitStmt()->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку новостей не прошел");
		}
		$array = $this->selectLimitStmt()->fetchAll();
		for ($i = 0; $i < count($array); $i++) {
			$data[] = $this->createObject($array[$i]);
		}
		return $data;
	}
	
	protected function createObject(array $array) {
		$obj = new \info\domain\News($array["id"], $array["title"], $array["text"], $array["author"], $array["type"], $array["views"], $array["date"]);
		return $obj;
	}
	
	private function selectLatestStmt() {
		return $this->selectLatestStmt;
	}
	
	private function selectLimitStmt() {
		return $this->selectLimitStmt;
	}
	
	protected function selectStmt() {
		return $this->selectStmt;
	}
	
	protected function selectAllStmt() {
		return $this->selectAllStmt;
	}
}

?>