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
	
	public function insertAgent(\PDO $pdo) {
		$stmt = $pdo->prepare("INSERT INTO agents (surname, name, patronymic, email, tel, form) VALUES (?,?,?,?,?,?)");
		$result = $stmt->execute(array($this->surname, $this->name, $this->patronymic, $this->email, $this->tel, $this->form));
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Данные не приняты");
		}
	}
}

?>