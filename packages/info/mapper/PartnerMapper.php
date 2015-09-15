<?php

namespace info\mapper;
require_once("DataMapper.php");

class PartnerMapper extends DataMapper {
	function __construct(\PDO $pdo) {
		$this->pdo = $pdo;
		$this->selectStmt = $this->pdo->prepare("SELECT * FROM partners WHERE id = ?");
		$this->selectAllStmt = $this->pdo->prepare("SELECT * FROM partners");
		$this->selectBannerStmt = $this->pdo->prepare("SELECT * FROM partners WHERE bannerFlag = 1");
	}
	
	function getBannerPartners() {
		$result = $this->selectBannerStmt->execute();
		if (!$result) {
			throw new \Exception("������ ���� ������. ������ �� ������� ��������� �� ������");
		}
		$collection = parent::getCollection($this->selectBannerStmt);
		return $collection;
	}
	
	protected function createObject(array $array) {
	$obj = new \info\domain\Partner($array["id"], $array["title"],$array["text"], $array["address"], $array["email"], $array["tel1"], $array["tel2"], $array["img"], $array["bannerFlag"]);
		return $obj;
	}
	
	protected function selectStmt() {
		return $this->selectStmt;
	}
	
	protected function selectAllStmt() {
		return $this->selectAllStmt;
	}
}

?>