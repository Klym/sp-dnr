<?php

namespace info\domain;
require_once("DomainObject.php");

class PageText extends DomainObject {
	function __construct($id, $title, $text) {
		parent::__construct($id, $title, $text);
	}
}

?>