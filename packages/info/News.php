<?php

namespace info;

class News extends Data {
	public $author;
	public $type;
	public $date;
	
	function __construct(\PDO $db = null) {
		if (!isset($db)) {
			return;
		}
		parent::__construct($db);
		// Запрос на выборку самых новых данных каждого типа
		$this->selectLatestStmt = $this->db->prepare("SELECT *, DATE_FORMAT(`date`, '%d,%m,%Y') AS date FROM news WHERE date IN (SELECT MAX(date) FROM news GROUP BY type) ORDER BY type");
	}
	
	function getLatestData() {
		$result = $this->selectLatestStmt()->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку новостей не прошел");
		}
		$array = $this->selectLatestStmt()->fetchAll();
		for ($i = 0; $i < count($array); $i++) {
			$data[] = $this->doCreateObject($array[$i]);
		}
		return $data;
	}
	
	protected function doCreateObject(array $array) {
		$obj = new News();
		parent::doCreateObject($array, $obj);
		$obj->author = $array["author"];

		$type = new Category($this->db);
		$obj->type = $type->find($array["type"]);

		$obj->date = $array["date"];
		return $obj;
	}

	private function selectLatestStmt() {
		return $this->selectLatestStmt;
	}
}

?>