<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pengguna extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('role')==null) {
            redirect('Login'); }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_pengguna");
    }

    public function index()
    {
         $data = $this->M_pengguna->getUser();
        $role = $this->M_pengguna->showData("mst_role");
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer'=> $this->footer(),
             'data' => $data,
             'role' => $role,
        );
        $this->load->view('user/index',$show);
        // $this->load->view('data');
    }
    
   

    public function add(){
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[mst_users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        if($this->form_validation->run()==FALSE){
            $msg = validation_errors();
            $this->flashdata_failed1($msg);
            redirect('user');
        }else{
            $data=array(
                "fullname"=> $_POST['fullname'],
                "username"=>$_POST['username'],
                "role"=>$_POST['role_id'],
                 
                "password"=>md5($_POST['password']),
                "last_update_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $res = $this->db->insert('mst_users',$data);
            if($res>=0){
                $msg = "Tambah User Berhasil";
                $this->flashdata_succeed1($msg);
                redirect('user');
            }
            else{
                 $msg = "Tambah User Gagal";
                $this->flashdata_failed1($msg);
                redirect('user');
            }
        }
    }
    
    public function do_update(){
        $id = $_POST['user_id'];
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        
        if($this->form_validation->run()==FALSE){
            $msg = validation_errors();
            $this->flashdata_failed1($msg);
            redirect('user');
        }
        else{
            $where = array('id' => $id);
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d H:i:s');
            $data = array(
                "fullname"=> $_POST['fullname'],
                "role"=>$_POST['role_id'],
                "is_active"=>$_POST['is_active'],
                "last_update_by" => $this->session->userdata('id'),
                "updated_at" => $date,            
            );
            
            $res = $this->M_data->UpdateData('mst_users',$data,$where);
            if($res>=0){
                $msg = "Update User Berhasil";
                $this->flashdata_succeed1($msg);
                redirect('user');
            }
            else{
                $msg = "Update User Gagal";
                $this->flashdata_failed1($msg);
                redirect('user');
            }
        }
        
    }

   public function change_pass(){
         $id = $_POST['user_id'];
         $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
        
        
      if($this->form_validation->run()==FALSE){
            $msg = validation_errors();
            $this->flashdata_failed1($msg);
            redirect('user');
        }
        else{
            $where = array('id' => $id);
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $data = array(
            "password"=>md5($_POST['password']),
            "last_update_by" => $this->session->userdata('id'),
            "updated_at" => $date,
            
        );
        
        $res = $this->M_data->UpdateData('mst_users',$data,$where);
           if($res>=0){
                    $msg = "Update Password Berhasil";
                    $this->flashdata_succeed1($msg);
                    redirect('user');
                }
                else{
                     $msg = "Update Password Gagal";
                    $this->flashdata_failed1($msg);
                    redirect('user');
            }
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
     public function flashdata_succeed1($pesan){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">$pesan </div></div>");
               
    }
    public function flashdata_failed1($pesan){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">$pesan </div></div>");
                
    }
}

