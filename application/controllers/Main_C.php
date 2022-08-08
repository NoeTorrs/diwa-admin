<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_C extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Main_M','main_m');
		$this->load->library('awslib');

	}
	public function index()
	{
		// if($this->session->userdata('logged')){
		// 	$type = $this->session->userdata('type');
		// 	if($type=="Admin"){
		// 		redirect(base_url().'/Main_C/manage_user');
		// 	}
		// 	else{
				redirect(base_url().'Main_C/dashboard');
	// 		}
	// 	}
	// 	else{
	// 		$this->load->view('login');
	// 	}
	}

	public function dashboard(){
	
		// $result["Users"][0]["Attributes"][0]["Value"]
		// $data = $this->awslib->getdata('ap-south-1','AKIA2W5CXRAPNGV24GHF','/9wBIVmDj0ij7QXFkx+nbMVI5KI+vOSopEp0IgoN','ap-south-1_3RbfUWs9p','1o1culjmds5m3i04f0dc3f42ln','1hkjrknipcgtprfuqr681i4u6kkbfclqk6r97ob8qmovnvtp3nsp');
		// var_dump($data);
		// if($this->session->userdata('logged') && $this->session->userdata('type')!="Admin"){
		// 	$hdata['user'] = $this->session->userdata();
		// 	$data["personnel"] = $this->main_m->getSchedule();
		// 	$data["area"] = $this->main_m->getSchedArea();
		
		 	$hdata["button"] = "";
			$hdata["page"] = ""; 
			$this->load->view('header');
			$this->load->view('dashboard');
			$this->load->view('footer');
		// }
		// else{
		// 	redirect(base_url());
		// }
	}

	public function logout(){
		// $this->session->sess_destroy();
		redirect(base_url());
	}

	public function manage_user(){
		#return var_dump( $this->session->userdata());
		// if($this->session->userdata('logged') && $this->session->userdata('type')=="Admin"){
		// 	$hdata['user'] = s
		

		$upool = $this->awslib->getdata();
		// $data = $this->model_m->getUsers();
		$data["users"] = $upool;
		$data["userjuris"] = $this->main_m->getUjuris();
		$data["region"] = $this->main_m->getregion();
		$data["utype"] = $this->main_m->getUtype();
		$data["agency"] = $this->main_m->getAgency();
		$data["userlogged"] = "noetrrs29@gmail.com";
		$hdata["page"] = "mgu";
		$this->load->view('header',$hdata);
		$this->load->view('manage_users',$data);
		$this->load->view('footer');
		// }
		// else{
		// 	redirect(base_url());
		// }
	}
	
}