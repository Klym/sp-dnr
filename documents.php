<?php
require("blocks/connect.php");
require("packages/info/mapper/CommitteesMapper.php");
require("packages/info/domain/Committees.php");
$comMapper = new \info\mapper\CommitteesMapper($pdo);
try {
	$committees = $comMapper->findAll();
	if (isset($_GET["id"])) {
		$committee = $comMapper->find($_GET["id"]);
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
<title>Союз Предпринимателей ДНР - Документы</title>
</head>
<body>
	<div id="wrapper" class="smallbg">
    	<? include("blocks/header.php"); ?>
        <? $page = "about"; include("blocks/nav.php"); ?>
       <div id="committees">
            <section class="documents">
            	<div class="document">
                	<a href="#" class="save"><div><p>docx</p></div></a>
                    <div class="title">
	                    <a href="#"><p>Устав Союза</p></a>
						<div><p>9 июня 2015 в 23:11</p></div>
					</div>
                    <div class="description">
                    	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    </div>
                </div>
                <div class="document">
                	<a href="#" class="save"><div><p>docx</p></div></a>
                    <div class="title">
	                    <a href="#"><p>Документ</p></a>
						<div><p>9 июня 2015 в 23:11</p></div>
					</div>
                    <div class="description">
                    	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    </div>
                </div>
            </section>
            <aside class="documents">
            	<div class="document">
                	<a href="#" class="save"><div><p>docx</p></div></a>
                    <div class="title">
	                    <a href="#"><p>Документ</p></a>
						<div><p>9 июня 2015 в 23:11</p></div>
					</div>
                    <div class="description">
                    	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    </div>
                </div>
                
                <div class="document">
                	<a href="#" class="save"><div><p>docx</p></div></a>
                    <div class="title">
	                    <a href="#"><p>Документ</p></a>
						<div><p>9 июня 2015 в 23:11</p></div>
					</div>
                    <div class="description">
                    	<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    </div>
                </div>
            </aside>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>
