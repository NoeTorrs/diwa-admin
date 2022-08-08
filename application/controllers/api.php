<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('main_m');
		$this->load->library('awslib');
	}

	public function getProvince(){
		$res = $this->main_m->getProvince($_GET["regionPSGC"]);
		echo json_encode($res);
	}


	public function getMunicity(){
		$res = $this->main_m->getMunicity($_GET["provincePSGC"]);
		echo json_encode($res);
	}
	
	public function getBarangay(){
		$res = $this->main_m->getBarangay($_GET["municityPSGC"]);
		echo json_encode($res);
	}

	public function addUser(){
		$step1 = $this->awslib->createUser($_POST["email"]);
		if(!isset($step1["message"])){
			if($step1["@metadata"]["statusCode"]===200){
				$step2 = $this->awslib->setUserPassword($_POST["email"]);
				$step3 = $this->main_m->addUser($_POST);
				$step4 = $this->awslib->getUser($_POST["email"]);
				echo json_encode($step4);
			}	
		}
		else{
			echo json_encode($step1);
		}
	}

	public function getDetails(){
		$res = $this->main_m->getDetails($_POST);
		echo json_encode($res);
	}

	public function updateDetails(){
		$res = $this->main_m->updateDetails($_POST);
		echo json_encode($res);
	}



}