<?php
require("blocks/connect.php");
require("packages/info/domain/Document.php");
require("packages/info/domain/PageText.php");
require("packages/info/mapper/documents/AboutDocuments.php");
require("packages/info/mapper/PageTextMapper.php");

$textMapper = new info\mapper\PageTextMapper($pdo);
$documentsMapper = new info\mapper\documents\AboutDocuments($pdo);
try {
	$documents = $documentsMapper->getDocuments();
	$pageText = $textMapper->find(1);
} catch (Exception $e) {
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
                <div id="aboutCustomStyles">
                	<?=$pageText->getText(); ?>
				</div>
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
            <aside class="about">
				<div class="committeesListItem">
                    <div class="marker">
                        <div class="circle"></div>
                        <div class="line"></div>
                    </div> 
                    <div class="comText"><a href="about.php#">О Союзе</a></div>
                </div>
                <div class="committeesListItem">
                    <div class="marker">
                        <div class="circle"></div>
                        <div class="line"></div>
                    </div> 
                    <div class="comText"><a href="#">Контакты</a></div>
                </div>
                <div class="committeesListItem">
                    <div class="marker">
                        <div class="circle"></div>
                        <div class="line"></div>
                    </div> 
                    <div class="comText"><a href="partners.php">Партнеры</a></div>
                </div>
                <div class="committeesListItem">
                    <div class="marker">
                        <div class="circle"></div>
                        <div class="line"></div>
                    </div> 
                    <div class="comText"><a href="documents.php">Документы</a></div>
                </div>
            </aside>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>
