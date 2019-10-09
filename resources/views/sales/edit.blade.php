@extends('layouts.app')


@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Edit Sales Report</h1>
        </div>
    </div>
    <div>
        {{-- {{ dump($sale) }} --}}
    </div>
    <sales-report-form :user="{{ auth()->user() }}"
        :edit="{{true}}"
        :report="{{$sale}}" ></sales-report-form>
@endsection