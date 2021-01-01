<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'namespace' => 'Qihucms\Feedback\Controllers\Api',
    'middleware' => ['api'],
    'as' => 'api.'
], function (Router $router) {
    $router->apiResource(config('qihu.feedback_prefix', 'feedback'), 'FeedbackController');
});

// 后台管理
Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => 'Qihucms\Feedback\Controllers\Admin',
    'middleware' => config('admin.route.middleware'),
    'as' => 'admin.'
], function (Router $router) {
    $router->resource('feedback', 'FeedbackController');
});