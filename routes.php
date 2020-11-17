<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'prefix' => 'feedback',
    'namespace' => 'Qihucms\Feedback\Controllers\Api',
    'middleware' => ['api'],
    'as' => 'api.'
], function (Router $router) {
    $router->apiResource('feedbacks', 'FeedbackController');
});

// 后台管理
Route::group([
    'prefix' => config('admin.route.prefix') . '/feedback',
    'namespace' => 'Qihucms\Feedback\Controllers\Admin',
    'middleware' => config('admin.route.middleware'),
    'as' => 'admin.'
], function (Router $router) {
    $router->resource('feedbacks', 'FeedbackController');
});