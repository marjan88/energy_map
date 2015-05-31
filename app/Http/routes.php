<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', 'Auth\AuthController@getLogin');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::get('home', 'Users\UserController@index');
    Route::get('home/data', 'Users\UserController@getData');
    Route::get('profile', 'Users\UserController@getEdit');
    Route::post('profile/{id}/edit', 'Users\UserController@postEdit');
    Route::get('anlagenregister', 'Users\AnlagenregisterController@index');
    Route::get('anlagenregister/{id}/show', 'Users\UserController@show');
    Route::get('delete/{id}', 'Users\UserController@deletePlant');

    #plant
//    Route::post('search/autocomplete', 'Users\UserController@autocomplete');
    Route::get('search/anlagenregister', 'Users\AnlagenregisterController@autocomplete');
    Route::post('search/anlagenregister', 'Users\AnlagenregisterController@getResults');
    Route::get('anlagenregister/{id}/data', 'Users\AnlagenregisterController@showData');
    Route::post('anlagenregister/create', 'Users\AnlagenregisterController@postCreate');
    Route::get('anlagenregister/confirm', 'Users\AnlagenregisterController@getCreate');
    Route::post('anlagenregister/store', 'Users\AnlagenregisterController@store');


    Route::get('about', 'PagesController@about');
    Route::get('contact', 'PagesController@contact');

    Route::pattern('id', '[0-9]+');
});


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

if (Request::is('admin/*')) {
    require __DIR__ . '/admin_routes.php';
}
