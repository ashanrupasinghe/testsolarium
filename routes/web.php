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

Route::get('/ping', 'SolariumController@ping');
Route::get('/search', 'SolariumController@search');
Route::get('/create', 'SolariumController@create');
Route::get('/delete', 'SolariumController@delete');
Route::get('/facetfield', 'SolariumController@facetField');
Route::get('/extractPDF', 'SolariumController@fuck');
