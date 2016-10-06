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

$app->get('/', function () use ($app) {
    return $app->version();
});

$api = app('Dingo\Api\Routing\Router');

// v1 version API
// choose version add this in header    Accept:application/vnd.lumen.v1+json

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Admin\V1',
    'middleware' => ['cors']
], function ($api) {

    // 登录
    $api->post('authorization', [
        'as' => 'auth.login',
        'uses' => 'AuthController@login',
    ]);
    // 注册
    $api->post('register', [
        'as' => 'users.store',
        'uses' => 'AuthController@register',
    ]);

    $api->group(['middleware' => 'api.auth'], function ($api) {

        //分类标签 ---start
        $api->get('metas/{type}/limit/{limit}', ['as' => 'meta.index','uses' => 'MetaController@index']);
        $api->get('metas/{type}/parent/{parent}', ['as' => 'meta.parent','uses' => 'MetaController@parent']);
        $api->post('metas/store', ['as' => 'meta.store','uses' => 'MetaController@store']);
        $api->delete('metas/{id}', ['as' => 'meta.destroy','uses' => 'MetaController@destroy']);
        $api->post('metaUpdate/{id}', ['as' => 'meta.update','uses' => 'MetaController@update']);
        $api->get('metaChild/{type}', ['as' => 'meta.child','uses' => 'MetaController@allCategory']);
        //分类标签 ---end

        //文章管理 ---start
        $api->get('contents/{limit}', ['uses' => 'ContentController@index']);
        $api->delete('contents/{id}', ['as' => 'contents.destroy','uses' => 'ContentController@destroy']);
        $api->post('contents/store', ['uses' => 'ContentController@store']);
        //文章管理 ---end

        //用户管理 ---start
        $api->get('users/{limit}', ['uses' => 'UserController@index']);
        //用户管理 ---end
    });

});


$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Client\V1',
    'middleware' => ['cors']
], function ($api) {

    //分类标签 ---start

    //分类标签 ---end

    //文章管理 ---start
    $api->get('articleList/{limit}', ['uses' => 'ArticleController@index']);
    //文章管理 ---end

    $api->group(['middleware' => 'api.auth'], function ($api) {

        //用户管理 ---start

        //用户管理 ---end
    });

});