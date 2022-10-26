<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Lharby{
 
	public function formatRupiah($angka) {
 
        $format_rupiah = 'Rp ' . number_format($angka, '0', ',', '.');
        return $format_rupiah;
   
	}
}

