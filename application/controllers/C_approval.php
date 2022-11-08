<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_approval extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_approval");
        $this->load->model("M_pengajuan");
        $this->load->helper('form');
        $this->load->library('Lharby');
    }

    public function index()
    {
        $datapengajuanbelumapprove = $this->M_approval->pengajuanbelumapprove();
        $datapengajuansudahapprove = $this->M_approval->pengajuansudahapprove();

        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'datapengajuanbelumapprove' => $datapengajuanbelumapprove,
            'datapengajuansudahapprove' => $datapengajuansudahapprove,

        );
        $this->load->view('approval/index', $show);
    }

    public function approved()
    {
        $is_approved = $_POST['is_approved'];
        $pengajuan_biaya_id = $_POST['pengajuan_biaya_id'];
        $pengajuan_id = $_POST['pengajuan_id'];
        $a = $_POST['jumlah_approval'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_approval = intval($b);
        $where = array('id' => $pengajuan_biaya_id);
        $date = date('Y-m-d H:i:s');
        $data_update = array(
            'is_approved' => $is_approved,
            "last_updated_by" => $this->session->userdata('id'),
            "updated_at" => $date,
        );
        $cekapproval = $this->M_pengajuan->GetData("akk_pengajuan_approval ", "where pengajuan_biaya_id = '$pengajuan_biaya_id'");
        $this->db->trans_start();
        if ($cekapproval) {
            $data_approval = array(
                'jumlah_approval' => $jumlah_approval,
                'note_app' => $_POST['note'],
                'created_at' => $date,
                'updated_at' => $date,
                'last_updated_by' => $this->session->userdata('id'),
            );
            $whereapp = array('pengajuan_biaya_id' => $pengajuan_biaya_id);
            $this->M_pengajuan->UpdateData('akk_pengajuan_approval', $data_approval, $whereapp);
        } else {
            $data_insert = array(
                'pengajuan_id' => $pengajuan_id,
                'pengajuan_biaya_id' => $pengajuan_biaya_id,
                'jumlah_approval' => $jumlah_approval,
                'note_app' => $_POST['note'],
                'created_at' => $date,
                'updated_at' => $date,
                'last_updated_by' => $this->session->userdata('id'),
            );
            $this->M_pengajuan->insertData('akk_pengajuan_approval', $data_insert);
        }
        $this->M_pengajuan->UpdateData('akk_pengajuan_biaya', $data_update, $where);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $pesan = "" . " Pengajuan Gagal di Approve";
            $this->flashdata_failed1($pesan);
            redirect('approval/');   // generate an error... or use the log_message() function to log your error
        } else {
            $pesan = "" . " Pengajuan Sukses di Approve";
            $this->flashdata_succeed1($pesan);
            redirect('approval/');
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
        redirect('/C_project');
    }
    public function flashdata_failed()
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
        redirect('/C_project');
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
