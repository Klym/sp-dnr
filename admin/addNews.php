<?php
session_start();
include("blocks/check.php");
require("../blocks/connect.php");
$page = "news";
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
<script src="ckeditor/ckeditor.js"></script>
<title>Админ Панель - Добавление новости</title>
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
                              <h3 class="panel-title">Добавление новости</h3>
                          </div>
                          <div class="panel-body">
                            <div class="row">
                             <form enctype="multipart/form-data" class="form-horizontal form" name="updateForm" method="post" action="insertNews.php">
                              <div class="form-group">
                                <label for="dataTitle" class="col-sm-2 control-label">Название</label>
                                <div class="col-sm-4">
                                  <input type="text" name="title" class="form-control" id="dataTitle" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="dataCat" class="col-sm-2 control-label">Категория</label>
                                <div class="col-sm-3">
                                    <select class="form-control" id="dataCat" name="type">
                                    	<? foreach ($categories as $category) : ?>
                                        	<option value="<?=$category->getId(); ?>"><?=$category->getTitle(); ?></option>
                                        <? endforeach; ?>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="catDescription" class="col-sm-2 control-label">Текст</label>
                                <div class="col-sm-10">
                                    <textarea name="text" id="text" name="text"></textarea>
									<script type="text/javascript">
	                                    CKEDITOR.replace('text');
                                    </script>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="dataImg" class="col-sm-2 control-label">Изображение</label>
                                <div class="col-sm-4">
                                  <input type="file" name="img" id="dataImg">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <input type="submit" class="btn btn-primary" value="Добавить">
                                </div>
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>