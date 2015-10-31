<?php

namespace moderators;

class Moderator {
	private $id;
	private $login;
	private $password;
	private $name;
	private $surname;
	private $patronymic;
	private $group;
	private $pdo;
	
	function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
	}
	
	function checkUser($login, $password) {		
		$result = $this->pdo->prepare("SELECT * FROM moderators WHERE login = ? AND password = ?");
		$result->execute(array($login, $password));
		$rows = $result->fetch();
		if (empty($rows)) {
			throw new \Exception("<html><head><meta http-equiv='refresh' content='2; url=login.php'></head>Ошибка. Пользователя с таким логином и паролем не найдено</html>");
		}
		$this->id = $rows["id"];
		$this->login = $rows["login"];
		$this->password = $rows["password"];
		$this->name = $rows["name"];
		$this->surname = $rows["surname"];
		$this->patronymic = $rows["patronymic"];
		$this->group = $rows["group"];
	}
		
	function serialize() {
		$arr["id"] = $this->id;
		$arr["login"] = $this->login;
		$arr["name"] = $this->name;
		$arr["surname"] = $this->surname;
		$arr["patronymic"] = $this->patronymic;
		$arr["group"] = $this->group;
		return $arr;
	}
}

?>