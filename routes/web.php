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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@index')->name('home');
Route::get('/awardconfig', 'AwardConfigController@awardConfig')->name('awardconfig');
Route::post('/awardconfig', 'AwardConfigController@awardConfig')->name('awardconfig');
Route::get('/user', 'UserController@user')->name('user');
Route::post('/user', 'UserController@user')->name('user');
Route::get('/userinfo', 'UserController@userinfo')->name('userinfo');
Route::post('/userinfo', 'UserController@userinfo')->name('userinfo');
Route::get('/awardstream', 'AwardStreamController@awardstream')->name('awardstream');
Route::post('/awardstream', 'AwardStreamController@awardstream')->name('awardstream');
Route::get('/getUserAward', 'AwardStreamController@getUserAward')->name('getUserAward');
Route::get('/', 'HomeController@welcome')->name('welcome');
