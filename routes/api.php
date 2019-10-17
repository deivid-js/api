<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'prefix' => 'v1'
], function($router) {
    /*
     | auth
     |
     */
    Route::group([
        'namespace' => 'Api',
        'prefix'    => 'auth'
    ], function($router) {
        Route::post('login'  , 'AuthController@login');
        Route::post('logout' , 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me'     , 'AuthController@me');
    });

    /*
     | http://localhost/dwr-api/public/api/v1/pessoa/
     |
     */
    Route::group([
        'namespace'  => 'Api',
        'prefix'     => 'pessoa',
    ], function($router) {
        Route::get('index'          , 'PessoaController@index');
        Route::post('store'         , 'PessoaController@store');
        Route::put('update/{id}'    , 'PessoaController@update');
        Route::delete('destroy/{id}', 'PessoaController@destroy');
    });
    
    /*
     | http://localhost/dwr-api/public/api/v1/endereco/
     |
     */
    Route::group([
        'namespace'  => 'Api',
        'prefix'     => 'endereco',
    ], function($router) {
        Route::get('index'          , 'EnderecoController@index');
        Route::post('store'         , 'EnderecoController@store');
        Route::put('update/{id}'    , 'EnderecoController@update');
        Route::delete('destroy/{id}', 'EnderecoController@destroy');
    });
    
    /*
     | http://localhost/dwr-api/public/api/v1/tipo-contato/
     |
     */
    Route::group([
        'namespace'  => 'Api',
        'prefix'     => 'tipo-contato',
    ], function($router) {
        Route::get('index'          , 'TipoContatoController@index');
        Route::post('store'         , 'TipoContatoController@store');
        Route::put('update/{id}'    , 'TipoContatoController@update');
        Route::delete('destroy/{id}', 'TipoContatoController@destroy');
    });
    
    /*
     | http://localhost/dwr-api/public/api/v1/contato/
     |
     */
    Route::group([
        'namespace'  => 'Api',
        'prefix'     => 'contato',
    ], function($router) {
        Route::get('index'          , 'ContatoController@index');
        Route::post('store'         , 'ContatoController@store');
        Route::put('update/{id}'    , 'ContatoController@update');
        Route::delete('destroy/{id}', 'ContatoController@destroy');
    });
});
