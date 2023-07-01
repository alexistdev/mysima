<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,
UserController as UserAdmin,
CriteriaController as CriteriaAdmin,
MataPelajaran as MapelAdmin,
DosenController as DosenAdmin};



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
////    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
////    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
////    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
Route::group(['middleware' => ['web', 'auth', 'roles']], function () {
    Route::group(['roles' => 'admin'], function () {
        Route::get('/admin/dashboard', [DashAdmin::class, 'index'])->name('adm.dashboard');
        Route::get('/admin/users', [UserAdmin::class, 'index'])->name('adm.users');
        Route::get('/admin/dosen', [DosenAdmin::class, 'index'])->name('adm.dosen');
        Route::get('/admin/dosen/add', [DosenAdmin::class, 'create'])->name('adm.dosen.add');
        Route::post('/admin/dosen', [DosenAdmin::class, 'store'])->name('adm.dosen.save');

        Route::get('/admin/criteria', [CriteriaAdmin::class, 'index'])->name('adm.criteria');
        Route::get('/admin/mapel', [MapelAdmin::class, 'index'])->name('adm.mapel');
        Route::post('/admin/mapel', [MapelAdmin::class, 'store'])->name('adm.mapel.save');
        Route::patch('/admin/mapel', [MapelAdmin::class, 'update'])->name('adm.mapel.update');
    });
});

require __DIR__.'/auth.php';
