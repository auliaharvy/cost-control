<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-03-26 07:01:17 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\Costcontrol\application\controllers\C_pengajuan.php 83
ERROR - 2020-03-26 08:19:00 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 08:19:00 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 08:22:18 --> Query error: Unknown column 'pengajuan_biay_id' in 'where clause' - Invalid query: select * from akk_pengajuan_approval where pengajuan_biay_id = '1'
ERROR - 2020-03-26 08:23:35 --> Query error: Table 'akkakarya_cos_control_dev.akk_pengajuan_approva' doesn't exist - Invalid query: INSERT INTO `akk_pengajuan_approva` (`pengajuan_id`, `pengajuan_biaya_id`, `jumlah_approval`, `created_at`, `last_updated_by`) VALUES ('3', '1', '100000000', '2020-03-26 08:23:35', '1')
ERROR - 2020-03-26 08:24:02 --> Severity: Notice --> Array to string conversion D:\xampp\htdocs\Costcontrol\application\controllers\C_pengajuan.php 74
ERROR - 2020-03-26 08:25:45 --> Query error: Unknown column 'pengajuan_biaya_id' in 'where clause' - Invalid query: UPDATE `akk_pengajuan_biaya` SET `is_approved` = '1', `last_updated_by` = '1', `updated_at` = '2020-03-26 08:25:45'
WHERE `pengajuan_biaya_id` = '1'
ERROR - 2020-03-26 08:36:55 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 08:36:56 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 08:37:51 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 08:37:51 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 08:46:19 --> Query error: Not unique table/alias: 'e' - Invalid query: SELECT `a`.*, `b`.`nama_jenis_rap`, `b`.`nama_pekerjaan`, `c`.`nama_jenis`, `d`.`nama_kategori`, `f`.`id` as `project_id`, `e`.`jumlah_approval`
FROM `akk_pengajuan_biaya` as `a`
JOIN `akk_pengajuan` as `e` ON `a`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `f` ON `e`.`project_id` = `f`.`id`
JOIN `akk_rap_biaya` as `b` ON `a`.`rap_biaya_id` = `b`.`id`
JOIN `mst_jenis_biaya` as `c` ON `b`.`jenis_biaya_id` = `c`.`id`
JOIN `mst_kategori_biaya` as `d` ON `b`.`kategori_biaya_id` = `d`.`id`
LEFT JOIN `akk_pengajuan_approval` as `e` ON `a`.`id` = `e`.`pengajuan_biaya_id`
ERROR - 2020-03-26 08:46:34 --> Query error: Unknown column 'e.jumlah_approval' in 'field list' - Invalid query: SELECT `a`.*, `b`.`nama_jenis_rap`, `b`.`nama_pekerjaan`, `c`.`nama_jenis`, `d`.`nama_kategori`, `f`.`id` as `project_id`, `e`.`jumlah_approval`
FROM `akk_pengajuan_biaya` as `a`
JOIN `akk_pengajuan` as `e` ON `a`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `f` ON `e`.`project_id` = `f`.`id`
JOIN `akk_rap_biaya` as `b` ON `a`.`rap_biaya_id` = `b`.`id`
JOIN `mst_jenis_biaya` as `c` ON `b`.`jenis_biaya_id` = `c`.`id`
JOIN `mst_kategori_biaya` as `d` ON `b`.`kategori_biaya_id` = `d`.`id`
LEFT JOIN `akk_pengajuan_approval` as `g` ON `a`.`id` = `g`.`pengajuan_biaya_id`
ERROR - 2020-03-26 08:53:14 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 08:53:14 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 09:06:41 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 09:06:41 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 16:59:55 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 16:59:55 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 17:04:46 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\Costcontrol\application\controllers\C_project.php 321
ERROR - 2020-03-26 17:04:47 --> Severity: Notice --> Undefined variable: data D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
ERROR - 2020-03-26 17:04:47 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\Costcontrol\application\views\project\detail.php 118
