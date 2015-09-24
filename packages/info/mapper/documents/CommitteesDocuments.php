<?php

namespace info\mapper\documents;
require_once("DocumentsMapper.php");

class CommitteesDocuments extends DocumentsMapper {
	function __construct(\PDO $pdo) {
		parent::__construct($pdo);
		$this->select = $this->pdo->prepare("SELECT *, DATE_FORMAT(`date`, '%d.%m.%Y в %H:%i') AS date FROM documents WHERE committee = ?");
	}
}

?>