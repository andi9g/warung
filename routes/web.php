<?php

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

Route::get('/', function () {
    return redirect('login');
});

Route::get("login", "Auth\LoginController@showLoginForm");
Route::post("login", "Auth\LoginController@login")->name("login");


Route::middleware(['auth'])->group(function () {
    //logout
    Route::post("logout", "Auth\LoginController@logout")->name("logout");

    Route::get('home', 'HomeController@index');
    Route::resource('pembelian', 'pembelianC');
    Route::post('ubah/pembelian', 'pembelianC@ubahjumlah')->name('ubah.jumlah');
    Route::post('barangkeluar', 'pembelianC@barangkeluar')->name('barang.keluar');
    
    Route::resource('penjualan', 'penjualanC');

    //laporan
    Route::get("barangmasuk", "laporanC@barangmasuk");
    Route::get("barangmasuk/cetak", "laporanC@cetakmasuk")->name("cetak.masuk");
    Route::get("barangkeluar", "laporanC@barangkeluar");
    Route::get("barangkeluar/cetak", "laporanC@cetakkeluar")->name("cetak.keluar");
});

Route::get('/', function(){
    return view('layouts.admin');
});

// Route::get('pdf', 'startController@pdf');

Route::get('siswa/export/', 'startController@export');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
