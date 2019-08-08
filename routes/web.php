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

Route::get('/', function () {
    return view('welcome');
});
  

Auth::routes();

// Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@index')->name('register');
//Route::post('register', 'Auth\RegisterController@register')->name('register');

// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset'); 



Route::get('/home', 'HomeController@index')->name('home');

Route::resource('department', 'DepartmentController');
Route::resource('category', 'CategoryController');

Route::resource('publicholiday', 'PublicHolidayController');

Route::resource('profile', 'ProfileController');

Route::resource('users', 'UsersController');

Route::resource('leave', 'LeaveController');
Route::get('leave', 'LeaveController@index')->name('leave.index');
Route::get('leave/create', 'LeaveController@create')->name('leave.create');
Route::post('leave', 'LeaveController@store')->name('leave.store');
Route::get('leave/{leave}/edit', 'LeaveController@edit')->name('leave.edit');
Route::patch('leave/{leave}', 'LeaveController@update')->name('leave.update');
Route::get('leave.approval', 'LeaveController@approval')->name('leave.approval');
Route::get('leave.leaveSummary', 'LeaveController@leaveSummary')->name('leave.leaveSummary');
Route::put('leave/{leave}', 'LeaveController@approveleave')->name('leave.approveleave');
Route::get('leave.staffleaveentry', 'LeaveController@staffleaveentry')->name('staffleaveentry');
//Route::put('leave/{leave}', 'LeaveController@chgstatus')->name('leave.chgstatus');


// get user individual leave entries and summary by admin

Route::get('leave.getUser', 'LeaveController@getUser')->name('leave.getUser');
Route::get('leave/staffhistory/{id}', 'LeaveController@staffhistory')->name('leave.staffhistory');
Route::get('leave/staffsummary/{id}', 'LeaveController@staffsummary')->name('leave.staffsummary');
Route::get('leave.allUsersum', 'LeaveController@allUsersum')->name('leave.allUsersum');
Route::get('leave.allUsersumAp', 'LeaveController@allUsersumAp')->name('leave.allUsersumAp');