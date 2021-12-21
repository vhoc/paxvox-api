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

$router->group(['middleware' => 'auth','prefix' => 'api'], function ($router) 
{
    $router->get('me', 'AuthController@me');
    $router->get('submissions', 'SubmissionController@index');
    $router->post('submissions', 'SubmissionController@store');
    $router->get('waiters/{id_location}', 'WaiterController@index');
    $router->post('waiters', 'WaiterController@store');
});

$router->group(['prefix' => 'api'], function () use ($router) 
{
   $router->post('register', 'AuthController@register');
   $router->post('login', 'AuthController@login');
   $router->get('validateToken', 'AuthController@validateToken');
   $router->post('reports/meseros', 'SubmissionChartController@meseros');
   $router->post('reports/frecuencia', 'SubmissionChartController@frecuencia_de_visita');
});