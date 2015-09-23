<?php

namespace statement;
require_once("Statement.php");

class Agent {
	private $id;
	public $surname;
	public $name;
	public $patronymic;
	public $email;
	public $tel;
	public $form;
	
	function __construct($surname, $name, $patronymic, $email, $tel, $form) {
		$this->surname = Statement::checkData($surname);
		$this->name = Statement::checkData($name);
		$this->patronymic = Statement::checkData($patronymic);
		$this->email = Statement::checkData($email);
		$this->tel = Statement::checkData($tel);
		$this->form = Statement::checkData($form);
	}
}

?>