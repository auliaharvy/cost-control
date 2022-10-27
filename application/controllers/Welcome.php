<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Load library phpspreadsheet
require('./Excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet


class Welcome extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
    }

    public function index()
    {
        // echo $this->session->userdata('role'); exit();
        $data = $this->M_data->showdata("mst_organization");
        // $data_inventory = $this->M_data->showData("akk_inventory");
        $data_inventory = $this->M_data->showInventory();

        $data_mst_material = $this->M_data->showData("mst_material");
        $data_project = $this->M_data->GetData("mst_project ", "where project_status=0");
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data' => $data,
            'data_inventory' => $data_inventory,
            'data_mst_material' => $data_mst_material,
            'data_project' => $data_project,

        );
        $this->load->view('kas/V_kas', $show);
        // $this->load->view('data');
    }

    // Export ke excel
    public function export()
    {
        $provinsi = $this->M_data->showData("mst_organization");
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('Surya Microsystem - HA')

            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php');

        // Add some data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Organization Name')
            ->setCellValue('B1', 'Cash In Hand');

        // Miscellaneous glyphs, UTF-8
        $i = 2;
        foreach ($provinsi as $d) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $d['organization_name'])
                ->setCellValue('B' . $i, $d['cash_in_hand']);
            $i++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Report KAS ' . date('d-m-Y H'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report KAS.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function log_kas()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $range = $_POST['range'];
            $data = $this->M_data->showLogKasRange($range);
            $title = 'LOG KAS DALAM ' . $range . ' BULAN TERAKHIR ';
        } else {
            $data = $this->M_data->showLogKas();
            $title = 'LOG KAS ';
        }

        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data' => $data,
            'title' => $title,

        );
        $this->load->view('kas/V_historycash', $show);
        // $this->load->view('data');
    }

    public function log_material()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $range = $_POST['range'];
            $title = 'LOG TRANSFER MATERIAL DALAM ' . $range . ' BULAN TERAKHIR';
            $data = $this->M_data->showLogMaterialRange($range);
        } else {
            $data = $this->M_data->showLogMaterial();
            $title = 'LOG TRANSFER MATERIAL';
        }

        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data' => $data,
            'title' => $title,

        );
        $this->load->view('kas/V_historymaterial', $show);
        // $this->load->view('data');
    }

    public function getkas()
    {
        $id = 1; //KAS BESAR
        $data = $this->M_data->showKas($id);
        echo json_encode($data);
    }
    //    public function add()
    // {
    // 	$show = array(
    // 		'nav'=> $this->nav(),
    // 		'footer'=> $this->footer(),

    // 	);
    // 	$this->load->view('product/v_addform',$show);
    // }

    public function add()
    {
        $this->form_validation->set_rules('amount', 'amount', 'required|integer');
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        if ($this->form_validation->run() == FALSE) {

            $this->flashdata_failed();
        } else {
            $data = array(
                "amount" => $_POST['amount'],
                "kas_type" => $_POST['kas_type'],
                "created_by" => $this->session->userdata('username'),
                "created_at" => $date,
            );
            $this->db->insert('mst_kas', $data);
            $this->flashdata_succeed();
        }
    }

    public function inventory_add()
    {
        $this->form_validation->set_rules('qty', 'Quantity', 'required|greater_than[0]');
        $material_id = $_POST['material_id'];
        $date = date('Y-m-d H:i:s');
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('/');
        } else {
            $data = array(
                "material_id" => $material_id,
                "qty" => $_POST['qty'],
                "last_updated_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $where = array('material_id' => $material_id);
            $cekmaterial = $this->M_data->cekMaterialInventory($material_id);
            $this->db->trans_start();
            if ($cekmaterial) { //jika material sudah ada di project tsb
                $qty_awal = $cekmaterial[0]['qty'];
                $qty_akhir = $qty_awal + $_POST['qty'];
                $data_up = array(
                    "qty" => $qty_akhir,
                    "last_updated_by" => $this->session->userdata('id'),
                    "updated_at" => $date,
                );
                $res = $this->M_data->UpdateData('akk_inventory', $data_up, $where);
            } else {
                $res = $this->M_data->InsertData('akk_inventory', $data);
            }
            $data_log = array(
                "material_id" => $material_id,
                "qty" => $_POST['qty'],
                "created_by" => $this->session->userdata('id'),
                "created_at" => $date,
                "note" => "Penambahan inventory melalui Kas Besar",
            );
            $this->M_data->InsertData('log_inventory_organization', $data_log);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $msg = "Penambahan Material ";
                $this->flashdata_succeed1($msg);
                redirect('/');
            } else {
                $msg = "Penambahan Material ";
                $this->flashdata_failed1($msg);
                redirect('/');
            }
        }
    }

    public function update_inventory()
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
                redirect('/');
            } else {
                $this->flashdata_failed1($msg);
                redirect('/');
            }
        }
    }

    public function transfer()
    {
        $this->form_validation->set_rules('qty', 'Quantity', 'required|greater_than[0]');
        $material_id = $_POST['material_id'];
        $project_id = $_POST['project_id'];
        $cekqty = $this->M_data->cekMaterialInventory($material_id);
        $qty_inv = $cekqty[0]['qty'];


        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('/');
        } else if ($qty_inv < $_POST['qty']) {
            $pesan = "Jumlah Transfer yang diinput tidak boleh melebihi Inventory yang ada";
            $this->flashdata_failed1($pesan);
            redirect('/');
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
                redirect('/');
            } else {
                $msg = "Transfer Material";
                $this->flashdata_failed1($msg);
                redirect('/');
            }
        }
    }



    public function delete($id)
    {
        $where = array('id' => $id);
        $res = $this->M_data->DeleteData('mst_kas', $where);
        if ($res >= 1) {
            $this->flashdata_succeed();
        } else {
            $this->flashdata_failed();
        }
    }



    public function tambah_kas()
    {
        $id = $this->input->post('organization_id');
        $get = $this->M_data->GetData("mst_organization ", "where id = '$id'");
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
            redirect('/');
        } else {
            $this->flashdata_failed1($msg);
            redirect('/');
        }
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
        redirect('/');
    }
    public function flashdata_failed()
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
        redirect('/');
    }

    public function flashdata_succeed1($pesan)
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">$pesan Berhasil </div></div>");
    }
    public function flashdata_failed1($pesan)
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">$pesan Gagal</div></div>");
    }
}
