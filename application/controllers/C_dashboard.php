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
        $this->load->model("M_laporan");
        $this->load->model("M_transaksi");
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
        $project = $this->M_transaksi->getProject(0);
        $data = $this->M_data->getProject2();
        $datapengajuan = $this->M_data->getTotalPengajuan();
        $datapengeluaran = $this->M_data->getProject1();
        $datapengajuanapproval = $this->M_data->getTotalPengajuanApproval();
        $datapembelian = $this->M_data->getPembelian();
        $datapembelianremaining = $this->M_data->getPembelianRemaining();
        $pembelianremaining = $this->M_data->TotalPembelianRemaining();
        $totalpembelianremaining = $this->lharby->formatRupiah($pembelianremaining[0]['total_pembelian']);
        $titlepembelianremaining = $totalpembelianremaining;
        $get_kas = $this->M_data->masterkas();
        $total_kas = $this->lharby->formatRupiah($get_kas[0]['cash_in_hand']); //pie chart total
        $title = $total_kas;
        $totalkaschart = $this->lharby->formatRupiah($get[0]['total_kas']);
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
            'datapengeluaran' => $datapengeluaran,
            'datapengajuanapproval' => $datapengajuanapproval,
            'datapembelian' => $datapembelian,
            'datapembelianremaining' => $datapembelianremaining,
            'titlepembelianremaining' => $titlepembelianremaining,
            'project' => $project,

        );
        $this->load->view('dashboard/index', $show);
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
