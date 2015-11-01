<?php
session_start();
include("blocks/check.php");
require("../blocks/connect.php");
require("../packages/info/mapper/NewsMapper.php");
require("../packages/info/domain/News.php");
require("../packages/info/domain/Category.php");
require("../packages/pagination/Pagination.php");
$page = "news";
$selected = isset($_GET["page"]) ? $_GET["page"] : 0;
$news = new info\mapper\NewsMapper($pdo);
try {
	$limitNews = $news->getData($selected, $_GET["type"]);
	$count = $news->getCount($_GET["type"]);
} catch(Exception $e) {
	die($e->getMessage());
}
$pagination = new pagination\Pagination($count, $selected);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="Bootstrap/styles/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="Bootstrap/js/jquery-1.11.1.min.js"></script>
<script src="Bootstrap/js/bootstrap.min.js"></script>
<script src="../js/scripts.js"></script>
<script src="js/del.js"></script>
<title>Админ Панель - Новости</title>
</head>
<body>
	<?php include("blocks/navbar.php"); ?>
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <?php include("blocks/nav.php"); ?>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-success" ng-controller="newsCtrl">
                          <div class="panel-heading">
                              <h3 class="panel-title">Редактирование новостей</h3>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success">Добавить &nbsp;<span class="glyphicon glyphicon-plus"></span></button>
                                </div>
                                <div class="col-md-9 pull-right">
                                    <?php include("blocks/pagination.php"); ?>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover" >
                              <thead>
                                  <tr>
                                    <th>Название <span class="pull-right"></span></th>
                                    <th>Категория <span class="pull-right"></span></th>
                                    <th>Дата <span class="pull-right"></span></th>
                                    <th>Действие</th>
                                  </tr>
                              </thead>
                              <? if (!empty($limitNews)) {
								foreach ($limitNews as $newsItem) : ?> 
                                  <tr>
                                       <td><?=$newsItem->getTitle(); ?></td>
                                       <td><?=$newsItem->getType()->getTitle(); ?></td>
                                       <td><?=$newsItem->getDate(); ?></td>
                                       <td style="text-align:center; vertical-align:middle;">
                                            <a href="editNews.php?id=<?=$newsItem->getid(); ?>">
                                                <button class="btn btn-default btn-xs">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                </button>
                                            </a>
                                            &nbsp;
                                            <button class="btn btn-default btn-xs" onClick="del(<?=$newsItem->getId()?>, this)">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                       </td>
                                    </tr>
								<? endforeach; } ?>
                            </table>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>