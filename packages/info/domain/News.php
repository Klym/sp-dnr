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
	
	public static function compressImg($path, $type) {
		switch($type) {
			case "image/jpeg" :
				$img = imagecreatefromjpeg($path);
			break;
			case "image/gif" :
				$img = imagecreatefromgif($path);
			break;
			case "image/png" :
				$img = imagecreatefrompng($path);
			break;
			default:
				return;
			break;
		}
		$width = imagesx($img);
		$height = imagesy($img);
		$new_width = 280;
		$new_height = floor( $height * ( $new_width / $width));
		$tmp_img = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		$new_path = time();
		if (imagejpeg($tmp_img, "../news_imgs/".$new_path.".jpg", 100)) {
			return $new_path;
		}
	}
	
	public function getAuthor() {
		return $this->author;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function setType($value) {
		$this->type = $value;
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
	
	public function setImg($value) {
		$this->img = $value;
	}
}

?>