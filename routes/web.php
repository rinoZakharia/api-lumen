<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
$router->get('order', ['uses' => 'OrderController@index']);
$router->post('api/login', 'LoginController@login');
$router->post('api/register', 'LoginController@register');
$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    $router->get('kategori', ['uses' => 'KategoriController@index']);
    $router->get('kategori/{id}', ['uses' => 'KategoriController@show']);
    $router->post('kategori', ['uses' => 'KategoriController@store']);
    $router->delete('kategori/{id}', ['uses' => 'KategoriController@destroy']);
    $router->post('kategori/{id}', ['uses' => 'KategoriController@update']);

    $router->get('pelanggan', ['uses' => 'PelangganController@index']);
    $router->get('pelanggan/{id}', ['uses' => 'PelangganController@show']);
    $router->post('pelanggan', ['uses' => 'PelangganController@store']);
    $router->delete('pelanggan/{id}', ['uses' => 'PelangganController@destroy']);
    $router->post('pelanggan/{id}', ['uses' => 'PelangganController@update']);

    $router->get('menu', ['uses' => 'MenuController@index']);
    $router->get('menu/{id}', ['uses' => 'MenuController@show']);
    $router->post('menu', ['uses' => 'MenuController@store']);
    $router->delete('menu/{id}', ['uses' => 'MenuController@destroy']);
    $router->post('menu/{id}', ['uses' => 'MenuController@update']);

    $router->get('order', ['uses' => 'OrderController@index']);
    $router->post('order/{id}', ['uses' => 'OrderController@update']);
});
