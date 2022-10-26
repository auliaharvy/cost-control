<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['project_on'] = 'C_project';
$route['project_finish'] = 'C_project/project_finished';
$route['project_detail/(:num)'] = 'C_project/detail/$1';
$route['project_delete/(:num)'] = 'C_project/delete/$1';
$route['rap/(:num)'] = 'C_project/detail_rap/$1';
$route['rap/create'] = 'C_project/create_rap_project';
$route['createrap'] = 'C_project/generaterap';
$route['confirmrap'] = 'C_project/confirmrap';

$route['project/add_termin'] = 'C_project/create_penerimaan_termin';
$route['termin'] = 'C_termin';
$route['termin/add'] = 'C_termin/add';

$route['createpengajuan'] = 'C_project/generatepengajuan';
$route['pengajuan/(:num)'] = 'C_project/detail_pengajuan/$1';
$route['pengajuan/create'] = 'C_project/create_pengajuan_biaya';
$route['pengajuan'] = 'C_pengajuan/index';
$route['pengajuan_detail/(:num)'] = 'C_pengajuan/detail/$1';
$route['approvedpengajuan'] = 'C_pengajuan/approved';
$route['unapprovedpengajuan'] = 'C_pengajuan/unapproved';

$route['office'] = 'C_office';

$route['pencairan'] = 'C_pencairan/index';
$route['list_pencairan'] = 'C_pencairan/list_pencairan';
$route['pencairan_detail/(:num)'] = 'C_pencairan/detail/$1';
$route['kirimpencairan'] = 'C_pencairan/create_kirim_pencairan';

$route['pembelian'] = 'C_pembelian/index';
$route['pembelian/create_remaining'] = 'C_pembelian/create_belanja_remaining';
$route['pembelian_detail/(:num)'] = 'C_pembelian/detail/$1';
$route['create_belanja'] = 'C_pembelian/create_belanja';

$route['laporan'] = 'C_laporan';
$route['laporan_detail/(:num)'] = 'C_laporan/detail/$1';
$route['report/export/(:num)'] = 'C_laporan/export/$1';

$route['user'] = 'C_pengguna';
$route['user/add'] = 'C_pengguna/add';
$route['user/update'] = 'C_pengguna/do_update';
$route['user/changepassword'] = 'C_pengguna/change_pass';

$route['dashboard'] = 'C_dashboard/index';

$route['material'] = 'C_material/index';
$route['material_add'] = 'C_material/add';
$route['material_update'] = 'C_material/do_update';

$route['kas/inventory_add'] = 'Welcome/inventory_add';
$route['kas/update_inventory'] = 'Welcome/update_inventory';
$route['kas/transfer'] = 'Welcome/transfer';
$route['kas/addkas'] = 'Welcome/tambah_kas';
$route['kas/historycash'] = 'Welcome/log_kas';
$route['kas/historymaterial'] = 'Welcome/log_material';

$route['hutang'] = 'C_hutang/index';
$route['hutang_detail/(:num)'] = 'C_hutang/detail/$1';
$route['bayarhutang/(:num)'] = 'C_hutang/bayar_hutang/$1';