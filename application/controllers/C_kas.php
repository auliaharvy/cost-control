<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_kas extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_kas");
        $this->load->helper('form');
        $this->load->library('Lharby');
    }

    public function index()
    {
        $datakas = $this->M_kas->showdata("mst_organization");
        $data_project = $this->M_kas->GetData("mst_project ", "where project_status=0");
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $range = $_POST['range'];
            $datalog = $this->M_kas->showLogKasRange($range);
            $title = 'LOG KAS DALAM ' . $range . ' BULAN TERAKHIR ';
        } else {
            $datalog = $this->M_kas->showLogKas();
            $title = '';
        }
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'datakas' => $datakas,
            'datalog' => $datalog,
            'title' => $title,
            'data_project' => $data_project,

        );
        $this->load->view('kas/index', $show);
    }
    public function editkas()
    {
        $id = $this->input->post('organization_id');
        $get = $this->M_kas->GetData("mst_organization ", "where id = '$id'");
        $cash_now = $get[0]['cash_in_hand'];
        $tag = $_POST['tag'];
        $a = $_POST['cash_in_hand'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $cash_in_hand = intval($b);
        if ($tag == 0) { //tambah
            $cash_update = $cash_now + $cash_in_hand;
            $msg = "Penambahan Kas";
        } else { //kurang
            $cash_update = $cash_now - $cash_in_hand;
            $cash_in_hand = $cash_in_hand * (-1); //dijadikan min
            $msg = "Pengurangan Kas";
        }
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
            'note' => $_POST['note'],
            "created_by" => $this->session->userdata('id'),
        );
        $this->db->trans_start();
        $this->M_data->UpdateData('mst_organization', $data_up, $where);
        $this->M_data->InsertData('log_mst_organization', $data_insert);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            $this->flashdata_succeed1($msg);
            redirect('kas');
        } else {
            $this->flashdata_failed1($msg);
            redirect('kas');
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
