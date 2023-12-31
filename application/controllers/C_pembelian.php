<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pembelian extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_pembelian");
        $this->load->model("M_transaksi");
        $this->load->model("M_data");
        $this->load->model("M_hutang");
        $this->load->library('Lharby');
        $this->load->library('upload');
    }

    public function index() //project on progress
    {
        $databelum = $this->M_pembelian->showPembelianbelum(); //show pembelian data
        $datasudah = $this->M_pembelian->showPembeliansudah(); //show pembelian data
        $project = $this->M_transaksi->getProject(0);
        $pengajuan = $this->M_pembelian->showPencairan(0);
        $hutang = $this->M_hutang->showHutangbelum(0);
        $project_id = $project[0]['id'];
        $pengajuan_id = $pengajuan[0]['pengajuan_id'];
        $destination_id = 2;
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'databelum' => $databelum,
            'datasudah' => $datasudah,
            'hutang' => $hutang,
            'project' => $project,
            'project_id' => $project_id,
            'project_office_id' => $project_id,
            'pengajuan_id' => $pengajuan_id,
            'destination_id' => $destination_id,
        );
        $this->load->view('pembelian/index', $show);
    }

    public function getListHutang()
    {
        $get = $this->M_hutang->showHutangbelum1();
        echo $get[0]['id'];
    }


    public function getRap($project_id)
    {
        $id = $this->input->post('id');
        $data = $this->M_laporan->getBiayaRap($project_id, 1);

        echo json_encode($data);
    }

    public function list_pencairan() //project on progress
    {

        $data = $this->M_pembelian->dataPencairan();

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
        $get = $this->M_pembelian->getPengajuan($id); //get projetc header
        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('id');
        $project_id = $get[0]['id'];
        $data_rap_biaya = $this->M_pembelian->getBiayaRap($get[0]['id']);
        if ($role == 4) { // pm
            $destination_id = 2;
            $title = 'KAS PROJECT';
            $data_pembelian = $this->M_pembelian->showPencairan($id, $destination_id);
            $data_remaining = $this->M_pembelian->showPencairanRemainingProject($project_id, $destination_id, $user_id);
        } else if ($role == 3 || $role == 2) {
            $destination_id = 1; //office , gm
            $title = 'KAS OFFICE';
            $data_pembelian = $this->M_pembelian->showPencairanOffice($id, $destination_id, $user_id);
            $data_remaining = $this->M_pembelian->showPencairanRemainingOffice($project_id, $destination_id, $user_id);
        } else { //office
            $destination_id = 0;
            $title = 'KAS';
            $data_pembelian = $this->M_pembelian->showPencairan($id, $destination_id);
            $data_remaining = $this->M_pembelian->showPencairanRemaining($id, $destination_id);
        }
        if ($data_remaining) {
            $remaining_pembelian_v = $data_remaining[0]['remaining_pembelian_v'];
        } else {
            $remaining_pembelian_v = 0;
        }
        $tgl = $get[0]['project_deadline'];
        $deadline = $this->convert_date($tgl);
        $rab_project = $this->lharby->formatRupiah($get[0]['rab_project']);
        $data = array(
            'project_id' => $get[0]['project_id'], //kayanya salah ...
            'project_name' => $get[0]['project_name'],
            'project_location' => $get[0]['project_location'],
            'remaining_pembelian_v' => $remaining_pembelian_v,
            'pengajuan_id' => $id,
            'project_deadline' => $deadline,
            'rab_project' => $rab_project,
            'data_rap_biaya' => $data_rap_biaya,
            // 'is_rap_confirm' => $cekrap[0]['is_rap_confirm'],
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'data_pembelian' => $data_pembelian,
            'title' => $title,
        );


        $this->load->view('pembelian/detail', $data);
    }

    public function upload()
    {
        $this->load->model('profile_model');
        $data['current_user'] = $this->auth_model->current_user();

        if ($this->input->method() === 'post') {
            // the user id contain dot, so we must remove it
            $file_name = str_replace('.', '', $data['current_user']->id);
            $config['upload_path']          = './upload/pembelian';
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['file_name']            = $file_name;
            $config['overwrite']            = true;
            $config['max_size']             = 3072; // 1MB
            $config['max_width']            = 1080;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('avatar')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $uploaded_data = $this->upload->data();

                $new_data = [
                    'id' => $data['current_user']->id,
                    'avatar' => $uploaded_data['file_name'],
                ];

                if ($this->profile_model->update($new_data)) {
                    $this->session->set_flashdata('message', 'Avatar updated!');
                    redirect(site_url('admin/setting'));
                }
            }
        }

        $this->load->view('pembelian', $data);
    }

    public function getProjectOfficeId($pengajuan_id)
    {
        $id = $this->input->post('id');

        if ($id == 1) { //office
            $data = $this->M_pembelian->getOffice();
        } else { //project
            $data = $this->M_pembelian->getPengajuan($pengajuan_id);
        }

        echo json_encode($data);
    }

    public function create_belanja()
    {
        $upload = $_POST['upload'];
        $jenis_transaksi = $_POST['jenis_transaksi'];
        $id_hutang = $_POST['id_hutang'];
        $date = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata('id');
        $pengiriman_uang_id = $_POST['pengiriman_uang_id'];
        $project_id = $_POST['project_id'];
        $destination_id = $_POST['destination_id'];
        $proj_off_id = $_POST['project_office_id'];
        $a = $_POST['jumlah_uang_pembelian'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_uang_pembelian = intval($b);
        $getHutang = $this->M_pembelian->GetData("akk_hutang ", "where id = '$id_hutang'");
        $total_hutang = $getHutang[0]['nominal'];
        $project_hutang = $getHutang[0]['project_id'];
        $hasil_hutang = $total_hutang - $jumlah_uang_pembelian;
        $getRapItem = $this->M_pembelian->getBiayaAktualRap($pengiriman_uang_id); //cari data untuk menambahkan jumlah aktual
        $rap_item_id = $getRapItem[0]['rap_biaya_id'];
        $aktual_rap = $getRapItem[0]['jumlah_aktual'];
        $jumlah_aktual_total = $jumlah_uang_pembelian + $aktual_rap;
        if ($jenis_transaksi == 1) {
            $note = $_POST['note'];
        } else {
            $note = $_POST['note'] . ' ( Bayar Hutang ) ';
        }
        $whererap = array('id' => $rap_item_id);
        $datarap = array(
            'jumlah_aktual' => $jumlah_aktual_total,
            "last_update_by" => $user_id,
            "updated_at" => $date,
        );
        $pengajuan_id = $getRapItem[0]['pengajuan_id'];
        $getPencairan = $this->M_pembelian->GetData("trx_pengiriman_uang ", "where id = '$pengiriman_uang_id'");
        $uang_pencairan = $getPencairan[0]['jumlah_uang'];
        if ($jenis_transaksi == 2 && $project_hutang != $project_id) {
            $pesan = "Pengajuan Project tidak sesuai dengan project";
            $this->flashdata_failed1($pesan);
            redirect('pembelian');
        } else if ($jenis_transaksi == 2 && $jumlah_uang_pembelian > $total_hutang) {
            $pesan = "Pembayaran Hutang Gagal Karena Melebihi Hutang yang ada";
            $this->flashdata_failed1($pesan);
            redirect('pembelian');
        } else {
            if ($jumlah_uang_pembelian > $uang_pencairan) {
                if ($jenis_transaksi == 1) {
                    $pesan = "Jumlah Pembelian yang diinput tidak boleh melebihi jumlah yang ada";
                } else {
                    $pesan = "Jumlah Pembayaran Hutang yang diinput tidak boleh melebihi jumlah yang ada";
                }
                $this->flashdata_failed1($pesan);
                redirect('pembelian');
            } else {
                $remaining_pembelian = $uang_pencairan - $jumlah_uang_pembelian;
                if ($remaining_pembelian > 0) {
                    $is_buy = 2; //parsial
                } else {
                    $is_buy = 1; //total
                }
                if ($destination_id == 1) { //office
                    $table = 'mst_office ';
                    $getcash = $this->M_pembelian->GetData($table, "where id = '$proj_off_id'");
                    $cash = $getcash[0]['cash_in_hand'];
                    $total_cash = $cash - $jumlah_uang_pembelian;
                } else { //project
                    $table = 'mst_project ';
                    $getcash = $this->M_pembelian->GetData($table, "where id = '$proj_off_id'");
                    $cash = $getcash[0]['cash_in_hand'];
                    $total_cash = $cash - $jumlah_uang_pembelian;
                }
                $config['upload_path']          = './upload/pembelian/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = '5000';
                $config['max_width']              = '5000';
                $config['encrypt_name']    = TRUE;
                $config['max_height']           = '5000';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('foto')) {
                    $error = array('error' => $this->upload->display_errors());
                    $msg = $error['error'];
                    $this->flashdata_succeed1($msg);
                    redirect('pembelian');
                } else {
                    $data1 = $this->upload->data();
                    $datapembelian = array(
                        "pengiriman_uang_id" => $pengiriman_uang_id,
                        "destination_id" => $destination_id,
                        "project_office_id" => $proj_off_id,
                        "jumlah_uang_pembelian" => $jumlah_uang_pembelian,
                        "created_at" => $date,
                        "last_updated_by" => $user_id,
                        "note" => $note,
                        "upload_file" => $data1['file_name'],
                    );
                    $wheresource = array('id' => $proj_off_id);
                    $datasource = array(
                        "cash_in_hand" => $total_cash,
                        "last_updated_by" => $user_id,
                        "updated_at" => $date,
                    );
                    $where = array('id' => $pengiriman_uang_id);
                    $data = array(
                        "remaining_pembelian" => $remaining_pembelian,
                        "is_buy" => $is_buy,
                        "last_updated_by" => $user_id,
                        "updated_at" => $date,
                        "buy_created_at" => $date,
                    );
                    $wherehutang = array('id' => $id_hutang);
                    if ($total_hutang > $jumlah_uang_pembelian) {
                        $datahutang = array(
                            "is_pay" => 0,
                            "nominal" => $hasil_hutang,
                            "pay_at" => $date,
                            "updated_by" => $user_id,
                        );
                    } else {
                        $datahutang = array(
                            "is_pay" => 1,
                            "pay_at" => $date,
                            "updated_by" => $user_id,
                        );
                    }
                    $this->db->trans_start();
                    if ($jenis_transaksi == 1) {
                        /*Trx Cash Remaining */
                        $where_cash = "where project_id = '$project_id' and destination_id = '$destination_id' and project_office_id = '$proj_off_id'";
                        $getCashRemaining = $this->M_pembelian->GetData("trx_cash_remaining ", $where_cash); //cek ada cash remaining utk project dan destination tsb
                        if ($getCashRemaining) {
                            $id_cash_remaining = $getCashRemaining[0]['id'];
                            $cash_remaining = ($getCashRemaining[0]['cash_remaining']) + $remaining_pembelian;
                            $where_cash_remaining = array(
                                "id" => $id_cash_remaining,
                            );
                            $data_update_cash = array(
                                "cash_remaining" => $cash_remaining,
                                "updated_at" => $date,
                                "last_updated_by" => $user_id,
                            );
                            $this->M_data->UpdateData('trx_cash_remaining', $data_update_cash, $where_cash_remaining);
                        } else { //jika sebelumnya tidak ada sisa pembelanjaan di project dan destination tsb
                            $data_insert_cash = array(
                                "project_id" => $project_id,
                                "destination_id" => $destination_id,
                                "project_office_id" => $proj_off_id,
                                "cash_remaining" => $remaining_pembelian,
                                "created_at" => $date,
                                "last_updated_by" => $user_id,
                            );
                            $this->M_data->InsertData('trx_cash_remaining', $data_insert_cash);
                        }
                        $this->M_data->UpdateData('trx_pengiriman_uang', $data, $where); //update untuk tanda bahwa cash yg dikirim telah dibelanakan
                        $this->M_data->UpdateData($table, $datasource, $wheresource); //update cash in hand source (office ' project')
                        $this->M_data->UpdateData('akk_rap_biaya', $datarap, $whererap);
                        $this->M_data->InsertData('trx_pembelian_barang', $datapembelian);
                    } else {
                        $where_cash = "where project_id = '$project_id' and destination_id = '$destination_id' and project_office_id = '$proj_off_id'";
                        $getCashRemaining = $this->M_pembelian->GetData("trx_cash_remaining ", $where_cash); //cek ada cash remaining utk project dan destination tsb
                        if ($getCashRemaining) {
                            $id_cash_remaining = $getCashRemaining[0]['id'];
                            $cash_remaining = ($getCashRemaining[0]['cash_remaining']) + $remaining_pembelian;
                            $where_cash_remaining = array(
                                "id" => $id_cash_remaining,
                            );
                            $data_update_cash = array(
                                "cash_remaining" => $cash_remaining,
                                "updated_at" => $date,
                                "last_updated_by" => $user_id,
                            );
                            $this->M_data->UpdateData('trx_cash_remaining', $data_update_cash, $where_cash_remaining);
                        } else { //jika sebelumnya tidak ada sisa pembelanjaan di project dan destination tsb
                            $data_insert_cash = array(
                                "project_id" => $project_id,
                                "destination_id" => $destination_id,
                                "project_office_id" => $proj_off_id,
                                "cash_remaining" => $remaining_pembelian,
                                "created_at" => $date,
                                "last_updated_by" => $user_id,
                            );
                            $this->M_data->InsertData('trx_cash_remaining', $data_insert_cash);
                        }
                        $this->M_data->UpdateData('trx_pengiriman_uang', $data, $where); //update untuk tanda bahwa cash yg dikirim telah dibelanakan
                        $this->M_data->UpdateData($table, $datasource, $wheresource); //update cash in hand source (office ' project')
                        $this->M_data->UpdateData('akk_rap_biaya', $datarap, $whererap);
                        $this->M_data->UpdateData('akk_hutang', $datahutang, $wherehutang);
                        $this->M_data->InsertData('trx_pembelian_barang', $datapembelian);
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === TRUE) {
                        if ($jenis_transaksi == 1) {
                            $msg = 'Pembelian Berhasil';
                        } else {
                            $msg = 'Pembayaran Hutang Berhasil';
                        }
                        $this->flashdata_succeed1($msg);
                        redirect('pembelian');
                    } else {
                        if ($jenis_transaksi == 1) {
                            $msg = 'Pembelian Gagal';
                        } else {
                            $msg = 'Pembayaran Hutang Gagal';
                        }
                        $this->flashdata_failed1($msg);
                        redirect('pembelian');
                    }
                }
            }
        }
    }


    public function create_belanja_remaining()
    { //REMAINING BIAYA HARUSNYA DIJADIIN SATU RECORD , BUKAN BANYAK RECORD DI TABLE PENCAIRAN
        $date = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata('id');
        $project_id = $_POST['project_id'];
        $pengajuan_id = $_POST['pengajuan_id'];
        $id_hutang = $_POST['id_hutang'];
        $jenis_transaksi = $_POST['jenis_transaksi'];
        $destination_id = 2;
        $rap_biaya_id = $_POST['rap_biaya_id'];
        $a = $_POST['jumlah_uang_pembelian'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_uang_pembelian = intval($b);
        $getHutang = $this->M_pembelian->GetData("akk_hutang ", "where id = '$id_hutang'");
        $total_hutang = $getHutang[0]['nominal'];
        $project_hutang = $getHutang[0]['project_id'];
        $hasil_hutang = $total_hutang - $jumlah_uang_pembelian;
        if ($jenis_transaksi == 1) {
            $note = $_POST['note'];
        } else {
            $note = $_POST['note'] . ' ( Bayar Hutang Tanpa Pengajuan ) ';
        }
        if ($destination_id == 1) { //office
            $table = 'mst_office ';
            $getcash = $this->M_pembelian->GetData($table, "where id = '$project_id'");
            $cash = $getcash[0]['cash_in_hand'];
            $total_cash = $cash - $jumlah_uang_pembelian; //cash di office
            $data_remaining = $this->M_pembelian->showPencairanRemainingOffice($project_id, $destination_id, $user_id);
            $cash_remaining = ($data_remaining[0]['cash_remaining']) - $jumlah_uang_pembelian; //cash di total remaining office berkurang
            $id_trx_cash_remaining = $data_remaining[0]['id'];
        } else { //project
            $table = 'mst_project ';
            $getcash = $this->M_pembelian->GetData($table, "where id = '$project_id'");
            $cash = $getcash[0]['cash_in_hand'];
            $total_cash = $cash - $jumlah_uang_pembelian;
            $data_remaining = $this->M_pembelian->showPencairanRemainingProject($project_id, $destination_id, $user_id);
            $cash_remaining = ($data_remaining[0]['cash_remaining']) - $jumlah_uang_pembelian; //cash di total remaining office berkurang 
            $id_trx_cash_remaining = $data_remaining[0]['id'];
        }
        $config['upload_path']          = './upload/pembelian/'; // config upload
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = '5000';
        $config['max_width']            = '5000';
        $config['encrypt_name']         = TRUE;
        $config['max_height']           = '5000';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($jenis_transaksi == 2 && $project_hutang != $project_id) {
            $pesan = "Pengajuan Project tidak sesuai dengan project";
            $this->flashdata_failed1($pesan);
            redirect('pembelian');
        } else if ($jenis_transaksi == 2 && $jumlah_uang_pembelian > $total_hutang) {
            $pesan = "Pembayaran Hutang Gagal Karena Melebihi Hutang yang ada";
            $this->flashdata_failed1($pesan);
            redirect('pembelian');
        } else {
            if ($jumlah_uang_pembelian > $cash) {
                if ($jenis_transaksi == 1) {
                    $pesan = "Jumlah Pembelian yang diinput tidak boleh melebihi jumlah yang ada";
                } else {
                    $pesan = "Jumlah Pembayaran Hutang yang diinput tidak boleh melebihi jumlah yang ada";
                }
                $this->flashdata_failed1($pesan);
                redirect('pembelian');
            } else if (!$this->upload->do_upload('foto_tanpa')) {
                $error = array('error' => $this->upload->display_errors());
                $msg = $error['error'];
                $this->flashdata_failed1($msg);
                redirect('pembelian');
            } else {
                $where_trx_remaining = array("id" => $id_trx_cash_remaining);
                $data_trx_remaining = array(
                    "cash_remaining" => $cash_remaining,
                    "updated_at" => $date,
                    "last_updated_by" => $user_id
                );
                $data1 = $this->upload->data();
                $datapembelian_remaining = array(
                    "project_id" => $project_id,
                    "rap_biaya_id" => $rap_biaya_id,
                    "destination_id" => $destination_id,
                    "project_office_id" => $project_id,
                    "jumlah_uang_pembelian" => $jumlah_uang_pembelian,
                    "created_at" => $date,
                    "last_updated_by" => $user_id,
                    "note" => $note,
                    "upload_file" => $data1['file_name'],
                );
                $wherehutang = array('id' => $id_hutang);
                if ($total_hutang > $jumlah_uang_pembelian) {
                    $datahutang = array(
                        "is_pay" => 0,
                        "nominal" => $hasil_hutang,
                        "pay_at" => $date,
                        "updated_by" => $user_id,
                    );
                } else {
                    $datahutang = array(
                        "is_pay" => 1,
                        "pay_at" => $date,
                        "updated_by" => $user_id,
                    );
                }
                $wheresource = array('id' => $project_id);
                $datasource = array(
                    "cash_in_hand" => $total_cash,
                    "last_updated_by" => $user_id,
                    "updated_at" => $date,
                );
                $getRapItem = $this->M_data->GetData("akk_rap_biaya ", "where id = '$rap_biaya_id'"); //cari data untuk menambahkan jumlah aktual
                $aktual_rap = $getRapItem[0]['jumlah_aktual'];
                $jumlah_aktual_total = $jumlah_uang_pembelian + $aktual_rap;
                $whererap = array('id' => $rap_biaya_id);
                $datarap = array(
                    'jumlah_aktual' => $jumlah_aktual_total,
                    "last_update_by" => $user_id,
                    "updated_at" => $date,
                );
                $this->db->trans_start();
                if ($jenis_transaksi == 1) {
                    $this->M_data->UpdateData($table, $datasource, $wheresource); //update cash in hand source (office ' project')
                    $this->M_data->UpdateData('trx_cash_remaining', $data_trx_remaining, $where_trx_remaining);
                    $this->M_data->UpdateData('akk_rap_biaya', $datarap, $whererap);
                    $this->M_data->InsertData('trx_pembelian_barang_remaining', $datapembelian_remaining);
                } else {
                    $this->M_data->UpdateData($table, $datasource, $wheresource); //update cash in hand source (office ' project')
                    $this->M_data->UpdateData('trx_cash_remaining', $data_trx_remaining, $where_trx_remaining);
                    $this->M_data->UpdateData('akk_hutang', $datahutang, $wherehutang);
                    $this->M_data->UpdateData('akk_rap_biaya', $datarap, $whererap);
                    $this->M_data->InsertData('trx_pembelian_barang_remaining', $datapembelian_remaining);
                }
                $this->db->trans_complete();
                if ($this->db->trans_status() === TRUE) {
                    if ($jenis_transaksi == 1) {
                        $msg = 'Pembelian Sisa Pengajuan Berhasil';
                    } else {
                        $msg = 'Pembayaran Hutang Melalui Sisa Pengajuan Berhasil';
                    }
                    $this->flashdata_succeed1($msg);
                    redirect('pembelian');
                } else {
                    if ($jenis_transaksi == 1) {
                        $msg = 'Pembelian Sisa Pengajuan Gagal';
                    } else {
                        $msg = 'Pembayaran Hutang Melalui Sisa Pengajuan Gagal';
                    }
                    $this->flashdata_failed1($msg);
                    redirect('pembelian');
                }
            }
        }
    }

    public function delete()
    {
        $idproject = $_POST['id_project'];
        $idpengiriman = $_POST['id_pengiriman'];
        $idpembelian = $_POST['id_pembelian'];
        $idremaining = $_POST['id_remaining'];
        $idrap = $_POST['id_rap'];
        $a = $_POST['jumlah_pembelian'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_pembelian = intval($b);
        $c = $_POST['cash'];
        $d = str_replace('.', '', $c); //ubah format rupiah ke integer
        $cash = intval($d);
        $getRapItem = $this->M_data->GetData("akk_rap_biaya ", "where id = '$idrap'"); //cari data untuk menambahkan jumlah aktual
        $aktual_rap = $getRapItem[0]['jumlah_aktual'];
        $cekbuy = $_POST['is_buy'];
        $this->db->trans_start();
        if ($cekbuy == 1) {
            $wherepengiriman = array('id' => $idpengiriman);
            $data = array(
                "is_buy" => 0,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
                "buy_created_at" => NULL,
            );
            $whereproject = array('id' => $idproject);
            $dataproject = array(
                "cash_in_hand" => $cash + $jumlah_pembelian,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
            );
            $whererap = array('id' => $idrap);
            $datarap = array(
                "jumlah_aktual" => $aktual_rap - $jumlah_pembelian,
                "last_update_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
            );
            $where = array('id' => $idpembelian);
            $this->M_data->UpdateData('trx_pengiriman_uang', $data, $wherepengiriman);
            $this->M_data->UpdateData('mst_project', $dataproject, $whereproject);
            $this->M_data->UpdateData('akk_rap_biaya', $datarap, $whererap);
            $this->M_data->DeleteData('trx_pembelian_barang', $where);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $pesan = "Penghapusan Transakasi Pembelian Berhasil";
                $this->flashdata_succeed1($pesan);
                redirect('pembelian');
            } else {
                $pesan = "Penghapusan Transakasi Pembelian Gagal";
                $this->flashdata_failed1($pesan);
                redirect('pembelian');
            }
        } else {
            $wherepengiriman = array('id' => $idpengiriman);
            $data = array(
                "is_buy" => 0,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
                "buy_created_at" => NULL,
                "remaining_pembelian" => 0,
            );
            $whereproject = array('id' => $idproject);
            $dataproject = array(
                "cash_in_hand" => $cash + $jumlah_pembelian,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
            );
            $whererap = array('id' => $idrap);
            $datarap = array(
                "jumlah_aktual" => $aktual_rap - $jumlah_pembelian,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
            );
            $where = array('id' => $idpembelian);
            $whereremaining = array('id' => $idremaining);
            $this->M_data->UpdateData('trx_pengiriman_uang', $data, $wherepengiriman);
            $this->M_data->UpdateData('mst_project', $dataproject, $whereproject);
            $this->M_data->UpdateData('akk_rap_biaya', $datarap, $whererap);
            $this->M_data->DeleteData('trx_pembelian_barang', $where);
            $this->M_data->DeleteData('trx_cash_remaining', $whereremaining);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $pesan = "Penghapusan Transakasi Pembelian Berhasil";
                $this->flashdata_succeed1($pesan);
                redirect('pembelian');
            } else {
                $pesan = "Penghapusan Transakasi Pembelian Gagal";
                $this->flashdata_failed1($pesan);
                redirect('pembelian');
            }
        }
    }

    public function deleteremaining()
    {
        $idproject = $_POST['id_project_remaining'];
        $idpembelian = $_POST['id_pembelian_remaining'];
        $idrap = $_POST['id_rap_remaining'];
        $a = $_POST['jumlah_pembelian_remaining'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_pembelian = intval($b);
        $c = $_POST['cash_remaining'];
        $d = str_replace('.', '', $c); //ubah format rupiah ke integer
        $cash = intval($d);
        $getRapItem = $this->M_data->GetData("akk_rap_biaya ", "where id = '$idrap'"); //cari data untuk menambahkan jumlah aktual
        $aktual_rap = $getRapItem[0]['jumlah_aktual'];
        $whereproject = array('id' => $idproject);
        $where = array('id' => $idpembelian);
        $total_cash = $cash + $jumlah_pembelian;
        $dataproject = array(
            "cash_in_hand" => $total_cash,
            "last_updated_by" => $this->session->userdata('id'),
            "updated_at" => date('Y-m-d H:i:s'),
        );
        $whererap = array('id' => $idrap);
        $datarap = array(
            "jumlah_aktual" => $aktual_rap - $jumlah_pembelian,
            "last_update_by" => $this->session->userdata('id'),
            "updated_at" => date('Y-m-d H:i:s'),
        );
        $this->db->trans_start();
        $this->M_data->UpdateData('mst_project', $dataproject, $whereproject); //update untuk tanda bahwa cash yg dikirim telah dibelanakan
        $this->M_data->UpdateData('akk_rap_biaya', $datarap, $whererap);
        $this->M_data->DeleteData('trx_pembelian_barang_remaining', $where);
        echo '<script>console.log('.json_encode($where).')</script>';
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            $pesan = "Penghapusan Transakasi Pembelian Berhasil";
            $this->flashdata_succeed1($pesan);
            redirect('laporan_detail/' . $idproject);
        } else {
            $pesan = "Penghapusan Transakasi Pembelian Gagal";
            $this->flashdata_failed1($pesan);
            redirect('laporan_detail/' . $idproject);
        }
    }

    public function delete1()
    {
        $idproject = $_POST['id_project'];
        $idpengiriman = $_POST['id_pengiriman'];
        $idpembelian = $_POST['id_pembelian'];
        $idremaining = $_POST['id_remaining'];
        $idrap = $_POST['id_rap'];
        $a = $_POST['jumlah_pembelian'];
        $b = str_replace('.', '', $a); //ubah format rupiah ke integer
        $jumlah_pembelian = intval($b);
        $cash = $_POST['cash'];
        $c = $_POST['cash'];
        $d = str_replace('.', '', $c); //ubah format rupiah ke integer
        $cash = intval($d);
        $getRapItem = $this->M_data->GetData("akk_rap_biaya ", "where id = '$idrap'"); //cari data untuk menambahkan jumlah aktual
        $aktual_rap = $getRapItem[0]['jumlah_aktual'];
        $cekbuy = $_POST['is_buy'];
        $this->db->trans_start();
        if ($cekbuy == 1) {
            $wherepengiriman = array('id' => $idpengiriman);
            $data = array(
                "is_buy" => 0,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
                "buy_created_at" => NULL,
            );
            $whereproject = array('id' => $idproject);
            $dataproject = array(
                "cash_in_hand" => $cash + $jumlah_pembelian,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
            );
            $whererap = array('id' => $idrap);
            $datarap = array(
                "jumlah_aktual" => $aktual_rap - $jumlah_pembelian,
                "last_update_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
            );
            $where = array('id' => $idpembelian);
            $this->M_data->UpdateData('trx_pengiriman_uang', $data, $wherepengiriman);
            $this->M_data->UpdateData('mst_project', $dataproject, $whereproject);
            $this->M_data->UpdateData('akk_rap_biaya', $datarap, $whererap);
            $this->M_data->DeleteData('trx_pembelian_barang', $where);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $pesan = "Penghapusan Transakasi Pembelian Berhasil";
                $this->flashdata_succeed1($pesan);
                redirect('laporan_detail/' . $idproject);
            } else {
                $pesan = "Penghapusan Transakasi Pembelian Gagal";
                $this->flashdata_failed1($pesan);
                redirect('laporan_detail/' . $idproject);
            }
        } else {
            $wherepengiriman = array('id' => $idpengiriman);
            $data = array(
                "is_buy" => 0,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
                "buy_created_at" => NULL,
                "remaining_pembelian" => 0,
            );
            $whereproject = array('id' => $idproject);
            $dataproject = array(
                "cash_in_hand" => $cash + $jumlah_pembelian,
                "last_updated_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
            );
            $whererap = array('id' => $idrap);
            $datarap = array(
                "jumlah_aktual" => $aktual_rap - $jumlah_pembelian,
                "last_update_by" => $this->session->userdata('id'),
                "updated_at" => date('Y-m-d H:i:s'),
            );
            $where = array('id' => $idpembelian);
            $whereremaining = array('id' => $idremaining);
            $res = $this->M_data->UpdateData('trx_pengiriman_uang', $data, $wherepengiriman);
            $res = $this->M_data->UpdateData('mst_project', $dataproject, $whereproject);
            $res = $this->M_data->UpdateData('akk_rap_biaya', $datarap, $whererap);
            $res = $this->M_data->DeleteData('trx_pembelian_barang', $where);
            $res = $this->M_data->DeleteData('trx_cash_remaining', $whereremaining);
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                $pesan = "Penghapusan Transakasi Pembelian Berhasil";
                $this->flashdata_succeed1($pesan);
                redirect('laporan_detail/' . $idproject);
            } else {
                $this->db->trans_rollback();
                // log_message('error', sprintf('%s : %s : DB transaction failed. Error no: %s, Error msg:%s, Last query: %s', __CLASS__, __FUNCTION__, $e->getCode(), $e->getMessage(), print_r($this->main_db->last_query(), TRUE)));
                $pesan = "Penghapusan Transakasi Pembelian Gagal";
                $this->flashdata_failed1($this->db->trans_status());
                redirect('laporan_detail/' . $idproject);
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
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">$pesan </div></div>");
    }
    public function flashdata_failed1($pesan)
    {
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">$pesan </div></div>");
    }
}
