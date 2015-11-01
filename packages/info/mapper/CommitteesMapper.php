<?php

namespace info\mapper;
require_once("DataMapper.php");

class CommitteesMapper extends DataMapper {
	function __construct(\PDO $pdo) {
		parent::__construct($pdo);
		$this->selectAllStmt = $this->pdo->prepare("SELECT * FROM committees");
		$this->selectStmt = $this->pdo->prepare("SELECT * FROM committees WHERE id = ?");
	}
	
	function getDocuments($id) {
		$documentsMapper = new documents\CommitteesDocuments($this->pdo);
		return $documentsMapper->getDocuments($id);
	}
	
	function insert(\info\domain\DomainObject $object) {
		
	}
	
	function update(\info\domain\DomainObject $object) {
		
	}
	
	protected function createObject(array $array) {
		$obj = new \info\domain\Committees($array["id"], $array["title"], $array["text"], $array["description"]);
		return $obj;
	}
	
	protected function selectStmt() {
		return $this->selectStmt;
	}
	
	protected function selectAllStmt() {
		return $this->selectAllStmt;
	}
	
	protected function deleteStmt() {
		return null;
	}
}

?>