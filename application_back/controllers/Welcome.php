<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
        parent::__construct();
        if ($this->session->userdata('role')==null) {
            redirect('Login'); }

    }

	public function index()
	{
         $data = $this->M_data->showdata("mst_organization");
        // $data_inventory = $this->M_data->showData("akk_inventory");
        $data_inventory = $this->M_data->showInventory();
        
        $data_mst_material = $this->M_data->showData("mst_material");
        $data_project = $this->M_data->GetData("mst_project ","where project_status=0");
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
			'footer'=> $this->footer(),
            'data' => $data,
            'data_inventory' => $data_inventory,
            'data_mst_material' => $data_mst_material,
            'data_project' => $data_project,
            
        );
        $this->load->view('V_kas',$show);
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
	// 	$show = array(
	// 		'nav'=> $this->nav(),
	// 		'footer'=> $this->footer(),
			
	// 	);
	// 	$this->load->view('product/v_addform',$show);
	// }

    public function add(){
        $this->form_validation->set_rules('amount', 'amount', 'required|integer');
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        if($this->form_validation->run()==FALSE){
            
            $this->flashdata_failed();
        }else{
            $data=array(
                "amount"=> $_POST['amount'],
                "kas_type"=>$_POST['kas_type'],
                "created_by" => $this->session->userdata('username'),
                "created_at" => $date,
            );
            $this->db->insert('mst_kas',$data);
           $this->flashdata_succeed();
        }
    }
    
    public function inventory_add(){
        $this->form_validation->set_rules('qty', 'Quantity', 'required|greater_than[0]');
        $material_id = $_POST['material_id'];
        $date = date('Y-m-d H:i:s');
        
        if($this->form_validation->run()==FALSE){
            
             $pesan = validation_errors();
             $this->flashdata_failed1($pesan);
             redirect('/');
        }else{
            
            $data=array(
                "material_id"=> $material_id,
                "qty"=> $_POST['qty'],
                "last_updated_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $where = array('material_id'=>$material_id);
            $cekmaterial = $this->M_data->cekMaterialInventory($material_id);
            $this->db->trans_start();
            if($cekmaterial){ //jika material sudah ada di project tsb
                $qty_awal = $cekmaterial[0]['qty'];
                $qty_akhir = $qty_awal+$_POST['qty'];
                $data_up=array(
                    "qty"=> $qty_akhir,
                    "last_updated_by" => $this->session->userdata('id'),
                    "updated_at" => $date,
                    );
                
                $res = $this->M_data->UpdateData('akk_inventory',$data_up,$where);
                
            }
            else{
                $res = $this->M_data->InsertData('akk_inventory',$data);
            }
            $data_log=array(
                "material_id"=> $material_id,
                "qty"=> $_POST['qty'],
                "created_by" => $this->session->userdata('id'),
                "created_at" => $date,
                "note" => "Penambahan inventory melalui Kas Besar",
            );
            $this->M_data->InsertData('log_inventory_organization',$data_log);
            $this->db->trans_complete();
           if($this->db->trans_status() === TRUE){
               $msg = "Penambahan Material Berhasil";
               $this->flashdata_succeed1($msg);
                redirect('/');
           }
           else{
               $msg = "Penambahan Material Gagal";
               $this->flashdata_failed1($msg);
                redirect('/');
           }
           
        }
    }
    
    public function update_inventory(){
         $this->form_validation->set_rules('qty', 'Quantity', 'required|greater_than[0]');
       
        
        if($this->form_validation->run()==FALSE){
            $pesan = validation_errors();
             $this->flashdata_failed1($pesan);
             redirect('/');
        }
        else{
            $id = $_POST['inventory_id'];
            $tag = $_POST['tag'];
            $qty = $_POST['qty'];
           
                 $get = $this->M_data->GetData("akk_inventory ","where id = '$id'");
                 $material_id = $get[0]['material_id'];
                    $qty_awal = $get[0]['qty'];
                    if($tag==0){ //plus
                        $qtyakhir = $qty_awal+$qty;
                        $msg = "Penambahan Material Berhasil";
                        $note = "Penambahan inventory melalui Kas Besar";
                    }
                    else{
                        $qtyakhir = $qty_awal-$qty;
                        $msg = "Pengurangan Material Berhasil";
                        $note = "Pengurangan inventory melalui Kas Besar";
                    }
                $where = array('id' => $id);
                $date = date('Y-m-d H:i:s');
                $data = array(
                    "qty" => $qtyakhir,
                    "last_updated_by" => $this->session->userdata('id'),
                    "updated_at" => $date,
                    
                );
                $data_log=array(
                    "material_id"=> $material_id,
                    "qty"=> $_POST['qty'],
                    "created_by" => $this->session->userdata('id'),
                    "created_at" => $date,
                    "note" => $note,
                );
                $this->db->trans_start();
                $this->M_data->InsertData('log_inventory_organization',$data_log);
                $this->M_data->UpdateData('akk_inventory',$data,$where);
                
                $this->db->trans_complete();
                   if($this->db->trans_status() === TRUE){
                        $this->flashdata_succeed1($msg);
                        redirect('/');
                   }
                   else{
                       $this->flashdata_failed1($msg);
                        redirect('/');
                   }
        }
            
            
           
    }
    
    public function transfer(){
        $this->form_validation->set_rules('qty', 'Quantity', 'required|greater_than[0]');
        $material_id = $_POST['material_id'];
        $project_id = $_POST['project_id'];
       $cekqty = $this->M_data->cekMaterialInventory($material_id);
       $qty_inv = $cekqty[0]['qty'];
      
        
        if($this->form_validation->run()==FALSE){
            $pesan = validation_errors();
             $this->flashdata_failed1($pesan);
             redirect('/');
            
        }
        else if($qty_inv<$_POST['qty']){
                $pesan = "Jumlah Transfer yang diinput tidak boleh melebihi Inventory yang ada";
                $this->flashdata_failed1($pesan);
                redirect('/');
        }
        else{
            
            
            $date = date('Y-m-d H:i:s');
          
            
            $getinv = $this->M_data->cekMaterialProject($project_id,$material_id);
            if($getinv) { //jika material sudah ada di inventory project
                 $id_inv_project = $getinv[0]['id'];
                $qty_project = $getinv[0]['qty'];
                $qty_akhir = $qty_project+$_POST['qty'];
                
                $data_up_pro=array(
                            "qty"=> $qty_akhir,
                            "last_updated_by" => $this->session->userdata('id'),
                            "updated_at" => $date,
                 );
                 $where_up_pro = array('id'=>$id_inv_project); //update qty di inventory project
                 $this->M_data->UpdateData('akk_inventory_project',$data_up_pro,$where_up_pro);
            }
            else{
                $data_ins_pro = array(
                        "project_id" => $project_id,
                        "material_id" => $material_id,
                        "qty" => $_POST['qty'],
                        "created_at" => $date,
                        "last_updated_by" => $this->session->userdata('id'),
                    );
                $this->M_data->InsertData('akk_inventory_project',$data_ins_pro);
            }
           
            
             
            $cekmaterial = $this->M_data->cekMaterialInventory($material_id);
            $where = array('material_id'=>$material_id);
            $qty_awal = $cekmaterial[0]['qty'];
            $qty_akhir = $qty_awal-$_POST['qty']; 
            $data_up=array(
                        "qty"=> $qty_akhir,
                        "last_updated_by" => $this->session->userdata('id'),
                        "updated_at" => $date,
            );
            
         $data_log=array(
                "material_id"=> $material_id,
                "qty"=> $_POST['qty'],
                "project_id" => $project_id,
                "created_by" => $this->session->userdata('id'),
                "created_at" => $date,
                "note" => "Transfer Inventory",
            );
            
            
            $this->db->trans_start();
           
            
            $this->M_data->UpdateData('akk_inventory',$data_up,$where);
            $this->M_data->InsertData('log_inventory_organization',$data_log);
            
            $this->db->trans_complete();
           if($this->db->trans_status() === TRUE){
               $msg = "Transfer Material Berhasil";
               $this->flashdata_succeed1($msg);
                redirect('/');
           }
           else{
               $msg = "Transfer Material Gagal";
               $this->flashdata_failed1($msg);
                redirect('/');
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
		$res = $this->M_data->DeleteData('mst_kas',$where);
		if($res>=1){
			$this->flashdata_succeed();
	   }
       else{
            $this->flashdata_failed();
        }
    }



    public function do_update(){
            $id = $this->input->post('organization_id');
        
        $get = $this->M_data->GetData("mst_organization ","where id = '$id'");
        $cash_now = $get[0]['cash_in_hand'];
       
        
        $a = $_POST['cash_in_hand'];
        $b = str_replace('.', '', $a ); //ubah format rupiah ke integer
        $cash_in_hand = intval($b);
        
        $cash_update = $cash_now+$cash_in_hand;
       
        $where = array('id' => $id);
        
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $data_up = array(
            'cash_in_hand' => $cash_update,
           "updated_at" => $date,
            "updated_by" => $this->session->userdata('id'),
            
        );
       
        $data_insert = array(
            "cash_additional" => $cash_in_hand,
            "created_by" => $this->session->userdata('id'),
        );
        $this->db->trans_start();
        $this->M_data->UpdateData('mst_organization',$data_up,$where);
        $this->M_data->InsertData('log_mst_organization',$data_insert);
        $this->db->trans_complete();
        
        
        if ($this->db->trans_status() === TRUE) {
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
                redirect('/');
    }
    public function flashdata_failed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
                redirect('/');
    }
    
     public function flashdata_succeed1($pesan){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">$pesan </div></div>");
               
    }
    public function flashdata_failed1($pesan){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">$pesan </div></div>");
                
    }
}

