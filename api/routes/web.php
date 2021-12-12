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

$router->group(['middleware' => 'auth'], function () use ($router){
    // $router->get('/', function () use ($router) {
    //     return $router->app->version();
    // });
    $router->post('/createUser', ['uses' => "UsersController@createUser"]);
    $router->post('/loginUser', ['uses' => "UsersController@loginUser"]);
    //$router->get('/routesUser', ['uses' => "RoutesController@getRoutesForUser"]);
    $router->get('/routes', ['uses' => "RoutesController@getRoutes"]);
    $router->get('/stations', ['uses' => "StationsController@fetchStations"]);
    $router->get('/stationSchedule', ['uses' => "StationsController@fetchStationSchedule"]);
    $router->post('/complaint', ['uses' => "ComplaintsController@addComplaint"]);
});

$router->group(['middleware' => 'auth', 'prefix' => 'admin'], function () use ($router){
    $router->post('/login', ['uses' => "AdminUsersController@login"]);
    $router->post('/addRoute', ['uses' => "RoutesController@addRoute"]);
    $router->get('/routes', ['uses' => "RoutesController@getRoutes"]);
    $router->post('/addStation', ['uses' => "StationsController@addStations"]);
    $router->get('/stations', ['uses' => "StationsController@fetchStations"]);
    $router->get('/stationSchedule', ['uses' => "StationsController@fetchStationSchedule"]);
    $router->post('/stationSchedule', ['uses' => "StationsController@addStationSchedule"]);
});