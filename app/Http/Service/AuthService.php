<?php

namespace App\Http\Service;


use App\Http\Controllers\Common\BaseController;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseController
{
//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login']]);
//
//    }

    public function login($request)
    {
        $name    = $request->name;
        $password = $request->password;

        // 判断用户是否存在
        $adminInfo = User::where('name', '=', $name)->first();
        if (!$adminInfo) {
            return 'user_not_exists';
        }

        // 判断用户秘密是正确
        $adminPassword = Hash::make($password . $adminInfo->salt);
        if (Hash::check($adminPassword,$adminInfo->password)) {
            return 'password_error';
        }

        //  登录成功 为管理员颁发token
        $user = request(['name', 'password']);
        if (! $token = auth('api')->attempt($user)) {
            return 'redis_write_token_error';
        }

        $data = [
            'name' => $adminInfo['name'],
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];

        return $data;

    }

}
