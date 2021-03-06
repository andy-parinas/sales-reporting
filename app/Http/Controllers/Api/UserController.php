<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
        $users = User::orderBy('name', 'asc')->paginate(10);

        return UserResource::collection($users);

    }

    public function destroy(User $user)
    {
        $user->delete();

        return response([], Response::HTTP_OK);

    }

}
