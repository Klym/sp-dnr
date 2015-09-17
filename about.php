<?php
require("blocks/connect.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/scripts.js"></script>
<script src="js/Partners.js"></script>
<title>Союз Предпринимателей ДНР - О Союзе Предпринимателей</title>
</head>
<body>
	<div id="wrapper" class="smallbg">
    	<? include("blocks/header.php"); ?>
        <? $page = "about"; include("blocks/nav.php"); ?>
        <div id="committees">
            <section class="about">
            	<header>
                	<div class="parallelogram"></div>
                	<div class="headerText about">О СОЮЗЕ ПРЕДПРИНИМАТЕЛЕЙ</div>
                </header>
                <div class="committeesText">
                	<!-- Хардкоженый текст о союзе -->
					
				</div>
            </section>
            <aside class="about">
				<!-- Right block -->
				<ul>
					<li><a href="#">О Союзе Предпринимателей</a></li>
					<li><a href="#">Контакты</a></li>
					<li><a href="partners.php">Партнеры</a></li>
				</ul>				
            </aside>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>
