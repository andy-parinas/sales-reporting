@extends('layouts.app')


@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Sales Report Details</h1>
        </div>
        <div  class="px-4 py-2 flex items-center">
            <a href="{{ route('sales.edit', ['sale' => $sale->id])}}" 
                class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white mr-2 hover:bg-blue-600">Edit</a>

            <delete-modal url="{{ route('sales.api.destroy', ['sale' => $sale->id])}}" 
                    back="{{route('sales.index')}}"
                    :user="{{ auth()->user() }}" ></delete-modal>
        </div>
    </div>
    
    @include('sales._sales-info')

    @include('sales._selected-products')

    @include('sales._sales-deductions')

    @include('sales._sales-commissions')
  
@endsection