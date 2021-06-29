<?php
use App\Http\Controllers\HomeController;
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
    return view('welcome');
});
Route::resource('products','ProductController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/upload-form', function() {return view('upload-form');});
Route::post('/upload-file',  '\App\Http\Controllers\HomeController@upload' );
Route::get('/unduh-gambar/{path}', [ HomeController::class, 'unduh' ]);
Route::get('/cetak-laporan','ProductController@cetak')->name('cetak-laporan');