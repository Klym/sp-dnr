<?php

namespace info\mapper;
require_once("DataMapper.php");
require_once("SelectionFactory.php");

class NewsMapper extends DataMapper {

	function __construct(\PDO $pdo) {
		parent::__construct($pdo);		
		// Запрос на выборку самых новых данных каждого типа
		$this->selectLatestStmt = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y') AS date FROM news WHERE date IN (SELECT MAX(date) FROM news GROUP BY type) ORDER BY type");		
		
		$this->selectStmt = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y в %H:%i') AS date FROM news WHERE id = ?");
		$this->selectYearsStmt = $this->pdo->prepare("SELECT MAX(DATE_FORMAT(`date`, '%Y')) AS max, MIN(DATE_FORMAT(`date`, '%Y')) AS min FROM news");
	}
	
	function getLatestData() {
		$result = $this->selectLatestStmt->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку последних новостей не прошел");
		}
		$collection = parent::getCollection($this->selectLatestStmt);
		return $collection;
	}
	
	function getData($page, $type = null, $from = null, $to = null) {
		if (!preg_match("|^[\d]+$|", $page)) {
			$page = 0;
		}
		$selectionFactory = new SelectionFactory($this->pdo, $page, $type, $from, $to);
		$stmt = $selectionFactory->selectData();
		$result = $stmt->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку новостей не прошел");
		}
		$collection = parent::getCollection($stmt, true);
		return $collection;
	}
	
	function getCount($type = null, $from = null, $to = null) {
		$selectionFactory = new SelectionFactory($this->pdo, null, $type, $from, $to);
		$stmt = $selectionFactory->selectCount();
		$result = $stmt->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на количество данных не прошел");
		}
		$arr = $stmt->fetch();
		return $arr["count"];
	}
	
	function getYears() {
		$this->selectYearsStmt->execute();
		$years = $this->selectYearsStmt->fetch();
		return $years;
	}
	
	function getDocuments($id) {
		$documentsMapper = new documents\NewsDocuments($this->pdo);
		return $documentsMapper->getDocuments($id);
	}
	
	protected function createObject(array $array) {
		$obj = new \info\domain\News($array["id"], $array["title"], $array["text"], $array["author"], $array["type"], $array["views"], $array["date"]);
		return $obj;
	}
	
	protected function selectStmt() {
		return $this->selectStmt;
	}
	
	protected function selectAllStmt() {
		return $this->selectAllStmt;
	}
}

?>