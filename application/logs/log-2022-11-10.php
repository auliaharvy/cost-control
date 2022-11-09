<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-11-10 00:03:33 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 190
ERROR - 2022-11-10 00:03:36 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:03:49 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:04:00 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:04:07 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:04:15 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:04:24 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:08:46 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 190
ERROR - 2022-11-10 00:09:41 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 190
ERROR - 2022-11-10 00:09:59 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 190
ERROR - 2022-11-10 00:10:37 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 190
ERROR - 2022-11-10 00:12:11 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 190
ERROR - 2022-11-10 00:13:12 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:14:15 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:17:18 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:17:42 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:19:22 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:19:48 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:21:50 --> Query error: Unknown column 'e.jumlah_pembelian_uang' in 'field list' - Invalid query: SELECT `a`.*, `d`.`project_name`, `d`.`project_location`, `b`.`note_app` as `keterangan`, `e`.`jumlah_pembelian_uang` as `jumlah_pembelian`, `e`.`created_at` as `tanggal_pembelian`, `d`.`project_deadline`, `c`.`id` as `pengajuan_id`, `b`.`jumlah_approval`, `g`.`nama_pekerjaan`
FROM `trx_pengiriman_uang` as `a`
JOIN `akk_pengajuan_approval` as `b` ON `a`.`pengajuan_approval_id` = `b`.`id`
JOIN `akk_pengajuan` as `c` ON `b`.`pengajuan_id` = `c`.`id`
JOIN `mst_project` as `d` ON `c`.`project_id` = `d`.`id`
LEFT JOIN `trx_pembelian_barang` as `e` ON `e`.`pengiriman_uang_id` = `a`.`id`
JOIN `akk_rap` as `f` ON `c`.`rap_id` = `f`.`id`
INNER JOIN `akk_rap_biaya` as `g` ON `f`.`id` = `g`.`rap_id`
WHERE `a`.`is_buy` =0
AND `d`.`project_status` =0
AND `d`.`created_by` = '11'
GROUP BY `a`.`id`
ERROR - 2022-11-10 00:21:50 --> Severity: error --> Exception: Call to a member function num_rows() on bool /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/models/M_pembelian.php 40
ERROR - 2022-11-10 00:22:37 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:23:51 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:25:50 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:27:45 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:29:11 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:34:59 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:35:08 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 190
ERROR - 2022-11-10 00:35:10 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:35:24 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:35:29 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/pembelian/index.php 138
ERROR - 2022-11-10 00:35:30 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 190
ERROR - 2022-11-10 00:45:21 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 190
ERROR - 2022-11-10 00:45:36 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 190
ERROR - 2022-11-10 00:49:59 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 189
ERROR - 2022-11-10 00:50:05 --> Severity: Warning --> Invalid argument supplied for foreach() /Users/daud/.bitnami/stackman/machines/xampp/volumes/root/htdocs/costcontrol1.1/application/views/project/index.php 189
