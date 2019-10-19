<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function index()
    {
        return view('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        $user = new User();

        return view('users.create', compact('user'));
    }

    public function store()
    {
        $data = array_merge($this->validateData(), ['api_token' => Str::random(32)]);

        $data['password'] =  Hash::make($data['password']);

        User::create($data);

        return redirect(route('users.index'));

    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    {
        // dd(request()->all());

        $user->update($this->validateOnUpdate($user));

        return redirect(route('users.show', ['user'=> $user->id]));
    }

    public function password(User $user)
    {
        return view('users.password', compact('user'));
    }

    public function passwordUpdate(User $user)
    {
        $data = $this->validatePasswordUpdate();

        $data['password'] =  Hash::make($data['password']);

        $user->update($data);


        return redirect(route('users.show', ['user'=> $user->id]));
    }


    private function validateData()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }
    
    private function validateOnUpdate(User $user)
    {
        $email = 'sometimes|required|string|email|max:255';

        if($user->email !== request('email')){
            $email = $email . '|unique:users';
        }

        $validateData = [
            'name' => 'sometimes|required|string|max:255',
            'email' => $email,
        ];

        return request()->validate($validateData);
    }

    private function passwordResetValidation()
    {
        return request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    private function validatePasswordUpdate()
    {
        return request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }
}
