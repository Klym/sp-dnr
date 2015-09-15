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
		echo "Отправка данных на почту";
	}
}

?>