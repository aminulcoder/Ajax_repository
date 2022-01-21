<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ajax', 'TeacherController@ajaxindex')->name('ajax.create');
Route::get('/teacher/all','TeacherController@allData')->name('allData');

Route::post('/teacher/store/','TeacherController@storeData')->name('storeData');
Route::get('/teacher/edit/{id}','TeacherController@editData')->name('editData');
Route::post('/teacher/update/{id}','TeacherController@updateData')->name('updateData');
Route::get('/teacher/destroy/{id}','TeacherController@deleteData')->name('deleteData');
