<?php

namespace App\Http\Controllers;

use App\Enums\TipoUsuario;
use App\Models\Usuarios;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

/** @package App\Http\Controllers */
class AuthController extends Controller
{

    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}


    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function isRegisterValid(Request $request)
    {
        return  $this->validate(
            $request,
            [
                'nome' => 'required|max:255',
                'usuario' => 'required|unique:usuarios,usuario|max:255',
                'data_nascimento' => 'required|max:255',
                'email' => 'required|email|unique:usuarios,email|max:255',
                'password' => 'required|max:50',
                'confirmar_senha' => 'required|same:password',
            ], [
                'usuario.unique' => 'Usúario já existe!',
                'email.unique' => 'Email já existe!',
                'confirmar_senha.same' => 'As senhas não correspondem!',
            ]
        );
    }

    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function isLoginValid(Request $request)
    {

        return $this->validate($request, [
            'usuario' => 'required|string|max:255',
            'password' =>  'required|string|max:50'
        ]);
    }

    /**
     * @param Request $request
     * @return App\Traits\Iluminate\Http\Response|void
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        if ($this->isLoginValid($request)) {
            $credentials = $request->only(['usuario', 'password']);

            $token = auth()->attempt($credentials);
            if($token){
            return $this->respondWithToken($token);
            }else{
                // return $this->errorResponse($credentials, Response::HTTP_NOT_FOUND);
                return $this->errorResponse('Usuário e/ou Senha inválidos. Por favor, tente novamente!', Response::HTTP_FORBIDDEN);
            }
        }
    }

    /**
     * @param Request $request
     * @return App\Traits\Iluminate\Http\Response|App\Traits\Iluminate\Http\JsonResponse|void
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        if ($this->isRegisterValid($request)) {
            try {
                Usuarios::create($request->all());

                $credentials = $request->only(['usuario', 'password']);
                $token = auth()->attempt($credentials);
                if($token){
                    return $this->respondWithToken($token);
                }else{
                    return $this->errorResponse('Não foi possível criar um token, tente fazer login!', Response::HTTP_FORBIDDEN);
                }
            } catch (\Exception $e) {
                return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }
        }
    }
}
