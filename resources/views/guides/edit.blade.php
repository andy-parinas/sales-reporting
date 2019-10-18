@extends('layouts.app')


@section('content')
<div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
    <div class="px-4 py-2">
        <h1 class="text-4xl font-bold uppercase text-gray-800" >Edit Tour Guide</h1>
    </div>
    <div  class="px-4 py-2 flex items-center">
        <a href="{{ route('guides.show', ['guide' => $guide->id ])}} " 
            class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white mr-2 hover:bg-blue-600">
            Cancel
        </a>
    </div>
</div>    
<tour-guide-form  :user="{{ auth()->user() }}" backend="{{ env('APP_URL')}}" edit="{{ true }}" :guide="{{ $guide}}"></tour-guide-form>

@endsection