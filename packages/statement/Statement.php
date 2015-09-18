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
	private $texation;
	private $headCount;
	private $note;
	private $date;
	private $state;
	
	function __construct($title, $regNum, $activity, $additionalActivity, $surname, $name, $patronymic, $email, $tel, $jurAddr, $actAddr, $texation, $headCount, $note, $date, $state) {
		$this->title = $title;
		$this->regNum = $regNum;
		$this->activity = $activity;
		$this->additionalActivity = $additionalActivity;
		$this->surname = $surname;
		$this->name = $name;
		$this->patronymic = $patronymic;
		$this->email = $email;
		$this->tel = $tel;
		$this->jurAddr = $jurAddr;
		$this->actAddr = $actAddr;
		$this->texation = $texation;
		$this->headCount = $headCount;
		$this->note = $note;
		$this->date = $date;
		$this->state = $state;
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
}

?>