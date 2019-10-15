@extends('layouts.app')


@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Tour Agent Details</h1>
        </div>
        <div  class="px-4 py-2 flex items-center">
            <a href="{{ route('agents.edit', ['product' => $agent->id])}} " 
                class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white mr-2 hover:bg-blue-600">
                Edit
            </a>
            <delete-modal url="{{ route('agents.api.destroy', ['agent' => $agent->id])}}" 
                    back="{{route('agents.index')}}"
                        :user="{{ auth()->user() }}" ></delete-modal>
        </div>
    </div>
    <div class="px-4 flex justify-around mt-5 items-start">
            <div class="mr-4 w-144">
                @include('agents._agent-info')
            </div>
            <div class="w-144">
                <h1 class="mb-2 text-lg font-light" >Tour Guide List</h1>
                <tour-guide-list  :user="{{ auth()->user() }}" backend="{{ env('APP_URL')}}"></tour-guide-list>
            </div>
    </div>
@endsection