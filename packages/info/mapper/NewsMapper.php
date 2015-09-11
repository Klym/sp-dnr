<?php

namespace info\mapper;
require_once("DataMapper.php");

class NewsMapper extends DataMapper {

	function __construct(\PDO $pdo) {
		parent::__construct($pdo);
		
		// Запрос на выборку самых новых данных каждого типа
		$this->selectLatestStmt = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y') AS date FROM news WHERE date IN (SELECT MAX(date) FROM news GROUP BY type) ORDER BY type");
		$this->selectLimitStmt = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y в %H:%i') AS date FROM news ORDER BY date DESC LIMIT ?, 10");
		$this->selectByTypeStmt = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y в %H:%i') AS date FROM news WHERE type = ? ORDER BY date DESC LIMIT ?, 10");
		//$this->selectStmt = $this->pdo->prepare("SELECT * FROM news WHERE id = ?");
		$this->selectCountStmt = $this->pdo->prepare("SELECT COUNT(*) AS count FROM news");
		$this->selectByTypeCountStmt = $this->pdo->prepare("SELECT COUNT(*) AS count FROM news WHERE type = ?");
	}
	
	function getLatestData() {
		$result = $this->selectLatestStmt->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку последних новостей не прошел");
		}
		$collection = parent::getCollection($this->selectLatestStmt);
		return $collection;
	}
	
	function getLmitData($page) {
		if (!preg_match("|^[\d]+$|", $page)) {
			$page = 0;
		}
		$this->selectLimitStmt->bindValue(1, $page * 10, \PDO::PARAM_INT);
		$result = $this->selectLimitStmt->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку новостей не прошел");
		}
		$collection = parent::getCollection($this->selectLimitStmt);
		return $collection;
	}
	
	function getByTypeData($page, $type) {
		if (!preg_match("|^[\d]+$|", $page)) {
			$page = 0;
		}
		if (!preg_match("|^[\d]+$|", $type)) {
			throw new \Exception("Ошибка входных данных. Параметр не является числом");
		}
		$this->selectByTypeStmt->bindValue(1, (int)$type, \PDO::PARAM_INT);
		$this->selectByTypeStmt->bindValue(2, $page * 10, \PDO::PARAM_INT);
		$result = $this->selectByTypeStmt->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку новостей по типу не прошел");
		}
		$collection = parent::getCollection($this->selectByTypeStmt);
		return $collection;
	}
	
	function getCount() {
		$result = $this->selectCountStmt->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на количество данных не прошел");
		}
		$array = $this->selectCountStmt->fetch();
		return $array["count"];
	}
	
	function getByTypeCount($type) {
		if (!preg_match("|^[\d]+$|", $type)) {
			throw new \Exception("Ошибка входных данных. Параметр не является числом");
		}
		$this->selectByTypeCountStmt->bindValue(1, (int)$type, \PDO::PARAM_INT);
		$result = $this->selectByTypeCountStmt->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на количество данных по типу не прошел");
		}
		$array = $this->selectByTypeCountStmt->fetch();
		return $array["count"];
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