<?php

use App\Models\Langganan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\Master2Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', [DashboardController::class, 'index'])->name('home');



Auth::routes();

Route::get('add-to-log', [HomeController::class, 'myTestAddToLog']);

Route::get('form_register', [RegisterController::class, 'form_register'])->name('form_register');
Route::post('get_Kabupaten', [PemesananController::class, 'getKabupaten'])->name('getKabupaten');
Route::post('get_Kecamatan', [PemesananController::class, 'getKecamatan'])->name('getKecamatan');
Route::post('get_Desa', [PemesananController::class, 'getDesa'])->name('getDesa');
Route::post('get_turunan', [PemesananController::class, 'get_turunan'])->name('getTurunan');
Route::post('get_bts', [PemesananController::class, 'get_bts'])->name('getBts');

Route::post('get_Kabupatencv/{id_profil}', [MasterController::class, 'getKabupatencv'])->name('getKabupatencv');
Route::post('get_Kecamatancv/{id_profil}', [MasterController::class, 'getKecamatancv'])->name('getKecamatancv');
Route::post('get_Desacv/{id_profil}', [MasterController::class, 'getDesacv'])->name('getDesacv');

Route::post('get_Kabupatenedit/{idlang}', [PemesananController::class, 'getKabupatenedit'])->name('getKabupatenedit');
Route::post('get_Kecamatanedit/{idlang}', [PemesananController::class, 'getKecamatanedit'])->name('getKecamatanedit');
Route::post('get_Desaedit/{idlang}', [PemesananController::class, 'getDesaedit'])->name('getDesaedit');
Route::post('get_turunanedit/{idlang}', [PemesananController::class, 'get_turunanedit'])->name('getTurunanedit');
Route::post('get_bts/{idlang}', [PemesananController::class, 'get_btsedit'])->name('getBtsedit');

Route::post('get_Kabupatenlok/{idlok}', [Master2Controller::class, 'getKabupatenlok'])->name('getKabupatenlok');
Route::post('get_Kecamatanlok/{idlok}', [Master2Controller::class, 'getKecamatanlok'])->name('getKecamatanlok');
Route::post('get_Desalok/{idlok}', [Master2Controller::class, 'getDesalok'])->name('getDesalok');

Route::group(['middleware'=>['userRole','auth']],function (){
    Route::get('edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('update-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('change-password', [ProfileController::class, 'edit_pass'])->name('change.password');
    Route::post('update-password', [ProfileController::class, 'changePassword'])->name('password.update');
});

Route::group(['prefix'=>'admin','middleware'=>['userRole','auth']],function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('export_filter', [DashboardController::class, 'export_filter'])->name('admin.exportfilter');
    Route::post('export_semua', [DashboardController::class, 'export_semua'])->name('admin.exportsemua');
    Route::post('get_ainv', [DashboardController::class, 'get_ainv'])->name('ainv');
    Route::post('get_binv', [DashboardController::class, 'get_binv'])->name('binv');
    Route::get('coba', [MasterController::class, 'coba'])->name('admin.coba');
    Route::get('map_lang', [MasterController::class, 'map_lang'])->name('admin.maplang');
    Route::get('count', [MasterController::class, 'count_notif'])->name('admin.countnotif');
    Route::get('msgnotif', [MasterController::class, 'msg_notif'])->name('admin.msgnotif');
    Route::get('logActivity', [HomeController::class,'logActivity'])->name('admin.actlog');
    //kelola profilcv
    Route::get('profilcv', [MasterController::class, 'profilcv'])->name('admin.profilcv');
    Route::post('editlogo', [MasterController::class, 'editlogo'])->name('admin.editlogo');
    Route::get('{id_profil}/editcv', [MasterController::class, 'edit_cv'])->name('admin.editcv');
    Route::post('posteditcv/', [MasterController::class, 'post_edit_cv'])->name('admin.posteditcv');
//    Kelola User
   Route::get('data_user', [UserController::class, 'data_user'])->name('admin.user');
    Route::get('data_pelanggan_aktif', [UserController::class, 'pelanggan_aktif'])->name('admin.pelangganaktif');
    // Route::get('data_pelanggan_aktif/filter', [UserController::class, 'pelanggan_aktif_filter'])->name('admin.pelangganaktif');
    Route::get('detail_pelanggan', [UserController::class, 'detail_pelanggan'])->name('admin.detailpelanggan');
    Route::get('change_ppn', [UserController::class, 'change_ppn'])->name('admin.changeppn');
    Route::get('selectallppn', [UserController::class, 'selectallppn'])->name('admin.selectallppn');
   Route::get('tambahuser', [UserController::class, 'tambah_user'])->name('admin.tambahuser');
   Route::post('postuser', [UserController::class, 'post_tambah_user'])->name('admin.postuser');
//    Route::get('{id_status}/pelanggan', [UserController::class, 'filter_pelanggan'])->name('admin.filter_pelanggan');
    Route::get('{id_user}/edituser', [UserController::class, 'edit_user'])->name('admin.edituser');
    Route::get('{id_pelanggan}/nonaktif_pelanggan', [UserController::class, 'nonaktif_pelanggan'])->name('admin.nonaktif_pelanggan');
    Route::put('postedituser/{id_user}', [UserController::class, 'post_edit_user'])->name('admin.postedituser');
    Route::get('printpel/{id_user}', [UserController::class, 'export'])->name('admin.printpel');
//    Route::delete('delete_user/{id_user}', [UserController::class, 'destroy'])->name('admin.deleteuser');
    //    Kelola layanan
    Route::get('data_layanan', [LayananController::class, 'index_layanan'])->name('admin.layanan');
    Route::get('tambahlayanan', [LayananController::class, 'tambah_layanan'])->name('admin.tambahlayanan');
    Route::post('postlayanan', [LayananController::class, 'post_tambah_layanan'])->name('admin.postlayanan');
    Route::get('{id_layanan}/editlayanan', [LayananController::class, 'edit_layanan'])->name('admin.editlayanan');
    Route::put('posteditlayanan/{id_layanan}', [LayananController::class, 'post_edit_layanan'])->name('admin.posteditlayanan');
    Route::get('nonaktif_layanan/{id_layanan}', [LayananController::class, 'nonaktif_layanan'])->name('admin.nonaktiflayanan');
    Route::get('aktif_layanan/{id_layanan}', [LayananController::class, 'aktif_layanan'])->name('admin.aktiflayanan');
    Route::delete('delete_layanan/{id_layanan}', [LayananController::class, 'destroy'])->name('admin.deletelayanan');
    // kelola ppn
    Route::get('data_ppn', [MasterController::class, 'ppn_index'])->name('admin.ppn');
    Route::get('tambahppn', [MasterController::class, 'tambah_ppn'])->name('admin.tambahppn');
    Route::post('postppn', [MasterController::class, 'post_tambah_ppn'])->name('admin.postppn');
    Route::get('{id_ppn}/editppn', [MasterController::class, 'edit_ppn'])->name('admin.editppn');
    Route::put('posteditppn/{id_ppn}', [MasterController::class, 'post_edit_ppn'])->name('admin.posteditppn');
    // kelola master lokasi
    Route::get('data_lokasi', [Master2Controller::class, 'lokasi_index'])->name('admin.lokasi');
    Route::get('tambahlokasi', [Master2Controller::class, 'tambah_lokasi'])->name('admin.tambahlokasi');
    Route::post('postlokasi', [Master2Controller::class, 'post_tambah_lokasi'])->name('admin.postlokasi');
    Route::get('{id_lokasi}/editlokasi', [Master2Controller::class, 'edit_lokasi'])->name('admin.editlokasi');
    Route::post('posteditlokasi', [Master2Controller::class, 'post_edit_lokasi'])->name('admin.posteditlokasi');
    // kelola master bts
    Route::get('data_bts', [Master2Controller::class, 'bts_index'])->name('admin.bts');
    Route::get('tambahbts', [Master2Controller::class, 'tambah_bts'])->name('admin.tambahbts');
    Route::post('postbts', [Master2Controller::class, 'post_tambah_bts'])->name('admin.postbts');
    Route::get('{id_bts}/editbts', [Master2Controller::class, 'edit_bts'])->name('admin.editbts');
    Route::put('posteditbts/{id_bts}', [Master2Controller::class, 'post_edit_bts'])->name('admin.posteditbts');
    Route::get('nonaktif_bts/{id_bts}', [Master2Controller::class, 'nonaktif_bts'])->name('admin.nonaktifbts');
    Route::get('aktif_bts/{id_bts}', [Master2Controller::class, 'aktif_bts'])->name('admin.aktifbts');
    // kelola frek
    Route::get('data_frek', [Master2Controller::class, 'frek_index'])->name('admin.frek');
    Route::get('tambahfrek', [Master2Controller::class, 'tambah_frek'])->name('admin.tambahfrek');
    Route::post('postfrek', [Master2Controller::class, 'post_tambah_frek'])->name('admin.postfrek');
    Route::get('{id_frek}/editfrek', [Master2Controller::class, 'edit_frek'])->name('admin.editfrek');
    Route::put('posteditfrek/{id_frek}', [Master2Controller::class, 'post_edit_frek'])->name('admin.posteditfrek');
    // kelola jenis
    Route::get('data_jenis', [Master2Controller::class, 'jenis_index'])->name('admin.jenis');
    Route::get('tambahjenis', [Master2Controller::class, 'tambah_jenis'])->name('admin.tambahjenis');
    Route::post('postjenis', [Master2Controller::class, 'post_tambah_jenis'])->name('admin.postjenis');
    Route::get('{id_jenis}/editjenis', [Master2Controller::class, 'edit_jenis'])->name('admin.editjenis');
    Route::put('posteditjenis/{id_jenis}', [Master2Controller::class, 'post_edit_jenis'])->name('admin.posteditjenis');
    // kelola metode
    Route::get('data_metode', [Master2Controller::class, 'metode_index'])->name('admin.metode');
    Route::get('tambahmetode', [Master2Controller::class, 'tambah_metode'])->name('admin.tambahmetode');
    Route::post('postmetode', [Master2Controller::class, 'post_tambah_metode'])->name('admin.postmetode');
    Route::get('{id_metode}/editmetode', [Master2Controller::class, 'edit_metode'])->name('admin.editmetode');
    Route::put('posteditmetode/{id_metode}', [Master2Controller::class, 'post_edit_metode'])->name('admin.posteditmetode');
    // kelola bank
    Route::get('data_bank', [Master2Controller::class, 'bank_index'])->name('admin.bank');
    Route::get('tambahbank', [Master2Controller::class, 'tambah_bank'])->name('admin.tambahbank');
    Route::post('postbank', [Master2Controller::class, 'post_tambah_bank'])->name('admin.postbank');
    Route::get('{id_bank}/editbank', [Master2Controller::class, 'edit_bank'])->name('admin.editbank');
    Route::put('posteditbank/{id_bank}', [Master2Controller::class, 'post_edit_bank'])->name('admin.posteditbank');
    // kelola langganan
    Route::get('data_langganan', [LanggananController::class, 'langganan_index'])->name('admin.langganan');
    Route::get('edit_langganan/{id_langganan}', [PemesananController::class, 'edit_langganan'])->name('admin.edit_langganan');
    Route::post('postedit_langganan', [PemesananController::class, 'postedit_langganan'])->name('admin.postedit_langganan');
    Route::get('setujui/{id_user}', [PemesananController::class, 'setujui_pesan'])->name('admin.approvepelanggan');
    Route::post('postsetujui', [PemesananController::class, 'post_setujui_pesan'])->name('admin.postapprove');
    Route::get('tolak/{id_langganan}', [PemesananController::class, 'tolak_langganan'])->name('admin.rejectlangganan');
    Route::get('nonaktif/{id_langganan}', [PemesananController::class, 'nonaktif_langganan'])->name('admin.nonaktif_langganan');
    Route::get('{id_user}/tambah', [PemesananController::class, 'form_lama'])->name('admin.form_lama');
    Route::delete('delete_langganan/{id_langganan}', [LayananController::class, 'destroy_lang'])->name('admin.deletelangganan');
    //pemesanan
    Route::get('pemesanan', [PemesananController::class, 'pemesanan'])->name('admin.form_pemesanan');
    Route::post('postpemesanan', [PemesananController::class, 'pelanggan_lama'])->name('pelanggan_lama');
    Route::post('postpemesanan2', [PemesananController::class, 'pelanggan_baru'])->name('pelanggan_baru');
    Route::post('postpemesanan3', [PemesananController::class, 'pelanggan_onprogress'])->name('pelanggan_onprogress');
    //kelola invoice
    Route::get('data_invoice', [InvoiceController::class, 'data_invoice'])->name('admin.invoice');
    Route::post('export2', [InvoiceController::class, 'export'])->name('admin.export2');
    Route::post('kirim_semua', [InvoiceController::class, 'kirim_balik'])->name('admin.kirimsemua');
    Route::post('setujui_manual/{id_invoice}', [InvoiceController::class, 'setujui_manual'])->name('admin.setujuimanual');
    Route::get('setujui_pembayaran/{id_invoice}', [InvoiceController::class, 'setujui_pembayaran'])->name('admin.approvepembayaran');
    Route::get('tolak_pembayaran/{id_invoice}', [InvoiceController::class, 'tolak_pembayaran'])->name('admin.tolakpembayaran');
    Route::get('setujui_klaim/{id_inv}', [InvoiceController::class, 'approve_klaim'])->name('admin.approveklaim');
    Route::get('print/{id_invoice}', [InvoiceController::class, 'print_invoice'])->name('admin.printinv');
        // pengelolaan user
    Route::get('users', [AdminController::class, 'data_user']);
    Route::get('user/{user_id}/update', [UserController::class, 'edit_users']);
    Route::put('user/{user_id}/update', [UserController::class, 'post_edit_users']);
    Route::get('user/{user_id}/delete', [UserController::class, 'destroy']);
    Route::get('user/{user_id}/update-role', [UserController::class, 'edit_users_role']);
    Route::put('user/{user_id}/update-role', [UserController::class, 'updateRole']);
});

Route::group(['prefix'=>'teknisi','middleware'=>['userRole','auth']],function (){
    
    // Route::get('dashboard', [DashboardController::class, 'index'])->name('teknisi.dashboard');
    Route::get('map_lang', [MasterController::class, 'teknisi_map_lang'])->name('teknisi.dashboard');
    Route::get('data_layanan', [LayananController::class, 'index_layanan'])->name('teknisi.layanan');
    //    kelola invoice
    Route::get('data_invoice', [InvoiceController::class, 'data_invoice'])->name('teknisi.invoice');
    Route::get('invoice_belum_kirim', [InvoiceController::class, 'invoice_belumkirim'])->name('teknisi.inv_belumkirim');
    Route::get('invoice_melebihi_batas', [InvoiceController::class, 'invoice_melebihibatas'])->name('teknisi.inv_melebihibatas');
    Route::get('invoice_menunggu_bayar', [InvoiceController::class, 'invoice_menunggu'])->name('teknisi.inv_menunggu');
    Route::get('invoice_lunas', [InvoiceController::class, 'invoice_lunas'])->name('teknisi.inv_lunas');
    Route::get('invoice_batal', [InvoiceController::class, 'invoice_batal'])->name('teknisi.inv_batal');
//    Route::get('kirim_invoice/{id_invoice}', [LanggananController::class, 'kirim_invoice'])->name('teknisi.kiriminvoice');
    Route::get('setujui_pembayaran/{id_invoice}', [InvoiceController::class, 'setujui_pembayaran'])->name('teknisi.approvepembayaran');
    Route::get('tolak_pembayaran/{id_invoice}', [InvoiceController::class, 'tolak_pembayaran'])->name('teknisi.tolakpembayaran');
    Route::get('print/{id_invoice}', [InvoiceController::class, 'print_invoice'])->name('teknisi.printinv');
// kelola data user
    Route::get('user', [UserController::class, 'data_user'])->name('teknisi.user');
    Route::get('user/{user_id}/update', [UserController::class, 'teknisi_data_user'])->name('teknisi.getedituser');
    Route::put('user/{user_id}/update', [UserController::class, 'post_teknisi_edit_user']);
    Route::get('user/{user_id}/delete', [UserController::class, 'destroy']);
    Route::get('tambahuser', [UserController::class, 'teknisi_tambah_user'])->name('teknisi.tambahuser');
    // kelola master lokasi
    Route::get('data_lokasi', [Master2Controller::class, 'teknisi_lokasi_index'])->name('teknisi.lokasi');
    Route::get('tambahlokasi', [Master2Controller::class, 'teknisi_tambah_lokasi'])->name('teknisi.tambahlokasi');
    Route::post('postlokasi', [Master2Controller::class, 'teknisi_post_tambah_lokasi'])->name('teknisi.postlokasi');
    Route::get('{id_lokasi}/editlokasi', [Master2Controller::class, 'teknisi_edit_lokasi'])->name('teknisi.editlokasi');
    Route::post('posteditlokasi', [Master2Controller::class, 'teknisi_post_edit_lokasi'])->name('teknisi.posteditlokasi');
    // kelola Master Mikrotik
    Route::get('data_mastermikrotik', [Master2Controller::class, 'mastermikrotik_index'])->name('teknisi.mastermikrotik');
    Route::get('tambahmastermikrotik', [Master2Controller::class, 'tambah_master_mikrotik'])->name('teknisi.tambahmastermikrotik');
    Route::post('postmastermikrotik', [Master2Controller::class, 'post_tambah_mastermikrotik'])->name('teknisi.postmastermikrotik');
    Route::get('{id_mastermikrotik}/edit_mastermikrotik', [Master2Controller::class, 'edit_mastermikrotik'])->name('teknisi.editmastermikrotik');
    Route::put('posteditmastermikrotik/{id_master}', [Master2Controller::class, 'post_edit_mastermikrotik'])->name('teknisi.posteditmastermikrotik');
    // pelanggan aktif
    Route::get('data_langganan', [LanggananController::class, 'teknisi_langganan_index'])->name('teknisi.langganan');
    Route::get('data_pelanggan_aktif', [UserController::class, 'teknisi_pelanggan_aktif'])->name('teknisi.pelangganaktif');
    Route::get('change_ppn', [UserController::class, 'change_ppn'])->name('teknisi.changeppn');
    Route::get('selectallppn', [UserController::class, 'teknisi_selectallppn'])->name('teknisi.selectallppn');
    Route::get('printpel/{id_user}', [UserController::class, 'teknisi_export'])->name('teknisi.printpel');
    // Route::get('{id_user}/tambah', [PemesananController::class, 'teknisi_form_lama'])->name('teknisi.form_lama');
    // Route::get('{id_user}/edituser', [UserController::class, 'edit_user'])->name('teknisi.edituser');
    Route::get('{id_pelanggan}/nonaktif_pelanggan', [UserController::class, 'teknisi_nonaktif_pelanggan'])->name('teknisi.nonaktif_pelanggan');
    Route::get('setujui/{id_user}', [PemesananController::class, 'setujui_pesan'])->name('tekinsi.approvepelanggan');
    // Route::post('postsetujui', [PemesananController::class, 'post_setujui_pesan'])->name('tekinsi.postapprove');
    // Route::get('tolak/{id_langganan}', [PemesananController::class, 'tolak_langganan'])->name('tekinsi.rejectlangganan');
    Route::post('kirim_semua', [InvoiceController::class, 'teknisi_kirim_balik'])->name('teknisi.kirimsemua');
    
    // kelola master bts
    Route::get('data_bts', [Master2Controller::class, 'teknisi_bts_index'])->name('teknisi.bts');
    Route::get('tambahbts', [Master2Controller::class, 'teknisi_tambah_bts'])->name('teknisi.tambahbts');
    Route::get('posttambahbts', [Master2Controller::class, 'teknisi_post_tambah_bts'])->name('teknisi.posttambahbts');
    Route::get('{id_bts}/editbts', [Master2Controller::class, 'teknisi_edit_bts'])->name('teknisi.editbts');
    Route::put('posteditbts/{id_bts}', [Master2Controller::class, 'teknisi_post_edit_bts'])->name('teknisi.posteditbts');
    Route::put('posteditbts/{id_bts}', [Master2Controller::class, 'teknisi_post_edit_bts'])->name('teknisi.posteditbts');
    Route::get('nonaktif_bts/{id_bts}', [Master2Controller::class, 'teknisi_nonaktif_bts'])->name('teknisi.nonaktifbts');
    Route::get('aktif_bts/{id_bts}', [Master2Controller::class, 'teknisi_aktif_bts'])->name('teknisi.aktifbts');
    Route::get('getloginbts', [TestingController::class, 'loginwb'])->name('teknisi.getloginbts');
    Route::post('postloginbts', [TestingController::class, 'submitlogin'])->name('teknisi.postloginbts');
    Route::get('{id_bts}/editloginbts', [TestingController::class, 'logineditmk'])->name('teknisi.geteditloginbts');
    Route::post('editloginbts/{id_bts}', [TestingController::class, 'submitloginedit'])->name('teknisi.editloginbts');
    Route::post('posteditloginbts/{id_bts}', [TestingController::class, 'teknisi_post_edit_mikrotik_bts'])->name('teknisi.posteditloginbts');
    Route::get('testing', [TestingController::class, 'index'])->name('teknisi.testing');

// kelola langganan
    Route::get('data_langganan', [LanggananController::class, 'semua_langganan'])->name('teknisi.langganan');
    Route::get('langganan_baru', [LanggananController::class, 'langganan_baru'])->name('teknisi.langgananbaru');
    Route::get('langganan_setuju', [LanggananController::class, 'langganan_setuju'])->name('teknisi.langganansetuju');
    Route::get('langganan_menunggu', [LanggananController::class, 'langganan_menunggu'])->name('teknisi.langgananmenunggu');
    Route::get('langganan_batal', [LanggananController::class, 'langganan_batal'])->name('teknisi.langgananbatal');
    Route::get('langganan_aktif', [LanggananController::class, 'langganan_aktif'])->name('teknisi.langgananaktif');
    Route::get('langganan_kadaluarsa', [LanggananController::class, 'langganan_kadaluarsa'])->name('teknisi.langganankadaluarsa');
});

Route::group(['prefix'=>'pelanggan','middleware'=>['userRole','auth']],function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('pelanggan.dashboard');
    //langganan
    Route::get('data_langganan', [UserController::class, 'semua_langganan'])->name('pelanggan.langganan');
    //invoice
    Route::get('data_invoice', [InvoiceController::class, 'data_invoice'])->name('pelanggan.invoice');
    Route::post('bukti/{id_inv}', [InvoiceController::class, 'bukti'])->name('pelanggan.bukti');
    Route::get('print/{id_invoice}', [InvoiceController::class, 'print_invoice'])->name('pelanggan.printinv');
    Route::get('ajukan_klaim/{id_inv}', [InvoiceController::class, 'klaim'])->name('pelanggan.klaim');
});

Route::group(['prefix'=>'keuangan','middleware'=>['userRole','auth']],function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('keuangan.dashboard');
    Route::post('export_filter', [DashboardController::class, 'keuangan_export_filter'])->name('keuangan.exportfilter');
    Route::post('export_semua', [DashboardController::class, 'keuangan_export_semua'])->name('keuangan.exportsemua');
    Route::post('get_ainv', [DashboardController::class, 'keuangan_get_ainv'])->name('ainv');
    Route::post('get_binv', [DashboardController::class, 'keuangan_get_binv'])->name('binv');
    Route::get('coba', [MasterController::class, 'keuangan_coba'])->name('keuangan.coba');
    // Route::get('map_lang', [MasterController::class, 'map_lang'])->name('keuangan.maplang');
    Route::get('count', [MasterController::class, 'keuangan_count_notif'])->name('keuangan.countnotif');
    Route::get('msgnotif', [MasterController::class, 'keuangan_msg_notif'])->name('keuangan.msgnotif');
    Route::get('logActivity', [HomeController::class,'keuangan_logActivity'])->name('keuangan.actlog');
    //kelola profilcv
    // pelanggan aktif
    Route::get('data_langganan', [LanggananController::class, 'keuangan_langganan_index'])->name('keuangan.langganan');
    Route::get('data_pelanggan_aktif', [UserController::class, 'keuangan_pelanggan_aktif'])->name('keuangan.pelangganaktif');
    // Route::get('{id_user}/tambah', [PemesananController::class, 'keuangan_form_lama'])->name('keuangan.form_lama');
    Route::get('{id_user}/edituser', [UserController::class, 'keuangan_edit_user'])->name('keuangan.edituser');
    Route::put('postedituser/{id_user}', [UserController::class, 'keuangan_post_edit_user'])->name('keuangan.postedituser');
    Route::get('{id_pelanggan}/nonaktif_pelanggan', [UserController::class, 'keuangan_nonaktif_pelanggan'])->name('keuangan.nonaktif_pelanggan');
    Route::get('printpel/{id_user}', [UserController::class, 'keuangan_export'])->name('keuangan.printpel');
    Route::get('change_ppn', [UserController::class, 'keuangan_change_ppn'])->name('keuangan.changeppn');
    Route::get('selectallppn', [UserController::class, 'keuangan_selectallppn'])->name('keuangan.selectallppn');
    // Route::get('edit_langganan/{id_langganan}', [PemesananController::class, 'edit_langganan'])->name('keuangan.edit_langganan');
    Route::post('kirim_semua', [InvoiceController::class, 'keuangan_kirim_balik'])->name('keuangan.kirimsemua');
    
    // Invoice keuangan
    Route::get('data_invoice', [InvoiceController::class, 'data_invoice'])->name('keuangan.invoice');
    Route::get('invoice_belum_kirim', [InvoiceController::class, 'invoice_belumkirim'])->name('keuangan.inv_belumkirim');
    Route::get('invoice_melebihi_batas', [InvoiceController::class, 'invoice_melebihibatas'])->name('keuangan.inv_melebihibatas');
    Route::get('invoice_menunggu_bayar', [InvoiceController::class, 'invoice_menunggu'])->name('keuangan.inv_menunggu');
    Route::get('invoice_lunas', [InvoiceController::class, 'invoice_lunas'])->name('keuangan.inv_lunas');
    Route::get('invoice_batal', [InvoiceController::class, 'invoice_batal'])->name('keuangan.inv_batal');
    // kelola bank
    Route::get('data_bank', [Master2Controller::class, 'keuangan_bank_index'])->name('keuangan.bank');
    Route::get('tambahbank', [Master2Controller::class, 'keuangan_tambah_bank'])->name('keuangan.tambahbank');
    Route::post('postbank', [Master2Controller::class, 'keuangan_post_tambah_bank'])->name('keuangan.postbank');
    Route::get('{id_bank}/editbank', [Master2Controller::class, 'keuangan_edit_bank'])->name('keuangan.editbank');
    Route::put('posteditbank/{id_bank}', [Master2Controller::class, 'keuangan_post_edit_bank'])->name('keuangan.posteditbank');
    // kelola ppn
    Route::get('data_ppn', [MasterController::class, 'keuangan_ppn_index'])->name('keuangan.ppn');
    Route::get('tambahppn', [MasterController::class, 'keuangan_tambah_ppn'])->name('keuangan.tambahppn');
    Route::post('postppn', [MasterController::class, 'keuangan_post_tambah_ppn'])->name('keuangan.postppn');
    Route::get('{id_ppn}/editppn', [MasterController::class, 'keuangan_edit_ppn'])->name('keuangan.editppn');
    Route::put('posteditppn/{id_ppn}', [MasterController::class, 'keuangan_post_edit_ppn'])->name('keuangan.posteditppn');
    //kelola invoice
    Route::get('data_invoice', [InvoiceController::class, 'data_invoice'])->name('keuangan.invoice');
    Route::post('export2', [InvoiceController::class, 'export'])->name('keuangan.export2');
    Route::post('kirim_semua', [InvoiceController::class, 'kirim_balik'])->name('keuangan.kirimsemua');
    Route::post('setujui_manual/{id_invoice}', [InvoiceController::class, 'keuangan_setujui_manual'])->name('keuangan.setujuimanual');
    Route::get('setujui_pembayaran/{id_invoice}', [InvoiceController::class, 'keuangan_setujui_pembayaran'])->name('keuangan.approvepembayaran');
    Route::get('tolak_pembayaran/{id_invoice}', [InvoiceController::class, 'keuangan_tolak_pembayaran'])->name('keuangan.tolakpembayaran');
    Route::get('setujui_klaim/{id_inv}', [InvoiceController::class, 'approve_klaim'])->name('keuangan.approveklaim');
    Route::get('print/{id_invoice}', [InvoiceController::class, 'print_invoice'])->name('keuangan.printinv');
});

