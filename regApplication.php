<?php
require("packages/statement/Statement.php");
require("packages/statement/Agent.php");

if (empty($_POST)) die("Ошибка. Данные не были переданы");

if (isset($_POST["title"])) { $title = $_POST["title"]; }
if (isset($_POST["regNum"])) { $regNum = $_POST["regNum"]; }
if (isset($_POST["activity"])) { $activity = $_POST["activity"]; }
if (isset($_POST["additionalActivity"])) { $additionalActivity = $_POST["additionalActivity"]; }
if (isset($_POST["surname"])) { $surname = $_POST["surname"]; }
if (isset($_POST["name"])) { $name = $_POST["name"]; }
if (isset($_POST["patronymic"])) { $patronymic = $_POST["patronymic"]; }
if (isset($_POST["tel"])) { $tel = $_POST["tel"]; }
if (isset($_POST["jurAddr"])) { $jurAddr = $_POST["jurAddr"]; }
if (isset($_POST["actAddr"])) { $actAddr = $_POST["actAddr"]; }
if (isset($_POST["texation"])) { $texation = $_POST["texation"]; }
if (isset($_POST["headCount"])) { $headCount = $_POST["headCount"]; }
if (isset($_POST["note"])) { $note = $_POST["note"]; }
if (isset($_POST["state"])) { $state = $_POST["state"]; }

if (isset($_POST["reprSurname"])) { $reprSurname[] = $_POST["reprSurname"]; }
if (isset($_POST["reprName"])) { $reprName[] = $_POST["reprName"]; }
if (isset($_POST["reprPatronymic"])) { $reprPatronymic[] = $_POST["reprPatronymic"]; }
if (isset($_POST["reprEmail"])) { $reprEmail[] = $_POST["reprEmail"]; }
if (isset($_POST["reprTel"])) { $reprTel[] = $_POST["reprTel"]; }

$statement = new statement\Statement($title, $regNum, $activity, $additionalActivity, $surname, $name, $patronymic, $email, $tel, $jurAddr, $actAddr, $texation, $headCount, $note, time(), $state);

for ($i = 0; $i < count($reprSurname); $i++) {
	$agents[] = new statement\Agent($reprSurname[$i], $reprName[$i], $reprPatronymic[$i], $reprEmail[$i], $reprTel[$i], 0);
}

$statement->sendStatement($agents);

?>