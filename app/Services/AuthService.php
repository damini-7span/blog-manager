<?php

namespace App\Services;

use Mail;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Support\Arr;
use App\Mail\ForgetPassword;
use App\Traits\ApiResponser;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    use ApiResponser;
    private $user;
    private $userOtp;
    private $userOtpService;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->userOtp = new UserOtp();
        $this->userOtpService = new UserOtpService($this->userOtp);
    }

    public function signup($inputs)
    {
        $userData = Arr::except($inputs, ['confirm_password']);
        $user = $this->user->create($userData);
        $user->assignRole('user');  
        return $user;
    }

    public function login($inputs)
    {
        if (Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password']])) {
            $user =  Auth::user();
            return $user;
        }

        throw ValidationException::withMessages([
            'email' => [__('auth.failed')],
        ]);
    }

    public function forgetpassword($inputs)
    {
        $user = $this->user->where('email', $inputs['email'])->first();
        if ($user == null) {
            throw new CustomException('email not found');
        }
        $code = mt_rand(100000, 999999);
        $this->userOtpService->store(['code' => $code, 'user_id' => $user->id, 'email' => $user->email]);
        Mail::to($user)->send(new ForgetPassword(['code' => $code]));
        $data['code'] = $code;
        return $data;
    }

    public function resetpassword($inputs)
    {
        $user = $this->userOtp->where(['code' => $inputs['code'], 'email' => $inputs['email']])->first();
        if ($user == null) {
            throw new CustomException('Invalid Code');
        }
        $this->user->where('id', $user->user_id)->update(['password' => bcrypt($inputs['password'])]);
        return $this->success('Password Reset Successfully', 200);
    }

    public function changepassword($inputs)
    {
        $user = Auth::user();
        $user->password = $inputs['password'];
        $user->update();
        return $this->success('Password Changed Successfully', 200);
    }
}
