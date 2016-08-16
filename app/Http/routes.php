<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('app');
});

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {
    Route::resource('cliente', 'ClienteController', ['except' => ['create', 'edit']]);
    Route::resource('projetos', 'ProjetoController', ['except' => ['create', 'edit']]);

    Route::group(['prefix' => 'projeto'], function () {

        Route::get('{id}/nota', 'ProjetoNotaController@index');
        Route::post('{id}/nota', 'ProjetoNotaController@store');
        Route::get('{id}/nota/{notaId}', 'ProjetoNotaController@show');
        Route::put('{id}/nota/{notaId}', 'ProjetoNotaController@update');
        Route::delete('{id}/nota/{notaId}', 'ProjetoNotaController@destroy');

        Route::resource('{id}/task', 'ProjetoTaskController', ['except' => ['create', 'edit']]);

        Route::get('{id}/menbros', 'ProjetoController@menbros');
        Route::post('{id}/file', 'ProjetoFileController@store');

    });

    Route::get('user/authenticated', 'UserController@authenticated');
});

