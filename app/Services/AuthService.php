<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Mail\ForgetPassword;
use Illuminate\Validation\ValidationException;
use Mail;

class AuthService
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function signup($inputs)
    {
        $userData = Arr::except($inputs, ['confirm_password']);
        $user = $this->user->create($userData);
        return $user;
    }

    public function login($inputs)
    {
        if (Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password']])) 
        {
            $user =  Auth::user();
            return $user;
        }

        throw ValidationException::withMessages([
            'email' => [__('auth.failed')],
        ]);
    }       

    public function forgetpassword($inputs)
    { 
        $user = $this->user->first();
        $user = $user->email;
        
        $code = mt_rand(100000,999999);
        Mail::to($user)->send(new ForgetPassword(['code' => $code]));
        $data['code'] = $code;
        return $data;
    }
}

?>