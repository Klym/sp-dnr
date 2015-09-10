<?php
require("blocks/connect.php");
require("packages/info/mapper/NewsMapper.php");
require("packages/info/domain/News.php");
require("packages/info/domain/Category.php");

$news = new info\mapper\NewsMapper($pdo);
try {
	$latestNews = $news->getLatestData();
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
                	<p><img src="img/articleLogo.jpg" width="123" height="98" alt="Логотип статьи"></p>
                    <div class="articleTitle"><p><?=$newsItem->getTitle(); ?></p></div>
                    <div class="articleDate"><p><?=$newsItem->getDate(); ?></p></div>
                    <p><?=$newsItem->getShortText(); ?><a href="viewArticle.php?id=<?=$newsItem->getId(); ?>">Читать далее...</a></p>
                </div>
                <footer>
                	<p><a href="news.php?id=<?=$newsItem->getType()->getId(); ?>">Перейти к категории "<?=$newsItem->getType()->getTitle(); ?>"</a></p>
				</footer>
            </article>
            <? endforeach; ?>
        </section>
        <div id="partners">
        	<header>
            	<span class="title">Партнеры Союза Предпринимателей »</span>
			</header>
            <div id="partnersBody">
            	<div id="prev"></div>
                <div id="banners">
                	<a href="#"><img src="partners/amd.jpg"></a>
                    <a href="#"><img src="partners/hp.jpg"></a>
                    <a href="#"><img src="partners/oracle.jpg"></a>
                    <a href="#"><img src="partners/actvis.jpg"></a>
                </div>
                <div id="next"></div>
            </div>
        </div>
        <div id="about">
        	<header>
            	<span class="title">О Союзе Предпринимателей »</span>
			</header>
            <div id="aboutBody">
            	<div id="aboutLogo"><img src="img/aboutLogo.jpg" width="250" height="199" alt="О Союзе"></div>
                <div id="aboutText">
                	<p class="title">Союз Предпринимателей Донецкой Народной Республики -</p><br>
                	<p>Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель</p><br>
                    <p class="link"><a href="#">Подробно</a></p>
                </div>
                <div id="aboutContacts">
                	<p class="title">Контакты:</p><br>
                    <address><p>109240, ул. Лермонтова, 25. Донецк, ДНР</p></address>
					<p>Телефон: +38 071 555 22 22</p>
					<p>E-mail: sp-dnr@mail.ru</p><br>
					<p><i>Схема проезда на карте</i></p>
                    <p class="link"><a href="#">Дополнительно</a></p>
                </div>
            </div>
        </div>
        <div id="reg">
        	<header>
            	<span class="title">Стать членом Союза Предпринимателей»</span>
			</header>
            <div id="regText">
	            <p>Для того чтобы стать членом Союза Предпринимателей перейдите <a href="applicationForm.php">по этой ссылке</a> и заполните форму.</p>
           	</div>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>