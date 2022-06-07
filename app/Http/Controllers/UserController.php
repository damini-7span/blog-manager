<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\Resource;
use App\Http\Resources\User\Collection;
use App\Http\Requests\UserProfile\Upsert;

class UserController extends Controller
{
    use ApiResponser;
    public $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->authorizeResource(User::class, 'user');
    }

    public function index(Request $request)
    {
        $users = $this->service->collection($request->all());
        return $this->collection(new Collection($users));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user, Request $request)
    {
        $user = $this->service->resource($user->id);
        return $this->resource(new Resource($user));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function userProfile(Upsert $request)
    {
        $user = $this->service->update(Auth::user()->id, $request->all());
        return $this->resource(new Resource($user));
    }
}
