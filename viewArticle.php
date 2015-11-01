<?php
require("blocks/connect.php");
require("packages/info/mapper/NewsMapper.php");
require("packages/info/domain/News.php");
require("packages/info/domain/Category.php");
require("packages/info/domain/Document.php");
require("packages/info/mapper/documents/NewsDocuments.php");

$news = new info\mapper\NewsMapper($pdo);
try {
	$newsItem = $news->find($_GET["id"]);
	$documents = $news->getDocuments($newsItem->getId());
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
                        <div id="eventRegText"><p><a href="applicationFormEvent.php">Регистрация на мероприятие</a></p></div>
                    </button>
				<? } ?>
                <article class="view">
                	<div class="newsTitle"><?=$newsItem->getTitle(); ?></div>
					<div class="newsInfo">Добавлено <?=$newsItem->getDate(); ?> | <span class="eye"><img src="img/eye.png" width="28" height="20" alt="Просмотры"></span> <?=$newsItem->getViews(); ?> <span class="pull-right">| <?=$newsItem->getType()->getTitle(); ?></span></div>
                    <div class="newsText">
	 	                <iframe src="ieFrame.php?id=<?=$newsItem->getId();?>" srcdoc="<style>body {font-family:Arial, Helvetica, sans-serif; font-size: 15px; font-weight: normal; color: #252424; line-height: 19px;}</style><?=$newsItem->getText();?>" width="100%" scrolling="no"></iframe>
					</div>
                </article>
                <? if (count($documents) > 0 ) foreach ($documents as $document) { ?>
                    <div class="document">
                        <a href="documents/<?=$document->getSrc(); ?>" class="save">
                        	<div><p><?=$document->getFormat(); ?></p></div>
						</a>
                        <div class="title">
                            <a href="documents/<?=$document->getSrc(); ?>"><p><?=$document->getTitle(); ?></p></a>
                            <div><p><?=$document->getDate(); ?></p></div>
                        </div>
                        <div class="description">
                            <p><?=$document->getDescription(); ?></p>
                        </div>
                    </div>
				<? } ?>
            </section>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>
