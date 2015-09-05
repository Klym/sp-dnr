<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/scripts.js"></script>
<script src="js/Partners.js"></script>
<title>Союз Предпринимателей ДНР - Комитеты</title>
</head>
<body>
	<div id="wrapper" class="smallbg">
    	<? include("blocks/header.php"); ?>
        <? $page = "committees"; include("blocks/nav.php"); ?>
        <div id="committees">
            <section>
            	<header>
                	<div class="parallelogram"></div>
                	<div class="headerText">КОМИТЕТ</div>
                </header>
            </section>
            <aside>
                <div class="committeesListItem">
                	<div class="marker">
	                    <div class="circle"></div>
                        <div class="line"></div>
					</div> 
                    <div class="comText"><a href="#">Комитет №1</a></div>
                </div>
                <div class="committeesListItem active">
                	<div class="marker">
	                    <div class="circle"></div>
                        <div class="line"></div>
					</div>
                    <div class="comText"><a href="#">Комитет №2</a></div>
                </div>
                <div class="committeesListItem">
                	<div class="marker">
	                    <div class="circle"></div>
                        <div class="line"></div>
					</div>
                	<div class="comText"><a href="#">Комитет №3</a></div>
                </div>
                <div class="committeesListItem">
                	<div class="marker">
	                    <div class="circle"></div>
                        <div class="line"></div>
					</div>
                	<div class="comText"><a href="#">Комитет №4</a></div>
                </div>
            </aside>
        </div>
        <? include("blocks/footer.php"); ?>
    </div>
</body>
</html>
