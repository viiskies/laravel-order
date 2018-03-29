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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('complete/{token}', 'UsersController@getToken')->name('complete.show');
Route::post('complete', 'UsersController@storePassword')->name('complete.store');

Route::middleware('auth')->group(function () {

    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::middleware('trackingUser')->group(function () {

        Route::middleware('role:admin')->group(function () {

            Route::post('products/import', 'ProductsImportController@import')->name('products.import');
            Route::get('products/import', 'ProductsImportController@importForm')->name('products.import.form');
            Route::get('products/import/log', 'ProductsImportController@showLog')->name('products.import.log');
            Route::post('products/import/log', 'ProductsImportController@filter')->name('products.import.filter');
            Route::get('cat/{id}', 'CategoriesController@show')->name('products.cat');
            Route::resource('publishers', 'PublishersController');
            Route::resource('platforms', 'PlatformController');
            Route::resource('countries', 'CountriesController');
            Route::resource('users', 'UsersController');
            Route::resource('categories', 'CategoriesController');
            Route::resource('products', 'ProductsController');

        });

        Route::get('/', 'HomeController@index')->name('home');
        Route::get('sort/', 'HomeController@sort')->name('home.sort');

        Route::get('chat', 'ChatsController@index')->name('chat.index');
        Route::get('chat/create', 'ChatsController@create')->name('chat.create');
        Route::post('chat/store', 'ChatsController@store')->name('chat.store');
        Route::get('chat/user', 'ChatsController@getUserChats')->name('chat.user');
        Route::get('chat/{chat}', 'ChatsController@show')->name('chat.show');
        Route::post('chat/store_message', 'ChatsController@storeMessage')->name('chat.store.message');
        Route::patch('chat/disable', 'ChatsController@disable')->name('chat.disable');
        Route::patch('chat/enable', 'ChatsController@enable')->name('chat.enable');

        Route::get('search/', 'SearchController@search')->name('products.search');
        Route::get('suggest/', 'SuggestionController@suggest')->name('products.suggest');

        Route::post('order/{id}', 'CartController@store')->name('order.store');
        Route::get('basket', 'CartController@index')->name('order.index');
        Route::post('cart', 'CartController@confirm')->name('cart.confirm');
        Route::get('orders', 'OrdersController@index')->name('order.orders');
        Route::get('order/{id}', 'OrdersController@show')->name('order.products');
        Route::put('order/{id}/action', 'OrdersController@action')->name('order.action');
        Route::get('order/invoice/{id}', 'OrdersController@download')->name('order.invoice.download');

        Route::post('update/{id}', 'CartController@update')->name('order.update');
        Route::delete('order/{id}', 'CartController@destroy')->name('order.product.delete');
        Route::delete('order', 'CartController@destroySelected')->name('order.product.del_selected');

        Route::get('special', 'SpecialOffersController@index')->name('special.index');
        Route::get('special/show/{id}', 'SpecialOffersController@show')->name('special.show');
        Route::post('special/store', 'SpecialOffersController@store')->name('special.store');
        Route::post('special/filter', 'SpecialOffersController@filter')->name('special.filter');
        Route::post('special/country', 'SpecialOffersController@getByCountry')->name('special.filter.country');
        Route::post('special/search', 'SpecialOffersController@search')->name('special.search');

        Route::post('update/{id}', 'CartController@update')->name('order.update');
        Route::delete('order/{id}', 'CartController@destroy')->name('order.product.delete');

        Route::get('contacts', 'HomeController@contacts')->name('pages.contacts');
        Route::get('export/{type}', 'OrderExportController@export')->name('export');
    });
});
