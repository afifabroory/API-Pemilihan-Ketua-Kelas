<?php

use App\Http\Controllers\VoterController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DataController;

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
    $router->get('/voter/verify', 'VoterController@verify');
    $router->post('/vote', 'VoterController@vote');
    $router->options('/vote', "VoterController@cors");

    $router->get('/candidate', 'CandidateController@index');

    $router->get('/voting/voter', 'DataController@voter');
    $router->get('/voting/result', 'DataController@result');
});