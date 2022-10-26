<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-05-09 14:20:36 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-05-09 17:00:49 --> Severity: Notice --> Undefined index: project_status /home/akkaryaj/public_html/application/controllers/C_laporan.php 36
ERROR - 2020-05-09 17:00:50 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-05-09 17:01:42 --> Severity: Notice --> Undefined variable: status /home/akkaryaj/public_html/application/controllers/C_laporan.php 68
ERROR - 2020-05-09 17:09:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, "bg-success text-white") as background_text
FROM `akk_rap` as `a`
JOIN `mst_p' at line 1 - Invalid query: SELECT `a`.*, `b`.`project_name`, `b`.`project_location`, `b`.`project_deadline`, `b`.`rab_project`, `b`.`cash_in_hand`, `b`.`project_status`, IF((b.project_status)=0, "bg-danger `text-white"`, "bg-success text-white") as background_text
FROM `akk_rap` as `a`
JOIN `mst_project` as `b` ON `a`.`project_id` = `b`.`id`
WHERE `b`.`id` = '8'
ERROR - 2020-05-09 17:09:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '`, "bg-success text-white") as background_text
FROM `akk_rap` as `a`
JOIN `mst_p' at line 1 - Invalid query: SELECT `a`.*, `b`.`project_name`, `b`.`project_location`, `b`.`project_deadline`, `b`.`rab_project`, `b`.`cash_in_hand`, `b`.`project_status`, IF(b.project_status=0, "bg-danger `text-white"`, "bg-success text-white") as background_text
FROM `akk_rap` as `a`
JOIN `mst_project` as `b` ON `a`.`project_id` = `b`.`id`
WHERE `b`.`id` = '8'
ERROR - 2020-05-09 17:13:11 --> Severity: Notice --> Undefined variable: background_text /home/akkaryaj/public_html/application/views/laporan/detail.php 78
ERROR - 2020-05-09 17:30:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'g.nama_jenis_rap, `g`.`nama_pekerjaan`, `h`.`project_name` as `project_source`
F' at line 2 - Invalid query: SELECT `a`.*, IF (a.destination_id = 1, concat(q.nama_type, " ", r.fullname), c.project_name) AS pro_office, `b`.`organization_name`, FORMAT(a.jumlah_uang, 0, "de_DE") as jumlah_uang, DATE_FORMAT(a.created_at, "%d %M %Y") as tanggal_pencairan
			g.nama_jenis_rap, `g`.`nama_pekerjaan`, `h`.`project_name` as `project_source`
FROM `trx_pengiriman_uang` as `a`
JOIN `mst_organization` as `b` ON `a`.`organization_id` = `b`.`id`
LEFT JOIN `mst_project` as `c` ON `a`.`project_office_id` = `c`.`id`
JOIN `akk_pengajuan_approval` as `d` ON `a`.`pengajuan_approval_id` = `d`.`id`
JOIN `akk_pengajuan_biaya` as `e` ON `d`.`pengajuan_biaya_id` = `e`.`id`
JOIN `akk_pengajuan` as `f` ON `e`.`pengajuan_id` = `f`.`id`
JOIN `akk_rap_biaya` as `g` ON `e`.`rap_biaya_id` = `g`.`id`
JOIN `mst_project` as `h` ON `f`.`project_id` = `h`.`id`
LEFT JOIN `mst_office` as `p` ON `a`.`project_office_id` = `p`.`id`
LEFT JOIN `mst_office_type` as `q` ON `p`.`type_office_id` = `q`.`id`
LEFT JOIN `mst_users` as `r` ON `p`.`user_id` = `r`.`id`
WHERE `h`.`id` = '4'
AND `d`.`is_send_cash` = 1
ORDER BY `id` DESC
ERROR - 2020-05-09 19:48:24 --> 404 Page Not Found: Wp-loginphp/index
ERROR - 2020-05-09 20:13:13 --> 404 Page Not Found: Faviconico/index
ERROR - 2020-05-09 20:17:06 --> 404 Page Not Found: Wp-loginphp/index
