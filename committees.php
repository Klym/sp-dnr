<?php
require("blocks/connect.php");
require("packages/info/mapper/CommitteesMapper.php");
require("packages/info/domain/Committees.php");
require("packages/info/domain/Document.php");
require("packages/info/mapper/documents/CommitteesDocuments.php");

$comMapper = new \info\mapper\CommitteesMapper($pdo);
try {
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
	                    <p>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни. Однажды одна маленькая строчка рыбного текста по имени Lorem ipsum решила выйти в большой мир грамматики. Великий Оксмокс предупреждал ее о злых запятых, диких знаках вопроса и коварных точках с запятой, но текст не дал сбить себя с толку. Он собрал семь своих заглавных букв, подпоясал инициал за пояс и пустился в дорогу. Взобравшись на первую вершину курсивных гор, бросил он последний взгляд назад, на силуэт своего родного города Буквоград, на заголовок деревни Алфавит и на подзаголовок своего переулка Строчка. Грустный реторический вопрос скатился по его щеке и он продолжил свой путь. По дороге встретил текст рукопись. Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и». Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор.Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни.</p>
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
