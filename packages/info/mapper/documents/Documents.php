<?php

namespace info\mapper\documents;
require_once("DocumentsMapper.php");

class Documents extends DocumentsMapper {
	function __construct(\PDO $pdo) {
		parent::__construct($pdo);
		$this->select = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y в %H:%i') AS date FROM documents ORDER BY date DESC");
		$this->selectLatestStmt = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y в %H:%i') AS date FROM documents ORDER BY date DESC LIMIT 4");
	}
	
	function getLatestDocuments() {
		$result = $this->selectLatestStmt->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку последних документов не прошел");
		}
		$collection = parent::getCollection($this->selectLatestStmt);
		return $collection;
	}
}

?>