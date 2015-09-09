<?php

namespace info;

abstract class Data {
	protected $id;
	protected $title;
	protected $text;
	protected $db;
	
	function __construct(\PDO $db) {
		$this->db = $db;
	}
}

?>