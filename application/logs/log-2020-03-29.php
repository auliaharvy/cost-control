<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-03-29 21:01:51 --> Query error: Table 'akkakarya_cos_control_dev.akk_pengajua' doesn't exist - Invalid query: SELECT `a`.*, `b`.`project_name`, `b`.`project_location`, `b`.`project_deadline`, `b`.`rab_project`, `b`.`id` as `project_id`
FROM `akk_pengajua` as `a`
JOIN `mst_project` as `b` ON `a`.`project_id` = `b`.`id`
WHERE `a`.`id` = '3'
ERROR - 2020-03-29 21:32:55 --> Query error: Unknown column 'updated_at' in 'field list' - Invalid query: UPDATE `mst_office` SET `cash_in_hand` = 200000000, `updated_at` = '2020-03-29 21:32:54', `last_updated_by` = '1'
WHERE `id` = '1'
ERROR - 2020-03-29 16:42:59 --> 404 Page Not Found: List_%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20pencairan/index
ERROR - 2020-03-29 21:43:50 --> Query error: Table 'akkakarya_cos_control_dev.trx_pengiriman_uan' doesn't exist - Invalid query: SELECT `a`.*, IF (a.destination_id = 1, `p`.`project_name`, c.project_name) AS pro_office, `b`.`organization_name`, `g`.`nama_jenis_rap`, `g`.`nama_pekerjaan`, `h`.`project_name` as `project_source`
FROM `trx_pengiriman_uan` as `a`
JOIN `mst_organization` as `b` ON `a`.`organization_id` = `b`.`id`
LEFT JOIN `mst_office` as `p` ON `a`.`project_office_id` = `p`.`id`
LEFT JOIN `mst_project` as `c` ON `a`.`project_office_id` = `c`.`id`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan` as `e` ON `d`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `h` ON `e`.`project_id` = `h`.`id`
JOIN `akk_rap` as `f` ON `e`.`rap_id` = `f`.`id`
JOIN `akk_rap_biaya` as `g` ON `f`.`id` = `g`.`rap_id`
ORDER BY `id` DESC
ERROR - 2020-03-29 21:44:05 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:05 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:05 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:05 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:05 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:05 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:05 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:05 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:05 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:05 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:06 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:07 --> Severity: Notice --> Undefined index: project_name D:\xampp\htdocs\Costcontrol\application\views\pencairan\list.php 67
ERROR - 2020-03-29 21:44:42 --> Query error: Table 'akkakarya_cos_control_dev.trx_pengiriman_uan' doesn't exist - Invalid query: SELECT `a`.*, IF (a.destination_id = 1, `p`.`project_name`, c.project_name) AS pro_office, `b`.`organization_name`, `g`.`nama_jenis_rap`, `g`.`nama_pekerjaan`, `h`.`project_name` as `project_source`
FROM `trx_pengiriman_uan` as `a`
JOIN `mst_organization` as `b` ON `a`.`organization_id` = `b`.`id`
LEFT JOIN `mst_office` as `p` ON `a`.`project_office_id` = `p`.`id`
LEFT JOIN `mst_project` as `c` ON `a`.`project_office_id` = `c`.`id`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan` as `e` ON `d`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `h` ON `e`.`project_id` = `h`.`id`
JOIN `akk_rap` as `f` ON `e`.`rap_id` = `f`.`id`
JOIN `akk_rap_biaya` as `g` ON `f`.`id` = `g`.`rap_id`
ORDER BY `id` DESC
ERROR - 2020-03-29 21:48:58 --> Query error: Table 'akkakarya_cos_control_dev.trx_pengiriman_uan' doesn't exist - Invalid query: SELECT `a`.*, IF (a.destination_id = 1, `p`.`project_name`, c.project_name) AS pro_office, `b`.`organization_name`, `g`.`nama_jenis_rap`, `g`.`nama_pekerjaan`, `h`.`project_name` as `project_source`
FROM `trx_pengiriman_uan` as `a`
JOIN `mst_organization` as `b` ON `a`.`organization_id` = `b`.`id`
LEFT JOIN `mst_office` as `p` ON `a`.`project_office_id` = `p`.`id`
LEFT JOIN `mst_project` as `c` ON `a`.`project_office_id` = `c`.`id`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan` as `e` ON `d`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `h` ON `e`.`project_id` = `h`.`id`
JOIN `akk_rap` as `f` ON `e`.`rap_id` = `f`.`id`
JOIN `akk_rap_biaya` as `g` ON `f`.`id` = `g`.`rap_id`
ORDER BY `id` DESC
ERROR - 2020-03-29 21:54:51 --> Query error: Table 'akkakarya_cos_control_dev.trx_pengiriman_uan' doesn't exist - Invalid query: SELECT `a`.*, IF (a.destination_id = 1, `p`.`project_name`, c.project_name) AS pro_office, `b`.`organization_name`, `g`.`nama_jenis_rap`, `g`.`nama_pekerjaan`, `h`.`project_name` as `project_source`
FROM `trx_pengiriman_uan` as `a`
JOIN `mst_organization` as `b` ON `a`.`organization_id` = `b`.`id`
LEFT JOIN `mst_office` as `p` ON `a`.`project_office_id` = `p`.`id`
LEFT JOIN `mst_project` as `c` ON `a`.`project_office_id` = `c`.`id`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan` as `e` ON `d`.`pengajuan_id` = `e`.`id`
JOIN `mst_project` as `h` ON `e`.`project_id` = `h`.`id`
JOIN `akk_rap` as `f` ON `e`.`rap_id` = `f`.`id`
JOIN `akk_rap_biaya` as `g` ON `f`.`id` = `g`.`rap_id`
WHERE `d`.`is_send_cash` = 1
ORDER BY `id` DESC
ERROR - 2020-03-29 22:13:33 --> Query error: Table 'akkakarya_cos_control_dev.akk_pengajuan_biaya_id' doesn't exist - Invalid query: SELECT `a`.*, IF (a.destination_id = 1, `p`.`project_name`, c.project_name) AS pro_office, `b`.`organization_name`, `g`.`nama_jenis_rap`, `g`.`nama_pekerjaan`, `h`.`project_name` as `project_source`
FROM `trx_pengiriman_uang` as `a`
JOIN `mst_organization` as `b` ON `a`.`organization_id` = `b`.`id`
LEFT JOIN `mst_office` as `p` ON `a`.`project_office_id` = `p`.`id`
LEFT JOIN `mst_project` as `c` ON `a`.`project_office_id` = `c`.`id`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan_biaya_id` as `e` ON `d`.`pengajuan_biaya_id` = `e`.`id`
JOIN `mst_project` as `h` ON `e`.`project_id` = `h`.`id`
JOIN `akk_rap_biaya` as `g` ON `e`.`rap_biaya_id` = `g`.`rap_id`
WHERE `d`.`is_send_cash` = 1
ORDER BY `id` DESC
ERROR - 2020-03-29 22:13:46 --> Query error: Unknown column 'e.project_id' in 'on clause' - Invalid query: SELECT `a`.*, IF (a.destination_id = 1, `p`.`project_name`, c.project_name) AS pro_office, `b`.`organization_name`, `g`.`nama_jenis_rap`, `g`.`nama_pekerjaan`, `h`.`project_name` as `project_source`
FROM `trx_pengiriman_uang` as `a`
JOIN `mst_organization` as `b` ON `a`.`organization_id` = `b`.`id`
LEFT JOIN `mst_office` as `p` ON `a`.`project_office_id` = `p`.`id`
LEFT JOIN `mst_project` as `c` ON `a`.`project_office_id` = `c`.`id`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan_biaya` as `e` ON `d`.`pengajuan_biaya_id` = `e`.`id`
JOIN `mst_project` as `h` ON `e`.`project_id` = `h`.`id`
JOIN `akk_rap_biaya` as `g` ON `e`.`rap_biaya_id` = `g`.`rap_id`
WHERE `d`.`is_send_cash` = 1
ORDER BY `id` DESC
ERROR - 2020-03-29 22:16:17 --> Query error: Unknown column 'e.project_id' in 'on clause' - Invalid query: SELECT `a`.*, IF (a.destination_id = 1, `p`.`project_name`, c.project_name) AS pro_office, `b`.`organization_name`, `g`.`nama_jenis_rap`, `g`.`nama_pekerjaan`, `h`.`project_name` as `project_source`
FROM `trx_pengiriman_uang` as `a`
JOIN `mst_organization` as `b` ON `a`.`organization_id` = `b`.`id`
LEFT JOIN `mst_office` as `p` ON `a`.`project_office_id` = `p`.`id`
LEFT JOIN `mst_project` as `c` ON `a`.`project_office_id` = `c`.`id`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan_biaya` as `e` ON `d`.`pengajuan_biaya_id` = `e`.`id`
JOIN `akk_pengajuan` as `f` ON `e`.`pengajuan_id` = `f`.`id`
JOIN `mst_project` as `h` ON `e`.`project_id` = `h`.`id`
JOIN `akk_rap_biaya` as `g` ON `e`.`rap_biaya_id` = `g`.`rap_id`
WHERE `d`.`is_send_cash` = 1
ORDER BY `id` DESC
