<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_material extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('role')==null) {
            redirect('Login'); }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_material");
       
    }

    public function index()
    {
         $data = $this->M_material->showData("mst_material");
        
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer'=> $this->footer(),
             'data' => $data,
            
            
        );
        $this->load->view('material/index',$show);
        // $this->load->view('data');
    }
    
   

    public function add(){
        $this->form_validation->set_rules('material_name', 'Nama Material', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        
     
        if($this->form_validation->run()==FALSE){
            
            $this->flashdata_failed();
        }else{
            $data=array(
                "material_name"=> $_POST['material_name'],
                "unit"=>$_POST['unit'],
              
              
            );
            $this->db->insert('mst_material',$data);
           $this->flashdata_succeed();
        }
    }
    
    public function do_update(){
            $id = $_POST['material_id'];
        
        $this->form_validation->set_rules('material_name', 'Nama Material', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        
     
        if($this->form_validation->run()==FALSE){
            $this->flashdata_failed();
        }
        else{
            $where = array('id' => $id);
        
            $data = array(
               "material_name"=> $_POST['material_name'],
                    "unit"=>$_POST['unit'],
                    
            );
            
            $res = $this->M_data->UpdateData('mst_material',$data,$where);
            if($res>=1){
                $this->flashdata_succeed();
            }
            else{
                $this->flashdata_failed();
            }
        }
        
    }

    public function do_insert()
    {
        
        $product_name = $_POST['product_name'];
        $qty = $_POST['qty'];
     
        $data_insert = array(
            'product_name' => $product_name,
            'qty' => $qty,
        );
        $res = $this->M_data->InsertData('product',$data_insert);
        if($res>=1){
            $this->flashdata_succeed();
        }
        else{
            $this->flashdata_failed();
        }
 
    }

    public function delete($id){
        $where = array('id' => $id);
        $res = $this->M_data->DeleteData('mst_office',$where);
        if($res>=1){
            $this->flashdata_succeed();
       }
       else{
            $this->flashdata_failed();
        }
    }



    

    public function header(){
        $data = array();
        $show = $this->load->view('component/header',$data,TRUE);
        return $show;
    }

    public function navbar(){
        $data = array();
        $show = $this->load->view('component/navbar',$data,TRUE);
        return $show;
    }

    
    public function sidebar(){
        $data = array();
        $show = $this->load->view('component/sidebar',$data,TRUE);
        return $show;
    }
    
    public function footer(){
        $data = array();
        $show = $this->load->view('component/footer',$data,TRUE);
        return $show;
    }


    public function flashdata_succeed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Action Succeed !!!</div></div>");
                redirect('material');
    }
    public function flashdata_failed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
                redirect('material');
    }
}

