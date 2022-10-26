<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-03-28 09:47:09 --> Severity: Parsing Error --> syntax error, unexpected end of file D:\xampp\htdocs\Costcontrol\application\views\pencairan\detail.php 208
ERROR - 2020-03-28 10:00:19 --> Query error: Not unique table/alias: 'b' - Invalid query: SELECT `a`.*, `b`.`nama_jenis_rap`, `b`.`nama_pekerjaan`, `c`.`jumlah_approval`
FROM `akk_pengajuan_approval` as `a`
JOIN `akk_pengajuan_biaya` as `b` ON `a`.`pengajuan_biaya_id` = `b`.`id`
JOIN `akk_rap_biaya` as `b` ON `a`.`rap_biaya_id` = `b`.`id`
WHERE `b`.`pengajuan_id` = '3'
ERROR - 2020-03-28 10:00:42 --> Query error: Unknown column 'b.nama_jenis_rap' in 'field list' - Invalid query: SELECT `a`.*, `b`.`nama_jenis_rap`, `b`.`nama_pekerjaan`, `c`.`jumlah_approval`
FROM `akk_pengajuan_approval` as `a`
JOIN `akk_pengajuan_biaya` as `b` ON `a`.`pengajuan_biaya_id` = `b`.`id`
JOIN `akk_rap_biaya` as `c` ON `a`.`rap_biaya_id` = `c`.`id`
WHERE `b`.`pengajuan_id` = '3'
ERROR - 2020-03-28 10:01:06 --> Query error: Unknown column 'a.rap_biaya_id' in 'on clause' - Invalid query: SELECT `a`.*, `c`.`nama_jenis_rap`, `c`.`nama_pekerjaan`
FROM `akk_pengajuan_approval` as `a`
JOIN `akk_pengajuan_biaya` as `b` ON `a`.`pengajuan_biaya_id` = `b`.`id`
JOIN `akk_rap_biaya` as `c` ON `a`.`rap_biaya_id` = `c`.`id`
WHERE `b`.`pengajuan_id` = '3'
ERROR - 2020-03-28 11:45:04 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-28 11:45:04 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-28 12:32:03 --> Query error: Table 'akkakarya_cos_control_dev.trx_pengiriman_uag' doesn't exist - Invalid query: INSERT INTO `trx_pengiriman_uag` (`organization_id`, `pengajuan_approval_id`, `destination_id`, `project_office_id`, `jumlah_uang`, `last_updated_by`, `created_at`) VALUES (1, '1', '1', '1', '55000000', '1', '2020-03-28 12:32:03')
ERROR - 2020-03-28 12:33:04 --> Query error: Table 'akkakarya_cos_control_dev.trx_pengiriman_uag' doesn't exist - Invalid query: INSERT INTO `trx_pengiriman_uag` (`organization_id`, `pengajuan_approval_id`, `destination_id`, `project_office_id`, `jumlah_uang`, `last_updated_by`, `created_at`) VALUES (1, '1', '2', '4', '55000000', '1', '2020-03-28 12:33:04')
ERROR - 2020-03-28 11:17:02 --> Severity: Parsing Error --> syntax error, unexpected ';', expecting ')' D:\xampp\htdocs\Costcontrol\application\controllers\C_pencairan.php 120
ERROR - 2020-03-28 17:55:54 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\Costcontrol\application\controllers\C_pencairan.php 114
ERROR - 2020-03-28 18:00:32 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\Costcontrol\application\controllers\C_pencairan.php 116
