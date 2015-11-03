<?php
require("blocks/connect.php");
require("packages/info/mapper/NewsMapper.php");
require("packages/info/mapper/PartnerMapper.php");
require("packages/info/mapper/documents/Documents.php");
require("packages/info/domain/News.php");
require("packages/info/domain/Category.php");
require("packages/info/domain/Partner.php");
require("packages/info/domain/Document.php");

$news = new info\mapper\NewsMapper($pdo);
$partners = new info\mapper\PartnerMapper($pdo);
$documentsMapper = new info\mapper\documents\Documents($pdo);
try {
	$latestNews = $news->getLatestData();
	$bannerPartners = $partners->getBannerPartners();
	$documents = $documentsMapper->getLatestDocuments();
} catch(Exception $e) {
	die($e->getMessage());
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
<title>Союз Предпринимателей ДНР - Главная</title>
</head>
<body>
	<div id="wrapper" class="main">
    	<? include("blocks/header.php"); ?>
        <? $page = "index"; include("blocks/nav.php"); ?>
        <section>
        	<? foreach($latestNews as $newsItem) : ?>
            <article>
            	<header><?=$newsItem->getType()->getTitle(); ?></header>
                <div class="articleBody">
                	<? if ($newsItem->getImg() != "") { ?>
	                    <p><img src="content_imgs/news_logos/<?=$newsItem->getImg(); ?>.jpg" width="123" alt="Логотип статьи"></p>
					<? } ?>
                    <div class="articleTitle"><p><?=$newsItem->getTitle(); ?></p></div>
                    <div class="articleDate"><p><?=$newsItem->getDate(); ?></p></div>
                    <p><?=$newsItem->getShortText(330); ?><a href="viewArticle.php?id=<?=$newsItem->getId(); ?>">Читать далее...</a></p>
                </div>
                <footer>
                	<p><a href="news.php?type=<?=$newsItem->getType()->getId(); ?>">Перейти к категории "<?=$newsItem->getType()->getTitle(); ?>"</a></p>
				</footer>
            </article>
            <? endforeach; ?>
        </section>
        <div id="partners">
        	<header>
            	<span class="title"><a href="partners.php">Партнеры Союза Предпринимателей »</a></span>
			</header>
            <div id="partnersBody">
            	<div id="prev"></div>
                <div id="banners">
                	<? foreach($bannerPartners as $banner) : ?>					
						<a href="#"><img src="partners/<?=$banner->getImg(); ?>"></a>
					<? endforeach; ?>
                </div>
                <div id="next"></div>
            </div>
        </div>
        <div id="about">
        	<header>
            	<span class="title"><a href="about.php">О Союзе Предпринимателей »</a></span>
			</header>
            <div class="aboutBody">
            	<div class="aboutLogo"><img src="img/aboutLogo.jpg" width="250" height="199" alt="О Союзе"></div>
                <div class="aboutText">
                	<p class="title">Союз Предпринимателей Донецкой Народной Республики -</p><br>
                	<p>Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель</p><br>
                    <p class="link"><a href="#">Подробно</a></p>
                </div>
                <div class="aboutContacts">
                	<p class="title">Контакты:</p><br>
                    <address><p>г.Донецк, ул.Артема, 97</p></address>
					<p>e-mail: spdpr2015@gmail.com</p>
					<p>+38 066 6958629, +38 093 3994405</p><br>
					<p><i>Схема проезда на карте</i></p>
                    <p class="link"><a href="#">Дополнительно</a></p>
                </div>
            </div>
        </div>
        <div id="reg">
        	<header>
            	<span class="title"><a href="applicationForm.php">Стать членом Союза Предпринимателей»</a></span>
			</header>
            <div id="regText">
	            <p>Для того чтобы стать членом Союза Предпринимателей перейдите <a href="applicationForm.php">по этой ссылке</a> и заполните форму.</p>
           	</div>
        </div>
        <div id="documents">
        	<header>
            	<span class="title"><a href="documents.php">Документы »</a></span>
			</header>
            <div id="committees">
                <section class="documents">
                    <? for ($i = 0; $i < count($documents); $i += 2) { ?>
                        <div class="document">
                            <a href="documents/<?=$documents[$i]->getSrc(); ?>" class="save">
                                <div><p><?=$documents[$i]->getFormat(); ?></p></div>
                            </a>
                            <div class="title">
                                <a href="documents/<?=$documents[$i]->getSrc(); ?>"><p><?=$documents[$i]->getTitle(); ?></p></a>
                                <div><p><?=$documents[$i]->getDate(); ?></p></div>
                            </div>
                            <div class="description">
                                <p><?=$documents[$i]->getDescription(); ?></p>
                            </div>
                        </div>
                    <? } ?>
                </section>
                <aside class="documents">
                    <? for ($i = 1; $i < count($documents) - 1; $i += 2) { ?>
                        <div class="document">
                            <a href="documents/<?=$documents[$i]->getSrc(); ?>" class="save">
                                <div><p><?=$documents[$i]->getFormat(); ?></p></div>
                            </a>
                            <div class="title">
                                <a href="documents/<?=$documents[$i]->getSrc(); ?>"><p><?=$documents[$i]->getTitle(); ?></p></a>
                                <div><p><?=$documents[$i]->getDate(); ?></p></div>
                            </div>
                            <div class="description">
                                <p><?=$documents[$i]->getDescription(); ?></p>
                            </div>
                        </div>
                    <? } ?>
                </aside>
			</div>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>