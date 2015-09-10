<?php

namespace info;

abstract class Data {
	public $id;
	public $title;
	public $text;
	public $shortText;
	protected $db;
	
	function __construct(\PDO $db) {
		$this->db = $db;
	}
	
	protected function doCreateObject(array $array, Data $obj) {
		$obj->id = $array["id"];
		$obj->title = $array["title"];
		$obj->text = $array["text"];
		$obj->shortText = $this->cutText($obj->text, 275);
	}
	
	protected function cutText($str, $length) {
		$str = iconv("utf-8", "windows-1251", $str);
		if (strlen(utf8_decode($str)) > $length) {
			$str = substr($str, 0, $length);
			$str = rtrim($str, "!,.-");
			$str = substr($str, 0, strrpos($str,' '));
			$str = $str."...";
		}
		return iconv("windows-1251", "utf-8" ,$str);
	}
}

?>