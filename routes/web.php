<?php

use App\Http\Controllers\LaporanpraktikController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\OrientasiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UnivController;
use App\Http\Controllers\FakulController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TingkatpendidikanController;
use App\Http\Controllers\UploadevaluasidokterpendidikController;
use App\Http\Controllers\UploadevaluasikinerjadokterController;
use App\Http\Controllers\UploadevaluasipenyelenggaraanController;
use App\Http\Controllers\UploadkepuasanController;
use App\Http\Controllers\UploadkepuasanpasienController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IhtController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\TnaController;
use App\Http\Controllers\JplController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IhtController::class, 'indexDashboard'], function () {
    return view('home');
});

Route::get('/home', [IhtController::class, 'indexDashboard'])->name('home')->middleware('auth');

Route::middleware('auth')->group(function(){
    Route::post('orientasis/downloadorientasipdf', [OrientasiController::class, 'downloadorientasipdf'])->name('downloadorientasipdf');
    Route::post('mahasiswas/downloadmahasiswapdf', [MahasiswaController::class, 'downloadmahasiswapdf'])->name('downloadmahasiswapdf');
    Route::get('mahasiswas/excelmahasiswa', [MahasiswaController::class, 'excelmahasiswa'])->name('excelmahasiswa');
    Route::get('mahasiswas/cetakmahasiswa', [MahasiswaController::class, 'cetakmahasiswa'])->name('cetakmahasiswa');
    Route::post('laporanpraktiks/cetaklaporanpraktik', [LaporanpraktikController::class, 'cetaklaporanpraktik'])->name('cetaklaporanpraktik');
    Route::get('orientasis/cetakorientasi', [OrientasiController::class, 'cetakorientasi'])->name('cetakorientasi');
    Route::resource('users', UserController::class);
    Route::resource('laporanpraktiks', LaporanpraktikController::class);
    Route::resource('mahasiswas', MahasiswaController::class);
    Route::resource('univs', UnivController::class);
    Route::resource('fakuls', FakulController::class);
    Route::resource('jurusans', JurusanController::class);
    Route::resource('prodis', ProdiController::class);
    Route::resource('tingkatpendidikans', TingkatpendidikanController::class);
    Route::resource('ruangans', RuanganController::class);
    Route::resource('uploadkepuasan', UploadkepuasanController::class);
    Route::resource('uploadevaluasipenyelenggaraan', UploadevaluasipenyelenggaraanController::class);
    Route::resource('uploadkepuasanpasien', UploadkepuasanpasienController::class);
    Route::resource('uploadevaluasikinerjadokter', UploadevaluasikinerjadokterController::class);
    Route::resource('uploadevaluasidokterpendidik', UploadevaluasidokterpendidikController::class);
    Route::resource('orientasis', OrientasiController::class);

    //route all iht
    Route::resource('/iht', IhtController::class);

    //route to ihtDetail
    Route::get('/iht/{iht}', [IhtController::class, 'show'])->name('iht.show');
    //route input detail
    Route::post('/addDetail', [IhtController::class, 'storeDetail'])->name('iht.storeDetail');
    //route edit detail
    Route::patch('/editDetail', [IhtController::class, 'updateDetail'])->name('iht.updateDetail');
    //route delete detail
    Route::delete('/deleteDetail/{detailIht}', [IhtController::class, 'destroyDetail'])->name('iht.destroyDetail');

    //route to ihtDetailPeserta
    Route::get('/iht/{id}/{detail_id}', [IhtController::class, 'showPeserta'])->name('iht.showPeserta');
    //route input peserta
    Route::post('/addPeserta', [IhtController::class, 'storePeserta'])->name('iht.storePeserta');
    //route input narasumber
    Route::post('/addNarasumber', [IhtController::class, 'storeNarasumber'])->name('iht.storeNarasumber');
    //route edit peserta
    Route::patch('/editPeserta', [IhtController::class, 'updatePeserta'])->name('iht.updatePeserta');
    //route edit narasumber
    Route::patch('/editNarasumber', [IhtController::class, 'updateNarasumber'])->name('iht.updateNarasumber');
    // //route delete peserta
    Route::delete('/deletePeserta/{pesertaIht}', [IhtController::class, 'destroyPeserta'])->name('iht.destroyPeserta');
    // //route delete peserta
    Route::delete('/deleteNarasumber/{narasumberIht}', [IhtController::class, 'destroyNarasumber'])->name('iht.destroyNarasumber');

    //route jpl
    Route::get('/jpls/createJpl', [JplController::class, 'createUtama'])->name('jpls.createUtama');
    Route::post('/jpls/storeJpl', [JplController::class, 'storeUtama'])->name('jpls.storeUtama');
    Route::delete('/jpls/deleteJpl/{jplUtama}', [JplController::class, 'destroyUtama'])->name('jpls.destroyUtama');
    Route::get('/jpls/editJpl/{jplUtama}', [JplController::class, 'editUtama'])->name('jpls.editUtama');
    Route::patch('/jpls/updateJpl/{jplUtama}', [JplController::class, 'updateUtama'])->name('jpls.updateUtama');
    Route::get('jpls/{jplUtama}', [JplController::class, 'showDetail'])->name('jpls.showDetail');
    Route::get('/jpls/{jplUtama}/create', [JplController::class, 'create'])->name('jpls.createJpl');
    Route::get('/jpls/{jplUtama}/{jpl}', [JplController::class, 'showDetailJpl'])->name('jpls.showDetailJpl');
    Route::post('/jpls/{jplUtama}/store', [JplController::class, 'store'])->name('jpls.store');
    Route::delete('/jpls/{jplUtama}/destroy/{jpl}', [JplController::class, 'destroy'])->name('jpls.destroy');
    Route::get('/jpls/{jplUtama}/edit/{jpl}', [JplController::class, 'edit'])->name('jpls.edit');
    Route::patch('/jpls/update/{jpl}', [JplController::class, 'update'])->name('jpls.update');

    Route::resource('/jpls', JplController::class);

    Route::post('/get_fields', [JplController::class, 'getAllFields'])->name('get.all.fields');

    //route tna utama
    Route::get('/tnas/createTna', [TnaController::class, 'createUtama'])->name('tnas.createUtama');
    Route::post('/tnas/storeTna', [TnaController::class, 'storeUtama'])->name('tnas.storeUtama');
    Route::delete('/tnas/deleteTna/{tnaUtama}', [TnaController::class, 'destroyUtama'])->name('tnas.destroyUtama');
    Route::get('/tnas/editTna/{tnaUtama}', [TnaController::class, 'editUtama'])->name('tnas.editUtama');
    Route::patch('/tnas/updateTna/{tnaUtama}', [TnaController::class, 'updateUtama'])->name('tnas.updateUtama');
    Route::get('/tnas/{tnaUtama}', [TnaController::class, 'show'])->name('tnas.show');
    Route::get('/tnas/{tnaUtama}/create', [TnaController::class, 'create'])->name('tnas.createTna');
    Route::post('/tnas/{tnaUtama}/store', [TnaController::class, 'store'])->name('tnas.store');
    Route::delete('/tnas/{tnaUtama}/destroy/{tna}', [TnaController::class, 'destroy'])->name('tnas.destroy');
    Route::get('/tnas/{tnaUtama}/edit/{tna}', [TnaController::class, 'edit'])->name('tnas.edit');
    Route::patch('/tnas/update/{tna}', [TnaController::class, 'update'])->name('tnas.update');

    Route::resource('tnas', TnaController::class);
    //route input peserta
    Route::post('/get_fields', [TnaController::class, 'getAllFields'])->name('get.all.fields');

    //route pegawai
    Route::resource('pegawais', PegawaiController::class);


    //route cetak pdf
    Route::get('/filterPelatihan', [IhtController::class, 'filterPelatihan'])->name('filterPelatihan');
    Route::get('/cetakPelatihan', [IhtController::class, 'cetakPelatihan'])->name('cetakPelatihan');
    Route::get('/cetakDetail/{iht}', [IhtController::class, 'cetakDetail'])->name('cetakDetail');
    Route::get('/cetakPeserta/{iht}/{detail_id}', [IhtController::class, 'cetakPeserta'])->name('cetakPeserta');
    Route::get('/cetakTna/{tnaUtama}', [TnaController::class, 'cetakTna'])->name('cetakTna');
    Route::get('/cetakPegawai', [PegawaiController::class, 'cetakPegawai'])->name('cetakPegawai');
    Route::get('/cetakJpl/{jplUtama}', [JplController::class, 'cetakJpl'])->name('cetakJpl');
    Route::get('/cetakDetail/{jplUtama}/{jpl}', [JplController::class, 'cetakDetail'])->name('cetakDetail');

    //route cetak excel
    Route::get('/excelPelatihan', [IhtController::class, 'excelPelatihan'])->name('excelPelatihan');
    Route::get('/excelDetail/{iht}', [IhtController::class, 'excelDetail'])->name('excelDetail');
    Route::get('/excelPeserta/{detail_id}', [IhtController::class, 'excelPeserta'])->name('excelPeserta');
    Route::get('/excelPegawai', [PegawaiController::class, 'excelPegawai'])->name('excelPegawai');
    Route::get('/excelTna/{tnaUtama}', [TnaController::class, 'excelTna'])->name('excelTna');
    Route::get('/excelJpl/{jplUtama}', [JplController::class, 'excelJpl'])->name('excelJpl');
    Route::get('/excelDetailJpl/{jplUtama}/{pegawai_id}', [JplController::class, 'excelDetailJpl'])->name('excelDetailJpl');
    Route::get('/excelOrientasi', [OrientasiController::class, 'excelOrientasi'])->name('excelOrientasi');
    Route::get('/excelMahasiswa', [MahasiswaController::class, 'excelMahasiswa'])->name('excelMahasiswa');
    Route::get('/excelLaporan', [LaporanpraktikController::class, 'excelLaporan'])->name('excelLaporan');
});


Auth::routes();
