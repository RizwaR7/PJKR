<?php

use App\Http\Controllers\AdmBannerController;
use App\Http\Controllers\AdmDirektoriController;
use App\Http\Controllers\AdmLogoController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\DosenSiterController;
use App\Http\Controllers\AdmMultimediaController;
use App\Http\Controllers\AdmUserController;
use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DosenProdiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiAgenda;
use App\Http\Controllers\InformasiArtikel;
use App\Http\Controllers\InformasiBeritaController;
use App\Http\Controllers\KategoriBeritaController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\AdmDosenController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\ProfilSejarahController;
use App\Http\Controllers\ProfilVisiMisiController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\AdmLoginController;
use App\Http\Controllers\AdmSliderController;
use App\Http\Controllers\RedirectToController;
use App\Http\Controllers\DetailBeritaController;
use App\Http\Controllers\DetailHalamanController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DetailAgendaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\AdmDashboard;
use App\Http\Controllers\AdmKelolaVideo;
use App\Http\Controllers\AdmStrukturOrganisasiController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DetailArtikelController;
use App\Http\Controllers\DetailPengumumanController;
use App\Http\Controllers\DetailProfilAkreditasiController;
use App\Http\Controllers\DetailProfilVisiMisiController;
use App\Http\Controllers\DetailProfilSejarahController;
use App\Http\Controllers\DetailStrukturOrganisasiController;
use App\Http\Controllers\PengumumanControllerClient;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

/* Admin Controller */

// Route::group(['middleware' => ['auth', 'cek_login']], function () {
// });

/* Public Controller */

Route::resource('/', HomeController::class);
Route::get('/masuk-admin', function () {
    if (auth()->check()) {
        return redirect('redirect');
    }
    return view('admin_side.pages.admin_login.login');
})->name('masuk_admin');

Route::group(['middleware' => ['auth', 'check.prodi']], function () {
    Route::resource('/admin', AdmDashboard::class)->except('show', 'edit', 'update', 'destroy')->names('admin_dashboard');
    Route::get('/redirect', [RedirectToController::class, 'cek']);
    // Route::resource('admin/footer', FooterController::class)->names('admin_footer');
    Route::resource('footer', FooterController::class);
    Route::resource('dosensiter', DosenSiterController::class);
    Route::resource('admin/menu', MenusController::class)->names('admin_menu');
    Route::resource('admin/menu/sub_menu/{id}', SubMenuController::class)->except('show', 'edit', 'update', 'destroy')->names('sub_menu');
    Route::resource('admin/kategori-berita', KategoriBeritaController::class)->names('admin_kategori_berita');
    Route::resource('admin/profil/visi-misi', ProfilVisiMisiController::class)->names('profil_visi_misi');
    Route::resource('admin/profil/sejarah', ProfilSejarahController::class)->names('profil_sejarah');
    Route::resource('admin/profil/akreditasi', AkreditasiController::class)->names('profil_akreditasi');
    Route::resource('admin/profil/dosen', AdmDosenController::class)->names('profil_dosen');
    Route::resource('admin/profil/struktur-organisasi', AdmStrukturOrganisasiController::class)->names('profil_struktur_organisasi');
    Route::delete('admin/profil/dosen/{id}', [AdmDosenController::class, 'destroy'])->name('profil_dosen.destroy');

    // Route::delete('admin/profil/dosen/{id}', [AdmDosenController::class, 'destroy'])->name('profil_dosen.destroy');
    // Route::put('admin/profil/dosen/{id}', [AdmDosenController::class, 'update'])->name('profil_dosen.update');

    Route::resource('admin/profil/pimpinan', PimpinanController::class)->names('profil_pimpinan');
    Route::resource('admin/informasi/pengumuman', PengumumanController::class)->names('informasi_pengumuman');
    Route::resource('admin/informasi/halaman', HalamanController::class)->names('informasi_halaman');
    Route::resource('admin/informasi/berita', InformasiBeritaController::class)->names('informasi_berita');
    Route::resource('admin/informasi/artikel', InformasiArtikel::class)->names('informasi_artikel');
    Route::resource('admin/informasi/agenda', InformasiAgenda::class)->names('informasi_agenda');
    Route::resource('admin/dosen-prodi', DosenProdiController::class)->names('dosen_prodi');
    Route::resource('admin/multimedia', AdmMultimediaController::class)->names('multimedia');
    Route::resource('admin/banner', AdmBannerController::class)->names('banner');
    Route::resource('admin/logo', AdmLogoController::class)->names('logo');
    Route::resource('admin/multimedia/direktori/{dir}', AdmDirektoriController::class)->except('show', 'edit', 'update', 'destroy')->names('direktori');
    Route::resource('admin/user', AdmUserController::class)->names('user');
    Route::resource('admin/slider', AdmSliderController::class)->names('slider');
    Route::resource('admin/kelola-video', AdmKelolaVideo::class)->names('kelola_video');
});

Route::resource('/berita', BeritaController::class)->names('berita')->except('show', 'edit', 'update', 'destroy')->names('berita');
Route::resource('/pengumuman', PengumumanControllerClient::class)->except('show', 'edit', 'update', 'destroy')->names('pengumuman');
Route::resource('/artikel', ArtikelController::class)->except('show', 'edit', 'update', 'destroy')->names('artikel');
Route::post('/masuk-admin/validation', [AdmLoginController::class, 'login'])->name('login_admin');
Route::post('/masuk-admin/logout', [AdmLoginController::class, 'logout'])->name('logout_admin');
Route::resource('/berita/detail/{id}', DetailBeritaController::class)->except('show', 'edit', 'update', 'destroy')->names('detail_berita');
Route::resource('/artikel/detail/{id}', DetailArtikelController::class)->except('show', 'edit', 'update', 'destroy')->names('detail_artikel');
Route::resource('/pengumuman/detail/{id}', DetailPengumumanController::class)->except('show', 'edit', 'update', 'destroy')->names('detail_pengumuman');
Route::resource('/halaman/detail/{id}', DetailHalamanController::class)->except('show', 'edit', 'update', 'destroy')->names('detail_halaman');
Route::resource('/agenda', AgendaController::class)->except('show', 'edit', 'update', 'destroy')->names('agenda');
Route::resource('/agenda/detail/{id}', DetailAgendaController::class)->except('show', 'edit', 'update', 'destroy')->names('detail_agenda');
Route::resource('/dosen', DosenController::class)->except('show', 'edit', 'update', 'destroy')->names('dosen');
Route::resource('/profil/visi-misi', DetailProfilVisiMisiController::class)->except('show', 'edit', 'update', 'destroy')->names('detail_visimisi');
Route::resource('/profil/sejarah', DetailProfilSejarahController::class)->except('show', 'edit', 'update', 'destroy')->names('detail_sejarah');
Route::resource('/profil/akreditasi', DetailProfilAkreditasiController::class)->except('show', 'edit', 'update', 'destroy')->names('detail_sejarah');
Route::get('/profil/struktur-organisasi', [DetailStrukturOrganisasiController::class, 'index'])->name('detail_struktur_organisasi');
