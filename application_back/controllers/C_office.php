<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_office extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('role')==null) {
            redirect('Login'); }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_office");
        $this->load->model("M_project");
    }

    public function index()
    {
         $data = $this->M_office->getOffice();
         $office_type = $this->M_data->showdata("mst_office_type");
         $user = $this->M_data->showdata("mst_users");
         $status = 0;
         $project = $this->M_project->getProject($status);
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer'=> $this->footer(),
             'data' => $data,
             'office_type' => $office_type,
             'user' => $user,
             'project' => $project,
            
        );
        $this->load->view('office/index',$show);
        // $this->load->view('data');
    }
    
    public function getkas()
    {
        $id = 1; //KAS BESAR
        $data=$this->M_data->showKas($id);
        echo json_encode($data);
    }
 //    public function add()
    // {
    //  $show = array(
    //      'nav'=> $this->nav(),
    //      'footer'=> $this->footer(),
            
    //  );
    //  $this->load->view('product/v_addform',$show);
    // }

    public function add(){
        $this->form_validation->set_rules('office_type_id', 'Office Type', 'required');
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        if($this->form_validation->run()==FALSE){
            
            $this->flashdata_failed();
        }else{
            $data=array(
                "type_office_id"=> $_POST['office_type_id'],
                "user_id"=>$_POST['user_id'],
                "project_name"=>$_POST['project_name'],
                "last_updated_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $this->db->insert('mst_office',$data);
           $this->flashdata_succeed();
        }
    }
    
    public function do_update(){
            $id = $_POST['office_id'];
        
        $get = $this->M_data->GetData2("mst_office ","where id = '$id'")->row();
        $where = array('id' => $id);
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $data = array(
           "type_office_id"=> $_POST['office_type_id'],
                "user_id"=>$_POST['user_id'],
                "project_name"=>$_POST['project_name'],
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => $date,
            
        );
        
        $res = $this->M_data->UpdateData('mst_office',$data,$where);
        if($res>=1){
            $this->flashdata_succeed();
        }
        else{
            $this->flashdata_failed();
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
                redirect('office');
    }
    public function flashdata_failed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
                redirect('office');
    }
}

