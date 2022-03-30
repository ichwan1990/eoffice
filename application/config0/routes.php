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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['disposisi/(:num)'] = 'disposisi/data';
$route['disposisi/(:num)/add'] = 'disposisi/add';
$route['disposisi/(:num)/edit/(:num)'] = 'disposisi/edit';
$route['disposisi/(:num)/del/(:num)'] = 'disposisi/del';


$route['sppd/kegiatan'] = 'sppd/data_kegiatan';
$route['sppd/kegiatan/add'] = 'sppd/add_kegiatan';
$route['sppd/kegiatan/edit/(:num)'] = 'sppd/edit_kegiatan';
$route['sppd/kegiatan/proses'] = 'sppd/proses_kegiatan';
$route['sppd/kegiatan/del/(:num)'] = 'sppd/del_kegiatan';

$route['sppd/dasar/(:num)'] = 'sppd/data_dasar';
$route['sppd/dasar/(:num)/add'] = 'sppd/add_dasar';
$route['sppd/dasar/(:num)/edit/(:num)'] = 'sppd/edit_dasar';
$route['sppd/dasar/proses'] = 'sppd/proses_dasar';
$route['sppd/dasar/(:num)/del/(:num)'] = 'sppd/del_dasar';

$route['sppd/pelaksana/(:num)'] = 'sppd/data_pelaksana';
$route['sppd/pelaksana/(:num)/add'] = 'sppd/add_pelaksana';
$route['sppd/pelaksana/(:num)/edit/(:num)'] = 'sppd/edit_pelaksana';
$route['sppd/pelaksana/proses'] = 'sppd/proses_pelaksana';
$route['sppd/pelaksana/(:num)/del/(:num)'] = 'sppd/del_pelaksana';

$route['sppd/pengikut/(:num)'] = 'sppd/data_pengikut';
$route['sppd/pengikut/(:num)/(:num)/add'] = 'sppd/add_pengikut';
$route['sppd/pengikut/proses'] = 'sppd/proses_pengikut';
$route['sppd/pengikut/(:num)/del/(:num)'] = 'sppd/del_pengikut';

$route['sppd/surat_pt/print/(:num)'] = 'cetak/surat_pt_print/$1';
$route['sppd/surat_sppd/print/(:num)'] = 'cetak/surat_sppd_print/$1';
$route['sppd/surat_pt_w/print/(:num)'] = 'cetak/surat_pt_print_word/$1';
$route['sppd/surat_sppd_w/print/(:num)'] = 'cetak/surat_sppd_print_word/$1';

$route['sppd/(:num)/ttd'] = 'sppd_lap/data_ttd';
$route['sppd/(:num)/ttd/add'] = 'sppd_lap/add_ttd';
$route['sppd/(:num)/ttd/edit/(:num)'] = 'sppd_lap/edit_ttd';
$route['sppd/ttd/proses'] = 'sppd_lap/proses_ttd';
$route['sppd/(:num)/ttd/del/(:num)'] = 'sppd_lap/del_ttd';

$route['sppd/(:num)/hal'] = 'sppd_lap/data_hal';
$route['sppd/(:num)/hal/add'] = 'sppd_lap/add_hal';
$route['sppd/(:num)/hal/edit/(:num)'] = 'sppd_lap/edit_hal';
$route['sppd/hal/proses'] = 'sppd_lap/proses_hal';
$route['sppd/(:num)/hal/del/(:num)'] = 'sppd_lap/del_hal';

$route['sppd/(:num)/pelpen'] = 'sppd_lap/data_pelpen';
$route['sppd/(:num)/pelpen/add'] = 'sppd_lap/add_pelpen';
$route['sppd/(:num)/pelpen/edit/(:num)'] = 'sppd_lap/edit_pelpen';
$route['sppd/pelpen/proses'] = 'sppd_lap/proses_pelpen';
$route['sppd/(:num)/pelpen/del/(:num)'] = 'sppd_lap/del_pelpen';

$route['sppd/report/(:num)/print'] = 'cetak/lap_hasil_print/$1';
$route['sppd/report_w/(:num)/print'] = 'cetak/lap_hasil_print_word/$1';