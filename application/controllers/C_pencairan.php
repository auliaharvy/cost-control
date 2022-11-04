<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pencairan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_pencairan");
        $this->load->model("M_transaksi");
        $this->load->library('Lharby');
    }

    public function index() //project on progress
    {

        $data = $this->M_pencairan->showPencairan();
        $datalogpencairan = $this->M_transaksi->dataPencairan();

        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data' => $data,
            'datalogpencairan' => $datalogpencairan,

        );
        $this->load->view('pencairan/index', $show);
    }

    public function list_pencairan() //project on progress
    {

        $data = $this->M_pencairan->dataPencairan();

        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data' => $data,

        );
        $this->load->view('pencairan/list', $show);
    }

    public function detail($id)
    {
        $get = $this->M_pencairan->getPengajuan($id); //get projetc header
        $destination = $this->M_pencairan->showdata("mst_office_type");
        $data_pencairan = $this->M_pencairan->showPengajuanApproval($id);
        $tgl = $get[0]['project_deadline'];
        $rab_project = $this->lharby->formatRupiah($get[0]['rab_project']);
        $deadline = $this->convert_date($tgl);
        $data = array(
            'id' => $id,
            'project_name' => $get[0]['project_name'],
            'project_location' => $get[0]['project_location'],

            'project_deadline' => $deadline,
            'rab_project' => $rab_project,
            // 'is_rap_confirm' => $cekrap[0]['is_rap_confirm'],

            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data_pencairan' => $data_pencairan,
            'destination' => $destination,

        );


        $this->load->view('pencairan/detail', $data);
    }

    public function getProjectOfficeId($pengajuan_id)
    {
        $id = $this->input->post('id');

        if ($id == 1) { //office
            $data = $this->M_pencairan->getOffice();
        } else { //project
            $data = $this->M_pencairan->getPengajuan($pengajuan_id);
        }

        echo json_encode($data);
    }



    public function create_kirim_pencairan()
    {

        $this->form_validation->set_rules('jumlah_uang', 'Jumlah Pencairan', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('destination_id', 'destination', 'required');
        $this->form_validation->set_rules('project_office_id', 'Project / Office ', 'required');
        $date = date('Y-m-d H:i:s');
        $pengajuan_id = $_POST['pengajuan_id'];
        $organization_id = 1;
        $destination_id = $_POST['destination_id'];
        $project_office_id = $_POST['project_office_id'];
        $jumlah_uang = $_POST['jumlah_uang'];
        $pengajuan_approval_id = $_POST['pengajuan_approval_id'];

        if ($this->form_validation->run() == FALSE) {

            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('pengajuan/');
        } else {
            $data = array(
                "organization_id" => $organization_id, //default 
                "pengajuan_approval_id" => $pengajuan_approval_id,
                "destination_id" => $destination_id,
                "project_office_id" => $project_office_id,
                "jumlah_uang" => $jumlah_uang,
                "last_updated_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $organization = $this->M_data->GetData("mst_organization ", "where id = '$organization_id'");
            $cash_org = $organization[0]['cash_in_hand'];
            $updt_cash_org = $cash_org - $jumlah_uang;
            if ($destination_id == 1) { //office
                $office = $this->M_data->GetData("mst_office ", "where id = '$project_office_id'");
                $cash_office = $office[0]['cash_in_hand'];
                $updt_cash_off_proj = $cash_office + $jumlah_uang;
                $table = 'mst_office';
            } else { //project
                $project = $this->M_data->GetData("mst_project ", "where id = '$project_office_id'");
                $cash_project = $project[0]['cash_in_hand'];
                $updt_cash_off_proj = $cash_project + $jumlah_uang;
                $table = 'mst_project';
            }
            $data_update_approv = array(
                "is_send_cash" => 1,
                "updated_at" => $date,
                "last_updated_by" => $this->session->userdata('id'),
            );
            $where_approv = array('id' => $pengajuan_approval_id);
            $data_update_org = array(
                "cash_in_hand" => $updt_cash_org,
                "updated_at" => $date,
                "updated_by" => $this->session->userdata('id'),
            );
            $where_org = array('id' => $organization_id);
            $data_update_off_proj = array(
                "cash_in_hand" => $updt_cash_off_proj,
                "updated_at" => $date,
                "last_updated_by" => $this->session->userdata('id'),
            );
            $where_off_proj = array('id' => $project_office_id);
            $this->db->trans_start();
            $this->db->insert('trx_pengiriman_uang', $data);
            $this->M_data->UpdateData('akk_pengajuan_approval', $data_update_approv, $where_approv);
            $this->M_data->UpdateData('mst_organization', $data_update_org, $where_org);
            $this->M_data->UpdateData($table, $data_update_off_proj, $where_off_proj);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $this->flashdata_succeed_rap();
                redirect('pencairan/');
            } else {
                $this->flashdata_failed_rap();
                redirect('pencairan_/');
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
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">$pesan !!!</div></div>");
    }
    public function flashdata_failed1($pesan)
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">$pesan !!!</div></div>");
    }
}
