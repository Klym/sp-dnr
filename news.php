<?php
require("blocks/connect.php");
require("packages/info/mapper/NewsMapper.php");
require("packages/info/domain/News.php");
require("packages/info/domain/Category.php");

$news = new info\mapper\NewsMapper($pdo);
try {
	$limitNews = $news->getLmitData();
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
            <section>
                <? foreach ($limitNews as $newsItem) : ?>
                    <article>
                        <div class="newsTitle"><?=$newsItem->getTitle(); ?></div>
                        <div class="newsImg"><img src="img/newsImg.jpg" width="380" height="160" alt="Изображение новости"></div>
                        <div class="newsInfo">Добавлено <?=$newsItem->getDate(); ?> | <span class="eye"><img src="img/eye.png" width="28" height="20" alt="Просмотры"></span> <?=$newsItem->getViews(); ?> | <?=$newsItem->getType()->getTitle(); ?></div>
                        <p><?=$newsItem->getShortText(); ?><br><p><a href="viewArticle.php?id=<?=$newsItem->getId(); ?>">Читать далее...</a></a></p>
                    </article>
                <? endforeach; ?>
                <nav class="pagination">
                	<ul>
                    	<a><li>&larr;&nbsp;Первая</li></a>
                    	<a><li>&laquo;</li></a>
                    	<a><li >1</li></a>
                        <a><li>2</li></a>
                        <a><li class="active">3</li></a>
                        <a><li>4</li></a>
                        <a><li>5</li></a>
                        <a><li>6</li></a>
                        <a><li>7</li></a>
                        <a><li>8</li></a>
                        <a><li>9</li></a>
                        <a><li>10</li></a>
                        <a><li>11</li></a>
                        <a><li>&raquo;</li></a>
                        <a><li>Последняя&nbsp;&rarr;</li></a>
                    </ul>
                </nav>
            </section>
            <aside>
                <? include("blocks/filter.php"); ?>
            </aside>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>
