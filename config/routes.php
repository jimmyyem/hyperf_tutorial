<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

//// user相关
//Router::addGroup('/user', function () {
//    Router::get('/index', 'App\Controller\UserController@index');
//    Router::get('/detail', 'App\Controller\UserController@detail');
//    //Router::get('/user/create', 'App\Controller\UserController@create');
//    Router::post('/store', 'App\Controller\UserController@store');
//    Router::put('/update', 'App\Controller\UserController@update');
//    Router::delete('/delete', 'App\Controller\UserController@delete');
//});


Router::get('/favicon.ico', function () {
    return '';
});


// 单路由使用中间件
Router::get('/api/v1/co', function() {
    return 'api/v1/co';
}, ['middleware' => [
    \App\Middleware\CheckBody::class
]]);

// 路由组使用中间件
Router::addGroup('/api/v2', function () {
    Router::get('/chan', function(){
        return 'api/v2/chan';
    });
}, ['middleware' => [
    \App\Middleware\CheckBody::class
]]);