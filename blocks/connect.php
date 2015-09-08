<?php
include("Classes/Db.php");
$db = Db::getInstance();
$db->setDb("localhost", "klym", "2517", "sp-dnr");
$pdo = $db->getDb();
?>