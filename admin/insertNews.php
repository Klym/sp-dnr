<?php
session_start();
include("blocks/check.php");
require("../blocks/connect.php");
require("../packages/info/mapper/NewsMapper.php");
require("../packages/info/domain/News.php");
require("../packages/info/domain/Category.php");

if (isset($_POST["title"]) && !empty($_POST["title"])) {$title = $_POST["title"];}
if (isset($_POST["type"]) && !empty($_POST["type"])) {$type = $_POST["type"];}
if (isset($_POST["text"]) && !empty($_POST["text"])) {$text = $_POST["text"];}

if (isset($title) && isset($type) && isset($text)) {
	$news = new info\mapper\NewsMapper($pdo);
	try {
		$newsItem = new info\domain\News(0, $title, $text, 1, $type, 0, date("Y-m-d H:i:s"), "");
		if (!empty($_FILES["img"]["name"])) {
			$type = $_FILES["img"]["type"];
			$path = $_FILES["img"]["tmp_name"];
			$img = $newsItem->compressImg($path, $type);
			if (!empty($img)) {
				$newsItem->setImg($img);
			}
		}
		$news->insert($newsItem);
	} catch(Exception $e) {
		die($e->getMessage());
	}
	echo "<html><head><meta http-equiv='refresh' content='2; url=news.php'>Новость успешно добавлена.</head></html>";;
} else {
	die("Вы ввели не все данные. Вернитесь и заполните все поля.");
}
?>