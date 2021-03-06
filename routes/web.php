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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/goods/index', 'GoodsController@index');
$router->get('/shopCart/getCartSumCount', 'ShopCartController@getCartSumCount');
$router->group(['middleware' => 'login'], function() use($router) {
    $router->post('/shopCart/addCartGoods', 'ShopCartController@addCartGoods');
});

$router->post('/login/doLogin', 'LoginController@doLogin');
$router->post('/login/logout', 'LoginController@logout');
