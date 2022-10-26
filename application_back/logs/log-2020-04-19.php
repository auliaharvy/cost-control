<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-19 01:24:54 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 D:\xampp\htdocs\Costcontrol\system\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2020-04-19 01:24:54 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 D:\xampp\htdocs\Costcontrol\system\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2020-04-19 01:24:54 --> Unable to connect to the database
ERROR - 2020-04-19 01:24:54 --> Unable to connect to the database
ERROR - 2020-04-19 01:24:57 --> Severity: Warning --> mysqli::real_connect(): (HY000/2002): No connection could be made because the target machine actively refused it.
 D:\xampp\htdocs\Costcontrol\system\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2020-04-19 01:24:57 --> Unable to connect to the database
ERROR - 2020-04-19 07:16:56 --> Severity: Notice --> Undefined variable: destination_id D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 197
ERROR - 2020-04-19 07:16:56 --> Severity: Notice --> Undefined variable: project_office_id D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 198
ERROR - 2020-04-19 08:04:54 --> Severity: Notice --> Array to string conversion D:\xampp\htdocs\Costcontrol\application\models\M_pembelian.php 293
ERROR - 2020-04-19 08:04:54 --> Query error: Table 'akkakarya_cos_control_dev.trx_cash_remaining' doesn't exist - Invalid query: select * from trx_cash_remaining Array
ERROR - 2020-04-19 08:08:46 --> Severity: Notice --> Undefined variable: project_office_id D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 195
ERROR - 2020-04-19 08:08:46 --> Query error: Table 'akkakarya_cos_control_dev.trx_cash_remaining' doesn't exist - Invalid query: select * from trx_cash_remaining where project_id = '4' and destination_id = '1' and project_office_id = ''
ERROR - 2020-04-19 08:09:11 --> Query error: Table 'akkakarya_cos_control_dev.trx_cash_remaining' doesn't exist - Invalid query: select * from trx_cash_remaining where project_id = '4' and destination_id = '1' and project_office_id = '1'
ERROR - 2020-04-19 08:32:18 --> Query error: Table 'akkakarya_cos_control_dev.trx_cash_remainin' doesn't exist - Invalid query: SELECT `a`.`cash_remaining`, FORMAT(a.cash_remaining, 0, "de_DE") as remaining_pembelian_v
FROM `trx_cash_remainin` as `a`
JOIN `mst_office` as `b` ON `a`.`project_office_id` = `b`.`id`
JOIN `mst_users` as `c` ON `b`.`user_id` = `c`.`id`
WHERE `a`.`project_id` = '3'
AND `a`.`destination_id` = 1
AND `c`.`id` = '5'
ERROR - 2020-04-19 08:53:13 --> Query error: Unknown column 'b.project_id' in 'field list' - Invalid query: SELECT `a`.*, `b`.`project_name`, `b`.`project_location`, `b`.`project_id`, `b`.`project_deadline`, `b`.`rab_project`, `b`.`id`, `a`.`id` as `pengajuan_id`
FROM `akk_pengajuan` as `a`
JOIN `mst_project` as `b` ON `a`.`project_id` = `b`.`id`
WHERE `a`.`id` = '3'
ERROR - 2020-04-19 06:19:03 --> Severity: Parsing Error --> syntax error, unexpected 'if' (T_IF) D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 254
ERROR - 2020-04-19 06:31:08 --> 404 Page Not Found: Pembelian/create_remaining
ERROR - 2020-04-19 11:32:07 --> Severity: Notice --> Undefined variable: proj_off_id D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 255
ERROR - 2020-04-19 11:32:07 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 256
ERROR - 2020-04-19 11:32:07 --> Severity: Notice --> Undefined variable: proj_off_id D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 284
ERROR - 2020-04-19 11:32:07 --> Query error: Column 'project_office_id' cannot be null - Invalid query: INSERT INTO `trx_pembelian_barang_remaining` (`project_id`, `rap_biaya_id`, `destination_id`, `project_office_id`, `jumlah_uang_pembelian`, `created_at`, `last_updated_by`) VALUES ('4', '17', '1', NULL, '10000000', '2020-04-19 11:32:07', '5')
ERROR - 2020-04-19 11:34:06 --> Severity: Notice --> Undefined variable: project_office_i D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 255
ERROR - 2020-04-19 11:34:06 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 256
ERROR - 2020-04-19 11:34:06 --> Severity: Notice --> Undefined variable: proj_off_id D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 284
ERROR - 2020-04-19 11:34:06 --> Query error: Column 'project_office_id' cannot be null - Invalid query: INSERT INTO `trx_pembelian_barang_remaining` (`project_id`, `rap_biaya_id`, `destination_id`, `project_office_id`, `jumlah_uang_pembelian`, `created_at`, `last_updated_by`) VALUES ('4', '17', '1', NULL, '10000000', '2020-04-19 11:34:06', '5')
ERROR - 2020-04-19 11:43:09 --> Severity: Notice --> Undefined variable: proj_off_id D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 264
ERROR - 2020-04-19 11:43:09 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 265
ERROR - 2020-04-19 11:53:03 --> Severity: Notice --> Undefined variable: proj_off_id D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 264
ERROR - 2020-04-19 11:53:03 --> Severity: Notice --> Undefined offset: 0 D:\xampp\htdocs\Costcontrol\application\controllers\C_pembelian.php 265
ERROR - 2020-04-19 11:56:21 --> Query error: Table 'akkakarya_cos_control_dev.trx_cash_remainin' doesn't exist - Invalid query: SELECT `a`.`id`, `a`.`cash_remaining`, FORMAT(a.cash_remaining, 0, "de_DE") as remaining_pembelian_v
FROM `trx_cash_remainin` as `a`
JOIN `mst_office` as `b` ON `a`.`project_office_id` = `b`.`id`
WHERE `a`.`project_id` = '4'
AND `a`.`destination_id` = '2'
AND `a`.`project_office_id` = '4'
ERROR - 2020-04-19 11:58:23 --> Query error: Table 'akkakarya_cos_control_dev.trx_cash_remainin' doesn't exist - Invalid query: SELECT `a`.`id`, `a`.`cash_remaining`, FORMAT(a.cash_remaining, 0, "de_DE") as remaining_pembelian_v
FROM `trx_cash_remainin` as `a`
WHERE `a`.`project_id` = '4'
AND `a`.`destination_id` = '2'
AND `a`.`project_office_id` = '4'
ERROR - 2020-04-19 19:52:58 --> Severity: Notice --> Undefined variable: destination_id D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 221
ERROR - 2020-04-19 19:52:59 --> Severity: Notice --> Undefined variable: project_office_id D:\xampp\htdocs\Costcontrol\application\views\pembelian\detail.php 222
