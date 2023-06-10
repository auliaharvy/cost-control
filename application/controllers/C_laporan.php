<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Load library phpspreadsheet
require('./Excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet
class C_laporan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == null) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_laporan");
        $this->load->model("M_data");
        $this->load->helper('form');
        $this->load->library('Lharby');
    }

    public function index()
    {
        $datasudah = $this->M_laporan->getProjectAllsudah();
        $dataprogress = $this->M_laporan->getProjectAllon();
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'datasudah' => $datasudah,
            'dataprogress' => $dataprogress,
        );
        $this->load->view('laporan/index', $show);
    }

    public function detail($id) //detail
    {
        $cekrap = $this->M_data->GetData("akk_rap ", "where project_id = '$id'");
        $get = $this->M_laporan->getRap($id);
        $stat = $get[0]['project_status'];
        if ($stat == 1) {
            $status = 'SELESAI';
        } else {
            $status = ' ON PROCCESS';
        }
        if ($cekrap) { //jika project sudah punya rap
            $is_rap_confirm = $cekrap[0]['is_rap_confirm'];
        } else { //jika project belum ada rap
            $is_rap_confirm = 0;
        }
        $tgl = $get[0]['project_deadline'];
        $deadline = $this->convert_date($tgl);
        $rab_project = $this->lharby->formatRupiah($get[0]['rab_project']);
        $cash_in_hand = $this->lharby->formatRupiah($get[0]['cash_in_hand']);
        $data_rap_biaya = $this->M_laporan->getBiayaRap($id);
        $data_uang1 = $this->M_laporan->showuangdetail($id);
        for($i = 0; $i < count($data_uang1); $i++) {
            $data_uang1[$i]['tipe_pembelian'] = "0";
        }
        $data_uang2 = $this->M_laporan->showuangdetailremaining($id);
        for($x = 0; $x < count($data_uang2); $x++) {
            $data_uang2[$x]['tipe_pembelian'] = "1";
        }
        $data_uang = array_merge($data_uang1, $data_uang2);
        echo '<script>console.log('.json_encode($data_uang).')</script>';
        echo '<script>console.log('.json_encode($data_uang1).')</script>';
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'project_id' => $id,
            'rap_id' => $get[0]['id'],
            'project_name' => $get[0]['project_name'],
            'project_location' => $get[0]['project_location'],
            'background_text' => $get[0]['background_text'],
            'pic' => $get[0]['fullname'],
            'status' => $status,
            'cash_in_hand' => $cash_in_hand,
            'project_deadline' => $deadline,
            'rab_project' => $rab_project,
            'data_rap_biaya' => $data_rap_biaya,
            'data_uang' => $data_uang,
            'is_rap_confirm' => $is_rap_confirm,
        );
        $this->load->view('laporan/detail', $show);
    }

    public function export($id)
    {
        $get = $this->M_laporan->getRap($id);
        $project_name = $get[0]['project_name'];
        $data_rap_biaya = $this->M_laporan->getBiayaRap($id);
        $data_uang1 = $this->M_laporan->showuangdetail($id);
        $data_uang2 = $this->M_laporan->showuangdetailremaining($id);
        $data_uang = array_merge($data_uang1, $data_uang2);
        $rab_project = $this->lharby->formatRupiah($get[0]['rab_project']);
        $cash_in_hand = $this->lharby->formatRupiah($get[0]['cash_in_hand']);
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        /* RAP */
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B2', 'RAP Proyek');
        $spreadsheet->getActiveSheet()->mergeCells('B2:H2');
        $spreadsheet->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('B4:H4')
            ->applyFromArray(
                array(
                    'font'  => array(
                        'bold'  =>  true
                    ),
                    'borders' => array(
                        'allBorders' => array(
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        ),
                    )
                )
            );
        // Set document properties
        $spreadsheet->getProperties()->setCreator('Surya Microsystem - HA')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php');
        // Add some data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B4', 'No')
            ->setCellValue('C4', 'Kategori')
            ->setCellValue('D4', 'Nama Pekerjaan')
            ->setCellValue('E4', 'Jumlah RAP')
            ->setCellValue('F4', 'Jumlah Aktual')
            ->setCellValue('G4', 'Persentase')
            ->setCellValue('H4', 'Keterangan');
        // Miscellaneous glyphs, UTF-8
        if (is_array($data_rap_biaya) || is_object($data_rap_biaya)) {
            $i = 5;
            $no = 1;
            foreach ($data_rap_biaya as $d) {
                $spreadsheet->getActiveSheet()->getStyle('B' . $i . ':H' . $i)
                    ->applyFromArray(
                        array(
                            'borders' => array(
                                'allBorders' => array(
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                    'color' => array('argb' => '000000'),
                                ),
                            )
                        )
                    );
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B' . $i, $no)
                    ->setCellValue('C' . $i, $d['nama_kategori'])
                    ->setCellValue('D' . $i, $d['nama_pekerjaan'])
                    ->setCellValue('E' . $i, $d['jumlah_biaya'])
                    ->setCellValue('F' . $i, $d['jumlah_aktual'])
                    ->setCellValue('G' . $i, $d['presentase'])
                    ->setCellValue('H' . $i, $d['note']);
                $i++;
                $no++;
            }
        }
        // Pembelian
        $j = $i + 2;
        $k = $j + 2;
        $l = $k + 1;
        $noPembelian = 1;
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . $j, 'Pembelian');
        $spreadsheet->getActiveSheet()->mergeCells('B' . $j . ':H' . $j);
        $spreadsheet->getActiveSheet()->getStyle('B' . $j)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('B' . $k . ':H' . $k)
            ->applyFromArray(
                array(
                    'font'  => array(
                        'bold'  =>  true
                    ),
                    'borders' => array(
                        'allBorders' => array(
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        ),
                    )
                )
            );
        // Add some data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . $k, 'No')
            ->setCellValue('C' . $k, 'Tanggal')
            ->setCellValue('D' . $k, 'Keterangan')
            ->setCellValue('E' . $k, 'Jumlah Pembelian')
            ->setCellValue('F' . $k, 'Kategori')
            ->setCellValue('G' . $k, 'Foto');
        // Miscellaneous glyphs, UTF-8
        if (is_array($data_uang) || is_object($data_uang)) {
            $l = $k + 1;
            foreach ($data_uang as $d) {
                $spreadsheet->getActiveSheet()->getStyle('B' . $l . ':H' . $l)
                    ->applyFromArray(
                        array(
                            'borders' => array(
                                'allBorders' => array(
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                    'color' => array('argb' => '000000'),
                                ),
                            )
                        )
                    );
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B' . $l, $noPembelian)
                    ->setCellValue('C' . $l, $d['created_at'])
                    ->setCellValue('D' . $l, $d['keterangan'])
                    ->setCellValue('E' . $l, $d['jumlah_uang_pembelian'])
                    ->setCellValue('F' . $l, $d['nama_kategori'])
                    ->setCellValue('G' . $l, base_url('/upload/pembelian/' . $d['upload_file']));
                $l++;
            }
        }


        // Redirect output to a client’s web browser (Xlsx)
        $filename = "Report Project - " . $project_name . ".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
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

    public function pdf($id)
    {
        $cekrap = $this->M_data->GetData("akk_rap ", "where project_id = '$id'");
        $get = $this->M_laporan->getRap($id);
        $stat = $get[0]['project_status'];
        if ($stat == 1) {
            $status = 'SELESAI';
        } else {
            $status = ' ON PROCCESS';
        }
        if ($cekrap) { //jika project sudah punya rap
            $is_rap_confirm = $cekrap[0]['is_rap_confirm'];
        } else { //jika project belum ada rap
            $is_rap_confirm = 0;
        }
        $tgl = $get[0]['project_deadline'];
        $deadline = $this->convert_date($tgl);
        $rab_project = $this->lharby->formatRupiah($get[0]['rab_project']);
        $cash_in_hand = $this->lharby->formatRupiah($get[0]['cash_in_hand']);
        $total = $this->M_laporan->showuangdetail($id);
        $totalall = $total[0]['total_pembelian'];
        $data_rap_biaya = $this->M_laporan->getBiayaRap($id);
        $data_uang1 = $this->M_laporan->showuangdetail($id);
        $data_uang2 = $this->M_laporan->showuangdetailremaining($id);
        $data_uang = array_merge($data_uang1, $data_uang2);
        $show = array(
            'nav' => $this->header(),
            'navbar' => $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer' => $this->footer(),
            'project_id' => $id,
            'rap_id' => $get[0]['id'],
            'project_name' => $get[0]['project_name'],
            'project_location' => $get[0]['project_location'],
            'background_text' => $get[0]['background_text'],
            'status' => $status,
            'cash_in_hand' => $cash_in_hand,
            'project_deadline' => $deadline,
            'rab_project' => $rab_project,
            'data_rap_biaya' => $data_rap_biaya,
            'data_uang' => $data_uang,
            'data_uang1' => $data_uang1,
            'data_uang2' => $data_uang2,
            'is_rap_confirm' => $is_rap_confirm,
            'total' => $totalall,
        );
        $this->load->view('laporan/pdf', $show);
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
