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
        $this->data['menu']=json_decode('[{"menu_id":"2","menu_name":"Dashboard","mob_href":"home","icon":"icon-bar-chart"},{"menu_id":"2","menu_name":"Upload","mob_href":"upload","icon":"icon-envelope-open"}]');
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
    //public function get_read($inputFileName){
    public function get_read($inputFileName){
        
        $this->load->library('excel');	
        $obj= PHPExcel_IOFactory::createReader('Excel2007');	
        $obj->setReadDataOnly(true);	
        $objPHPExcel=$obj->load($inputFileName); 
        //$objPHPExcel=$obj->load('D:\\project\\immobi\\webbase\\upload\\sample.xlsx'); 
        $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);
        $objWorksheetA=$objPHPExcel->setActiveSheetIndex(2);
        $reg=array(1,12,23,34,45);
        $regA=array(1,10,19,28,37);
        //$regA=array(1,10,18,26,34);
        $response =$this->read($objWorksheet,$reg);
        $responseA =$this->readA($objWorksheetA,$regA);
        //print_r(json_encode($response));
        $_SESSION['response']=$response;
        $_SESSION['responseA']=$responseA;
        $this->data['show']=1;
        $this->data['response']=$response;
        $this->data['responseA']=$responseA;
        $this->tempe->load($this->themes.'/modul',$this->themes.'/upload',$this->data);
    }
    public function read($objWorksheet,$reg){
        for($a=0;$a<count($reg);$a++){
            $periode= $objWorksheet->getCellByColumnAndRow(2,2)->getValue();
            $area= $objWorksheet->getCellByColumnAndRow($reg[$a],48)->getValue();
            $area = str_replace('Resume', '', $area);
            $totCol=$reg[$a]+4;
            $col=array();
            for($s=$reg[$a];$s<=$totCol;$s++){
                $col[]=$s;
            }
            //print_r($col);
            $data=$this->get_data($objWorksheet,$col);
            $response[]=array('periode'=>$periode,'area'=>$area,'data'=>$data);
        }
        //print_r($response);
        return $response;
    }
    public function readA($objWorksheetA,$regA){
        for($aa=0;$aa<count($regA);$aa++){
            $periode= $objWorksheetA->getCellByColumnAndRow(2,2)->getValue();
            $area= $objWorksheetA->getCellByColumnAndRow($regA[$aa],4)->getValue();
            $totCol=$regA[$aa]+5;
            $col=array();
            for($ss=$regA[$aa];$ss<=$totCol;$ss++){
                if(($ss==2)||($ss==11)||($ss==20)||($ss==29)||($ss==38)){
                    $ss=$ss+1;
                }
                /*else if($ss==10){
                    $ss=$ss-1;
                }*/
                $col[]=$ss;
            }
            //print_r($col);
            $data=$this->get_dataA($objWorksheetA,$col);
            $response[]=array('periode'=>$periode,'area'=>$area,'data'=>$data);
        }
        return $response;
    }
    public function get_data($objWorksheet,$col){
       //print_r($col); 
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
    public function get_dataA($objWorksheetA,$col){
        $pos=array(62,78,68);
        for($i=0;$i<count($pos);$i++){
            $parameter= $objWorksheetA->getCellByColumnAndRow($col[0],$pos[$i])->getValue();	
            $telkomsel= $objWorksheetA->getCellByColumnAndRow($col[1],$pos[$i])->getValue();
            $xl= $objWorksheetA->getCellByColumnAndRow($col[2],$pos[$i])->getValue();
            $indosat= $objWorksheetA->getCellByColumnAndRow($col[3],$pos[$i])->getValue();
            $three= $objWorksheetA->getCellByColumnAndRow($col[4],$pos[$i])->getValue();
            $data[]=array(
                'parameter'=>htmlspecialchars_decode($parameter, ENT_NOQUOTES),
                //'telkomsel'=>number_format((float)$telkomsel*100, 2, '.', '')."/".$col[1].",".$pos[$i],
                'telkomsel'=>number_format((float)$telkomsel*100, 2, '.', ''),
                'xl'=>number_format((float)$xl*100, 2, '.', ''),
                'indosat'=>number_format((float)$indosat*100, 2, '.', ''),
                'three'=>number_format((float)$three*100, 2, '.', '')
                );
        }
        return $data;
    }
    public function save_file(){
        $data1=$_SESSION['response'];
        $data2=$_SESSION['responseA'];
        //print_r(count($data2));die;
        for($a=0;$a<count($data1);$a++){
            for($aa=0;$aa<count($data1[$a]['data']);$aa++){
                $data['periode']=$data1[$a]['periode'];
                $data['report_type']='voice';
                $data['area']=$data1[$a]['area'];
                $data['parameter']=$data1[$a]['data'][$aa]['parameter'];
                $data['telkomsel']=$data1[$a]['data'][$aa]['telkomsel'];
                $data['xl']=$data1[$a]['data'][$aa]['xl'];
                $data['indosat']=$data1[$a]['data'][$aa]['indosat'];
                $data['three']=$data1[$a]['data'][$aa]['three'];
                $data['input_by']='1';
                $data['input_date']=date('Y-m-d H:i:s');
                $this->Proccess->insert_report($data);
                //redirect(site_url('upload'));
            }
        }
        for($b=0;$b<count($data2);$b++){
            for($bb=0;$bb<count($data2[$b]['data']);$bb++){
                $dataA['periode']=$data1[0]['periode'];
                $dataA['report_type']='data';
                $dataA['area']=$data2[$b]['area'];
                $dataA['parameter']=$data2[$b]['data'][$bb]['parameter'];
                $dataA['telkomsel']=$data2[$b]['data'][$bb]['telkomsel'];
                $dataA['xl']=$data2[$b]['data'][$bb]['xl'];
                $dataA['indosat']=$data2[$b]['data'][$bb]['indosat'];
                $dataA['three']=$data2[$b]['data'][$bb]['three'];
                $dataA['input_by']='1';
                $dataA['input_date']=date('Y-m-d H:i:s');
                $this->Proccess->insert_report($dataA);
            }
        }
        redirect(site_url('upload'));
    }
}