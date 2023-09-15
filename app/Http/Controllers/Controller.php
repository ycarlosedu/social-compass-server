<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ApiResponser;

    protected function respondWithToken($token)
    {
        $user = Auth::user();
        return $this->successResponse([
            'usuario' => $user,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL()
        ], 200);
    }
}
