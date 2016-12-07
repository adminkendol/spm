<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Controller extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        //do whatever you want to do when object instantiate
    }
}
class Base extends CI_Controller {

    //private $basedata;

    function __construct(){
        session_start(); //mengadakan session
	parent::__construct();
	$this->load->helper('url');
        //$this->load->model(array('base/basedata'));
        $this->themes=$this->config->config['themes'];
    }
    /*public function getmenu($par=0,$id,$offset,$limit,$order) {
        $get_menu = $this->basedata->menu($par,$id,$offset,$limit,$order);
	return $get_menu;
    }*/
    /*-------------------komponen-----------------------------*/
    
}
