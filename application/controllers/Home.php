<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base {
    function __construct(){
        parent::__construct();
 
        $this->data['title']="HOME";
        $this->data['tab']="1";
        $this->data['subtitle']="Dashboard";
        $this->data['menu']=json_decode('[{"menu_id":"2","menu_name":"Dashboard","mob_href":"#","icon":"icon-bar-chart"},{"menu_id":"2","menu_name":"Active Ticket","mob_href":"#","icon":"icon-envelope-open"},{"menu_id":"2","menu_name":"Completed Ticket","mob_href":"#","icon":"icon-paper-clip"}]');
        if ( !isset($_SESSION['username']) ) {
            redirect('home/login');
        }
    }
	
    public function index(){
        
        //$this->tempe->load('',$this->themes.'/login',$this->data);
        //$this->load->view($this->themes.'/login',$this->data);
        //$this->load->view($this->themes.'/modul',$this->data);
        $this->dash();
    }
    public function login(){
        $this->load->view($this->themes.'/login',$this->data);
    }
    public function validate_login(){
        
    }
    public function dash(){
        //$this->data['menu']=$this->getmenu(0,'','','','0');
        $this->tempe->load($this->themes.'/modul',$this->themes.'/dashboard',$this->data);
    }
    public function error(){
        //$this->data['menu']=$this->getmenu(0,'','','','0');
        //$this->tempe->load($this->themes.'modul',$this->themes.'error',$this->data);
    }
}
