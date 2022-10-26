<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-26 09:45:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `mst_users` as `a`
JOIN `mst_role` as `b` ON `a`.`role_id` = `b`.`id`
WHERE' at line 2 - Invalid query: SELECT `a`.*, `b`.`id` as `role_id`, `b`.`role_name`, IF(a.is_active=0, "Active", "Non Active") as is_active_v;
FROM `mst_users` as `a`
JOIN `mst_role` as `b` ON `a`.`role_id` = `b`.`id`
WHERE `a`.`is_active` =0
ERROR - 2020-04-26 09:45:24 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-04-26 09:45:44 --> Query error: Unknown column 'a.role_id' in 'on clause' - Invalid query: SELECT `a`.*, `b`.`id` as `role_id`, `b`.`role_name`, IF(a.is_active=0, "Active", "Non Active") as is_active_v
FROM `mst_users` as `a`
JOIN `mst_role` as `b` ON `a`.`role_id` = `b`.`id`
WHERE `a`.`is_active` =0
ERROR - 2020-04-26 09:49:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, "") as background_text
FROM `mst_users` as `a`
JOIN `mst_role` as `b` ON `a`.' at line 1 - Invalid query: SELECT `a`.*, `b`.`id` as `role_id`, `b`.`role_name`, IF(a.is_active=0, "Active", "Non Active") as is_active_v, IF(a.is_active=0, "bg-danger `text-white"`, "") as background_text
FROM `mst_users` as `a`
JOIN `mst_role` as `b` ON `a`.`role` = `b`.`id`
WHERE `a`.`is_active` =0
ERROR - 2020-04-26 09:51:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`text-white`, "") as background_text
FROM `mst_users` as `a`
JOIN `mst_role` as ' at line 1 - Invalid query: SELECT `a`.*, `b`.`id` as `role_id`, `b`.`role_name`, IF(a.is_active=0, "Active", "Non Active") as is_active_v, IF(a.is_active=0, `bg-danger` `text-white`, "") as background_text
FROM `mst_users` as `a`
JOIN `mst_role` as `b` ON `a`.`role` = `b`.`id`
WHERE `a`.`is_active` =0
ERROR - 2020-04-26 10:37:13 --> Severity: Notice --> Undefined index: is_active /home/akkaryaj/public_html/application/controllers/C_pengguna.php 49
ERROR - 2020-04-26 10:37:13 --> Query error: Unknown column 'role_id' in 'field list' - Invalid query: INSERT INTO `mst_users` (`fullname`, `username`, `role_id`, `is_active`, `password`, `last_update_by`, `created_at`) VALUES ('Helmi Dwi', 'helmidwi', '4', NULL, 'e10adc3949ba59abbe56e057f20f883e', '1', '2020-04-26 10:37:13')
ERROR - 2020-04-26 10:37:13 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-04-26 10:37:43 --> Query error: Unknown column 'role_id' in 'field list' - Invalid query: INSERT INTO `mst_users` (`fullname`, `username`, `role_id`, `password`, `last_update_by`, `created_at`) VALUES ('Helmi Dwi', 'helmidwi', '4', 'e10adc3949ba59abbe56e057f20f883e', '1', '2020-04-26 10:37:43')
ERROR - 2020-04-26 10:38:03 --> Severity: Error --> Call to undefined method C_pengguna::flashdata_succed1() /home/akkaryaj/public_html/application/controllers/C_pengguna.php 57
ERROR - 2020-04-26 11:23:01 --> Query error: Table 'akkaryaj_cost_control.mst_user' doesn't exist - Invalid query: UPDATE `mst_user` SET `password` = 'f1887d3f9e6ee7a32fe5e76f4ab80d63', `last_update_by` = '1', `updated_at` = '2020-04-26 11:23:01'
WHERE `id` = '7'
ERROR - 2020-04-26 11:53:41 --> Severity: Error --> Cannot use object of type stdClass as array /home/akkaryaj/public_html/application/controllers/C_project.php 110
ERROR - 2020-04-26 12:51:49 --> 404 Page Not Found: Wp-loginphp/index
ERROR - 2020-04-26 13:17:23 --> 404 Page Not Found: Wp-loginphp/index
ERROR - 2020-04-26 15:04:04 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-04-26 16:15:14 --> Severity: Notice --> Undefined index: $cash_in_hand /home/akkaryaj/public_html/application/controllers/Welcome.php 104
ERROR - 2020-04-26 16:15:47 --> Severity: Notice --> Undefined index: $cash_in_hand /home/akkaryaj/public_html/application/controllers/Welcome.php 104
ERROR - 2020-04-26 16:16:24 --> Severity: Notice --> Undefined index: $cash_in_hand /home/akkaryaj/public_html/application/controllers/Welcome.php 104
ERROR - 2020-04-26 16:17:12 --> Severity: Notice --> Undefined variable: data_mst_biaya /home/akkaryaj/public_html/application/views/project/detail.php 173
ERROR - 2020-04-26 16:17:12 --> Severity: Warning --> Invalid argument supplied for foreach() /home/akkaryaj/public_html/application/views/project/detail.php 173
ERROR - 2020-04-26 16:17:15 --> Severity: Notice --> Undefined variable: data_mst_biaya /home/akkaryaj/public_html/application/views/project/detail.php 173
ERROR - 2020-04-26 16:17:15 --> Severity: Warning --> Invalid argument supplied for foreach() /home/akkaryaj/public_html/application/views/project/detail.php 173
ERROR - 2020-04-26 16:17:50 --> Query error: Table 'akkaryaj_cost_control.mst_materia' doesn't exist - Invalid query: SELECT *
FROM `mst_materia`
ORDER BY `id` DESC
ERROR - 2020-04-26 16:17:51 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-04-26 16:35:37 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 557
ERROR - 2020-04-26 16:35:37 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 559
ERROR - 2020-04-26 16:35:37 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 567
ERROR - 2020-04-26 16:35:37 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 568
ERROR - 2020-04-26 16:35:37 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 569
ERROR - 2020-04-26 16:36:55 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 557
ERROR - 2020-04-26 16:36:55 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 559
ERROR - 2020-04-26 16:36:55 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 567
ERROR - 2020-04-26 16:36:55 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 568
ERROR - 2020-04-26 16:36:55 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 569
ERROR - 2020-04-26 16:37:10 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 557
ERROR - 2020-04-26 16:37:10 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 559
ERROR - 2020-04-26 16:37:10 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 567
ERROR - 2020-04-26 16:37:10 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 568
ERROR - 2020-04-26 16:37:10 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 569
ERROR - 2020-04-26 16:37:27 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 557
ERROR - 2020-04-26 16:37:27 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 559
ERROR - 2020-04-26 16:37:27 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 567
ERROR - 2020-04-26 16:37:27 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 568
ERROR - 2020-04-26 16:37:27 --> Severity: Notice --> Undefined offset: 0 /home/akkaryaj/public_html/application/controllers/C_project.php 569
ERROR - 2020-04-26 16:43:26 --> Severity: Notice --> Undefined index: $cash_in_hand /home/akkaryaj/public_html/application/controllers/Welcome.php 104
ERROR - 2020-04-26 16:46:07 --> Severity: Notice --> Undefined index: $cash_in_hand /home/akkaryaj/public_html/application/controllers/Welcome.php 104
ERROR - 2020-04-26 16:46:07 --> Query error: Unknown column 'cash_in_han' in 'field list' - Invalid query: UPDATE `mst_organization` SET `cash_in_han` = 4292750000, `updated_at` = '2020-04-26 16:46:07', `updated_by` = '1'
WHERE `id` = '1'
ERROR - 2020-04-26 16:47:34 --> Severity: Notice --> Undefined index: $cash_in_hand /home/akkaryaj/public_html/application/controllers/Welcome.php 104
ERROR - 2020-04-26 16:47:34 --> Severity: Error --> Function name must be a string /home/akkaryaj/public_html/application/controllers/Welcome.php 107
ERROR - 2020-04-26 16:48:17 --> Severity: Notice --> Undefined index: $cash_in_hand /home/akkaryaj/public_html/application/controllers/Welcome.php 104
ERROR - 2020-04-26 16:49:26 --> Severity: Notice --> Array to string conversion /home/akkaryaj/public_html/application/controllers/Welcome.php 111
ERROR - 2020-04-26 17:11:50 --> Severity: Notice --> Undefined variable: data_inventory /home/akkaryaj/public_html/application/controllers/C_project.php 664
ERROR - 2020-04-26 17:16:06 --> Query error: Unknown column 'project_id' in 'field list' - Invalid query: INSERT INTO `akk_inventory` (`created_at`, `id`, `last_updated_by`, `material_id`, `project_id`, `qty`, `updated_at`) VALUES ('2020-04-13 11:57:39','3','6','1','12','10','2020-04-13 11:58:06'), ('2020-04-26 17:12:45','6','4','3','12','500',NULL)
ERROR - 2020-04-26 20:40:41 --> 404 Page Not Found: Faviconico/index
