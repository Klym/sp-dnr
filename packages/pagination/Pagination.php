<?php

namespace pagination;

class Pagination {
	public $count = 10;
	private $countPages;
	private $selected;
	private $from = 0;
	
	function __construct($dataCount, $selected) {
		$this->countPages = ceil($dataCount / $this->count);
		$this->selected = $selected;
		if ($this->countPages < $this->count) {
			$this->count = $this->countPages;
		}
	}
	
	function generate() {
		if (!preg_match("|^[\d]+$|", $this->selected)) {
			$this->selected = 0;
		}
		$this->from = ($this->selected <= $this->count / 2) ? 0 : $this->selected - $this->count / 2;
		if ($this->selected + $this->count / 2 >= $this->countPages) {
			$this->from -= $this->selected + $this->count / 2 - $this->countPages;
			if ($this->from < 0) {
				$this->from = 0;
			}
		}
	}
	
	function getFrom() {
		return $this->from;
	}
	
	function getSelected() {
		return $this->selected;
	}
	
	function getPrev() {
		return ($this->selected != 0 ) ? $this->selected - 1 : 0;
	}
	
	function getNext() {
		return ($this->selected != $this->countPages - 1) ? $this->selected + 1 : $this->selected;
	}
	
	function toEnd() {
		return $this->countPages - 1;
	}
	
	function isPrevDisabled() {
		return ($this->selected == 0) ? "class=\"disabled\"" : "";
	}
	
	function isNextDisabled() {
		return ($this->selected >= $this->countPages - 1) ? "class=\"disabled\"" : "";
	}
}

?>