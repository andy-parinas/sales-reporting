@extends('layouts.app')


@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Tour Agent Details</h1>
        </div>
        <div  class="px-4 py-2 flex items-center">
            <a href="{{ route('agents.edit', ['agent' => $agent->id])}} " 
                class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white mr-2 hover:bg-blue-600">
                Edit
            </a>
            <delete-modal url="{{ route('agents.api.destroy', ['agent' => $agent->id])}}" 
                    back="{{route('agents.index')}}"
                        :user="{{ auth()->user() }}" ></delete-modal>
        </div>
    </div>
    <div class="mt-10 w-144 mx-auto">
        @include('agents._agent-info')
    </div>
    
    <div class="mx-auto w-288 mt-5 mb-16">
        <h1 class="mb-2 text-lg font-semibold text-blue-700" >Commisions Matrix</h1>
        <tour-commission-list 
                :user="{{ auth()->user() }}"  
                backend="{{ env('APP_URL')}}" 
                :tour-commissions="{{ $tourCommissions }}"
                :agent-id="{{$agent->id}}" ></tour-commission-list>
    </div>
@endsection

