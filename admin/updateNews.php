<?php
session_start();
include("blocks/check.php");
require("../blocks/connect.php");
require("../packages/info/mapper/NewsMapper.php");
require("../packages/info/domain/News.php");
require("../packages/info/domain/Category.php");
require("../packages/statement/Statement.php");

if (isset($_POST["id"]) && !empty($_POST["id"])) {$id = $_POST["id"];}
if (isset($_POST["title"]) && !empty($_POST["title"])) {$title = $_POST["title"];}
if (isset($_POST["type"]) && !empty($_POST["type"])) {$type = $_POST["type"];}
if (isset($_POST["text"]) && !empty($_POST["text"])) {$text = $_POST["text"];}

if (isset($id) && isset($title) && isset($type) && isset($text)) {
	$news = new info\mapper\NewsMapper($pdo);
	try {
		$newsItem = $news->find($id);
		$newsItem->setTitle(statement\Statement::checkData($title));
		$newsItem->setType($type);
		$newsItem->setText($text);
		if (!empty($_FILES["img"]["name"])) {
			$type = $_FILES["img"]["type"];
			$path = $_FILES["img"]["tmp_name"];
			$img = $newsItem->compressImg($path, $type);
			if (!empty($img)) {
				if ($newsItem->getImg() != "") {
					unlink("../content_imgs/news_logos/".$newsItem->getImg().".jpg");
				}
				$newsItem->setImg($img);
			}
		}
		$news->update($newsItem);
	} catch(Exception $e) {
		die($e->getMessage());
	}
	echo "<html><head><meta http-equiv='refresh' content='2; url=editNews.php?id=".$id."'>Новость успешно обновлена.</head></html>";;
} else {
	die("Вы ввели не все данные. Вернитесь и заполните все поля.");
}
?>