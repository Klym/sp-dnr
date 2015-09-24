<?php
require("blocks/connect.php");
require("packages/info/domain/Document.php");
require("packages/info/mapper/documents/Documents.php");

$documentsMapper = new info\mapper\documents\Documents($pdo);
try {
	$documents = $documentsMapper->getDocuments();
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
<title>Союз Предпринимателей ДНР - Документы</title>
</head>
<body>
	<div id="wrapper" class="smallbg">
    	<? include("blocks/header.php"); ?>
        <? $page = "about"; include("blocks/nav.php"); ?>
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
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>