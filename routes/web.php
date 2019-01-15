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

//Route::view('/', 'welcome');

Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/writer', 'Auth\LoginController@showWriterLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/', 'Auth\RegWriterController@showWriterRegisterForm');
Route::get('/complete/{id}', 'Auth\RegWriterController@completeRegisterationForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/writer', 'Auth\LoginController@writerLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/registerMember/writer', 'Auth\RegWriterController@createWriter');
Route::post('/complete', 'Auth\RegWriterController@completeRegisteration');
Route::match(['put', 'patch'], '/complete/{id}', 'Auth\RegWriterController@completeRegisteration')->name('completeRegistration');

Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin');
Route::view('/writer', 'writer');

//Callback Link
Route::get('/completeRegisteration/{$name}', 'HomeController@callbackLink');

//Testing
Route::get('/pay', function () {
    return view('/pay');
});

//Membership Registration
Route::get('/register/member', 'MemberController@showMemberRegisterForm');
Route::post('/register/member', 'MemberController@memberRegister');
Route::view('/register/member', 'member.register');
Route::view('/working', 'auth.completeRegisteration');

Route::get('/login/member', 'MemberController@showMemberLoginForm');
Route::post('/login/member', 'MemberController@memberLogin');

Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
