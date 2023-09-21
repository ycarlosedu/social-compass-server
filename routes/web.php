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

            $router->get('/',  ['uses' => 'UsuariosController@buscaTodosUsuarios']);

            $router->get('/{id}', ['uses' => 'UsuariosController@buscaUmUsuario']);

            $router->put('/{id}', ['uses' => 'UsuariosController@atualizarUsuario']);

	        $router->post('/atualizar/{id}', ['uses' => 'UsuariosController@atualizarUsuario']);
        });

        // POSTS
        $router->group(['prefix' => '/posts'], function () use ($router) {

            $router->get('/',  ['uses' => 'PostsController@buscaTodos']);

            $router->get('/{id}', ['uses' => 'PostsController@buscaUm']);

            $router->post('/', ['uses' => 'PostsController@criar']);

            $router->put('/{id}', ['uses' => 'PostsController@atualizar']);

            $router->put('/curtir/{id}', ['uses' => 'PostsController@curtir']);

            $router->delete('/{id}', ['uses' => 'PostsController@deletar']);

            $router->post('/atualizar/{id}', ['uses' => 'PostsController@atualizar']);

            $router->post('/curtir/{id}', ['uses' => 'PostsController@curtir']);

            $router->post('/deletar/{id}', ['uses' => 'PostsController@deletar']);
        });

        // COMENTARIOS
        $router->group(['prefix' => '/comentarios'], function () use ($router) {

            $router->post('/', ['uses' => 'ComentariosController@criar']);

            $router->put('/{id}', ['uses' => 'ComentariosController@atualizar']);

            $router->delete('/{id}', ['uses' => 'ComentariosController@deletar']);

            $router->post('/atualizar/{id}', ['uses' => 'ComentariosController@atualizar']);

            $router->post('/deletar/{id}', ['uses' => 'ComentariosController@deletar']);
        });

        // MARKET
        $router->group(['prefix' => '/market-itens'], function () use ($router) {

            $router->get('/', ['uses' => 'MarketController@buscaTodos']);

            $router->get('/{id}', ['uses' => 'MarketController@buscaUm']);

            $router->post('/', ['uses' => 'MarketController@criar']);

            $router->put('/{id}', ['uses' => 'MarketController@atualizar']);

            $router->put('/comprar/{id}', ['uses' => 'MarketController@comprar']);

            $router->delete('/{id}', ['uses' => 'MarketController@deletar']);

            $router->post('/atualizar/{id}', ['uses' => 'MarketController@atualizar']);

            $router->post('/comprar/{id}', ['uses' => 'MarketController@comprar']);

            $router->post('/deletar/{id}', ['uses' => 'MarketController@deletar']);
        });
    });
});
