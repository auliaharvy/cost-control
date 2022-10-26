<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-17 08:23:05 --> 404 Page Not Found: Wp-loginphp/index
ERROR - 2020-04-17 21:22:38 --> Severity: Notice --> Undefined variable: jumlah_approval D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 152
ERROR - 2020-04-17 21:22:55 --> Severity: Notice --> Undefined index: jumlah_approval D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 124
ERROR - 2020-04-17 22:33:35 --> Severity: Notice --> Undefined variable: jumlah_uang D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 141
ERROR - 2020-04-17 22:33:35 --> Severity: Notice --> Undefined variable: id D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 151
ERROR - 2020-04-17 18:02:36 --> Severity: Parsing Error --> syntax error, unexpected '$pengiriman_uang_id' (T_VARIABLE) D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 107
ERROR - 2020-04-17 18:02:56 --> Severity: Parsing Error --> syntax error, unexpected ',' D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 161
ERROR - 2020-04-17 23:04:45 --> Query error: Unknown column 'proj_off_id' in 'field list' - Invalid query: INSERT INTO `trx_pembelian_barang` (`pengiriman_uang_id`, `destination_id`, `proj_off_id`, `jumlah_uang_pembelian`, `created_at`, `last_updated_by`) VALUES ('26', '1', '1', '200000', '2020-04-17 23:04:45', '5')
ERROR - 2020-04-17 23:10:45 --> Severity: Parsing Error --> syntax error, unexpected 'else' (T_ELSE) D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 100
ERROR - 2020-04-17 23:26:48 --> Severity: Notice --> Undefined variable: remaining_pembelian_v D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 73
ERROR - 2020-04-17 23:27:01 --> Severity: Notice --> Undefined variable: remaining_pembelian_v D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 72
ERROR - 2020-04-17 23:38:58 --> Query error: Table 'akkakarya_cos_control_dev.akk_pengajuan_biay' doesn't exist - Invalid query: SELECT `a`.*, `b`.`nama_jenis_rap`, `b`.`nama_pekerjaan`, `c`.`nama_jenis`, `d`.`nama_kategori`, `f`.`id` as `project_id`, `g`.`jumlah_approval`, IF(g.jumlah_approval!=null, FORMAT(g.jumlah_approval, 0, "de_DE"), 0) as jumlah_approval_v, FORMAT(a.jumlah_pengajuan, 0, "de_DE") as jumlah_pengajuan_v
FROM `akk_pengajuan_biay` as `a`
JOIN `akk_pengajuan` as `e` ON `a`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `f` ON `e`.`project_id` = `f`.`id`
JOIN `akk_rap_biaya` as `b` ON `a`.`rap_biaya_id` = `b`.`id`
JOIN `mst_jenis_biaya` as `c` ON `b`.`jenis_biaya_id` = `c`.`id`
JOIN `mst_kategori_biaya` as `d` ON `b`.`kategori_biaya_id` = `d`.`id`
LEFT JOIN `akk_pengajuan_approval` as `g` ON `a`.`id` = `g`.`pengajuan_biaya_id`
WHERE `e`.`id` = '6'
ERROR - 2020-04-17 23:52:15 --> Severity: Notice --> Undefined variable: id D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 137
ERROR - 2020-04-17 23:52:15 --> Severity: Notice --> Undefined variable: id D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 137
