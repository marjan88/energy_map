<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function() {
    Route::pattern('id', '[0-9]+');
    Route::pattern('id2', '[0-9]+');

    #Admin Dashboard
    Route::get('dashboard', 'DashboardController@index');


    #News
//    Route::get('news/data', 'ArticlesController@data');
    #Plant
    Route::get('anlagenregister', ['as' => 'anlagenregister', 'uses' => 'AnlagenregisterController@index']);
    Route::post('search/autocomplete', 'UserController@autocomplete');
    Route::get('search/anlagenregister', 'AnlagenregisterController@autocomplete');
    Route::post('search/anlagenregister', 'AnlagenregisterController@getResults');
    Route::get('anlagenregister/{id}/data', 'AnlagenregisterController@showData');
    Route::post('anlagenregister/create', 'AnlagenregisterController@postCreate');
    Route::get('anlagenregister/select-user', 'AnlagenregisterController@getCreate');
    Route::post('anlagenregister/store', 'AnlagenregisterController@store');

    #Users
    Route::get('users/', ['as' => 'users', 'uses' => 'UserController@index']);
    Route::get('users/create', ['as' => 'user.create', 'uses' => 'UserController@getCreate']);
    Route::post('users/create', 'UserController@postCreate');
    Route::get('users/{id}/edit', 'UserController@getEdit');
    Route::post('users/{id}/edit', 'UserController@postEdit');
    Route::get('users/{id}/delete', 'UserController@postDelete');
    Route::post('plant/delete', 'UserController@destroy');
    Route::get('users/data', 'UserController@data');

    #Contact
    Route::get('contact', ['as' => 'contact', 'uses' => 'ContactController@index']);
    Route::post('contact/create', ['as' => 'contact.create', 'uses' => 'ContactController@store']);

    #Settings
    Route::get('settings', ['as' => 'settings', 'uses' => 'SettingsController@index']);
    Route::post('settings', ['as' => 'post.settings', 'uses' => 'SettingsController@store']);
    Route::post('send-mail', 'SettingsController@postMail');
    Route::post('image', ['as' => 'post.image', 'uses' => 'SettingsController@storeImage']);

    #Roles
//    Route::get('roles/', 'Admin\RoleController@index');
//    Route::get('roles/create', 'Admin\RoleController@getCreate');
//    Route::post('roles/create', 'Admin\RoleController@postCreate');
//    Route::get('roles/{id}/edit', 'Admin\RoleController@getEdit');
//    Route::post('roles/{id}/edit', 'Admin\RoleController@postEdit');
//    Route::get('roles/{id}/delete', 'Admin\RoleController@getDelete');
//    Route::post('roles/{id}/delete', 'Admin\RoleController@postDelete');
//    Route::get('roles/data', 'Admin\RoleController@data');
});
