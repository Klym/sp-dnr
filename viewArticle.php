<?php
require("blocks/connect.php");
require("packages/info/mapper/NewsMapper.php");
require("packages/info/domain/News.php");
require("packages/info/domain/Category.php");

$news = new info\mapper\NewsMapper($pdo);
try {
	$newsItem = $news->find($_GET["id"]);
} catch(Exception $e) {
	die($e->getMessage());
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/scripts.js"></script>
<script src="js/Partners.js"></script>
<title>Союз Предпринимателей ДНР - Новости</title>
</head>
<body>
	<div id="wrapper" class="news">
    	<? include("blocks/header.php"); ?>
        <? $page = "news"; include("blocks/nav.php"); ?>
        <div id="news">
            <section class="view">
                <nav class="breadcrumbs">
                    <a href="index.php">Главная</a> /
                    <a href="news.php?type=<?=$newsItem->getType()->getId(); ?>"><?=$newsItem->getType()->getTitle(); ?></a> /
                    <span class="active"><?=$newsItem->getTitle(); ?></span>
                </nav>
                 <? if ($newsItem->getType()->getId() == 2) { ?>
                    <button id="eventReg">
                        <div id="pen"></div>
                        <div id="eventRegText"><p>Регистрация на мероприятие</p></div>
                    </button>
				<? } ?>
                <article class="view">
                	<div class="newsTitle"><?=$newsItem->getTitle(); ?></div>
					<div class="newsInfo">Добавлено <?=$newsItem->getDate(); ?> | <span class="eye"><img src="img/eye.png" width="28" height="20" alt="Просмотры"></span> <?=$newsItem->getViews(); ?> <span class="pull-right">| <?=$newsItem->getType()->getTitle(); ?></span></div>
                    <p><?=$newsItem->getText(); ?></p>
                </article>
            </section>
            <aside>
                <? include("blocks/filter.php"); ?>
            </aside>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>
