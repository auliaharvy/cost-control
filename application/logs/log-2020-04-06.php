<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-06 18:54:35 --> Severity: Parsing Error --> syntax error, unexpected '%' D:\xampp\htdocs\Costcontrol\application\models\M_project.php 44
ERROR - 2020-04-06 18:55:35 --> Query error: Table 'akkakarya_cos_control_dev.mst_projec' doesn't exist - Invalid query: SELECT `a`.*, CONCAT("Rp ", FORMAT(a.rab_project, 0, "de_DE")) as rab_project, CONCAT("Rp ", FORMAT(b.total_biaya, 0, "de_DE")) as total_biaya, STR_TO_DATE(a.project_deadline, "%d/%m/%Y") as project_deadline
FROM `mst_projec` as `a`
LEFT JOIN `akk_rap` as `b` ON `b`.`project_id` = `a`.`id`
WHERE `a`.`project_status` =0
ERROR - 2020-04-06 18:58:28 --> Query error: Table 'akkakarya_cos_control_dev.mst_projec' doesn't exist - Invalid query: SELECT `a`.*, CONCAT("Rp ", FORMAT(a.rab_project, 0, "de_DE")) as rab_project, CONCAT("Rp ", FORMAT(b.total_biaya, 0, "de_DE")) as total_biaya, DATE_FORMAT(a.project_deadline, "%d/%m/%Y") as project_deadline
FROM `mst_projec` as `a`
LEFT JOIN `akk_rap` as `b` ON `b`.`project_id` = `a`.`id`
WHERE `a`.`project_status` =0
ERROR - 2020-04-06 19:01:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '(b.total_biaya, 0, "de_DE") as total_biaya, DATE_FORMAT(a.project_deadline, "%d/' at line 1 - Invalid query: SELECT `a`.*, FORMAT(a.rab_project, 0, "de_DE") as rab_projectFORMAT(b.total_biaya, 0, "de_DE") as total_biaya, DATE_FORMAT(a.project_deadline, "%d/%m/%Y") as project_deadline
FROM `mst_project` as `a`
LEFT JOIN `akk_rap` as `b` ON `b`.`project_id` = `a`.`id`
WHERE `a`.`project_status` =0
ERROR - 2020-04-06 19:39:11 --> Query error: Table 'akkakarya_cos_control_dev.akk_pengajuan_biay' doesn't exist - Invalid query: SELECT `a`.*, `b`.`nama_jenis_rap`, `b`.`nama_pekerjaan`, `c`.`nama_jenis`, `d`.`nama_kategori`, `f`.`id` as `project_id`, `g`.`jumlah_approval`
FROM `akk_pengajuan_biay` as `a`
JOIN `akk_pengajuan` as `e` ON `a`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `f` ON `e`.`project_id` = `f`.`id`
JOIN `akk_rap_biaya` as `b` ON `a`.`rap_biaya_id` = `b`.`id`
JOIN `mst_jenis_biaya` as `c` ON `b`.`jenis_biaya_id` = `c`.`id`
JOIN `mst_kategori_biaya` as `d` ON `b`.`kategori_biaya_id` = `d`.`id`
LEFT JOIN `akk_pengajuan_approval` as `g` ON `a`.`id` = `g`.`pengajuan_biaya_id`
ERROR - 2020-04-06 19:42:49 --> Query error: Table 'akkakarya_cos_control_dev.akk_pengajuan_biay' doesn't exist - Invalid query: SELECT `a`.*, `b`.`nama_jenis_rap`, `b`.`nama_pekerjaan`, `c`.`nama_jenis`, `d`.`nama_kategori`, `f`.`id` as `project_id`, `g`.`jumlah_approval`
FROM `akk_pengajuan_biay` as `a`
JOIN `akk_pengajuan` as `e` ON `a`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `f` ON `e`.`project_id` = `f`.`id`
JOIN `akk_rap_biaya` as `b` ON `a`.`rap_biaya_id` = `b`.`id`
JOIN `mst_jenis_biaya` as `c` ON `b`.`jenis_biaya_id` = `c`.`id`
JOIN `mst_kategori_biaya` as `d` ON `b`.`kategori_biaya_id` = `d`.`id`
LEFT JOIN `akk_pengajuan_approval` as `g` ON `a`.`id` = `g`.`pengajuan_biaya_id`
ERROR - 2020-04-06 19:43:00 --> Severity: Parsing Error --> syntax error, unexpected '$data' (T_VARIABLE) D:\xampp\htdocs\Costcontrol\application\models\M_project.php 121
ERROR - 2020-04-06 19:43:09 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\Costcontrol\application\views\project\v_pengajuan.php 167
ERROR - 2020-04-06 19:44:11 --> Query error: Table 'akkakarya_cos_control_dev.akk_pengajuan_biay' doesn't exist - Invalid query: SELECT `a`.*, `b`.`nama_jenis_rap`, `b`.`nama_pekerjaan`, `c`.`nama_jenis`, `d`.`nama_kategori`, `f`.`id` as `project_id`, `g`.`jumlah_approval`
FROM `akk_pengajuan_biay` as `a`
JOIN `akk_pengajuan` as `e` ON `a`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `f` ON `e`.`project_id` = `f`.`id`
JOIN `akk_rap_biaya` as `b` ON `a`.`rap_biaya_id` = `b`.`id`
JOIN `mst_jenis_biaya` as `c` ON `b`.`jenis_biaya_id` = `c`.`id`
JOIN `mst_kategori_biaya` as `d` ON `b`.`kategori_biaya_id` = `d`.`id`
LEFT JOIN `akk_pengajuan_approval` as `g` ON `a`.`id` = `g`.`pengajuan_biaya_id`
WHERE `e`.`id` = '4'
ERROR - 2020-04-06 19:49:44 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp\htdocs\Costcontrol\application\views\project\v_pengajuan.php 167
ERROR - 2020-04-06 20:42:24 --> Query error: Table 'akkakarya_cos_control_dev.akk_pengajua' doesn't exist - Invalid query: SELECT `a`.*, sum(b.jumlah_pengajuan) as total_pengajuan, `c`.`project_name`, `c`.`project_location`, `c`.`project_deadline`
FROM `akk_pengajua` as `a`
JOIN `akk_pengajuan_biaya` as `b` ON `a`.`id` = `b`.`pengajuan_id`
JOIN `mst_project` as `c` ON `a`.`project_id` = `c`.`id`
ORDER BY `id` DESC
ERROR - 2020-04-06 20:46:09 --> Query error: Unknown column 'b.jumlah_pengajuan' in 'field list' - Invalid query: SELECT `a`.*, sum(b.jumlah_pengajuan) as total_pengajuan, `c`.`project_name`, `c`.`project_location`, `c`.`project_deadline`
FROM `akk_pengajuan` as `a`
JOIN `mst_project` as `c` ON `a`.`project_id` = `c`.`id`
ORDER BY `id` DESC
ERROR - 2020-04-06 21:42:32 --> Severity: Notice --> Undefined variable: is_approved D:\xampp\htdocs\Costcontrol\application\views\project\v_pengajuan.php 110
ERROR - 2020-04-06 21:42:32 --> Severity: Notice --> Undefined variable: is_approved D:\xampp\htdocs\Costcontrol\application\views\project\v_pengajuan.php 114
ERROR - 2020-04-06 21:42:32 --> Severity: Notice --> Undefined variable: is_approved D:\xampp\htdocs\Costcontrol\application\views\project\v_pengajuan.php 110
ERROR - 2020-04-06 21:42:32 --> Severity: Notice --> Undefined variable: is_approved D:\xampp\htdocs\Costcontrol\application\views\project\v_pengajuan.php 114
ERROR - 2020-04-06 21:42:59 --> Query error: Table 'akkakarya_cos_control_dev.akk_pengajuan_biaa' doesn't exist - Invalid query: SELECT `a`.*, `b`.`nama_jenis_rap`, `b`.`nama_pekerjaan`, `c`.`nama_jenis`, `d`.`nama_kategori`, `f`.`id` as `project_id`, `g`.`jumlah_approval`
FROM `akk_pengajuan_biaa` as `a`
JOIN `akk_pengajuan` as `e` ON `a`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `f` ON `e`.`project_id` = `f`.`id`
JOIN `akk_rap_biaya` as `b` ON `a`.`rap_biaya_id` = `b`.`id`
JOIN `mst_jenis_biaya` as `c` ON `b`.`jenis_biaya_id` = `c`.`id`
JOIN `mst_kategori_biaya` as `d` ON `b`.`kategori_biaya_id` = `d`.`id`
LEFT JOIN `akk_pengajuan_approval` as `g` ON `a`.`id` = `g`.`pengajuan_biaya_id`
WHERE `e`.`id` = '4'
ERROR - 2020-04-06 22:02:28 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:02:28 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:02:28 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:26 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:26 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:26 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:31 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:31 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:31 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:33 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:33 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:33 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:41 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:41 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:41 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:46 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:46 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:46 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:52 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:52 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:52 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:54 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:55 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:04:55 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:03 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:03 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:03 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:26 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:26 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:26 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:36 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:36 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:36 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:43 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:44 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:44 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:47 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:47 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:48 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:55 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:55 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:55 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:57 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:57 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:08:57 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:09:05 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:09:05 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:09:05 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:09:48 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:09:48 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:09:48 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:09:56 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:09:56 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:09:57 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:10:08 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:10:08 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:10:08 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:10:15 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:10:15 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:10:15 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:10:19 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:10:19 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:10:19 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:11:18 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:11:18 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:11:18 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:11:23 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:11:23 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:11:23 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:12:59 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:12:59 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:12:59 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:11 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:12 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:12 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:13 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:13 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:13 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:19 --> 404 Page Not Found: Pembelanjaan/index
ERROR - 2020-04-06 22:13:19 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-04-06 22:13:23 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:23 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:23 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:26 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:26 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:26 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:32 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:32 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:32 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:38 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:38 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:38 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:51 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:51 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:51 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:53 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:53 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:13:53 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:31:58 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:31:59 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:31:59 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:00 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:00 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:00 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:12 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:12 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:12 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:16 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:16 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:16 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:49 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:49 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:49 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:57 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:58 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:32:58 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:33:01 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:33:02 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:33:02 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:33:06 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:33:06 --> 404 Page Not Found: Dist/img
ERROR - 2020-04-06 22:33:06 --> 404 Page Not Found: Dist/img
