<?php
require("blocks/connect.php");
require("packages/info/mapper/NewsMapper.php");
require("packages/info/domain/News.php");
require("packages/info/domain/Category.php");
require("packages/pagination/Pagination.php");

$selected = isset($_GET["page"]) ? $_GET["page"] : 0;
if (!isset($_GET["startYear"]) || !isset($_GET["startMonth"]) || !isset($_GET["startDay"])) {
	$from = null;
} else {
	$from = $_GET["startYear"]."-".$_GET["startMonth"]."-".$_GET["startDay"];
}

if (!isset($_GET["endYear"]) || !isset($_GET["endMonth"]) || !isset($_GET["endDay"])) {
	$to = null;
} else {
	$to = $_GET["endYear"]."-".$_GET["endMonth"]."-".$_GET["endDay"];
}
$news = new info\mapper\NewsMapper($pdo);
try {
	$limitNews = $news->getData($selected, $_GET["type"], $from, $to);
	$count = $news->getCount($_GET["type"], $from, $to);
} catch(Exception $e) {
	die($e->getMessage());
}
$pagination = new pagination\Pagination($count, $selected);
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
<title>Союз Предпринимателей ДНР - Новости</title>
</head>
<body>
	<div id="wrapper" class="news">
    	<? include("blocks/header.php"); ?>
        <? $page = "news"; include("blocks/nav.php"); ?>
        <div id="news">
            <section>
            	<? 	if (!empty($limitNews)) {
					foreach ($limitNews as $newsItem) : ?>
                    <article>
                    	<div class="articleBody">
                        	<? if ($newsItem->getImg() != "") { ?>
                            	<div class="newsImg">
                                    <a href="viewArticle.php?id=<?=$newsItem->getId(); ?>">
                                        <img src="content_imgs/news_logos/<?=$newsItem->getImg(); ?>.jpg" width="280" alt="Изображение новости">
                                    </a>
                                </div>
                            <? } ?>
                            <div>
                                <div class="newsTitle">
                                    <a href="viewArticle.php?id=<?=$newsItem->getId(); ?>"><?=$newsItem->getTitle(); ?></a>
                                </div>
                                <p><?=$newsItem->getShortText(760); ?><br><p><a href="viewArticle.php?id=<?=$newsItem->getId(); ?>">Читать далее...</a></p>
							</div>
                            <div class="clear"></div>
						</div>
						<div class="newsInfo">Добавлено <?=$newsItem->getDate(); ?> | <span class="eye"><img src="img/eye.png" width="22" alt="Просмотры"></span> <?=$newsItem->getViews(); ?><span class="type"><?=$newsItem->getType()->getTitle(); ?></span></div>
                    </article>
                <? endforeach; } ?>
                <nav class="pagination">
                	<ul>
                    	<a href="news.php?page=0" <?=$pagination->isPrevDisabled(); ?>>
                        	<li>&larr;&nbsp;Первая</li>
						</a>
                    	<a href="news.php?page=<?=$pagination->getPrev(); ?>" <?=$pagination->isPrevDisabled(); ?>>
                        	<li>&laquo;</li>
						</a>
						<? for ($c = 0, $i = $pagination->getFrom(); $c < $pagination->count; $i++, $c++) { ?>
                            <a href="news.php?page=<?=$i; ?>">
                                <li <?=($pagination->getSelected() == $i) ? "class=\"active\"" : 0; ?>><?=($i + 1); ?></li>
                            </a>
                        <? } ?>
                        
                        <a href="news.php?page=<?=$pagination->getNext(); ?>" <?=$pagination->isNextDisabled(); ?>>
                        	<li>&raquo;</li>
						</a>
                        <a href="news.php?page=<?=$pagination->toEnd(); ?>" <?=$pagination->isNextDisabled(); ?>>
                        	<li>Последняя&nbsp;&rarr;</li>
						</a>
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
