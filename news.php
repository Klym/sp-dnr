<?php
require("blocks/connect.php");
require("packages/info/mapper/NewsMapper.php");
require("packages/info/domain/News.php");
require("packages/info/domain/Category.php");
require("packages/pagination/Pagination.php");

$selected = isset($_GET["page"]) ? $_GET["page"] : 0;

$news = new info\mapper\NewsMapper($pdo);
try {
	$limitNews = $news->getData($selected, $_GET["type"], $_GET["from"], $_GET["to"]);
	$count = $news->getCount($_GET["type"], $_GET["from"], $_GET["to"]);
} catch(Exception $e) {
	die($e->getMessage());
}
$pagination = new pagination\Pagination($count, $selected);
$pagination->generate();
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
