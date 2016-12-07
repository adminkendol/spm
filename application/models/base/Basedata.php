<?php 

/* 
 * Author: chandra.
 * date created : 2016-08-17
 * class API models.
 */

class Basedata extends CI_Model {
    function __construct(){
	parent::__construct();
    }

    public function menu($par=0,$id='',$offset,$limit,$order){
        if($par==1){
            $and="AND sm.parent_id=0";
        }else{
            $and="";
        }
        if($id!=''){
            $and2="AND sm.menu_id='$id'";
        }else{
            $and2="";
        }
        if($limit!=""){
            $lim="limit ".$offset.",".$limit;
        }else{
            $lim="";
        }
        if($order=='1'){
            $odr="ORDER BY sm.parent_id";
        }else{
            $odr="ORDER BY sm.position";
        }
	$query=$this->db->query("SELECT sm.*,(SELECT sm1.menu_name FROM samsat_menu sm1 where sm1.menu_id=sm.parent_id) as parent_name FROM samsat_menu sm
                WHERE 1=1 $and $and2 $odr $lim");
        return $query->result();
    }
    
}
