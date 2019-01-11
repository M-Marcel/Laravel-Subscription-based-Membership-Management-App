<?php

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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/writer', 'Auth\LoginController@showWriterLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/writer', 'Auth\RegisterController@showWriterRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/writer', 'Auth\LoginController@writerLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/writer', 'Auth\RegisterController@createWriter');

Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin');
Route::view('/writer', 'writer');

//Callback Link
Route::get('/completeRegisteration/{$name}', 'HomeController@callbackLink');

//Testing
// Route::get('/working', function () {
//     return view('/working');
// });

//Membership Registration
Route::get('/register/member', 'MemberController@showMemberRegisterForm');
Route::post('/register/member', 'MemberController@memberRegister');
Route::view('/register/member', 'member.register');
Route::view('/working', 'working');

Route::get('/login/member', 'MemberController@showMemberLoginForm');
Route::post('/login/member', 'MemberController@memberLogin');
