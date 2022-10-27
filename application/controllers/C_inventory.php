<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_inventory extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_data");
        $this->load->helper('form');
        $this->load->library('Lharby');
    }

    public function index()
    {
        $datainventory = $this->M_data->showInventory();
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'datainventory' => $datainventory,

        );
        $this->load->view('inventory/index', $show);
    }

    public function editmaterial()
    {
        $this->form_validation->set_rules('qty', 'Quantity', 'required|greater_than[0]');
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('/');
        } else {
            $id = $_POST['inventory_id'];
            $tag = $_POST['tag'];
            $qty = $_POST['qty'];
            $get = $this->M_data->GetData("akk_inventory ", "where id = '$id'");
            $material_id = $get[0]['material_id'];
            $qty_awal = $get[0]['qty'];
            if ($tag == 0) { //plus
                $qtyakhir = $qty_awal + $qty;
                $msg = "Penambahan Material ";
                $note = "Penambahan inventory melalui Kas Besar";
            } else {
                $qtyakhir = $qty_awal - $qty;
                $msg = "Pengurangan Material ";
                $note = "Pengurangan inventory melalui Kas Besar";
            }
            $where = array('id' => $id);
            $date = date('Y-m-d H:i:s');
            $data = array(
                "qty" => $qtyakhir,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => $date,
            );
            $data_log = array(
                "material_id" => $material_id,
                "qty" => $_POST['qty'],
                "created_by" => $this->session->userdata('id'),
                "created_at" => $date,
                "note" => $note,
            );
            $this->db->trans_start();
            $this->M_data->InsertData('log_inventory_organization', $data_log);
            $this->M_data->UpdateData('akk_inventory', $data, $where);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $this->flashdata_succeed1($msg);
                redirect('inventory');
            } else {
                $this->flashdata_failed1($msg);
                redirect('inventory');
            }
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
