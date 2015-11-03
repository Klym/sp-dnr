<?php
require("blocks/connect.php");
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
if (isset($_POST["email"])) { $email = $_POST["email"]; }
if (isset($_POST["tel"])) { $tel = $_POST["tel"]; }
if (isset($_POST["jurAddr"])) { $jurAddr = $_POST["jurAddr"]; }
if (isset($_POST["actAddr"])) { $actAddr = $_POST["actAddr"]; }
if (isset($_POST["taxation"])) { $taxation = $_POST["taxation"]; }
if (isset($_POST["headCount"])) { $headCount = $_POST["headCount"]; }
if (isset($_POST["note"])) { $note = $_POST["note"]; }

if (isset($_POST["reprSurname"])) { $reprSurname[] = $_POST["reprSurname"]; }
if (isset($_POST["reprName"])) { $reprName[] = $_POST["reprName"]; }
if (isset($_POST["reprPatronymic"])) { $reprPatronymic[] = $_POST["reprPatronymic"]; }
if (isset($_POST["reprEmail"])) { $reprEmail[] = $_POST["reprEmail"]; }
if (isset($_POST["reprTel"])) { $reprTel[] = $_POST["reprTel"]; }

$statement = new statement\Statement($title, $regNum, $activity, $additionalActivity, $surname, $name, $patronymic, $email, $tel, $jurAddr, $actAddr, $taxation, $headCount, $note, date("Y-m-d H:i:s",time()));
try {
	$statement->insertStatement($pdo);
} catch (Exception $e) {
	die($e->getMessage());
}

for ($i = 0; $i < count($reprSurname[0]); $i++) {
	$agents[] = new statement\Agent($reprSurname[0][$i], $reprName[0][$i], $reprPatronymic[0][$i], $reprEmail[0][$i], $reprTel[0][$i], $statement->getId());
	try {
		$agents[$i]->insertAgent($pdo);
	} catch (Exception $e) {
		die($e->getMessage());
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="img/favicon.png">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/scripts.js"></script>
<script src="js/Partners.js"></script>
<title>Союз Предпринимателей ДНР - Заявка на регистрацию в Союзе Предпринимателей</title>
</head>
<body>
	<div id="wrapper" class="smallbg">
    	<? include("blocks/header.php"); ?>
        <? $page = "applicationForm"; include("blocks/nav.php"); ?>
        <section id="regSection">
            <header>
                <div class="parallelogram"></div>
                <div class="headerText">Заявка на регистрацию в Союзе Предпринимателей</div>
                <div class="regLine"></div>
            </header><br>
            <h1><? $statement->sendStatement($agents); ?></h1>
		</section>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>