<?php
session_start();
include("blocks/check.php");
require("../blocks/connect.php");
require("../packages/info/mapper/NewsMapper.php");
require("../packages/info/domain/News.php");
require("../packages/info/domain/Category.php");

if (isset($_GET["id"]) && !empty($_GET["id"])) {$id = $_GET["id"];}

$newsMapper = new info\mapper\NewsMapper($pdo);
try {
	$newsMapper->deleteImg($id);
} catch (Exception $e) {
	die(json_encode(array("result" => $e->getMessage())));
}
echo json_encode(array("result" => "200 OK"));
?>