<?php

namespace info\domain;
use info\mapper\CategoryMapper;
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once("DomainObject.php");
require_once(__ROOT__."/packages/info/mapper/CategoryMapper.php");

class News extends DomainObject {
	private $author;
	private $type;
	private $views;
	private $date;
	private $img;
	
	function __construct($id, $title, $text, $author, $type, $views, $date, $img) {
		parent::__construct($id, $title, $text);
		$this->author = $author;
		$db = \database\Db::getInstance();
		$pdo = $db->getDb();
		$category = new CategoryMapper($pdo);
		$this->type = $category->find($type);
		$this->views = $views;
		$this->date = $date;
		$this->img = $img;
	}
	
	public function getAuthor() {
		return $this->author;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function getViews() {
		return $this->views;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function getImg() {
		return $this->img;
	}
}

?>