<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HomeController;

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

Auth::routes(['verify' => true]);
Route::get('/waiting_admin_approval', 'PageController@showWaitAdminApproval')->name('waiting_admin_approval');

Route::middleware('admin')->group(function () {
    Route::get('/admin_home', 'AdminController@index')->name('admin_home');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
