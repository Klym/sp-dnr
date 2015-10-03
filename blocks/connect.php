<?php
define('__ROOT__', dirname(dirname(__FILE__))); 
require(__ROOT__."/packages/database/Db.php");
$db = database\Db::getInstance();
$db->setDb("localhost", "klym", "2517", "sp-dnr");
$pdo = $db->getDb();
?>