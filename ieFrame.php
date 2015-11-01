<?php
require("blocks/connect.php");
require("packages/info/mapper/NewsMapper.php");
require("packages/info/domain/News.php");
require("packages/info/domain/Category.php");

$news = new info\mapper\NewsMapper($pdo);
try {
	$newsItem = $news->find($_GET["id"]);
} catch(Exception $e) {
	die($e->getMessage());
}
echo "<style>body { font-family: Arial, Helvetica, sans-serif;
					font-size: 15px;
					font-weight: normal;
					color: #252424;
					line-height: 19px;
				   }
	  </style>";
echo $newsItem->getText();
?>