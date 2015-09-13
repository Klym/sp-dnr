<?php

namespace info\mapper;
require_once("DataMapper.php");

class CategoryMapper extends DataMapper {
	function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
		$this->selectStmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = ?");
		$this->selectAllStmt = $this->pdo->prepare("SELECT * FROM categories");
	}
	
	protected function createObject(array $array) {
		$obj = new \info\domain\Category($array["id"], $array["title"]);
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