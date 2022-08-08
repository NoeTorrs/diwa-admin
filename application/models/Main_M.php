<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_M extends CI_Model {
	function __construct()
	{
	    parent::__construct();
	}

    public function addUser($data){
        return $this->db->insert('tbl_user',$data);
    }

    public function getUjuris(){
        $this->db->where('userJurName !=',"superadmin");
        $result = $this->db->get("tbl_user_jurisdiction");
        return $result->result();
    }
    public function getRegion(){
        $result = $this->db->get("tbl_region");
        return $result->result();
    }

    public function getProvince($region){
        $this->db->where('regionPSGC',$region);
        $result = $this->db->get("tbl_province");
        return $result->result();
    }

    public function getMunicity($province){
        $this->db->where('provincePSGC',$province);
        $result = $this->db->get("tbl_municity");
        return $result->result();
    }

    public function getBarangay($municity){
        $this->db->where('municityPSGC',$municity);
        $result = $this->db->get("tbl_barangay");
        return $result->result();
    }

    public function getUtype(){
        $this->db->where('userTypeName !=',"superadmin");
        $result = $this->db->get("tbl_usertype");
        return $result->result();
    }

    public function getAgency(){
        $this->db->where('agencyName !=',"superadmin");
        $result = $this->db->get("tbl_agency");
        return $result->result();
    }

    public function getDetails($data){
        $this->db->where($data);
        $result = $this->db->get('tbl_user');
        return $result->result();
    }

    public function updateDetails($data){
        $this->db->where('email'.$data["email"]);
        $result = $this->db->update('tbl_user',$data);
        return $result->result();
    }


}
