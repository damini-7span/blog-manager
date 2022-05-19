<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Services\Admin\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\Collection;

class UserController extends Controller
{
    use ApiResponser;
    public $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
        // $this->authorizeResource(User::class, 'user');
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

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
