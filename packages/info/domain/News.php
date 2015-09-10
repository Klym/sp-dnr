<?php

namespace info\domain;
use info\mapper\CategoryMapper;
require_once("DomainObject.php");
require_once("packages/info/mapper/CategoryMapper.php");

class News extends DomainObject {
	private $author;
	private $type;
	private $date;
	
	function __construct($id, $title, $text, $author, $type, $date) {
		parent::__construct($id, $title, $text);
		$this->author = $author;
		$db = \database\Db::getInstance();
		$pdo = $db->getDb();
		$category = new CategoryMapper($pdo);
		$this->type = $category->find($type);
		$this->date = $date;
	}
	
	public function getAuthor() {
		return $this->author;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function getDate() {
		return $this->date;
	}
}

?>