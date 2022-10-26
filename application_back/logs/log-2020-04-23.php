<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-23 10:12:12 --> Severity: Error --> Call to undefined method M_data::getTotalPengajuanApproval() /home/akkaryaj/public_html/application/controllers/C_dashboard.php 32
ERROR - 2020-04-23 10:12:12 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-04-23 10:12:37 --> Severity: Notice --> Undefined index: total_approval /home/akkaryaj/public_html/application/controllers/C_dashboard.php 37
ERROR - 2020-04-23 10:13:58 --> Query error: Unknown column 'bb.total' in 'field list' - Invalid query: select sum(bb.total) as totalpengajuan from( select a.pengajuan_id,c.project_name,sum(a.jumlah_approval) as total_approval 
	    from akk_pengajuan_approval as a JOIN akk_pengajuan as b on a.pengajuan_id = b.id 
	    JOIN mst_project as c on b.project_id = c.id group by a.pengajuan_id) as bb
ERROR - 2020-04-23 10:43:36 --> Severity: Notice --> Undefined variable: destination_id /home/akkaryaj/public_html/application/views/pembelian/detail.php 202
ERROR - 2020-04-23 10:43:36 --> Severity: Notice --> Undefined variable: project_office_id /home/akkaryaj/public_html/application/views/pembelian/detail.php 203
ERROR - 2020-04-23 10:59:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'as bb' at line 4 - Invalid query: select sum(bb.total_pembelian) as total_pembelian from( select c.pengajuan_id,e.project_name,sum(a.jumlah_uang_pembelian) as total_pembelian 
	    from trx_pembelian_barang as a JOIN trx_pengiriman_uang as b on a.pengiriman_uang_id = b.id 
	    JOIN akk_pengajuan_approval as c on b.pengajuan_approval_id = c.id JOIN akk_pengajuan as d on c.pengajuan_id = d.id 
	    JOIN mst_project as e on d.project_id = e.id group by c.pengajuan_id as bb
ERROR - 2020-04-23 18:36:30 --> Severity: Notice --> Undefined variable: destination_id /home/akkaryaj/public_html/application/views/pembelian/detail.php 202
ERROR - 2020-04-23 18:36:30 --> Severity: Notice --> Undefined variable: project_office_id /home/akkaryaj/public_html/application/views/pembelian/detail.php 203
ERROR - 2020-04-23 18:36:42 --> 404 Page Not Found: Laporan_detail/4
ERROR - 2020-04-23 18:36:42 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-04-23 23:03:23 --> 404 Page Not Found: Vendor/phpunit
