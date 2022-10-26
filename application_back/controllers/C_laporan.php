<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_laporan extends CI_Controller {

	function __construct() {
        parent::__construct();
        if ($this->session->userdata('role')==null) {
            redirect('Login'); }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_laporan");
        $this->load->helper('form');
        $this->load->library('Lharby');
    }

	public function index() 
	{
       
        $data = $this->M_laporan->getProjectAll();
        
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
			'footer'=> $this->footer(),
            'data' => $data,
            
        );
        $this->load->view('laporan/index',$show);
        // $this->load->view('data');
	}
	
	public function detail($id) //detail
	{
       $get = $this->M_laporan->getRap($id);
       $tgl = $get[0]['project_deadline'];
        $deadline = $this->convert_date($tgl);
        $rab_project = $this->lharby->formatRupiah($get[0]['rab_project']);
        $cash_in_hand = $this->lharby->formatRupiah($get[0]['cash_in_hand']);
        
        $data_rap_biaya = $this->M_laporan->getBiayaRap($id,1);
        $data_rap_biaya2 = $this->M_laporan->getBiayaRap($id,2);
        $data_rap_biaya3 = $this->M_laporan->getBiayaRap($id,3);
        $data_rap_biaya4 = $this->M_laporan->getBiayaRap($id,4);
        
        $data_pengajuan = $this->M_laporan->showpengajuandetail($id);
        
        $data_pencairan = $this->M_laporan->dataPencairan($id);
        $data_pembelian = $this->M_laporan->dataPembelian($id);
        $data_pembelian_remaining = $this->M_laporan->dataPembelianRemaining($id);
        
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
			'footer'=> $this->footer(),
			 'project_id' => $id,
            'rap_id' => $get[0]['id'],
            'project_name' => $get[0]['project_name'],
            'project_location' => $get[0]['project_location'],
            'cash_in_hand' => $cash_in_hand,
            'project_deadline' => $deadline,
            'rab_project' => $rab_project,
             'data_rap_biaya' => $data_rap_biaya,
            'data_rap_biaya2' => $data_rap_biaya2,
            'data_rap_biaya3' => $data_rap_biaya3,
            'data_rap_biaya4' => $data_rap_biaya4,
            'data_pengajuan' => $data_pengajuan,
            'data_pencairan' => $data_pencairan,
            'data_pembelian' => $data_pembelian,
            'data_pembelian_remaining' => $data_pembelian_remaining,
        );
        $this->load->view('laporan/detail',$show);
        // $this->load->view('data');
	}

   

	function convert_date($tgl){
        $tanggal = date('d F Y', strtotime($tgl));
        return $tanggal;
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
                redirect('/C_project');
    }
    public function flashdata_failed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
                redirect('/C_project');
    }

    public function flashdata_succeed_rap(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Action Succeed !!!</div></div>");
               
    }
    public function flashdata_failed_rap(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
                
    }

    public function flashdata_succeed1($pesan){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">$pesan </div></div>");
               
    }
    public function flashdata_failed1($pesan){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">$pesan </div></div>");
                
    }
}

