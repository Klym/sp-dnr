<?php
require("blocks/connect.php");
require("packages/info/mapper/CommitteesMapper.php");
require("packages/info/domain/Committees.php");
require("packages/info/domain/Document.php");
require("packages/info/mapper/documents/CommitteesDocuments.php");
require("packages/info/domain/PageText.php");
require("packages/info/mapper/PageTextMapper.php");

$textMapper = new info\mapper\PageTextMapper($pdo);
$comMapper = new \info\mapper\CommitteesMapper($pdo);
try {
	$pageText = $textMapper->find(2);
	$committees = $comMapper->findAll();
	if (isset($_GET["id"])) {
		$committee = $comMapper->find($_GET["id"]);
		$documents = $comMapper->getDocuments($committee->getId());
	}
} catch (Exception $e) {
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
<title>Союз Предпринимателей ДНР - <?=(!isset($_GET["id"])) ? "Комитеты" : $committee->getTitle(); ?></title>
</head>
<body>
	<div id="wrapper" class="smallbg">
    	<? include("blocks/header.php"); ?>
        <? $page = "committees"; include("blocks/nav.php"); ?>
        <div id="committees">
            <section>
            	<header>
                	<div class="parallelogram"></div>
                	<div class="headerText"><?=(!isset($_GET["id"])) ? "КОМИТЕТЫ" : $committee->getTitle(); ?></div>
                </header>
                <div class="committeesText">
                	<? if (!isset($_GET["id"])) { ?>
	                    <?=$pageText->getText(); ?>
                        <br>
                        <? foreach($committees as $comm) : ?>
						<article>
                            <div class="committeesTitle">
                                <a href="viewArticle.php?id=<?=$comm->getId(); ?>"><?=$comm->getTitle(); ?></a>
                            </div>
                            <p><?=$comm->getShortText(); ?><br><p><a href="committees.php?id=<?=$comm->getId(); ?>">Читать далее...</a></p>
                        </article>
                        <? endforeach; ?>
					<? } else { ?>
                    	<p><?=$committee->getText(); ?></p>
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
                    <? } ?>
				</div>
            </section>
            <aside>
            	<? foreach($committees as $comm) : ?>
                    <div class="committeesListItem <?=($_GET["id"] == $comm->getId()) ? "active" : ""; ?>">
                        <div class="marker">
                            <div class="circle"></div>
                            <div class="line"></div>
                        </div> 
                        <div class="comText"><a href="committees.php?id=<?=$comm->getId(); ?>"><?=$comm->getTitle(); ?></a></div>
                    </div>
				<? endforeach; ?>                    
            </aside>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>
