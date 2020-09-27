<?php

Route::group(['namespace' => 'Api\Controllers'], function () {
    Route::get('/example', [
        'as' => 'example', 
        'uses' => 'ExampleController@example'
    ]);
});
