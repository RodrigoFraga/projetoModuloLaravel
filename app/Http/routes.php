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

Route::post('auth/authenticate', 'AuthenticateController@authenticate');
Route::post('auth/register', 'AuthenticateController@register');

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {
    Route::resource('cliente', 'ClienteController', ['except' => ['create', 'edit']]);
    Route::get('projetos/menbro', 'ProjetoController@findWithMenber');
    Route::resource('projetos', 'ProjetoController', ['except' => ['create', 'edit']]);
    Route::resource('projetos.menbro', 'ProjetoMenbroController', ['except' => ['create', 'edit', 'update']]);

    Route::group(['middleware' => 'check.projeto.permission', 'prefix' => 'projeto'], function () {

        Route::resource('{id}/nota', 'ProjetoNotaController', ['except' => ['create', 'edit']]);

        Route::resource('{id}/task', 'ProjetoTaskController', ['except' => ['create', 'edit']]);

        Route::get('{id}/menbros', 'ProjetoController@menbros');

        Route::get('{id}/file/{fileId}/download', 'ProjetoFileController@showFile');
        Route::resource('{id}/file', 'ProjetoFileController', ['except' => ['create', 'edit']]);

    });

    Route::get('user/authenticated', 'UserController@authenticated');
    Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);
});

