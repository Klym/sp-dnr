<?php

namespace info\domain;
require_once("DomainObject.php");

class Committees extends DomainObject {
	function __construct($id, $title, $text, $shortText) {
		parent::__construct($id, $title, $text);
		$this->shortText = $shortText;
	}
}

?>