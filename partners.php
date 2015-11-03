<?php
require("blocks/connect.php");
require("packages/info/mapper/PartnerMapper.php");
require("packages/info/domain/Partner.php");

$partnerMapper = new info\mapper\PartnerMapper($pdo);
try {
	$partners = $partnerMapper->findAll();
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
<title>Союз Предпринимателей ДНР - Партнеры</title>
</head>
<body>
	<div id="wrapper" class="smallbg">
    	<? include("blocks/header.php"); ?>
        <? $page = "about"; include("blocks/nav.php"); ?>
        <div id="partnersPage">
            <section class="partners">
            	<header>
                	<div class="parallelogram"></div>
                	<div class="headerText partners">НАШИ ПАРТНЕРЫ</div>
                </header>
                <div id="partnersContent">
					<? foreach($partners as $partner) : ?>
						<div class="aboutBody">
							<div class="aboutLogo"><img src="partners/<?=$partner->getImg(); ?>" width="250" alt="<?=$partner->getTitle(); ?>"></div>
							<div class="aboutText">
								<p class="title"><?=$partner->getTitle(); ?></p><br>
								<p><?=$partner->getText(); ?></p><br>
							</div>
							<div class="aboutContacts">
								<p class="title">Контакты:</p><br>
								<address><p><?=$partner->getAddress(); ?></p></address>
								<p>Телефон: <?=$partner->getTel1(); ?></p>
								<p>Телефон: <?=$partner->getTel2(); ?></p>
								<p>E-mail: <?=$partner->getEmail(); ?></p><br>
							</div>						
						</div>
					<? endforeach; ?>
				</div>
            </section>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>