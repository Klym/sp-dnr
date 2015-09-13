<?php

namespace info\domain;
require_once("DomainObject.php");

class Category extends DomainObject {
	function __construct($id, $title) {
		parent::__construct($id, $title);
	}
}

?>