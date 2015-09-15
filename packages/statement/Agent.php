<?php

namespace statement;

class Agent {
	private $id;
	private $surname;
	private $name;
	private $patronymic;
	private $email;
	private $tel;
	private $form;
	
	function __construct($surname, $name, $patronymic, $email, $tel, $form) {
		$this->surname = $surname;
		$this->name = $name;
		$this->patronymic = $patronymic;
		$this->email = $email;
		$this->tel = $tel;
		$this->form = $form;
	}
}

?>