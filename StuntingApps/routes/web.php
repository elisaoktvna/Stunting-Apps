<?php

use App\Models\PaketGizi;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaskesController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\PaketGiziController;
use App\Http\Controllers\PengukuranController;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\TemplateEdukasiController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\OrtuProfileController;

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

// routes/web.php

Route::get('/loginadmin', [AdminController::class, 'loginForm'])->name('loginadmin');
Route::post('/proseslogin', [AdminController::class, 'login']);
Route::get('/logout/user', [AdminController::class, 'logout'])->name('logout.user');

Route::get('/loginortu', [OrtuController::class, 'loginForm'])->name('loginortu');
Route::post('/prosesloginortu', [OrtuController::class, 'login']);
Route::get('/logout/ortu', [OrtuController::class, 'logout'])->name('logout.ortu');
Route::get('/signuportu', [OrtuController::class, 'signup'])->name('signuportu');
Route::post('/prosessignup', [OrtuController::class, 'prosessignup'])->name('prosessignup');

Route::get('/signup', function () {
    return view('signup'); // Replace with your actual login view file path
})->name('signup');


Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/paket', [LandingPageController::class, 'tampilpaket']);
Route::get('/faskeslengkap', [LandingPageController::class, 'tampilfaskeslengkap']);
Route::get('/edukasilengkap', [LandingPageController::class, 'edukasilengkap']);


Route::middleware(['user'])->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'filter']);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/addadmin', [AdminController::class, 'create']);
Route::post('/addadmincreate', [AdminController::class, 'store']);
Route::delete('/deleteadmin/{id}', [AdminController::class, 'destroy']);

Route::get('/ortu', [OrtuController::class, 'index']);
Route::get('/dataanak', [OrtuController::class, 'tampilanak']);
Route::get('/addortu', [OrtuController::class, 'create']);
Route::post('/addortucreate', [OrtuController::class, 'store']);
Route::get('/editortu/{id}', [OrtuController::class, 'edit']);
Route::put('/update/{id}', [OrtuController::class, 'update'])->name('update');



// route kecamatan
route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan.index');
route::get('/addkecamatan', [KecamatanController::class, 'create'])->name('kecamatan.create');
route::post('/addkecamatancreate', [KecamatanController::class, 'store'])->name('kecamatan.store');
route::get('/kecamatan/edit/{kecamatan}', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
route::put('/kecamatan/update/{kecamatan}', [KecamatanController::class, 'update'])->name('kecamatan.update');
route::delete('/kecamatan/delete{kecamatan}', [KecamatanController::class, 'destroy'])->name('kecamatan.destroy');


// route edukasi
Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi.index');
Route::get('/edukasi/create', [EdukasiController::class, 'create'])->name('edukasi.create'); // Menampilkan form tambah edukasi
Route::post('/edukasi', [EdukasiController::class, 'store'])->name('edukasi.store'); // Menyimpan data edukasi baru
Route::get('edukasi/edit/{id}', [EdukasiController::class, 'edit'])->name('edukasi.edit');
Route::put('edukasi/update/{id}', [EdukasiController::class, 'update'])->name('edukasi.update');
Route::delete('/edukasi/{id}', [EdukasiController::class, 'destroy'])->name('edukasi.destroy');

// route faskes
Route::get('/faskes', [FaskesController::class, 'index'])->name('faskes.index');
Route::get('/faskes/create', [FaskesController::class, 'create'])->name('faskes.create'); // Menampilkan form tambah edukasi
Route::post('/faskes', [FaskesController::class, 'store'])->name('faskes.store'); // Menyimpan data edukasi baru
Route::get('faskes/edit/{id}', [FaskesController::class, 'edit'])->name('faskes.edit');
Route::put('faskes/update/{id}', [FaskesController::class, 'update'])->name('faskes.update');
Route::delete('/faskes/{id}', [FaskesController::class, 'destroy'])->name('faskes.destroy');

// Route Paket Gizi
Route::get('/paketgizi', [PaketGiziController::class, 'index'])->name('paketgizi.index');
Route::get('/paketgizi/create', [PaketGiziController::class, 'create'])->name('paketgizi.create');
Route::post('/paketgizi', [PaketGiziController::class, 'store'])->name('paketgizi.store');
Route::get('/paketgizi/{id}/edit', [PaketGiziController::class, 'edit'])->name('paketgizi.edit');
Route::put('/paketgizi/{id}', [PaketGiziController::class, 'update'])->name('paketgizi.update');
Route::delete('/paketgizi/{id}', [PaketGiziController::class, 'destroy'])->name('paketgizi.destroy');

// route template edukasi
Route::get('/templateedukasi', [TemplateEdukasiController::class, 'index'])->name('templateedukasi.index');
Route::get('/templateedukasi/create', [TemplateEdukasiController::class, 'create'])->name('template_edukasi.create');
Route::post('/templateedukasi', [TemplateEdukasiController::class, 'store'])->name('template_edukasi.store');
Route::get('/templateedukasi/edit/{id}', [TemplateEdukasiController::class, 'edit'])->name('template_edukasi.edit');
Route::put('/templateedukasi/update/{id}', [TemplateEdukasiController::class, 'update'])->name('template_edukasi.update');
Route::delete('/templateedukasi/{id}', [TemplateEdukasiController::class, 'destroy'])->name('template_edukasi.destroy');

});

Route::middleware(['multiguard:web,ortu'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard-ortu', [DashboardController::class, 'dashboardOrtu'])->name('dashboard.ortu');

    // route anak
    Route::get('/anak', [AnakController::class, 'index'])->name('anak.index');
    Route::get('/addanak', [AnakController::class, 'create'])->name('anak.create');
    Route::post('/addanakcreate', [AnakController::class, 'store'])->name('anak.store');
    Route::get('/anak/edit/{anak}', [AnakController::class, 'edit'])->name('anak.edit');
    Route::put('/anak/update/{anak}', [AnakController::class, 'update'])->name('anak.update');
    Route::delete('/anak/delete/{anak}', [AnakController::class, 'destroy'])->name('anak.destroy');
    Route::patch('/anak/{anak}/verifikasi/{status}', [AnakController::class, 'verifikasi'])->name('anak.verifikasi');
    Route::get('/anak/{id}', [AnakController::class, 'show'])->name('anak.show');
    Route::get('/anak/{anak}/edukasi/{edukasi}', [AnakController::class, 'showEdukasi'])->name('anak.edukasi.show');


    Route::get('/pengukuran', [PengukuranController::class, 'index']);
    Route::get('/addpengukuran', [PengukuranController::class, 'create']);
    Route::get('/addpengukuran/{id}', [PengukuranController::class, 'createByOrtu'])->name('addpengukuran');;
    Route::post('/addpengukur', [PengukuranController::class, 'store']);
});

    //Profile
Route::middleware(['auth:web'])->get('/user/profile', [UserProfileController::class, 'index'])->name('user.profile');
Route::middleware(['auth:ortu'])->get('/ortu/profile', [OrtuProfileController::class, 'index'])->name('ortu.profile');



