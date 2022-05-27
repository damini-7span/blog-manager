<?php

namespace App\Http\Controllers\User;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\Admin\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\Resource;
use App\Http\Requests\UserProfile\Upsert;

class UserController extends Controller
{
    use ApiResponser;
    public $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function userProfile(Upsert $request)
    {
        $user = $this->service->update(Auth::user()->id, $request->all());
        return $this->resource(new Resource($user));
    }
}
