<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_inventory_project extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_inventory");
        $this->load->model("M_transaksi");
        $this->load->model("M_project");
        $this->load->helper('form');
        $this->load->library('Lharby');
    }

    public function index()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $range = $_POST['range'];
            $title = 'LOG TRANSFER MATERIAL DALAM ' . $range . ' BULAN TERAKHIR';
            $datalogmaterial = $this->M_inventory->showLogMaterialRange($range);
        } else {
            $datalogmaterial = $this->M_inventory->showLogMaterial();
            $title = '';
        }
        $project = $this->M_transaksi->getProject(0);
        $data_inventory = $this->M_project->showInventory();
        $data_project = $this->M_inventory->GetData("mst_project ", "where project_status=0");
        $data_mst_material = $this->M_inventory->showData("mst_material");
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'datainventory' => $data_inventory,
            'data_mst_material' => $data_mst_material,
            'data_project' => $data_project,
            'project' => $project,
            'datalogmaterial' => $datalogmaterial,
            'title' => $title,
        );
        $this->load->view('inventory_project/index', $show);
    }

    public function editmaterial()
    {
        $this->form_validation->set_rules('qty', 'Quantity', 'required|greater_than[0]');
        $project_id = $_POST['project_id'];
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('project_detail/' . $project_id);
        } else {
            $id = $_POST['inventory_id'];
            $tag = $_POST['tag'];
            $qty = $_POST['qty'];
            $get = $this->M_data->GetData("akk_inventory_project ", "where id = '$id'");
            $qty_awal = $get[0]['qty'];
            if ($tag == 0) { //plus
                $qtyakhir = $qty_awal + $qty;
                $msg = "Penambahan Material dalam Project Berhasil ";
            } else {
                $qtyakhir = $qty_awal - $qty;
                $msg = "Pengurangan Material dalam Project Berhasil ";
            }
            $where = array('id' => $id);
            $date = date('Y-m-d H:i:s');
            $data = array(
                "qty" => $qtyakhir,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => $date,
            );
            $res = $this->M_data->UpdateData('akk_inventory_project', $data, $where);
            if ($res >= 1) {
                $this->flashdata_succeed1($msg);
                redirect('inventory_project');
            } else {
                $this->flashdata_failed1($msg);
                redirect('inventory_project');
            }
        }
    }

    public function tambahmaterial()
    {
        $this->form_validation->set_rules('qty', 'Quantity', 'required|greater_than[0]');
        $material_id = $_POST['material_id'];
        $date = date('Y-m-d H:i:s');
        $project_id = $_POST['project_id'];
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('inventory_project');
        } else {
            $data = array(
                "material_id" => $material_id,
                "qty" => $_POST['qty'],
                "project_id" => $project_id,
                "last_updated_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $where = array('project_id' => $project_id, 'material_id' => $material_id);
            $cekmaterial = $this->M_data->cekMaterialProject($project_id, $material_id);
            if ($cekmaterial) { //jika material sudah ada di project tsb
                $qty_awal = $cekmaterial[0]['qty'];
                $qty_akhir = $qty_awal + $_POST['qty'];
                $data_up = array(
                    "qty" => $qty_akhir,
                    "last_updated_by" => $this->session->userdata('id'),
                    "updated_at" => $date,
                );
                $res = $this->M_data->UpdateData('akk_inventory_project', $data_up, $where);
            } else {
                $res = $this->db->insert('akk_inventory_project', $data);
            }
            if ($res >= 1) {
                $msg = "Penambahan Material Berhasil";
                $this->flashdata_succeed1($msg);
                redirect('inventory_project');
            } else {
                $msg = "Penambahan Material Gagal";
                $this->flashdata_failed1($msg);
                redirect('inventory_project');
            }
        }
    }


    public function transfermaterial()
    {
        $this->form_validation->set_rules('qty', 'Quantity', 'required|greater_than[0]');
        $material_id = $_POST['material_id'];
        $project_id = $_POST['project_id'];
        $cekqty = $this->M_data->cekMaterialInventory($material_id);
        $qty_inv = $cekqty[0]['qty'];
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('inventory');
        } else if ($qty_inv < $_POST['qty']) {
            $pesan = "Jumlah Transfer yang diinput tidak boleh melebihi Inventory yang ada";
            $this->flashdata_failed1($pesan);
            redirect('inventory');
        } else {
            $date = date('Y-m-d H:i:s');
            $getinv = $this->M_data->cekMaterialProject($project_id, $material_id);
            if ($getinv) { //jika material sudah ada di inventory project
                $id_inv_project = $getinv[0]['id'];
                $qty_project = $getinv[0]['qty'];
                $qty_akhir = $qty_project + $_POST['qty'];
                $data_up_pro = array(
                    "qty" => $qty_akhir,
                    "last_updated_by" => $this->session->userdata('id'),
                    "updated_at" => $date,
                );
                $where_up_pro = array('id' => $id_inv_project); //update qty di inventory project
                $this->M_data->UpdateData('akk_inventory_project', $data_up_pro, $where_up_pro);
            } else {
                $data_ins_pro = array(
                    "project_id" => $project_id,
                    "material_id" => $material_id,
                    "qty" => $_POST['qty'],
                    "created_at" => $date,
                    "last_updated_by" => $this->session->userdata('id'),
                );
                $this->M_data->InsertData('akk_inventory_project', $data_ins_pro);
            }
            $cekmaterial = $this->M_data->cekMaterialInventory($material_id);
            $where = array('material_id' => $material_id);
            $qty_awal = $cekmaterial[0]['qty'];
            $qty_akhir = $qty_awal - $_POST['qty'];
            $data_up = array(
                "qty" => $qty_akhir,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => $date,
            );
            $data_log = array(
                "material_id" => $material_id,
                "qty" => $_POST['qty'],
                "project_id" => $project_id,
                "created_by" => $this->session->userdata('id'),
                "created_at" => $date,
                "note" => "Transfer Inventory",
            );
            $this->db->trans_start();
            $this->M_data->UpdateData('akk_inventory', $data_up, $where);
            $this->M_data->InsertData('log_inventory_organization', $data_log);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $msg = "Transfer Material";
                $this->flashdata_succeed1($msg);
                redirect('inventory');
            } else {
                $msg = "Transfer Material";
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

    public function flashdata_succeed1($pesan)
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">$pesan </div></div>");
    }
    public function flashdata_failed1($pesan)
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">$pesan </div></div>");
    }
}
