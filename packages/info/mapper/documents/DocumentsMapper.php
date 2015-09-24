<?php

namespace info\mapper\documents;
use info\mapper\DataMapper;
require_once("packages/info/mapper/DataMapper.php");

abstract class DocumentsMapper extends DataMapper {

	function getDocuments($id = null) {
		$result = $this->select->execute(array($id));
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку документов не прошел");
		}
		$collection = parent::getCollection($this->select, true);
		return $collection;
	}
	
	protected function createObject(array $array) {
		$obj = new \info\domain\Document($array["id"], $array["title"], null, $array["description"], $array["date"], $array["src"]);
		return $obj;
	}
	
	protected function selectStmt() {
		return null;
	}
	
	protected function selectAllStmt() {
		return null;
	}
}

?>