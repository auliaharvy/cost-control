<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require('./Excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet


class C_laporan extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('role')==null) {
            redirect('Login'); }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("M_laporan");
        $this->load->helper('form');
        $this->load->library('Lharby');
    }

    public function index() 
    {
       
        $data = $this->M_laporan->getProjectAll();
        
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer'=> $this->footer(),
            'data' => $data,
            
        );
        $this->load->view('laporan/index',$show);
        // $this->load->view('data');
    }
    

    
    public function detail($id) //detail
    {
       $get = $this->M_laporan->getRap($id);
       $stat = $get[0]['project_status'];
       if($stat==1){
           $status = 'SELESAI';
       }
       else{
           $status = ' ON PROCCESS';
       }
       $tgl = $get[0]['project_deadline'];
        $deadline = $this->convert_date($tgl);
        $rab_project = $this->lharby->formatRupiah($get[0]['rab_project']);
        $cash_in_hand = $this->lharby->formatRupiah($get[0]['cash_in_hand']);
        
        $data_rap_biaya = $this->M_laporan->getBiayaRap($id,1);
        $data_rap_biaya2 = $this->M_laporan->getBiayaRap($id,2);
        $data_rap_biaya3 = $this->M_laporan->getBiayaRap($id,3);
        $data_rap_biaya4 = $this->M_laporan->getBiayaRap($id,4);
        
        $data_pengajuan = $this->M_laporan->showpengajuandetail($id);
        
        $data_pencairan = $this->M_laporan->dataPencairan($id);
        $data_pembelian = $this->M_laporan->dataPembelian($id);
        $data_pembelian_remaining = $this->M_laporan->dataPembelianRemaining($id);
        
        $show = array(
            'nav'=> $this->header(),
            'navbar'=> $this->navbar(),
            'sidebar' => $this->sidebar(),
            'footer'=> $this->footer(),
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
            'data_rap_biaya2' => $data_rap_biaya2,
            'data_rap_biaya3' => $data_rap_biaya3,
            'data_rap_biaya4' => $data_rap_biaya4,
            'data_pengajuan' => $data_pengajuan,
            'data_pencairan' => $data_pencairan,
            'data_pembelian' => $data_pembelian,
            'data_pembelian_remaining' => $data_pembelian_remaining,
        );
        $this->load->view('laporan/detail',$show);
        // $this->load->view('data');
    }
    
    public function export($id)
    {
        $get = $this->M_laporan->getRap($id);
        $project_name = $get[0]['project_name'];
        $data_rap_biaya = $this->M_laporan->getBiayaRap($id,1);
        $data_rap_biaya2 = $this->M_laporan->getBiayaRap($id,2);
        $data_rap_biaya3 = $this->M_laporan->getBiayaRap($id,3);
        $data_rap_biaya4 = $this->M_laporan->getBiayaRap($id,4);
        
        $data_pengajuan = $this->M_laporan->showpengajuandetail($id);
        
        $data_pencairan = $this->M_laporan->dataPencairan($id);
        $data_pembelian = $this->M_laporan->dataPembelian($id);
        $data_pembelian_remaining = $this->M_laporan->dataPembelianRemaining($id);
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        
       /* RAP */
        $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('B2', 'RAP Biaya Umum Proyek');
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
        ->setCellValue('B4', 'Jenis')
        ->setCellValue('C4', 'Nama Jenis')
        ->setCellValue('D4', 'Nama Pekerjaan')
        ->setCellValue('E4', 'Jumlah RAP')
        ->setCellValue('F4', 'Jumlah Aktual')
        ->setCellValue('G4', 'Persentase')
        ->setCellValue('H4', 'Keterangan')
        ;

        // Miscellaneous glyphs, UTF-8
        if (is_array($data_rap_biaya) || is_object($data_rap_biaya))
        {
            $i=5; foreach($data_rap_biaya as $d) {
                $spreadsheet->getActiveSheet()->getStyle('B'.$i.':H'.$i)
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
                ->setCellValue('B'.$i, $d['nama_jenis'])
                ->setCellValue('C'.$i, $d['nama_jenis_rap'])
                ->setCellValue('D'.$i, $d['nama_pekerjaan'])
                ->setCellValue('E'.$i, $d['jumlah_biaya'])
                ->setCellValue('F'.$i, $d['jumlah_aktual_f'])
                ->setCellValue('G'.$i, $d['presentase'])
                ->setCellValue('H'.$i, $d['note'])
                ;
                $i++;
            }
        }
        //Biaya Material
        $j = $i+2;
        $k = $j+2; $l=$k+1;
        
        
        $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('B'.$j, 'RAP Biaya Material dan Alat');
        $spreadsheet->getActiveSheet()->mergeCells('B'.$j.':H'.$j);
            $spreadsheet->getActiveSheet()->getStyle('B'.$j)->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('B'.$k.':H'.$k)
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
        ->setCellValue('B'.$k, 'Jenis')
        ->setCellValue('C'.$k, 'Nama Jenis')
        ->setCellValue('D'.$k, 'Nama Pekerjaan')
        ->setCellValue('E'.$k, 'Jumlah RAP')
        ->setCellValue('F'.$k, 'Jumlah Aktual')
        ->setCellValue('G'.$k, 'Persentase')
        ->setCellValue('H'.$k, 'Keterangan')
        ;

        // Miscellaneous glyphs, UTF-8
        if (is_array($data_rap_biaya2) || is_object($data_rap_biaya2))
        {
            $l=$k+1; foreach($data_rap_biaya2 as $d) {
                $spreadsheet->getActiveSheet()->getStyle('B'.$l.':H'.$l)
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
                ->setCellValue('B'.$l, $d['nama_jenis'])
                ->setCellValue('C'.$l, $d['nama_jenis_rap'])
                ->setCellValue('D'.$l, $d['nama_pekerjaan'])
                ->setCellValue('E'.$l, $d['jumlah_biaya'])
                ->setCellValue('F'.$l, $d['jumlah_aktual_f'])
                ->setCellValue('G'.$l, $d['presentase'])
                ->setCellValue('H'.$l, $d['note'])
                ;
                $l++;
            }
        }
        //Biaya Temporary Persiapan
        $m = $l+2;
        $n = $m+2; $l=$n+1;
        
        
        $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('B'.$m, 'RAP Biaya Temporary dan Persiapan');
        $spreadsheet->getActiveSheet()->mergeCells('B'.$m.':H'.$m);
            $spreadsheet->getActiveSheet()->getStyle('B'.$m)->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('B'.$n.':H'.$n)
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
        ->setCellValue('B'.$n, 'Jenis')
        ->setCellValue('C'.$n, 'Nama Jenis')
        ->setCellValue('D'.$n, 'Nama Pekerjaan')
        ->setCellValue('E'.$n, 'Jumlah RAP')
        ->setCellValue('F'.$n, 'Jumlah Aktual')
        ->setCellValue('G'.$n, 'Persentase')
        ->setCellValue('H'.$n, 'Keterangan')
        ;

        // Miscellaneous glyphs, UTF-8
        if (is_array($data_rap_biaya3) || is_object($data_rap_biaya3))
        {
            $l=$n+1; foreach($data_rap_biaya3 as $d) {
                $spreadsheet->getActiveSheet()->getStyle('B'.$l.':H'.$l)
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
                ->setCellValue('B'.$l, $d['nama_jenis'])
                ->setCellValue('C'.$l, $d['nama_jenis_rap'])
                ->setCellValue('D'.$l, $d['nama_pekerjaan'])
                ->setCellValue('E'.$l, $d['jumlah_biaya'])
                ->setCellValue('F'.$l, $d['jumlah_aktual_f'])
                ->setCellValue('G'.$l, $d['presentase'])
                ->setCellValue('H'.$l, $d['note'])
                ;
                $l++;
            }
        }
         //Biaya Temporary Persiapan
        $m = $l+2;
        $n = $m+2; $l=$n+1;
        
        
        $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('B'.$m, 'RAP Biaya Lain Lain');
        $spreadsheet->getActiveSheet()->mergeCells('B'.$m.':H'.$m);
            $spreadsheet->getActiveSheet()->getStyle('B'.$m)->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('B'.$n.':H'.$n)
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
        ->setCellValue('B'.$n, 'Jenis')
        ->setCellValue('C'.$n, 'Nama Jenis')
        ->setCellValue('D'.$n, 'Nama Pekerjaan')
        ->setCellValue('E'.$n, 'Jumlah RAP')
        ->setCellValue('F'.$n, 'Jumlah Aktual')
        ->setCellValue('G'.$n, 'Persentase')
        ->setCellValue('H'.$n, 'Keterangan')
        ;

        // Miscellaneous glyphs, UTF-8
        if (is_array($data_rap_biaya4) || is_object($data_rap_biaya4))
        {
            $l=$n+1; foreach($data_rap_biaya4 as $d) {
                $spreadsheet->getActiveSheet()->getStyle('B'.$l.':H'.$l)
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
                ->setCellValue('B'.$l, $d['nama_jenis'])
                ->setCellValue('C'.$l, $d['nama_jenis_rap'])
                ->setCellValue('D'.$l, $d['nama_pekerjaan'])
                ->setCellValue('E'.$l, $d['jumlah_biaya'])
                ->setCellValue('F'.$l, $d['jumlah_aktual_f'])
                ->setCellValue('G'.$l, $d['presentase'])
                ->setCellValue('H'.$l, $d['note'])
                ;
                $l++;
            }
        }
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Report RAP 1 '.date('d-m-Y H'));
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        
        
        /* END RAP */
        
        
        /* PENGAJUAN */
        $spreadsheet->createSheet();
         $spreadsheet->setActiveSheetIndex(1)
                        ->setCellValue('B2', 'PENGAJUAN');
            $spreadsheet->getActiveSheet()->mergeCells('B2:G2');
                $spreadsheet->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('B4:G4')
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
        $spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('B4', 'Nama Jenis')
        ->setCellValue('C4', 'Nama Pekerjaan')
        ->setCellValue('D4', 'Jumlah Pengajuan')
        ->setCellValue('E4', 'Jumlah Approval')
        ->setCellValue('F4', 'Tanggal Approval')
        ->setCellValue('G4', 'Keterangan')
        ;

        // Miscellaneous glyphs, UTF-8
        if (is_array($data_pengajuan) || is_object($data_pengajuan))
        {
            $i=5; foreach($data_pengajuan as $d) {
                $spreadsheet->getActiveSheet()->getStyle('B'.$i.':F'.$i)
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
                $spreadsheet->setActiveSheetIndex(1)
                ->setCellValue('B'.$i, $d['nama_jenis_rap'])
                ->setCellValue('C'.$i, $d['nama_pekerjaan'])
                ->setCellValue('D'.$i, $d['jumlah_pengajuan'])
                ->setCellValue('E'.$i, $d['jumlah_approval'])
                ->setCellValue('F'.$i, $d['approval_date'])
                ->setCellValue('F'.$i, $d['note_app'])
                ;
                $i++;
            }
        }
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Report Pengajuan '.date('d-m-Y H'));
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(1);
        
        /* END PENGAJUAN */
        
        /* PENCAIRAN */
        $spreadsheet->createSheet();
         $spreadsheet->setActiveSheetIndex(2)
                        ->setCellValue('B2', 'PENCAIRAN');
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
         // Add some data
        $spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('B4', 'Project')
        ->setCellValue('C4', 'Nama Jenis')
        ->setCellValue('D4', 'Nama Pekerjaan')
        ->setCellValue('E4', 'Sumber Dana')
        ->setCellValue('F4', 'Tujuan Dana')
        ->setCellValue('G4', 'Jumlah Dana')
        ->setCellValue('H4', 'Tanggal Pencairan')
        ;

        // Miscellaneous glyphs, UTF-8
        if (is_array($data_pencairan) || is_object($data_pencairan))
        {
            $i=5; foreach($data_pencairan as $d) {
                $spreadsheet->getActiveSheet()->getStyle('B'.$i.':H'.$i)
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
                $spreadsheet->setActiveSheetIndex(2)
                ->setCellValue('B'.$i, $d['project_source'])
                ->setCellValue('C'.$i, $d['nama_jenis_rap'])
                ->setCellValue('D'.$i, $d['nama_pekerjaan'])
                ->setCellValue('E'.$i, $d['organization_name'])
                ->setCellValue('F'.$i, $d['pro_office'])
                ->setCellValue('G'.$i, $d['jumlah_uang'])
                ->setCellValue('H'.$i, $d['tanggal_pencairan'])
                ;
                $i++;
            }
        }
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Report Pencairan '.date('d-m-Y H'));
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(2);
        
        /* END PENCAIRAN */
        
        /* PEMBELIAN BERDASARKAN PENGAJUAN */
        $spreadsheet->createSheet();
         $spreadsheet->setActiveSheetIndex(3)
                        ->setCellValue('B2', 'PEMBELIAN BERDASARKAN PENGAJUAN');
            $spreadsheet->getActiveSheet()->mergeCells('B2:G2');
                $spreadsheet->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('B4:G4')
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
        $spreadsheet->setActiveSheetIndex(3)
        ->setCellValue('B4', 'Project')
        ->setCellValue('C4', 'Nama Jenis')
        ->setCellValue('D4', 'Nama Pekerjaan')
        ->setCellValue('E4', 'Sumber Dana')
        ->setCellValue('F4', 'Jumlah Dana')
        ->setCellValue('G4', 'Tanggal Pembelian')
        
        ;

        // Miscellaneous glyphs, UTF-8
        if (is_array($data_pembelian) || is_object($data_pembelian))
        {
            $i=5; foreach($data_pembelian as $d) {
                $spreadsheet->getActiveSheet()->getStyle('B'.$i.':G'.$i)
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
                $spreadsheet->setActiveSheetIndex(3)
                ->setCellValue('B'.$i, $d['project_source'])
                ->setCellValue('C'.$i, $d['nama_jenis_rap'])
                ->setCellValue('D'.$i, $d['nama_pekerjaan'])
                ->setCellValue('E'.$i, $d['pro_office'])
                ->setCellValue('F'.$i, $d['jumlah_uang'])
                ->setCellValue('G'.$i, $d['tanggal_pembelian'])
                
                ;
                $i++;
            }
        }
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Pembelian Berdasar Pengajuan');
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(3);
        
        /* END PEMBELIAN BERDASARKAN PENGAJUAN */
        
        /* PEMBELIAN TANPA PENGAJUAN */
        $spreadsheet->createSheet();
         $spreadsheet->setActiveSheetIndex(4)
                        ->setCellValue('B2', 'PEMBELIAN TANPA PENGAJUAN');
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
         // Add some data
        $spreadsheet->setActiveSheetIndex(4)
        ->setCellValue('B4', 'Project')
        ->setCellValue('C4', 'Nama Jenis')
        ->setCellValue('D4', 'Nama Pekerjaan')
        ->setCellValue('E4', 'Sumber Dana')
        ->setCellValue('F4', 'Jumlah Dana')
        ->setCellValue('G4', 'Tanggal Pembelian')
        ->setCellValue('H4', 'Keterangan')
        
        ;

        // Miscellaneous glyphs, UTF-8
        if (is_array($data_pembelian_remaining) || is_object($data_pembelian_remaining))
        {
            $i=5; foreach($data_pembelian_remaining as $d) {
                $spreadsheet->getActiveSheet()->getStyle('B'.$i.':H'.$i)
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
                $spreadsheet->setActiveSheetIndex(4)
                ->setCellValue('B'.$i, $d['project_source'])
                ->setCellValue('C'.$i, $d['nama_jenis_rap'])
                ->setCellValue('D'.$i, $d['nama_pekerjaan'])
                ->setCellValue('E'.$i, $d['pro_office'])
                ->setCellValue('F'.$i, $d['jumlah_uang'])
                ->setCellValue('G'.$i, $d['tanggal_pembelian'])
                ->setCellValue('H'.$i, $d['note'])
                ;
                $i++;
            }
        }
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Pembelian Tanpa Pengajuan');
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(4);
        
        /* END PEMBELIAN TANPA PENGAJUAN */
        
        // Redirect output to a client’s web browser (Xlsx)
        $filename = "Report Project - ".$project_name.".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$filename);
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

   

    function convert_date($tgl){
        $tanggal = date('d F Y', strtotime($tgl));
        return $tanggal;
    }

    

    public function header(){
        $data = array();
        $show = $this->load->view('component/header',$data,TRUE);
        return $show;
    }

    public function navbar(){
        $data = array();
        $show = $this->load->view('component/navbar',$data,TRUE);
        return $show;
    }

    
    public function sidebar(){
        $data = array();
        $show = $this->load->view('component/sidebar',$data,TRUE);
        return $show;
    }
    
    public function footer(){
        $data = array();
        $show = $this->load->view('component/footer',$data,TRUE);
        return $show;
    }


    public function flashdata_succeed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Action Succeed !!!</div></div>");
                redirect('/C_project');
    }
    public function flashdata_failed(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
                redirect('/C_project');
    }

    public function flashdata_succeed_rap(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Action Succeed !!!</div></div>");
               
    }
    public function flashdata_failed_rap(){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Action Failed !!!</div></div>");
                
    }

    public function flashdata_succeed1($pesan){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">$pesan </div></div>");
               
    }
    public function flashdata_failed1($pesan){
        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">$pesan </div></div>");
                
    }
}

