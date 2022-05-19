<?php

namespace App\Services\Admin;

use App\Models\User;

class userService
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function collection($inputs = null)
    {
        $query = $this->user->getQB();
        return $query->get();
    }
}
