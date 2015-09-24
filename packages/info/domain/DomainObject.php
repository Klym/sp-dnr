<?php

namespace info\domain;

abstract class DomainObject {
	protected $id;
	protected $title;
	protected $text;
	protected $shortText;
	
	function __construct($id, $title, $text = null) {
		$this->id = $id;
		$this->title = $title;
		if (!is_null($text)) {
			$this->text = $text;
			$this->shortText = $this->cutText($this->text, 330);
		}
	}
	
	private function cutText($str, $length) {
		$str = iconv("utf-8", "windows-1251", $str);
		if (strlen(utf8_decode($str)) > $length) {
			$str = substr($str, 0, $length);
			$str = rtrim($str, "!,.-");
			$str = substr($str, 0, strrpos($str,' '));
			$str = $str."...";
		}
		return iconv("windows-1251", "utf-8" ,$str);
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getText() {
		return $this->text;
	}
	
	public function getShortText() {
		return $this->shortText;
	}
}

?>