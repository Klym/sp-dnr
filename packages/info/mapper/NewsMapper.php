<?php

namespace info\mapper;
require_once("DataMapper.php");
require_once("SelectionFactory.php");

class NewsMapper extends DataMapper {

	function __construct(\PDO $pdo) {
		parent::__construct($pdo);		
		// Запрос на выборку самых новых данных каждого типа
		$this->selectLatestStmt = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y') AS date FROM news WHERE date IN (SELECT MAX(date) FROM news GROUP BY type) GROUP BY type LIMIT 4");
		
		$this->selectStmt = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y в %H:%i') AS new_date FROM news WHERE id = ?");
		$this->selectYearsStmt = $this->pdo->prepare("SELECT MAX(DATE_FORMAT(`date`, '%Y')) AS max, MIN(DATE_FORMAT(`date`, '%Y')) AS min FROM news");
		$this->insertStmt = $this->pdo->prepare("INSERT INTO news (title, text, author, type, views, date, img) VALUES (?,?,?,?,?,?,?)");
		$this->updateStmt = $this->pdo->prepare("UPDATE news SET title = ?, type = ?, text = ?, img = ? WHERE id = ?");
		$this->deleteStmt = $this->pdo->prepare("DELETE FROM news WHERE id = ?");
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
	
	function deleteImg($id) {
		$item = parent::find($id);
		if ($item->getImg() == "") return;
		$query = $this->pdo->prepare("UPDATE news SET img = '' WHERE id = ?");
		$result = $query->execute(array($id));
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на обновление поля изображения не прошел");
		}
		unlink("../news_imgs/".$item->getImg().".jpg");
	}
	
	function insert(\info\domain\DomainObject $object) {
		$values = array($object->getTitle(), $object->getText(), $object->getAuthor(), $object->getType()->getId(), $object->getViews(), $object->getDate(), $object->getImg());
		$result = $this->insertStmt->execute($values);
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на добавление новости не прошел");
		}
	}
	
	function update(\info\domain\DomainObject $object) {
		$values = array($object->getTitle(), $object->getType(), $object->getText(), $object->getImg(), $object->getId());
		$result = $this->updateStmt->execute($values);
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на обновление новости не прошел");
		}
	}
	
	protected function createObject(array $array) {
		$obj = new \info\domain\News($array["id"], $array["title"], $array["text"], $array["author"], $array["type"], $array["views"], $array["new_date"], $array["img"]);
		return $obj;
	}
	
	protected function selectStmt() {
		return $this->selectStmt;
	}
	
	protected function selectAllStmt() {
		return $this->selectAllStmt;
	}
	
	protected function deleteStmt() {
		return $this->deleteStmt;
	}
}

?>