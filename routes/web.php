<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

Route::get('authors', 'AuthorController@index');
Route::post('authors', 'AuthorController@store');
Route::get('authors/{author}', 'AuthorController@show');
Route::put('authors/{author}', 'AuthorController@update');
Route::patch('authors/{author}', 'AuthorController@update');
Route::delete('authors/{author}', 'AuthorController@destroy');