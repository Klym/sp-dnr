<?php
session_start();
include("blocks/check.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="Bootstrap/styles/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="Bootstrap/js/jquery-1.11.1.min.js"></script>
<script src="Bootstrap/js/bootstrap.min.js"></script>
<title>Админ Панель - Главная страница</title>
</head>
<body>
	<?php include("blocks/navbar.php"); ?>
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <?php include("blocks/nav.php"); ?>
            </div>
            <div class="col-md-9">
                
            </div>
        </div>
    </div>
</body>
</html>