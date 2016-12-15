<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Proccess extends CI_Model {
    function __construct(){
	parent::__construct();
    }
    public function insert_report($data){
        $this->db->insert('report', $data);
    }
    public function select_dash(){
        $query=$this->db->query("select * from dashboard where regional='Jabodetabek'");
            return $query->result();
    }     
}        
