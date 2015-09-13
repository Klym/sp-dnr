<?php

namespace info\mapper;
require_once("DataMapper.php");

class CommitteesMapper extends DataMapper {
	function __construct(\PDO $pdo) {
		parent::__construct($pdo);
		$this->selectAllStmt = $this->pdo->prepare("SELECT * FROM committees");
		$this->selectStmt = $this->pdo->prepare("SELECT * FROM committees WHERE id = ?");
	}
	
	protected function createObject(array $array) {
		$obj = new \info\domain\Committees($array["id"], $array["title"], $array["text"]);
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