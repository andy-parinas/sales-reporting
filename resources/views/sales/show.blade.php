@extends('layouts.app')


@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Sales Report Details</h1>
        </div>
        <div  class="px-4 py-2 flex items-center">
            <a href="{{ route('sales.edit', ['sale' => $sale->id])}}" 
                class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white mr-2 hover:bg-blue-600">Edit</a>

            <delete-modal url="{{ route('sales.api.destroy', ['sale' => $sale->id])}}" :user="{{ auth()->user() }}" ></delete-modal>
        </div>
    </div>
    
    @include('sales._sales-info')

    @include('sales._selected-products')

    @include('sales._sales-deductions')


    <div class="my-10 px-5 w-288 mx-auto">
        <div class="flex border border-gray-700 mt-5 items-start text-sm bg-green-200">
            <div class="flex-1">
                <div class="flex justify-between border-b border-gray-700">
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Sales</div>
                    <div class="w-32  px-2 py-1 text-right"> {{ $sale->total_sales }} </div>
                </div>
                <div class="flex justify-between border-b-2 border-gray-700">
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">Deductions</div>
                    <div class="w-32  px-2 py-1 text-right"> {{ $sale->total_deductions }} </div>
                </div>
                <div class="flex justify-between border-b border-gray-700" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Agent Sales</div>
                    <div class="w-32  px-2 py-1 text-right"> {{ $sale->total_agent_sales }}</div>
                </div>
    
                @foreach ($salesCommissions as $salesCommission)
                    <div class="flex justify-between border-b border-gray-700">
                        <div class="flex-1 border-gray-700 border-r px-2 py-1">{{ $salesCommission->commission->name }}</div>
                        <div class="w-32  px-2 py-1 text-right"> {{  $salesCommission->amount }} </div>
                    </div>
                @endforeach

                
    
                <div class="flex justify-between border-b border-gray-700 h-8" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1"></div>
                    <div class="w-32  px-2 py-1">  </div>
                </div>
                <div class="flex justify-between border-b border-gray-700" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Agent Commission</div>
                    <div class="w-32  px-2 py-1 text-right"> {{ $sale->total_commissions }} </div>
                </div>
                <div class="flex justify-between border-b border-gray-700" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">GST</div>
                    <div class="w-32  px-2 py-1 text-right"> {{ $sale->gst }} </div>
                </div>
                <div class="flex justify-between font-semibold bg-green-400">
                    <div class="flex-1 border-gray-700 border-r  px-2 py-1">Grand Total Agent Commission</div>
                    <div class="w-32  px-2 py-1 text-right"> {{ $sale->grand_total_commission }} </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection