<?php

// laravel演示部分
Route::get('/', 'TasksController@index');

Route::resource('tasks', 'TasksController');  // 生成任务资源路由
Route::get('/about', 'AboutController@index');

// angular演示部分
Route::get('/angular', 'AngularController@index');
Route::group(['prefix' => 'api'], function () {
    Route::resource('tasks', 'Api\TasksController');
});