<?php

namespace info\domain;
require_once("DomainObject.php");

class Document extends DomainObject {
	private $description;
	private $date;
	private $src;
	private $format;
	
	function __construct($id, $title, $text, $description, $date, $src) {
		parent::__construct($id, $title, $text);
		$this->description = $description;
		$this->date = $date;
		$this->src = $src;
		$this->format = $this->generateFormat($src);
	}
	
	private function generateFormat($src) {
		$formatIndex = strrpos($src, ".");
		return substr($src, $formatIndex + 1);
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function getSrc() {
		return $this->src;
	}
	
	public function getFormat() {
		return $this->format;
	}
}

?>