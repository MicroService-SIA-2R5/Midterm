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


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users',['uses' => 'StudentController@getUsers']);
});

$router->get('/users',['uses' => 'StudentController@getUsers']);
$router->post('/users',['uses' => 'StudentController@add']);
$router->put('/users/{id}', 'StudentController@update');
$router->delete('/users/{id}',['uses' => 'StudentController@deleteStudent']);
$router->get('/users/{id}', 'StudentController@show');