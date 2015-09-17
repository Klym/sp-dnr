<?php

namespace statement;

class Agent {
	private $id;
	public $surname;
	public $name;
	public $patronymic;
	public $email;
	public $tel;
	public $form;
	
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