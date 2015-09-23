<?php

namespace statement;

class Statement {
	private $id;
	private $title;
	private $regNum;
	private $activity;
	private $additionalActivity;
	private $surname;
	private $name;
	private $patronymic;
	private $email;
	private $tel;
	private $jurAddr;
	private $actAddr;
	private $taxation;
	private $headCount;
	private $note;
	private $date;
	private $state;
	
	function __construct($title, $regNum, $activity, $additionalActivity, $surname, $name, $patronymic, $email, $tel, $jurAddr, $actAddr, $texation, $headCount, $note, $date) {
		$this->title = self::checkData($title);
		$this->regNum = self::checkData($regNum);
		$this->activity = self::checkData($activity);
		$this->additionalActivity = self::checkData($additionalActivity);
		$this->surname = self::checkData($surname);
		$this->name = self::checkData($name);
		$this->patronymic = self::checkData($patronymic);
		$this->email = self::checkData($email);
		$this->tel = self::checkData($tel);
		$this->jurAddr = self::checkData($jurAddr);
		$this->actAddr = self::checkData($actAddr);
		$this->taxation = self::checkData($texation);
		$this->headCount = self::checkData($headCount);
		$this->note = self::checkData($note);
		$this->date = self::checkData($date);
		$this->state = 0;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function insertStatement(\PDO $pdo) {
		$stmt = $pdo->prepare("INSERT INTO statements (title, regNum, activity, additionalActivity, surname, name, patronymic, email, tel, jurAddr, actAddr, taxation, headCount, note, date, state) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$result = $stmt->execute(array($this->title, $this->regNum, $this->activity, $this->additionalActivity, $this->surname, $this->name, $this->patronymic, $this->email, $this->tel, $this->jurAddr, $this->actAddr, $this->taxation, $this->headCount, $this->note, $this->date, $this->state));
		if (!$result) {
			throw new \Exception("Ошибка базы данных. Данные не приняты");
		}
		$this->id = $pdo->lastInsertId();
	}
	
	public function sendStatement($agents = null) {
		$to = "admin@sp-dnr.ru";
		$subject = "Новая заявка на вступление в Союз";
		$subject ='=?utf-8?B?'. base64_encode($subject).'?=';
		$headers  = "Content-type: text/html; charset=utf-8 \r\n";
		$headers .= "From: <newapplication@sp-dnr.ru>\r\n";
		$message = "<html>
					<head>
					<style>body { font-family: Arial; font-size:13px; }</style>
					</head>
					<body>
						<strong>Название предприятия:</strong> ".$this->title."<br>
						<strong>Регистрационный номер или ИНН предпринимателя:</strong> ".$this->regNum."<br>
						<strong>Основной род деятельности:</strong> ".$this->activity."<br>
						<strong>Дополнительный род деятельности:</strong> ".$this->additionalActivity."<br>
						<strong>Средняя численность персонала:</strong> ".$this->headCount."<br><br>
						<strong>Руководитель:</strong><br>
						<strong>Фамилия:</strong> ".$this->surname."<br>
						<strong>Имя:</strong> ".$this->name."<br>
						<strong>Отчество:</strong> ".$this->patronymic."<br>
						<strong>E-Mail:</strong> ".$this->email."<br>
						<strong>Телефон:</strong> ".$this->tel."<br><br>
						<strong>Представители:</strong><br>";
						foreach ($agents as $agent) {
							$message .= "<strong>Фамилия:</strong> ".$agent->surname."<br>
							<strong>Имя:</strong> ".$agent->name."<br>
							<strong>Отчество:</strong> ".$agent->patronymic."<br>
							<strong>E-Mail:</strong> ".$agent->email."<br>
							<strong>Телефон:</strong> ".$agent->tel."<br><br>";
						}
						$message .= "<strong>Юридический адрес:</strong> ".$this->jurAddr."<br>
						<strong>Фактический адрес:</strong> ".$this->actAddr."<br>
						<strong>Примечания, интересующие вопросы:</strong> ".$this->note."
					</body>
					</html>";
		$result = mail($to, $subject, $message, $headers);
		if ($result) {
			echo "Ваша заявка принята на рассмотрение";
		} else {
			echo "Ошибка! Заявка не отправлена, повторите попытку.";
		}
	}
	
	public static function checkData($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED | ENT_SUBSTITUTE, 'UTF-8');
		return $data;
	}
}

?>