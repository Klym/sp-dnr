<?php

namespace info;

class Category {
	public $id;
	public $title;
	private $db;
	
	function __construct(\PDO $db = null) {
		if (!isset($db)) {
			return;
		}
		$this->db = $db;
		$this->selectStmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
		$this->selectAllStmt = $this->db->prepare("SELECT * FROM categories");
	}
	
	public function find($id) {
		$result = $this->selectStmt->execute(array($id));
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку типов новостей не прошел");
		}
		$category = $this->selectStmt->fetch();
		return $this->doCreateObject($category);
	}
	
	public function findAll() {
		$result = $this->selectAllStmt->execute();
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Запрос на выборку типов новостей не прошел");
		}
		$categories = $this->selectAllStmt->fetchAll();
		for ($i = 0; $i < count($categories); $i++) {
			$data[] = $this->doCreateObject($categories[$i]);
		}
		return $data;
	}
	
	private function doCreateObject(array $array) {
		$category = new Category();
		$category->id = $array["id"];
		$category->title = $array["title"];
		return $category;
	}
}

?>