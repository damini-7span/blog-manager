<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Services\AuthService;
use App\Http\Requests\Auth\Login;
use App\Http\Requests\Auth\Signup;
use App\Http\Resources\User\Resource;
use App\Http\Requests\Auth\ResetPassword;
use App\Http\Requests\Auth\ForgetPassword;
use App\Http\Requests\Auth\ChangePassword;
class AuthController extends Controller
{
    use ApiResponser;
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;   
    }

    public function signup(Signup $request)
    {
        $user = $this->service->signup($request->all());
        $data = [
            'user' => new Resource($user),
            'token' => $user->createToken(config('app.name'))->plainTextToken
        ];
        return $this->success($data, 200);
    }

    public function login(Login $request)
    {
        $user = $this->service->login($request->all());
        $data = [
            'user' => new Resource($user),
            'token' => $user->createToken(config('app.name'))->plainTextToken
        ];
        return $this->success($data, 200);
    }

    public function forgetpassword(ForgetPassword $request)
    {
        $data = $this->service->forgetpassword($request->all());
        return $data;
    }

    public function resetpassword(ResetPassword $request)
    {
        $data = $this->service->resetpassword($request->all());
        return $data;
    }

    public function changepassword(ChangePassword $request)
    {
        $data = $this->service->changepassword($request->all());
        return $data;
    }
}
