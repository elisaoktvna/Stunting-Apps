<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrtuApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaskesApiController;
use App\Http\Controllers\api\AnakApiController;
use App\Http\Controllers\DashboardApiController;
use App\Http\Controllers\KecamatanApiController;
use App\Http\Controllers\PaketGiziApiController;
use App\Http\Controllers\PengukuranApiController;
use App\Http\Controllers\TemplateEduAPiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/anak', [AnakApiController::class, 'index']);
Route::post('/anak', [AnakApiController::class, 'store']);
Route::get('/anak/{id}', [AnakApiController::class, 'show']);
Route::put('/anak/{id}', [AnakApiController::class, 'update']);
Route::delete('/anak/{id}', [AnakApiController::class, 'destroy']);

// login
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// ortu
Route::get('/ortu/{id}', [OrtuApiController::class, 'show']);
Route::put('/ortu/{id}', [OrtuApiController::class, 'update']);
Route::put('/ortu/{id}/update-password', [OrtuApiController::class, 'updatePassword']);


// kecamatan
Route::get('/kecamatan', [KecamatanApiController::class, 'index']);

// pengukuran
Route::get('/pengukuran', [PengukuranApiController::class, 'index']);
Route::post('/pengukuran', [PengukuranApiController::class, 'store']);

// edukasi
Route::get('/edukasi', [TemplateEduAPiController::class, 'getAll']);

// dashboard
Route::middleware('auth:sanctum')->get('/dashboard', [DashboardApiController::class, 'index']);

// paketgizi
Route::get('/paketgizi', [PaketGiziApiController::class, 'index']);

// faskes
Route::get('/faskes', [FaskesApiController::class, 'index']);



