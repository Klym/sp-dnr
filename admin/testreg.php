<?php
session_start();
require("../blocks/connect.php");
require("../packages/statement/Statement.php");
require("packages/moderators/Moderator.php");

if (isset($_SESSION["login"])) {
	header("Location: index.php");
}

if (isset($_POST["login"]) && !empty($_POST["login"])) {$login = $_POST["login"];}
if (isset($_POST["password"]) && !empty($_POST["password"])) {$password = $_POST["password"];}

if (isset($login) && isset($password)) {
	$password = statement\Statement::checkData($password);
	$password = strrev(md5($password));

	$moderator = new moderators\Moderator($pdo);
	try {
		$moderator->checkUser(statement\Statement::checkData($login), $password);
		$_SESSION = $moderator->serialize();
		echo "<html><head><meta http-equiv='refresh' content='0; url=index.php'></head></html>";
	} catch (Exception $e) {
		die($e->getMessage());
	}
} else {
	die("<html><head><meta http-equiv='refresh' content='2; url=login.php'></head>Вы не ввели не всю информацию, вернитесь и заполните все поля.</html>");
}
?>