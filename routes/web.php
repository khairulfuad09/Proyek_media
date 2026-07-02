<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscoveryLearningController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/feedback', function () {
    return view('admin.feedback-guru');
});
Route::get('/waiting', function () {
    return view('waiting');
})->name('waiting');


Route::get('/LanjutPembelajaran', [App\Http\Controllers\ProgressSiswaController::class, 'index'])->name('last.progress.siswa');

Route::get('/Progress Siswa', [App\Http\Controllers\ProgressController::class, 'index'])->name('progress.siswa')->middleware('role:siswa');

Route::get('/admin/update-users', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.update-users');

Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'beranda'])->name('adminDanGuru.dashboard');

Route::get('/Discovery-Learning/{materi}/{tahap}', [DiscoveryLearningController::class, 'show'])->name('discovery.learning')->middleware('role:siswa');


Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::post('/admin/update-users/{id}', [App\Http\Controllers\AdminController::class, 'updateUserRole'])->name('admin.update-user-role');
Route::post('/simpan-jawaban', [App\Http\Controllers\JawabanSiswaController::class, 'store'])->name('jawaban.store')->middleware('auth');
Route::post('/simpan-feedback', [App\Http\Controllers\AdminController::class, 'simpanFeedbackDanNilai'])->name('feedback.simpan')->middleware('auth');