<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,
UserController as UserAdmin,
CriteriaController as CriteriaAdmin,
MataPelajaran as MapelAdmin,
DosenController as DosenAdmin,
KelasController as KelasAdmin};

use App\Http\Controllers\Dosen\{DashboardController as DashDosen,
InputNilaiController as NilaiDosen};



//Route::get('/', function () {
//   redirect('/login','301');
//});
Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => ['web', 'auth', 'roles']], function () {
    Route::group(['roles' => 'admin'], function () {
        Route::get('/admin/dashboard', [DashAdmin::class, 'index'])->name('adm.dashboard');
        Route::get('/admin/mahasiswa', [UserAdmin::class, 'index'])->name('adm.mahasiswa');
        Route::post('/admin/mahasiswa', [UserAdmin::class, 'store'])->name('adm.mahasiswa.save');
        Route::patch('/admin/mahasiswa', [UserAdmin::class, 'update'])->name('adm.mahasiswa.update');
        Route::get('/admin/mahasiswa/add', [UserAdmin::class, 'create'])->name('adm.mahasiswa.add');
        Route::get('/admin/mahasiswa/{id}', [UserAdmin::class, 'edit'])->name('adm.mahasiswa.edit');
        Route::get('/admin/mahasiswa/detail/{id}', [UserAdmin::class, 'detail'])->name('adm.mahasiswa.detail');
        Route::post('/admin/mahasiswa/detail/{id}', [UserAdmin::class, 'matkul_add'])->name('adm.mahasiswa.matkul.add');

        Route::get('/admin/dosen', [DosenAdmin::class, 'index'])->name('adm.dosen');
        Route::get('/admin/dosen/add', [DosenAdmin::class, 'create'])->name('adm.dosen.add');
        Route::get('/admin/dosen/{id}', [DosenAdmin::class, 'edit'])->name('adm.dosen.edit');
        Route::post('/admin/dosen', [DosenAdmin::class, 'store'])->name('adm.dosen.save');
        Route::patch('/admin/dosen', [DosenAdmin::class, 'update'])->name('adm.dosen.update');
        Route::delete('/admin/dosen', [DosenAdmin::class, 'destroy'])->name('adm.dosen.delete');
        Route::get('/admin/dosen/detail/{id}', [DosenAdmin::class, 'detail'])->name('adm.dosen.detail');
        Route::post('/admin/dosen/detail/{id}', [DosenAdmin::class, 'matkul_add'])->name('adm.dosen.matkul.add');

        Route::get('/admin/criteria', [CriteriaAdmin::class, 'index'])->name('adm.criteria');
        Route::get('/admin/mapel', [MapelAdmin::class, 'index'])->name('adm.mapel');
        Route::post('/admin/mapel', [MapelAdmin::class, 'store'])->name('adm.mapel.save');
        Route::patch('/admin/mapel', [MapelAdmin::class, 'update'])->name('adm.mapel.update');
        Route::delete('/admin/mapel', [MapelAdmin::class, 'destroy'])->name('adm.mapel.delete');

        Route::get('/admin/kelas', [KelasAdmin::class, 'index'])->name('adm.kelas');
        Route::post('/admin/kelas', [KelasAdmin::class, 'store'])->name('adm.kelas.save');
        Route::get('/admin/{id}/kelas', [KelasAdmin::class, 'detail'])->name('adm.kelas.detail');
        Route::post('/admin/{id}/kelas', [KelasAdmin::class, 'tambah_data_siswa'])->name('adm.kelas.tambah_siswa');
        Route::delete('/admin/{id}/kelas', [KelasAdmin::class, 'lepas_data_siswa'])->name('adm.kelas.lepas_siswa');

        /** ajax */
        Route::get('/admin/ajax/matkul', [UserAdmin::class, 'getDataMatkul'])->name('ajax.datamatkul');
        Route::get('/admin/ajax/sks', [UserAdmin::class, 'getDataSKS'])->name('ajax.sks');
        Route::get('/admin/ajax/get_siswa_kelas', [KelasAdmin::class, 'getDataMahasiswa'])->name('ajax.getsiswakelas');
        Route::get('/admin/ajax/get_siswa_non_kelas', [KelasAdmin::class, 'getDataMahasiswaNonKelas'])->name('ajax.getsiswanonkelas');
        Route::post('/admin/ajax/bayar', [UserAdmin::class, 'isbayar'])->name('ajax.isbayar');
    });

    Route::group(['roles' => 'dosen'], function () {
        Route::get('/staff/dashboard', [DashDosen::class, 'index'])->name('dosen.dashboard');
        Route::get('/staff/nilai', [NilaiDosen::class, 'index'])->name('dosen.nilai');
        Route::post('/staff/nilai', [NilaiDosen::class, 'store'])->name('dosen.nilai.save');
    });
});

require __DIR__.'/auth.php';
