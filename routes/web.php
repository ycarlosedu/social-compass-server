<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use \Illuminate\Http\Request;

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

$config['index_page'] = '';
$config['uri_protocol'] = "REQUEST_URI";

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => 'cors'], function () use ($router) {

    $router->options('/{any:.*}', ['middleware' => ['CorsMiddleware'], function (){
        return response(['status' => 'success']);
    }]);

    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'AuthController@register');

    $router->group(['middleware' => 'auth'], function () use ($router) {

        // USUARIOS
        $router->group(['prefix' => '/usuarios'], function () use ($router) {

            $router->get('/',  ['uses' => 'UsuariosController@BuscaTodosUsuarios']);

            $router->get('/{id}', ['uses' => 'UsuariosController@buscaUmUsuario']);

            $router->put('/{id}', ['uses' => 'UsuariosController@atualizarUsuarios']);
        });

    });
});
