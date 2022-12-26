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
        $project = $this->M_transaksi->getProject(0);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->M_data->getProject2();
            $datapengajuan = $this->M_data->getTotalPengajuan();
            $datapengeluaran = $this->M_data->getProject1();
            $datapengajuanapproval = $this->M_data->getTotalPengajuanApproval();
            $datapembelian = $this->M_data->getPembelian();
            $pembelianremaining = $this->M_data->TotalPembelianRemaining();
            $totalpembelianremaining = $this->lharby->formatRupiah($pembelianremaining[0]['total_pembelian']);
            $titlepembelianremaining = $totalpembelianremaining;
            $get_kas = $this->M_data->masterkas();
            $total_kas = $this->lharby->formatRupiah($get_kas[0]['cash_in_hand']); //pie chart total
            $title = $total_kas;
            $datapembelianremaining = $this->M_data->getProject3($_POST['project_id']);
            foreach ($project as $element) {
                if ($_POST['project_id'] == $element['id']) {
                    $project_name = $element['project_name'];
                    $project_id = $element['id'];
                }
            }
        } else {
            $project_name = $project['0']['project_name'];
            $project_id = $project['0']['id'];
            $datapembelianremaining = $this->M_data->getProject3($project['0']['id']);
            $data = $this->M_data->getProject2();
            $datapengajuan = $this->M_data->getTotalPengajuan();
            $datapengeluaran = $this->M_data->getProject1();
            $datapengajuanapproval = $this->M_data->getTotalPengajuanApproval();
            $datapembelian = $this->M_data->getPembelian();
            $pembelianremaining = $this->M_data->TotalPembelianRemaining();
            $totalpembelianremaining = $this->lharby->formatRupiah($pembelianremaining[0]['total_pembelian']);
            $titlepembelianremaining = $totalpembelianremaining;
            $get_kas = $this->M_data->masterkas();
            $total_kas = $this->lharby->formatRupiah($get_kas[0]['cash_in_hand']); //pie chart total
            $title = $total_kas;
        }
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data' => $data,
            'title' => $title,
            // 'data_detail_table' => $this->getDetailPerProjectTable($project_id),
            'project_name' => $project_name,
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
