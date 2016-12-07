<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends Base
{
    function __construct()
    {
        parent::__construct();
        // load helper dan library
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        //$this->data['menu']=json_decode('[{"menu_id":"2","menu_name":"Dashboard","mob_href":"#","icon":"icon-bar-chart"},{"menu_id":"2","menu_name":"Active Ticket","mob_href":"#","icon":"icon-envelope-open"},{"menu_id":"2","menu_name":"Completed Ticket","mob_href":"#","icon":"icon-paper-clip"}]');
        $this->data['menu']=json_decode('[{"menu_id":"2","menu_name":"Dashboard","mob_href":"#","icon":"icon-bar-chart"},{"menu_id":"2","menu_name":"Upload","mob_href":"#","icon":"icon-envelope-open"}]');
    }

    public function index($error = NULL){
        $data = array(
            'action' => site_url('upload/proses'),
            'judul' => set_value('judul'),
            'error' => $error['error'] // ambil parameter error
        );

        //$this->load->view('metronic/upload', $data);
        $this->data['show']=0;
        $this->tempe->load($this->themes.'/modul',$this->themes.'/upload',$this->data);
    }
    public function get_file(){
        
        $fileName = time().$_FILES['file']['name'];
        $config['upload_path'] = "D:\\project\\immobi\\webbase\\upload\\";
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $fileName = str_replace(' ', '_', $fileName);
        $inputFileName = 'D:\\project\\immobi\\webbase\\upload\\'.$fileName;
        //print_r($fileName);die;
        $this->get_read($inputFileName);
    }
    public function get_read($inputFileName){
        
        $this->load->library('excel');	
        $obj= PHPExcel_IOFactory::createReader('Excel2007');	
        $obj->setReadDataOnly(true);	
        $objPHPExcel=$obj->load($inputFileName); 
        $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);
        $reg=array(1,12,23,34,45);
        $response =$this->read($objWorksheet,$reg);
        
        //print_r(json_encode($response));die;
        $this->data['show']=1;
        $this->data['response']=$response;
        $this->tempe->load($this->themes.'/modul',$this->themes.'/upload',$this->data);
    }
    public function read($objWorksheet,$reg){
        for($a=0;$a<count($reg);$a++){
            $area= $objWorksheet->getCellByColumnAndRow($reg[$a],48)->getValue();
            $totCol=$reg[0]+4;
            for($s=$reg[0];$s<=$totCol;$s++){
                $col[]=$s;
            }
            $data=$this->get_data($objWorksheet,$col);
            $response[]=array('area'=>$area,'data'=>$data);
        }
        return $response;
    }
    public function get_data($objWorksheet,$col){
        for($i=77;$i<=85;$i++){	
            $parameter= $objWorksheet->getCellByColumnAndRow($col[0],$i)->getValue();	
            $telkomsel= $objWorksheet->getCellByColumnAndRow($col[1],$i)->getValue();
            $xl= $objWorksheet->getCellByColumnAndRow($col[2],$i)->getValue();
            $indosat= $objWorksheet->getCellByColumnAndRow($col[3],$i)->getValue();
            $three= $objWorksheet->getCellByColumnAndRow($col[4],$i)->getValue();
            $data[]=array(
                'parameter'=>htmlspecialchars_decode($parameter, ENT_NOQUOTES),
                'telkomsel'=>number_format((float)$telkomsel*100, 2, '.', ''),
                'xl'=>number_format((float)$xl*100, 2, '.', ''),
                'indosat'=>number_format((float)$indosat*100, 2, '.', ''),
                'three'=>number_format((float)$three*100, 2, '.', '')
                );
        }
        return $data;
    }
    

}