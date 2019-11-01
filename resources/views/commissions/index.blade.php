@extends('layouts.app')

@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Commissions</h1>
        </div>
    </div>
    <div class="">
        <tour-commission-dashboard :user="{{ auth()->user() }}"  backend="{{ env('APP_URL')}}"></tour-commission-dashboard>
    </div>
@endsection