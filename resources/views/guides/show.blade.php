@extends('layouts.app')


@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Tour Guide Details</h1>
        </div>
        <div  class="px-4 py-2 flex items-center">
            <a href="{{ route('guides.edit', ['guide' => $guide->id])}} " 
                class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white mr-2 hover:bg-blue-600">
                Edit
            </a>
            <delete-modal url="{{ route('guides.api.destroy', ['guide' => $guide->id])}}" 
                    back="{{route('guides.index')}}"
                        :user="{{ auth()->user() }}" ></delete-modal>
        </div>
    </div>
    <div class="mt-10 w-144 mx-auto">
        <div class="flex items-center justify-between">
            <h1 class="mb-2 text-lg font-light" >Tour Guide Information</h1>
            <a href="{{ route('guides.index')}}" class="text-blue-600 font-semibold hover:text-blue-700">Back</a>
        </div>
        <div class="border border-gray-700">
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Agent Name</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <div class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm">
                            {{ $guide->name }}
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">E-Mail Address</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <div class="w-full focus:outline-none py-3 pl-10 text-gray-800 text-sm">
                            {{  $guide->email }}
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Contact Number</label>
                    </div>
                    <div  class="flex-1 border-gray-700" >
                        <div class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm">
                            {{ $guide->phone }}
                        </div>
                    </div>
                </div>
        </div>
    </div>    
@endsection