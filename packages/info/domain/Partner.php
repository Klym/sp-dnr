<?php

namespace info\domain;
require_once("DomainObject.php");

class Partner extends DomainObject {
	private $address;
	private $email;
	private $tel1;
	private $tel2;
	private $img;
	private $bannerFlag;
	
	function __construct($id, $title, $text, $address, $email, $tel1, $tel2, $img, $bannerFlag) {
		parent::__construct($id, $title, $text);
		$this->address = $address;
		$this->email = $email;
		$this->tel1 = $tel1;
		$this->tel2 = $tel2;
		$this->img = $img;
		$this->bannerFlag = $bannerFlag;
	}
	
	public function getAddress() {
		return $this->address;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function getTel1() {
		return $this->tel1;		
	}
	
	public function getTel2() {
		return $this->tel2;		
	}
	
	public function getImg() {
		return $this->img;
	}
	
	public function getBannerFlag(){
		return $this->bannerFlag;
	}
}

?>