<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pengajuan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_transaksi");
        $this->load->model("M_pengajuan");
        $this->load->model("M_laporan");
        $this->load->model("M_project");
        $this->load->model("M_data");
        $this->load->library('Lharby');
    }

    public function index() //project on progress
    {

        $data = $this->M_transaksi->pengajuanbelumapprove();
        $datapengajuansudahapprove = $this->M_transaksi->pengajuansudahapprove();
        $project = $this->M_transaksi->getProject(0);
        // $data_rap_biaya = $this->M_pengajuan->getBiayaRap();

        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data' => $data,
            'datapengajuansudahapprove' => $datapengajuansudahapprove,
            'project' => $project,
            // 'data_rap_biaya' => $data_rap_biaya,

        );
        $this->load->view('pengajuan/index', $show);
    }

    public function getRap($project_id)
    {
        $id = $this->input->post('id');
        $data = $this->M_laporan->getBiayaRap($project_id, 1);

        echo json_encode($data);
    }

    public function detail($id)
    {
        $get = $this->M_pengajuan->getPengajuan($id);
        $data_pengajuan = $this->M_pengajuan->showpengajuandetail($id);
        $tgl = $get[0]['project_deadline'];
        $deadline = $this->convert_date($tgl);
        $rab_project = $this->lharby->formatRupiah($get[0]['rab_project']);
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
            'data_pengajuan' => $data_pengajuan,

        );


        $this->load->view('pengajuan/detail', $data);
    }

    public function approved()
    {
        $is_approved = $_POST['is_approved'];
        $pengajuan_biaya_id = $_POST['pengajuan_biaya_id'];
        $pengajuan_id = $_POST['pengajuan_id'];
        $a = $_POST['jumlah_approval'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_approval = intval($b);
        $msg = $_POST['msg'];
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
                'last_updated_by' => $this->session->userdata('id'),
            );
            $whereapp = array('pengajuan_biaya_id' => $pengajuan_biaya_id);
            $this->M_pengajuan->UpdateData('akk_pengajuan_approval', $data_approval, $whereapp);
        } else {
            $data_insert = array(
                'pengajuan_id' => $pengajuan_id,
                'pengajuan_biaya_id' => $pengajuan_biaya_id,
                'jumlah_approval' => $jumlah_approval,
                'created_at' => $date,
                'last_updated_by' => $this->session->userdata('id'),
            );
            $this->M_pengajuan->insertData('akk_pengajuan_approval', $data_insert);
        }
        $this->M_pengajuan->UpdateData('akk_pengajuan_biaya', $data_update, $where);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $pesan = "" . $msg . " Pengajuan Gagal";
            $this->flashdata_failed1($pesan);
            redirect('approval/');   // generate an error... or use the log_message() function to log your error
        } else {
            $pesan = "" . $msg . " Pengajuan Sukses";
            $this->flashdata_succeed1($pesan);
            redirect('approval/');
        }
    }

    public function unapproved()
    {
        $is_approved = $_POST['is_approved'];
        $pengajuan_biaya_id = $_POST['pengajuan_biaya_id'];
        $pengajuan_id = $_POST['pengajuan_id'];
        $msg = $_POST['msg'];
        $where = array('id' => $pengajuan_biaya_id);
        $date = date('Y-m-d H:i:s');
        $data_update = array(
            'is_approved' => $is_approved,
            "last_updated_by" => $this->session->userdata('id'),
            "updated_at" => $date,
        );
        $this->db->trans_start();
        $this->M_pengajuan->UpdateData('akk_pengajuan_biaya', $data_update, $where);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $pesan = "" . $msg . " Pengajuan Gagal";
            $this->flashdata_failed1($pesan);
            redirect('pengajuan/');   // generate an error... or use the log_message() function to log your error
        } else {
            $pesan = "" . $msg . " Pengajuan Sukses";
            $this->flashdata_succeed1($pesan);
            redirect('pengajuan/');
        }
    }

    public function generaterap()
    {
        $project_id = $_POST['project_id'];
        $cekrap = $this->M_project->GetData("akk_rap ", "where project_id = '$project_id'");
        if ($cekrap) {
            redirect('rap/' . $project_id);
        } else {
            $data = array(
                "project_id" => $project_id,
                "last_updated_by" => $this->session->userdata('id'),
            );
            $res = $this->db->insert('akk_rap', $data);
            if ($res > 0) {
                redirect('rap/' . $project_id);
            } else {
                $this->flashdata_failed_rap();
                redirect('project_detail/' . $project_id);
            }
        }
    }

    public function generatepengajuan()
    {
        $project_id = $_POST['project_id'];
        $cekpengajuan = $this->M_project->GetData("akk_pengajuan ", "where project_id = '$project_id'");
        $cekrap = $this->M_project->GetData("akk_rap ", "where project_id = '$project_id'");

        if ($cekpengajuan) {
            redirect('pengajuan/' . $project_id);
        } else {
            $data = array(
                "project_id" => $project_id,
                "rap_id"    => $cekrap[0]['id'],
                "last_updated_by" => $this->session->userdata('id'),
            );
            $res = $this->db->insert('akk_pengajuan', $data);
            if ($res > 0) {
                redirect('pengajuan/' . $project_id);
            } else {
                $this->flashdata_failed_rap();
                redirect('project_detail/' . $project_id);
            }
        }
    }



    public function detail_pengajuan($id)
    { //belom diapaapain
        $get = $this->M_project->getPengajuan($id);
        $data_pengajuan_biaya = $this->M_project->getBiayaPengajuan($get[0]['id']);
        $data_rap_biaya = $this->M_project->getBiayaRap2($get[0]['id']);
        $datakategori = $this->M_data->showdata("mst_kategori_biaya");
        $datajenis = $this->M_data->showdata("mst_jenis_biaya");
        $tgl = $get[0]['project_deadline'];
        $deadline = $this->convert_date($tgl);
        $data = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'project_id' => $id,
            'rap_id' => $get[0]['id'],
            'pengajuan_id' => $get[0]['pengajuan_id'],
            'project_name' => $get[0]['project_name'],
            'project_location' => $get[0]['project_location'],
            'project_deadline' => $deadline,
            'rab_project' => $get[0]['rab_project'],
            'is_pengajuan_confirm' => $get[0]['is_pengajuan_confirm'],
            'data_pengajuan_biaya' => $data_pengajuan_biaya,
            'data_rap_biaya' => $data_rap_biaya,

        );

        $this->load->view('project/v_pengajuan', $data); //view belom diedit
    }

    public function confirmrap()
    {
        $is_rap_confirm = $_POST['is_rap_confirm'];
        $rap_id = $_POST['rap_id'];
        $project_id = $_POST['project_id'];
        $msg = $_POST['msg'];
        $where = array('id' => $rap_id);
        $date = date('Y-m-d H:i:s');
        $data = array(
            'is_rap_confirm' => $_POST['is_rap_confirm'],


            "last_updated_by" => $this->session->userdata('id'),
            "updated_at" => $date,

        );

        $res = $this->M_data->UpdateData('akk_rap', $data, $where);
        if ($res >= 1) {
            $pesan = "" . $msg . " RAP Sukses";
            $this->flashdata_succeed1($pesan);
            redirect('rap/' . $project_id);
        } else {
            $pesan = "" . $msg . " RAP Gagal";
            $this->flashdata_failed1($pesan);
            redirect('rap/' . $project_id);
        }
    }



    public function create_pengajuan_biaya()
    {
        $this->form_validation->set_rules('jumlah_pengajuan', 'Jumlah Pengajuan', 'required');

        $date = date('Y-m-d H:i:s');
        $project_id = $_POST['project_id'];
        if ($this->form_validation->run() == FALSE) {
            $this->flashdata_failed_rap();
            redirect('pengajuan/' . $project_id);
        } else {
            $data = array(
                "pengajuan_id" => $_POST['pengajuan_id'],
                "rap_biaya_id" => $_POST['rap_biaya_id'],
                "jumlah_pengajuan" => $_POST['jumlah_pengajuan'],
                "last_updated_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $this->db->insert('akk_pengajuan_biaya', $data);
            $this->flashdata_succeed_rap();
            redirect('pengajuan/' . $project_id);
        }
    }

    public function updatepengajuan()
    {
        $id = $this->input->post('akk_pengajuan_biaya_id');
        $where = array('id' => $id);
        $date = date('Y-m-d H:i:s');
        $a = $_POST['jumlah_pengajuan'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah = intval($b);
        $data = array(
            'jumlah_pengajuan' => $jumlah,
            "last_updated_by" => $this->session->userdata('id'),
            "updated_at" => $date,
            "note" => $_POST['note'],
        );
        $res = $this->M_data->UpdateData('akk_pengajuan_biaya', $data, $where);
        if ($res >= 1) {
            $pesan = " Update Pengajuan Berhasil";
            $this->flashdata_succeed1($pesan);
            redirect('pengajuan');
        } else {
            $pesan = " Update Pengajuan Gagal";
            $$this->flashdata_failed1($pesan);
            redirect('pengajuan');
        }
    }

    public function getListBiayaRap($id)
    {
        //  $id=$this->input->post('id');

        $get = $this->M_data->GetData("mst_project ", "where id = '$id'");
        $data_rap_biaya = $this->M_laporan->getBiayaRap($get[0]['id'], 1);


        echo json_encode($data_rap_biaya);
    }

    public function getPengajuanId($id)
    {
        //  $id=$this->input->post('id');

        $get = $this->M_project->getPengajuan($id);

        echo $get[0]['pengajuan_id'];
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
