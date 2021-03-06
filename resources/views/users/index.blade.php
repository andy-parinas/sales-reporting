@extends('layouts.app')


@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Users</h1>
        </div>
        <div  class="px-4 py-2">
            <a href="{{ route('users.create')}}" class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white hover:bg-blue-600">Create New User</a>
        </div>
    </div>

    <user-list :user="{{ auth()->user() }}"  backend="{{ env('APP_URL')}}" ></user-list>

@endsection