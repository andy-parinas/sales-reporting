@extends('layouts.app')

@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Reset Password</h1>
        </div>
        <div  class="px-4 py-2 flex items-center">
            <a href="{{ route('users.show', ['user' => $user->id ])}} " 
                class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white mr-2 hover:bg-blue-600">
                Cancel
            </a>
        </div>
    </div>
    <div class="mt-10 w-160 mx-auto">
        <form method="POST" action="{{ route('users.password.update', ['user' => $user->id]) }}">
            @csrf
            @method('PATCH')
            <div class="border border-gray-700">
                <div class="flex bg-gray-200">
                    <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="name">Name</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <div class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm">
                            {{ $user->name }}
                        </div>
                    </div>
                </div>
                <div class="flex bg-gray-200">
                    <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="email">E-Mail Address</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <div class="w-full focus:outline-none py-3 pl-10 text-gray-800 text-sm">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r border-b py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="password">Password</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <input class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm @error('password') bg-red-200 @enderror" 
                            type="password" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="password-confirm">Confirm Password</label>
                    </div>
                    <div  class="flex-1 border-gray-700" >
                        <input class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm @error('password') bg-red-200 @enderror" 
                            type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>
            </div>
            <button type="submit"
                    class="flex items-center w-full mt-5 py-2 px-4 text-white 
                                rounded-full justify-center focus:outline-none bg-indigo-600 hover:bg-indigo-700">
                Submit 
            </button>
        </form>
    </div>    
@endsection