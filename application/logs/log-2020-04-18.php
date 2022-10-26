<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-18 09:19:57 --> Query error: Unknown column 'a.user_id' in 'on clause' - Invalid query: SELECT `a`.*, `c`.`nama_jenis_rap`, `c`.`nama_pekerjaan`, FORMAT(a.jumlah_uang, 0, "de_DE") as jumlah_uang_v
FROM `trx_pengiriman_uang` as `a`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan_biaya` as `b` ON `d`.`pengajuan_biaya_id` = `b`.`id`
JOIN `akk_rap_biaya` as `c` ON `b`.`rap_biaya_id` = `c`.`id`
JOIN `mst_office` as `e` ON `a`.`project_office_id` = `e`.`id`
JOIN `mst_office` as `f` ON `a`.`user_id` = `f`.`id`
WHERE `b`.`pengajuan_id` = '6'
AND `a`.`destination_id` = 1
AND `f`.`id` = '5'
ERROR - 2020-04-18 09:21:03 --> Query error: Table 'akkakarya_cos_control_dev.trx_pengiriman_uan' doesn't exist - Invalid query: SELECT `a`.*, `c`.`nama_jenis_rap`, `c`.`nama_pekerjaan`, FORMAT(a.jumlah_uang, 0, "de_DE") as jumlah_uang_v
FROM `trx_pengiriman_uan` as `a`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan_biaya` as `b` ON `d`.`pengajuan_biaya_id` = `b`.`id`
JOIN `akk_rap_biaya` as `c` ON `b`.`rap_biaya_id` = `c`.`id`
JOIN `mst_office` as `e` ON `a`.`project_office_id` = `e`.`id`
JOIN `mst_office` as `f` ON `e`.`user_id` = `f`.`id`
WHERE `b`.`pengajuan_id` = '6'
AND `a`.`destination_id` = 1
AND `f`.`id` = '5'
ERROR - 2020-04-18 09:34:50 --> Query error: Table 'akkakarya_cos_control_dev.trx_pengiriman_uan' doesn't exist - Invalid query: SELECT SUM(remaining_pembelian) as remaining_pembelian, FORMAT(SUM(remaining_pembelian), 0, "de_DE") as remaining_pembelian_v, `c`.`nama_jenis_rap`, `c`.`nama_pekerjaan`, FORMAT(a.jumlah_uang, 0, "de_DE") as jumlah_uang_v
FROM `trx_pengiriman_uan` as `a`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan_biaya` as `b` ON `d`.`pengajuan_biaya_id` = `b`.`id`
JOIN `akk_rap_biaya` as `c` ON `b`.`rap_biaya_id` = `c`.`id`
JOIN `mst_office` as `e` ON `a`.`project_office_id` = `e`.`id`
JOIN `mst_users` as `f` ON `e`.`user_id` = `f`.`id`
WHERE `b`.`pengajuan_id` = '6'
AND `a`.`destination_id` = 1
AND `f`.`id` = '3'
AND `a`.`is_buy` = 2
GROUP BY `a`.`destination_id`, `a`.`project_office_id`
ERROR - 2020-04-18 09:56:08 --> Severity: Notice --> Undefined variable: idx D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 75
ERROR - 2020-04-18 06:26:52 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 274
