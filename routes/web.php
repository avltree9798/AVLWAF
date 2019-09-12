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
    return redirect('/dashboard');
});

Route::get('/register', 'UserController@create')->name('www.user.registration');
Route::post('/register', 'UserController@store')->name('www.user.store');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('www.user.do-login');
Route::group([
    'middleware'=>'auth'
], function(){
    Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('/custom-rules', 'RuleController@index')->name('rules');
    Route::get('/custom-rules/create', 'RuleController@create')->name('rules.create');
    Route::post('/custom-rules/create', 'RuleController@store')->name('rules.store');
    Route::get('/custom-rules/edit/{id}', 'RuleController@edit')->name('rules.edit');
    Route::post('/custom-rules/edit/{id}', 'RuleController@update')->name('rules.update');
    Route::get('/custom-rules/delete/{id}', 'RuleController@destroy')->name('rules.delete');
    Route::get('/blacklist', 'BlacklistController@index')->name('blacklist');
    Route::get('/blacklist/create', 'BlacklistController@create')->name('blacklist.create');
    Route::post('/blacklist/create', 'BlacklistController@store')->name('blacklist.store');
    Route::get('/blacklist/delete/{id}', 'BlacklistController@destroy')->name('blacklist.delete');
    Route::get('/billing', 'UserController@billing')->name('billing');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('/profile', 'UserController@updateProfile')->name('profile.update');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});