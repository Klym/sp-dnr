<?php

namespace info\mapper;

abstract class DataMapper {
	protected $pdo;
	
	function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
	}
	
	public function find($id) {
		$result = $this->selectStmt()->execute(array($id));
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку данных не прошел");
		}
		$array = $this->selectStmt()->fetch();
		if (!is_array($array)) {
			throw new \Exception("Ошибка базы данных. Таблица пуста");
		}
		if (!isset($array["id"])) {
			throw new \Exception("Ошибка запроса. Данные не имеют идентификатора");
		}
		return $this->createObject($array);
	}
	
	public function findAll() {
		$result = $this->selectAllStmt()->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку данных не прошел");
		}
		$array = $this->selectAllStmt()->fetchAll();
		if (!is_array($array)) {
			throw new \Exception("Ошибка базы данных. Таблица пуста");
		}
		for ($i = 0; $i < count($array); $i++) {
			$data[] = $this->createObject($array[$i]);
		}
		return $data;
	}

	protected abstract function createObject(array $array);
	protected abstract function selectStmt();
	protected abstract function selectAllStmt();
}

?>