<?php

namespace App\Services;

use App\Models\UserOtp;

class userOtpService
{
    public function __construct(UserOtp $userOtp)
    {
        $this->userOtp = $userOtp;
    }

    public function store($inputs)
    {
        $userotp = $this->userOtp->create($inputs);
        return $userotp;
    }
}


?>