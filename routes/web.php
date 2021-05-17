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
    Route::get('/check_trainers', 'AdminController@showCheckTrainers')->name('check_trainers');
    Route::post('/trainer_request_count', 'AdminController@getCountTrainerRequest')->name('trainer_request_count');
    Route::post('/approve_trainer', 'AdminController@updateApproveTrainer')->name('approve_trainer');
    Route::post('/disapprove_trainer', 'AdminController@updateDisapproveTrainer')->name('disapprove_trainer');
    Route::get('/admin_home', 'AdminController@index')->name('admin_home');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
