<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_project");
        $this->load->helper('form');
        $this->load->library('Lharby');
    }

    public function index() //project on progress
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $range = $_POST['range'];
            $master_kas = $this->M_data->GetKasRange($range);
            $get = $this->M_data->GetJumlahKasRange($range); //barchart total
            $titlekas = 'TOTAL MODAL YANG DISETOR DALAM ' . $range . ' BULAN ';
        } else {
            $master_kas = $this->M_data->GetKas();
            $get = $this->M_data->GetJumlahKas(); //barchart total
            $titlekas = 'TOTAL MODAL YANG DISETOR ';
        }
        $data = $this->M_data->GetPie();
        $get_kas = $this->M_data->Total_cash();
        $datapengajuan = $this->M_data->getTotalPengajuan();
        $pengajuan = $this->M_data->TotalPengajuan();
        $datapengajuanapproval = $this->M_data->getTotalPengajuanApproval();
        $pengajuanapproval = $this->M_data->TotalPengajuanApproval();
        $datapembelian = $this->M_data->getPembelian();
        $pembelian = $this->M_data->TotalPembelian();
        $datapembelianremaining = $this->M_data->getPembelianRemaining();
        $pembelianremaining = $this->M_data->TotalPembelianRemaining();
        $totalpengajuan = $this->lharby->formatRupiah($pengajuan[0]['totalpengajuan']);
        $titlepengajuan = $totalpengajuan;
        $totalpengajuanapproval = $this->lharby->formatRupiah($pengajuanapproval[0]['total_approval']);
        $titlepengajuanapproval = $totalpengajuanapproval;
        $totalpembelian = $this->lharby->formatRupiah($pembelian[0]['total_pembelian']);
        $titlepembelian = $totalpembelian;
        $totalpembelianremaining = $this->lharby->formatRupiah($pembelianremaining[0]['total_pembelian']);
        $titlepembelianremaining = $totalpembelianremaining;
        $totalkaschart = $this->lharby->formatRupiah($get[0]['total_kas']);
        $total_kas = $this->lharby->formatRupiah($get_kas[0]['total']); //pie chart total
        $title = $total_kas;
        $titlebarchart = $titlekas . ' ' . $totalkaschart;
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data' => $data,
            'master_kas' => $master_kas,
            'title' => $title,
            'titlebarchart' => $titlebarchart,
            'datapengajuan' => $datapengajuan,
            'titlepengajuan' => $titlepengajuan,
            'datapengajuanapproval' => $datapengajuanapproval,
            'titlepengajuanapproval' => $titlepengajuanapproval,
            'datapembelian' => $datapembelian,
            'titlepembelian' => $titlepembelian,
            'datapembelianremaining' => $datapembelianremaining,
            'titlepembelianremaining' => $titlepembelianremaining,

        );
        $this->load->view('dashboard/index', $show);
        // $this->load->view('data');
    }



    function convert_date($tgl)
    {
        $tanggal = date('d F Y', strtotime($tgl));
        return $tanggal;
    }



    public function header()
    {
        $data = array();
        $show = $this->load->view('component/header', $data, TRUE);
        return $show;
    }

    public function navbar()
    {
        $data = array();
        $show = $this->load->view('component/navbar', $data, TRUE);
        return $show;
    }


    public function sidebar()
    {
        $data = array();
        $show = $this->load->view('component/sidebar', $data, TRUE);
        return $show;
    }

    public function footer()
    {
        $data = array();
        $show = $this->load->view('component/footer', $data, TRUE);
        return $show;
    }


    public function flashdata_succeed()
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Action Succeed !!!</div></div>");
        redirect('/C_project');
    }
    public function flashdata_failed()
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
        redirect('/C_project');
    }

    public function flashdata_succeed_rap()
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Action Succeed !!!</div></div>");
    }
    public function flashdata_failed_rap()
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
    }

    public function flashdata_succeed1($pesan)
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">$pesan </div></div>");
    }
    public function flashdata_failed1($pesan)
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">$pesan </div></div>");
    }
}
