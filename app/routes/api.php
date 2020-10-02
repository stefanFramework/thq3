<?php

Route::group(['namespace' => 'Api\Controllers'], function () {
    Route::get('/example', [
        'as' => 'example',
        'uses' => 'ExampleController@example'
    ]);

    Route::get('/services', [
        'as' => 'services',
        'uses' => 'ServiceController@index'
    ]);
});
