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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('raffles/detail/{raffle}', 'RaffleController@detail')->name('raffles.detail');
Route::get('raffles/results', 'RaffleController@results')->name('raffles.results');

Route::get('cart/loadCart', 'CartController@loadCart')->name('cart.loadCart');
Route::post('cart/addToCart', 'CartController@addtoCart')->name('cart.addtoCart');
Route::post('cart/deleteItemCart', 'CartController@deleteItemCart')->name('cart.deleteItemCart');
Route::post('cart/resetCart', 'CartController@resetCart')->name('cart.resetCart');
Route::get('cart/preview', 'CartController@preview')->name('cart.preview');

Route::get('contact', 'ContactController@index')->name('contact.index');
Route::post('contact', 'ContactController@send')->name('contact.send');

// ADMINISTRATION PANEL
Route::group(['middleware' => ['auth']], function () {

    
    Route::resource('companies', 'CompanyController');
    Route::get('companies/status/{company}', 'CompanyController@status')->name('companies.status');

    Route::get('panel', 'PanelController@index')->name('panel.index');

    Route::resource('users', 'UserController')->except('show');
    Route::get('users/status/{user}', 'UserController@status')->name('users.status');
    Route::get('users/profile/{user}', 'UserController@profile')->name('users.profile');
    Route::post('users/updateProfile/{user}', 'UserController@updateProfile')->name('users.profile.update');

    Route::resource('raffles', 'RaffleController')->except(['destroy']);
    Route::delete('raffles/removeImage/{file}', 'RaffleController@removeImage')->name('raffles.removeImage');

    Route::resource('raffleTypes', 'RaffleTypeController')->except(['create', 'edit', 'show']);
    Route::get('raffleTypes/getType', 'RaffleTypeController@getType')->name('raffleTypes.getType');

    Route::resource('raffleCategories', 'RaffleCategoryController')->except(['create', 'edit', 'show']);
    Route::get('raffleCategories/getCategory', 'RaffleCategoryController@getCategory')->name('raffleCategories.getCategory');

    Route::get('faqs/manage', 'FaqController@manage')->name('faqs.manage');
    Route::resource('faqs', 'FaqController')->except(['index']);

    Route::resource('support', 'SupportController');

    /* REPORTES */
    Route::get('reports', 'ReportController@index')->name('reports.index');
    Route::get('reports/raffles', 'ReportController@raffles')->name('reports.raffles');
    Route::get('reports/raffle/{raffle}', 'ReportController@raffleDetail')->name('reports.raffleDetail');

});

Route::get('faqs', 'FaqController@index')->name('faqs.index'); // Se coloca aca para evitar error de ruta con 'faqs.manage'