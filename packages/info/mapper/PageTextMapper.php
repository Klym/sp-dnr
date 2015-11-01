<?php

namespace info\mapper;
require_once("DataMapper.php");

class PageTextMapper extends DataMapper {
	function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
		$this->selectStmt = $this->pdo->prepare("SELECT * FROM texsts WHERE id = ?");
	}
	
	function update(\info\domain\DomainObject $object) {
		
	}
	
	protected function createObject(array $array) {
		$obj = new \info\domain\PageText($array["id"], null, $array["text"]);
		return $obj;
	}
	
	protected function selectStmt() {
		return $this->selectStmt;
	}
	
	protected function selectAllStmt() {
		return null;
	}
	
	protected function deleteStmt() {
		return null;
	}
}

?>