<?php
require_once("../packages/info/mapper/NewsMapper.php");
$newsNavMapper = new info\mapper\NewsMapper($pdo);
if ($page == "news") {
	$categoryNavMapper = new info\mapper\CategoryMapper($pdo);
}
try {
	if ($page == "news") {
		$categories = $categoryNavMapper->findAll();
	}
	$newsCount = $newsNavMapper->getCount();
} catch(Exception $e) {
	die($e->getMessage());
}
?>
<div class="list-group navigation shadow">
    <a href="index.php" class="list-group-item <? if ($page == "index") echo "active"; ?>">
        <span class="glyphicon glyphicon-chevron-right pull-right"></span>
        Главная
    </a>
    <a href="news.php" class="list-group-item <? if ($page == "news" && !isset($_GET["type"])) echo "active"; ?>">
        <span class="badge"><?=$newsCount; ?></span>
        Новости
    </a>
    <? if ($page == "news") {
		foreach ($categories as $category) :
	?>
		<a href="news.php?type=<?=$category->getId(); ?>" class="list-group-item embeded <? if ($_GET["type"] == $category->getId()) echo "active"; ?>">
        	<span class="badge"><?=$news->getCount($category->getId()); ?></span>
        	<?=$category->getTitle(); ?>
    	</a>
    <?  endforeach; } ?>
</div>