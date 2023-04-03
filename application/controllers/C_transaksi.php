<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_transaksi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_transaksi");
        $this->load->model("M_pencairan");
        $this->load->model("M_hutang");
        $this->load->library('Lharby');
    }

    public function index() //termin
    {
        $datatermin = $this->M_transaksi->showTermin();
        $datapengajuanbelumapprove = $this->M_transaksi->pengajuanbelumapprove();
        $datapengajuansudahapprove = $this->M_transaksi->pengajuansudahapprove();
        $datahutangbelum = $this->M_hutang->showHutangbelum();
        $datahutangsudah = $this->M_hutang->showHutangsudah();
        $datapencairan = $this->M_pencairan->showPengajuanApproval();
        $datalogpencairan = $this->M_pencairan->dataPencairansudah();
        $status = 0; //on progress
        $project = $this->M_transaksi->getProject($status);
        // $data_pencairan = $this->M_transaksi->showPencairan();
        // $datapengajuan = $this->M_transaksi->showPengajuan();
        // $data_pencairan = $this->M_pencairan->showPengajuanApproval();
        // $datalogpencairan = $this->M_transaksi->dataPencairan();
        // $data_rap_biaya = $this->M_laporan->getBiayaRap();
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'datatermin' => $datatermin,
            'datapengajuanbelumapprove' => $datapengajuanbelumapprove,
            'datapengajuansudahapprove' => $datapengajuansudahapprove,
            'datahutangbelum' => $datahutangbelum,
            'datahutangsudah' => $datahutangsudah,
            'datapencairan' => $datapencairan,
            // 'data_pencairan' => $data_pencairan,
            'datalogpencairan' => $datalogpencairan,
            'project' => $project,
            // 'data_rap_biaya' => $data_rap_biaya,

        );
        $this->load->view('transaksi/index', $show);
        // $this->load->view('data');
    }

    public function tambahtermin()
    {
        $this->form_validation->set_rules('project_id', 'Project Name', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');
        $this->form_validation->set_rules('termin_ke', 'Termin Ke', 'required');
        $get = $this->M_transaksi->GetData("mst_organization ", "where id = 1");
        $cash_now = $get[0]['cash_in_hand'];
        $date = date('Y-m-d H:i:s');
        $now = strtotime($date);
        $a = $_POST['nominal'];
        $nominal_termin = str_replace('.', '', $a); //ubah format rupiah ke integer
        $nominal = intval($nominal_termin);
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('transaksi');
        } else {
            $data = array(
                "project_id" => $_POST['project_id'],
                "nominal" => $nominal,
                "note" => $_POST['note'],
                "termin_ke" => $_POST['termin_ke'],
                "created_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $cash_update = $cash_now + $nominal;
            $where = array('id' => 1);
            $data_up = array(
                'cash_in_hand' => $cash_update,
                "updated_at" => $date,
                "updated_by" => $this->session->userdata('id'),
            );
            $data_insert = array(
                "cash_additional" => $nominal,
                'note' => $_POST['note'],
                "created_by" => $this->session->userdata('id'),
            );
            $this->db->trans_start();
            $this->db->insert('akk_penerimaan_project', $data);
            $this->M_data->UpdateData('mst_organization', $data_up, $where);
            $this->M_data->InsertData('log_mst_organization', $data_insert);
            $this->db->trans_complete();
            $pesan = "Penerimaan Termin Project Sukses";
            $this->flashdata_succeed1($pesan);
            redirect('transaksi');
        }
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
        redirect('/termin');
    }
    public function flashdata_failed()
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
        redirect('/termin');
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
