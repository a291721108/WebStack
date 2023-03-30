<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Common\BaseController;
use App\Http\Service\AuthService;
use Illuminate\Http\JsonResponse;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);

    }

    /**
     * @return JsonResponse
     */
    public function login(Request $request)
    {

        $data = AuthService::login($request);

        if (is_array($data)) {
            return $this->success('success', '200', $data);
        }
        return $this->error($data, '404', []);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * @param $token
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
