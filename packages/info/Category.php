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
	}
	
	public function find($id) {
		$result = $this->selectStmt->execute(array($id));
		if (!$result) {
			throw new Exception("Ошибка базы данных. Запрос на выборку типов новостей не прошел");
		}
		$category = $this->selectStmt->fetch();
		return $this->doCreateObject($category);
	}
	
	private function doCreateObject(array $array) {
		$category = new Category();
		$category->id = $array["id"];
		$category->title = $array["title"];
		return $category;
	}
}

?>