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
        $project = $this->M_laporan->getProjectAll(0);
        $dataAll = $this->M_data->getAll();
        $titleAll = $this->M_data->getAlltitle();
        $title_kas = $this->M_data->gettitlekas();
        $title_piutang = $this->M_data->gettitlepiutang();
        $title_hutang = $this->M_data->gettitlehutang();
        $title_omset = $this->M_data->gettitleomset();
        $title_pengajuan = $this->M_data->gettitlepengajuan();
        $datakas = $this->M_data->getKasdashboard();
        $datapengajuan = $this->M_data->getPengajuandashboard();
        $dataomset = $this->M_data->getOmset();
        $datahutang = $this->M_data->getHutang();
        $datapiutang = $this->M_data->getPiutang();
        $totalkas = $this->lharby->formatRupiah($title_kas[0]['total_kas']);
        $titlekas = $totalkas;
        // $totalpiutang = $this->lharby->formatRupiah($title_piutang[0]['total_piutang']);
        // $titlepiutang = $totalpiutang;
        $totalhutang = $this->lharby->formatRupiah($title_hutang[0]['total_hutang']);
        $titlehutang = $totalhutang;
        $totalpengajuan = $this->lharby->formatRupiah($title_pengajuan[0]['total_pengajuan']);
        $titlepengajuan = $totalpengajuan;
        $totalomset = $this->lharby->formatRupiah($title_omset[0]['total_omset']);
        $titleomset = $totalomset;
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'datakas' => $datakas,
            'dataAll' => $dataAll,
            'datapengajuan' => $datapengajuan,
            'dataomset' => $dataomset,
            'datahutang' => $datahutang,
            'datapiutang' => $datapiutang,
            'title_piutang' => $title_piutang,
            'project' => $project,
            'titlekas' => $titlekas,
            // 'titlepiutang' => $titlepiutang,
            'titlehutang' => $titlehutang,
            'titlepengajuan' => $titlepengajuan,
            'titleomset' => $titleomset,
        );
        $this->load->view('dashboard/index1', $show);
    }



    public function getDetailPerProjectTable($project_id)
    {
        //  $id=$this->input->post('id');
        if ($_POST['tipe_detail'] == 'pengajuan') {
            $dataproject = $this->M_data->getpengajuan("akk_pengajuan_biaya", "where id = '$project_id'");
        } elseif ($_POST['tipe_detail'] == 'approval') {
            $dataproject = $this->M_data->GetData("akk_pengajuan_approval", "where id = '$project_id'");
        } elseif ($_POST['tipe_detail'] == 'pencairan') {
            $dataproject = $this->M_data->GetData("trx_pengiriman_uang", "where id = '$project_id'");
        } elseif ($_POST['tipe_detail'] == 'pembelian') {
            $dataproject = $this->M_data->GetData("trx_pembelian_barang", "where id = '$project_id'");
        } elseif ($_POST['tipe_detail'] == 'pembelian_tanpa') {
            $dataproject = $this->M_data->GetData("trx_pembelian_barang_remaining", "where id = '$project_id'");
        }

        echo json_encode($dataproject);
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
