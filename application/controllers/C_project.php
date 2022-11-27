<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_project extends CI_Controller
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
        $this->load->helper('form');
        $this->load->library('Lharby');
    }

    public function index() //project on progress
    {

        $databelum = $this->M_project->getProject(0);
        $datasudah = $this->M_project->getProject(1);

        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'databelum' => $databelum,
            'datasudah' => $datasudah,

        );
        $this->load->view('project/index', $show);
        // $this->load->view('data');
    }

    public function project_finished() //project on progress
    {
        $status = 1; //on progress
        $data = $this->M_project->getProject($status);
        // $data = $this->M_data->showdata("mst_project");
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data' => $data,

        );
        $this->load->view('project/v_project_finished', $show);
    }

    // public function rap() {
    //     $id = $this->uri->segment(3);
    //     $get = $this->M_data->GetData2("mst_project ","where id = '$id'")->row();

    //     $kirim['id'] = $get->id;
    //     $kirim['nama'] = $get->project_name;
    //     $kirim['alamat'] = $get->description;

    //     $this->output
    //             ->set_content_type('application/json')
    //             ->set_output(json_encode($kirim));
    // }


    public function add()
    {
        $this->form_validation->set_rules('project_name', 'Project Name', 'required|regex_match[/^[][a-zA-Z0-9@# ,().]+$/]');
        // $this->form_validation->set_rules('rab_project', 'Total RAB', 'required|numeric|greater_than[0]');

        $date = date('Y-m-d H:i:s');
        $now = strtotime($date);
        $deadline = strtotime($_POST['project_deadline']);
        $a = $_POST['rab_project'];
        $rab_projec = str_replace('.', '', $a); //ubah format rupiah ke integer
        $rab_project = intval($rab_projec);
        if ($now > $deadline) {
            $pesan = "Input waktu deadline dengan tanggal yang benar";
            $this->flashdata_failed1($pesan);
            redirect('project_on');
        } else if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('project_on');
        } else {
            $data = array(
                "project_name" => $_POST['project_name'],
                "project_location" => $_POST['project_location'],
                "project_deadline" => $_POST['project_deadline'],
                "rab_project" => $rab_project,
                "organization_id" => 1, //root organization
                "created_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $this->db->insert('mst_project', $data);
            $project_id = $this->db->insert_id();
            $pesan = "Pembuatan Project Sukses";
            $dataRap = array(
                "project_id" => $project_id,
                "last_updated_by" => $this->session->userdata('id'),
            );
            $this->db->insert('akk_rap', $dataRap);

            $this->flashdata_succeed1($pesan);
            redirect('project_on');
        }
    }

    public function do_update()
    {
        $id = $this->input->post('project_id');
        $this->form_validation->set_rules('project_name', 'Project Name', 'required|regex_match[/^[][a-zA-Z0-9@# ,().]+$/]');
        $this->form_validation->set_rules('rab_project', 'Total RAB', 'required|numeric|greater_than[0]');
        $date = date('Y-m-d H:i:s');
        $get = $this->M_data->GetData("mst_project ", "where id = '$id'");
        $now = $get[0]['project_deadline'];
        $deadline = strtotime($_POST['project_deadline']);
        $a = $_POST['rab_project'];
        $rab_projec = str_replace('.', '', $a); //ubah format rupiah ke integer
        $rab_project = intval($rab_projec);
        if ($now >= $deadline) {
            $pesan = "Input waktu deadline dengan tanggal yang benar";
            $this->flashdata_failed1($pesan);
            redirect('project_on');
        } else {
            $get = $this->M_data->GetData2("mst_project ", "where id = '$id'")->row();
            $where = array('id' => $id);
            $date = date('Y-m-d H:i:s');
            $data = array(
                'project_name' => $_POST['project_name'],
                'project_location' => $_POST['project_location'],
                'project_deadline' => $_POST['project_deadline'],
                'rab_project' => $rab_project,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => $date,
            );

            $res = $this->M_data->UpdateData('mst_project', $data, $where);
            if ($res >= 1) {
                $pesan = "Edit Project Sukses";
                $this->flashdata_succeed1($pesan);
                redirect('project_on');
            } else {
                $pesan = "Edit Project Gagal";
                $this->flashdata_failed1($pesan);
                redirect('project_on');
            }
        }
    }


    public function create_pengajuan_biaya()
    {

        $this->form_validation->set_rules('rap_biaya_id', 'Rap Item', 'required');
        $this->form_validation->set_rules('jumlah_pengajuan', 'Jumlah Pengajuan', 'required');
        $rap_biaya_id = $_POST['rap_biaya_id'];
        $a = $_POST['jumlah_pengajuan'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_pengajuan = intval($b);
        $date = date('Y-m-d H:i:s');
        $project_id = $_POST['project_id'];
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('pengajuan');
        } else {

            $data = array(
                "pengajuan_id" => $_POST['pengajuan_id'],
                "rap_biaya_id" => $_POST['rap_biaya_id'],
                "jumlah_pengajuan" => $jumlah_pengajuan,
                "note" => $_POST['note'],
                "last_updated_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $this->db->insert('akk_pengajuan_biaya', $data);
            $pesan = "Pembuatan Pengajuan Sukses";
            $this->flashdata_succeed1($pesan);
            redirect('pengajuan');
        }
    }

    public function updatepengajuan()
    {
        $id = $this->input->post('pengajuan_biaya_id');
        $project_id = $_POST['project_id'];

        $a = $_POST['jumlah_pengajuan'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_pengajuan = intval($b);

        $this->form_validation->set_rules('jumlah_pengajuan', 'Jumlah Pengajuan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('pengajuan/' . $project_id);
        } else {
            $get = $this->M_data->GetData2("akk_pengajuan_biaya ", "where id = '$id'")->row();
            $where = array('id' => $id);
            $date = date('Y-m-d H:i:s');

            $data = array(
                'jumlah_pengajuan' => $jumlah_pengajuan,
                'note' => $_POST['note'],

                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => $date,

            );

            $res = $this->M_data->UpdateData('akk_pengajuan_biaya', $data, $where);
            if ($res >= 1) {
                $pesan = "Update Pengajuan Sukses";
                $this->flashdata_succeed1($pesan);
                redirect('pengajuan/' . $project_id);
            } else {
                $pesan = "Update Pengajuan Gagal";
                $this->flashdata_failed1($pesan);
                redirect('pengajuan/' . $project_id);
            }
        }
    }

    public function create_rap_project()
    {
        $this->form_validation->set_rules('nama_jenis_rap', 'Jenis Rap', 'required');
        $a = $_POST['jumlah_biaya'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_biaya = intval($b);
        $date = date('Y-m-d H:i:s');
        $project_id = $_POST['project_id'];
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('project_detail/' . $project_id);
        } else {
            $rap_id = $_POST['rap_id'];
            // $get = $this->M_data->GetData("akk_rap ","where id = '$rap_id'");
            // $total_rap_now = $get[0]['total_biaya'];
            // $jumlah_biaya = $_POST['jumlah_biaya'];
            // $total_rap_current = $total_rap_now + $jumlah_biaya;

            // $where = array('id' => $rap_id);

            // $data_updt_rap = array(
            //     "total_biaya" => $total_rap_current,
            //     "last_updated_by" => $this->session->userdata('id'),
            //     "updated_at" => $date,
            // );

            $data = array(
                "rap_id" => $rap_id,
                "kategori_biaya_id" => $_POST['kategori_biaya_id'],
                "nama_pekerjaan" => $_POST['nama_pekerjaan'],
                "jumlah_biaya" => $jumlah_biaya,
                "note" => $_POST['note'],
                "last_update_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $this->db->trans_start();
            $this->db->insert('akk_rap_biaya', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $pesan = "Tambah Biaya RAP Sukses";
                $this->flashdata_succeed1($pesan);
                redirect('project_detail/' . $project_id);
            } else {
                $pesan = "Tambah Biaya RAP Gagal";
                $this->flashdata_failed1($pesan);
                redirect('project_detail/' . $project_id);
            }
        }
    }

    public function update_rap()
    {
        $this->form_validation->set_rules('nama_jenis_rap', 'Jenis Rap', 'required');
        $a = $_POST['jumlah_biaya'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_biaya = intval($b);
        $date = date('Y-m-d H:i:s');
        $project_id = $_POST['project_id'];
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('project_detail/' . $project_id);
        } else {
            $id = $_POST['rap_item_id'];
            // $get = $this->M_data->GetData("akk_rap ","where id = '$rap_id'");
            // $total_rap_now = $get[0]['total_biaya'];
            // $jumlah_biaya = $_POST['jumlah_biaya'];
            // $total_rap_current = $total_rap_now + $jumlah_biaya;
            $where = array('id' => $id);
            // $data_updt_rap = array(
            //     "total_biaya" => $total_rap_current,
            //     "last_updated_by" => $this->session->userdata('id'),
            //     "updated_at" => $date,
            // );
            $data = array(
                "kategori_biaya_id" => $_POST['kategori_biaya_id'],
                "jenis_biaya_id" => $_POST['jenis_biaya_id'],
                "nama_jenis_rap" => $_POST['nama_jenis_rap'],
                "nama_pekerjaan" => $_POST['nama_pekerjaan'],
                "jumlah_biaya" => $jumlah_biaya,
                "last_update_by" => $this->session->userdata('id'),
                "updated_at" => $date,
            );
            $this->db->trans_start();
            $this->M_data->UpdateData('akk_rap_biaya', $data, $where);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $pesan = "Update RAP Sukses";
                $this->flashdata_succeed1($pesan);
                redirect('project_detail/' . $project_id);
            } else {
                $pesan = "Update RAP Sukses";
                $this->flashdata_failed1($pesan);
                redirect('project_detail/' . $project_id);
            }
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
            redirect('pengajuan');
        } else {
            $data = array(
                "project_id" => $project_id,
                "rap_id"    => $cekrap[0]['id'],
                "last_updated_by" => $this->session->userdata('id'),
            );
            $res = $this->db->insert('akk_pengajuan', $data);
            if ($res > 0) {
                redirect('pengajuan/');
            } else {
                $this->flashdata_failed_rap();
                redirect('project_detail/' . $project_id);
            }
        }
    }

    public function detail_rap($id)
    {
        $get = $this->M_project->getRap($id);
        $datarapformedit = $this->M_project->getBiayaRapformEdit($get[0]['id']);
        $data_rap_biaya = $this->M_project->getBiayaRap($get[0]['id'], 1);
        $data_rap_biaya2 = $this->M_project->getBiayaRap($get[0]['id'], 2);
        $data_rap_biaya3 = $this->M_project->getBiayaRap($get[0]['id'], 3);
        $data_rap_biaya4 = $this->M_project->getBiayaRap($get[0]['id'], 4);
        $datakategori = $this->M_data->showdata("mst_kategori_biaya");
        $datajenis = $this->M_data->showdata("mst_jenis_biaya");
        $tgl = $get[0]['project_deadline'];
        $deadline = $this->convert_date($tgl);
        $rab_project = $this->lharby->formatRupiah($get[0]['rab_project']);
        $cash_in_hand = $this->lharby->formatRupiah($get[0]['cash_in_hand']);
        $data = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'project_id' => $id,
            'rap_id' => $get[0]['id'],
            'project_name' => $get[0]['project_name'],
            'project_location' => $get[0]['project_location'],
            'cash_in_hand' => $cash_in_hand,
            'project_deadline' => $deadline,
            'rab_project' => $rab_project,
            'is_rap_confirm' => $get[0]['is_rap_confirm'],
            'datakategori' => $datakategori,
            'datajenis' => $datajenis,
            'data_rap_biaya' => $data_rap_biaya,
            'data_rap_biaya2' => $data_rap_biaya2,
            'data_rap_biaya3' => $data_rap_biaya3,
            'data_rap_biaya4' => $data_rap_biaya4,
            'datarapformedit' => $datarapformedit,

        );

        $this->load->view('project/v_rap', $data);
    }

    public function getJenisBiaya($id)
    {
        //  $id=$this->input->post('id');


        $data = $this->M_project->getJenisrap($id);


        echo json_encode($data);
    }


    public function detail_pengajuan($id)
    { //belom diapaapain
        $get = $this->M_project->getPengajuan($id);
        $data_pengajuan_biaya = $this->M_project->getBiayaPengajuan($get[0]['pengajuan_id']);
        $data_rap_biaya = $this->M_project->getBiayaRap2($get[0]['id']);

        $datakategori = $this->M_data->showdata("mst_kategori_biaya");
        $datajenis = $this->M_data->showdata("mst_jenis_biaya");
        $tgl = $get[0]['project_deadline'];
        $rab = $get[0]['rab_project'];
        $rab_biaya = $this->lharby->formatRupiah($rab);
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
            'rab_project' => $rab_biaya,
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
            redirect('project_detail/' . $project_id);
        } else {
            $pesan = "" . $msg . " RAP Gagal";
            $this->flashdata_failed1($pesan);
            redirect('project_detail/' . $project_id);
        }
    }

    public function inventory_add()
    {
        $this->form_validation->set_rules('qty', 'Quantity', 'required|greater_than[0]');
        $material_id = $_POST['material_id'];
        $date = date('Y-m-d H:i:s');
        $project_id = $_POST['project_id'];
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('project_detail/' . $project_id);
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
                redirect('project_detail/' . $project_id);
            } else {
                $msg = "Penambahan Material Gagal";
                $this->flashdata_failed1($msg);
                redirect('project_detail/' . $project_id);
            }
        }
    }



    public function detail($id)
    {
        $get = $this->M_data->GetData("mst_project ", "where id = '$id'");
        $cekrap = $this->M_data->GetData("akk_rap ", "where project_id = '$id'");
        $listProject = $this->M_project->getProject(0);
        $totalRap = $this->M_project->getDetailProject($id);
        $data_rap_biaya = $this->M_laporan->getBiayaRap($get[0]['id']);
        $cash_in_hand = $this->lharby->formatRupiah($get[0]['cash_in_hand']);
        if ($cekrap) { //jika project sudah punya rap
            $is_rap_confirm = $cekrap[0]['is_rap_confirm'];
        } else { //jika project belum ada rap
            $is_rap_confirm = 0;
        }
        $datakategori = $this->M_data->showdata("mst_kategori_biaya");
        $getRap = $this->M_project->getRap($id);
        $data_inventory = $this->M_project->showInventory($id);
        $tgl = $get[0]['project_deadline'];
        $deadline = $this->convert_date($tgl);
        $rab = $get[0]['rab_project'];
        $rab_biaya = $this->lharby->formatRupiah($rab);
        $rap = $totalRap[0]['total_biaya_v'];
        $rap_biaya = $this->lharby->formatRupiah($rap);
        $data_mst_material = $this->M_data->showData("mst_material");
        $data = array(
            'id' => $id,
            'project_id' => $id,
            'project_name' => $get[0]['project_name'],
            'project_location' => $get[0]['project_location'],
            'project_status' => $get[0]['project_status'],
            'project_progress' => $get[0]['project_progress'],
            'datakategori' => $datakategori,
            'project_deadline' => $deadline,
            'rab_project' => $rab_biaya,
            'rap_project' => $rap_biaya,
            'cash_in_hand' => $cash_in_hand,
            'rap_id' => $getRap[0]['id'],
            'is_rap_confirm' => $is_rap_confirm,
            'data_inventory' => $data_inventory,
            'data_mst_material' => $data_mst_material,
            'data_rap_biaya' => $data_rap_biaya,
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
        );

        $this->load->view('project/detail', $data);
    }

    public function update_progress()
    {
        $project_id = $_POST['project_id'];
        $id = $this->input->post('id_project');
        $this->form_validation->set_rules('project_progress', 'Project Progress', 'required|numeric|greater_than[0]');
        $date = date('Y-m-d H:i:s');
        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('project_on');
        } else {
            $where = array('id' => $id);
            $project_progress = $_POST['project_progress'];
            if ($project_progress == 100) { //belum ada aksi jika 100%
                $data = array(
                    'project_progress' => $project_progress,
                    "last_updated_by" => $this->session->userdata('id'),
                    "updated_at" => $date,
                );
            } else {
                $data = array(
                    'project_progress' => $project_progress,
                    "last_updated_by" => $this->session->userdata('id'),
                    "updated_at" => $date,
                );
            }
            $res = $this->M_data->UpdateData('mst_project', $data, $where);
            if ($res >= 1) {
                $pesan = "Update Project Progress Berhasil";
                $this->flashdata_succeed1($pesan);
                redirect('project_on');
            } else {
                $pesan = "Update Project Progress Gagal";
                $this->flashdata_failed1($pesan);
                redirect('project_on');
            }
        }
    }
    public function finishing_project()
    { //menyelesain project
        $id = $_POST['id_project'];
        $project_id = $_POST['project_id'];
        $finish_at = $_POST['finish_at'];
        $get = $this->M_data->GetData("mst_project ", "where id = '$id'");
        $cash_in_hand_project = $get[0]['cash_in_hand'];
        $project_name = $get[0]['project_name'];
        $organization_id = $get[0]['organization_id'];
        $note = 'RETURN CASH PROJECT ' . $project_name;
        $getkas = $this->M_data->GetData("mst_organization ", "where id = '$organization_id'");
        $cash_in_hand_kas = $getkas[0]['cash_in_hand'];
        $total_cash = $cash_in_hand_kas + $cash_in_hand_project;
        $where = array('id' => $id);
        $date = date('Y-m-d H:i:s');
        $data = array( //cash dikosongkan , dan status menjadi 1 (selesai)
            "project_status" => 1,
            "project_progress" => 100,
            "cash_in_hand" => 0,
            "last_updated_by" => $this->session->userdata('id'),
            "updated_at" => $date,
            "finish_at" => $finish_at,
        );
        $data_kas_log = array( //insert log organization
            "cash_additional" => $cash_in_hand_project,
            "note" => $note,
            "created_by" => $this->session->userdata('id'),
            "created_at" => $date,
        );
        $data_kas = array( //update cash orgnization
            "cash_in_hand" => $total_cash,
            "updated_by" => $this->session->userdata('id'),
            "updated_at" => $date,
        );
        $where_kas = array('id' => $organization_id);
        $this->db->trans_start();
        $this->M_data->UpdateData('mst_project', $data, $where);
        $this->M_data->UpdateData('mst_organization', $data_kas, $where_kas);
        $datainventory = $this->M_project->GetDataInventory($id);
        foreach ($datainventory as $di) {
            if ($di['mat_id_inv'] == null) {
                $data_ins = array(
                    "material_id" => $di['mat_id_prj'],
                    "qty" => $di['qty_prj'],
                );
                $this->M_data->InsertData('akk_inventory', $data_ins);
            } else {
                $data_up = array(
                    "qty" => $di['qty_prj'] + $di['qty_inv']
                );
                $whereup = array('material_id' => $di['mat_id_prj']);
                $this->M_data->UpdateData('akk_inventory', $data_up, $whereup);
            }
        }
        $this->M_data->InsertData('log_mst_organization', $data_kas_log);
        //  $this->db->insert_batch('akk_inventory', $datainventory);
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            $pesan = "Penyelesaian Project Sukses";
            $this->flashdata_succeed1($pesan);
            redirect('project_on');
        } else {
            $pesan = "Penyelesaian Project Gagal";
            $this->flashdata_failed1($pesan);
            redirect('project_on');
        }
    }



    public function update_inventory()
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
            } else {
                $qtyakhir = $qty_awal - $qty;
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
                $this->flashdata_succeed_rap();
                redirect('project_detail/' . $project_id);
            } else {
                $this->flashdata_failed_rap();
                redirect('project_detail/' . $project_id);
            }
        }
    }

    public function create_penerimaan_termin()
    {

        $this->form_validation->set_rules('project_id', 'Project', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');
        $this->form_validation->set_rules('termin', 'Termin', 'required');
        $project_id = $_POST['project_id'];

        $a = $_POST['nominal'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $nominal = intval($b);

        $date = date('Y-m-d H:i:s');

        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('termin/' . $project_id);
        } else {

            $data = array(
                "project_id" => $project_id,
                "nominal" => $nominal,
                "termin_ke" => $_POST['termin'],
                "note" => $_POST['note'],
                "created_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $res = $this->db->insert('akk_penerimaan_project', $data);
            if ($res >= 1) {
                $pesan = "Penerimaan Termin Project Berhasil";
                $this->flashdata_succeed1($pesan);
                redirect('termin/' . $project_id);
            } else {
                $pesan = "Penerimaan Termin Project Gagal";
                $this->flashdata_failed1($pesan);
                redirect('termin/' . $project_id);
            }
        }
    }

    public function create_hutang()
    {

        $this->form_validation->set_rules('project_id', 'Project', 'required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required');
        $project_id = $_POST['project_id'];

        $a = $_POST['nominal'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $nominal = intval($b);

        $date = date('Y-m-d H:i:s');

        if ($this->form_validation->run() == FALSE) {
            $pesan = validation_errors();
            $this->flashdata_failed1($pesan);
            redirect('pengajuan/' . $project_id);
        } else {

            $data = array(
                "project_id" => $project_id,
                "nominal" => $nominal,
                "note" => $_POST['note'],
                "created_by" => $this->session->userdata('id'),
                "created_at" => $date,
            );
            $res = $this->db->insert('akk_hutang', $data);
            if ($res >= 1) {
                $pesan = "Pengajuan Hutang Berhasil";
                $this->flashdata_succeed1($pesan);
                redirect('project_detail/' . $project_id);
            } else {
                $pesan = "Pengajuan Hutang Gagal";
                $this->flashdata_failed1($pesan);
                redirect('project_detail/' . $project_id);
            }
        }
    }


    public function delete($id)
    {
        $where = array('id' => $id);
        $res = $this->M_data->DeleteData('mst_project', $where);
        if ($res >= 1) {
            $this->flashdata_succeed();
        } else {
            $this->flashdata_failed();
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
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">$pesan </div></div>");
    }
    public function flashdata_failed1($pesan)
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">$pesan </div></div>");
    }
}
