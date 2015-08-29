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

Route::get('/', ['middleware' => 'user', 'uses' => 'Auth\AuthController@getLogin']);

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'isAdmin'], 'namespace' => 'Users'], function() {
    Route::get('home', 'UserController@index');
    Route::get('home/data', 'UserController@getData');
    Route::get('profile', 'UserController@getEdit');
    Route::post('profile/{id}/edit', 'UserController@postEdit');


    #plant
//    Route::post('search/autocomplete', 'Users\UserController@autocomplete');
    Route::get('search/anlagenregister', 'AnlagenregisterController@autocomplete');
    Route::post('search/anlagenregister', 'AnlagenregisterController@getResults');
    Route::get('anlagenregister/{id}/data', 'AnlagenregisterController@showData');
    Route::post('anlagenregister/create', 'AnlagenregisterController@postCreate');
    Route::get('anlagenregister/confirm', 'AnlagenregisterController@getCreate');
    Route::post('anlagenregister/store', 'AnlagenregisterController@store');
    Route::get('anlagenregister', 'AnlagenregisterController@index');
    Route::get('anlagenregister/{id}/show', 'UserController@show');
    Route::get('delete/{id}', 'UserController@deletePlant');
    Route::get('pdf/{id}', 'DocumentController@createPdf');



    Route::get('contact', 'ContactController@index');
    Route::get('impressum', 'ContactController@impressum');
    Route::post('contact', ['as' => 'contact.send', 'uses' => 'ContactController@send']);

    Route::pattern('id', '[0-9]+');
});


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

if (Request::is('admin/*')) {
    require __DIR__ . '/admin_routes.php';
}
