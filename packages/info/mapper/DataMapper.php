<?php

namespace info\mapper;

abstract class DataMapper {
	protected $pdo;
	
	function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
	}
	
	public function find($id) {
		if (!preg_match("|^[\d]+$|",$id)) {
			throw new \Exception("Ошибка. Параметр не является числом");
		}
		$result = $this->selectStmt()->execute(array($id));
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку данных не прошел");
		}
		$array = $this->selectStmt()->fetch();
		if (empty($array)) {
			throw new \Exception("Ошибка базы данных. Данных по запросу не обнаружено");
		}
		if (!isset($array["id"])) {
			throw new \Exception("Ошибка запроса. Данные в базе не имеют идентификатора");
		}
		return $this->createObject($array);
	}
	
	public function findAll() {
		$result = $this->selectAllStmt()->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку данных не прошел");
		}
		$array = $this->getCollection($this->selectAllStmt());
		return $array;
	}
		
	public function delete($id) {
		if (!preg_match("|^[\d]+$|",$id)) {
			throw new \Exception("Ошибка. Параметр не является числом");
		}
		$result = $this->deleteStmt()->execute(array($id));
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на удаление данных не прошел");
		}
	}
	
	protected function getCollection($handleStatement, $noException = false) {
		$array = $handleStatement->fetchAll();
		if (empty($array) && !$noException) {
			throw new \Exception("Ошибка базы данных. Данных по запросу не обнаружено");
		}
		for ($i = 0; $i < count($array); $i++) {
			$data[] = $this->createObject($array[$i]);
		}
		return $data;
	}
	
	public abstract function insert(\info\domain\DomainObject $object);
	public abstract function update(\info\domain\DomainObject $object);
	protected abstract function createObject(array $array);
	protected abstract function selectStmt();
	protected abstract function selectAllStmt();
	protected abstract function deleteStmt();
}

?>