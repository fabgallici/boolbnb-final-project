<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization,X-Requested-With');


//LOGIN ONLY
    Route::get('/login/{status}', 'Auth\LoginController@showLoginForm') -> name('bhootel.login');

//-----------------------------------------------------//


//GUEST AND USER
    Route::get('/', 'GuestController@index') -> name('all.index');

//-----------------------------------------------------//


//GUEST ROUTES
    //SOSTITUITA DA SEARCH ROUTES
    // Route::post('/search', 'GuestController@search') -> name('guest.search');

    Route::get('/apartment/{id}', 'GuestController@show') -> name('guest-apt.show');


//-----------------------------------------------------//
//SEARCH ROUTES
    Route::post('/show', 'SearchController@show') -> name('search.show');
    Route::post('/search', 'SearchController@search') -> name('search.search');
    Route::get('/search/configs', 'SearchController@getAllConfigs') ->name('search.config');
    // Route::get('/search/aptConfigs', 'SearchController@getAptConfig') ->name('search.apt-config');
    //new
    Route::get('/search/apartConfigs/{id}', 'SearchController@getApartConfigs') ->name('search.apart-config');

//-----------------------------------------------------//

///USERS UPR UPRA

Auth::routes();


//SOSTITUITA DA SEARCH ROUTES
// Route::post('/user/search', 'UserController@search') -> name('user.search');

Route::get('/user/apartment/{id}', 'UserController@show') -> name('user-apt.show');

Route::get('/user/edit-apt/{id}', 'UserController@edit') -> name('user-apt.edit');
// Route::post('/user/update-apt/{id}', 'UserController@update') -> name('user-apt.update'); ///what if
Route::post('/user/update-apt/', 'UserController@update') -> name('user-apt.update'); ///what if

Route::get('/user/create-apt', 'UserController@create') -> name('user-apt.create');
Route::post('/user/store', 'UserController@store') -> name('user.store');

Route::get('/user/destroy-apt', 'UserController@destroy') -> name('user-apt.destroy');

Route::get('/user/user-panel', 'UserController@userPanel') -> name('user.user-panel');

// Clear Session for Testing view count
Route::get('/clear', 'ClearSessionController@clearSession');

//braintree
//Route::post('/dropin/{id}','PaymentsController@pay')->name('dropin.payment');

Route::view('/hosted','hosted');
Route::get('/payment/make/{id}', 'PaymentsController@pay')->name('payment.pay');
Route::post('/payment/make/{id}{adId}', 'PaymentsController@make')->name('payment.make');

Route::get('/payment/sponsor/{id}', 'PaymentsController@sponsor')->name('sponsor.show');
// mail
Route::post('/mail-store', 'MessageController@store') ->name('mail-store');
Route::get('/mail-send/{id}', 'MessageController@sendMail') ->name('mail-send');



// charts
Route::get('/charts/{id}', 'StatController@charStat')-> name('charts');

// stats views
Route::get('/view-stat', 'StatController@viewStat') -> name('view-stat');
// stat msg
Route::get('/stat-msg', 'StatController@msgstat') -> name('stat-msg');
