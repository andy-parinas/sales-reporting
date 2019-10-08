@extends('layouts.app')


@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Sales Report Details</h1>
        </div>
        <div  class="px-4 py-2">
            <a href="" class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white hover:bg-blue-600">Edit</a>
        </div>
    </div>
    
    @include('sales._sales-info')
    <div class="my-10 px-5 w-288 mx-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left bg-gray-300 border border-gray-800 text-sm">
                    <th class="py-2 px-2 border border-gray-800">Selected Product</th>
                    <th class="py-2 px-2 border border-gray-800 text-right">Price</th>
                    <th class="py-2 px-2 border border-gray-800 text-right">QTY</th>
                    <th class="py-2 px-2 border border-gray-800 text-right">Total</th>
                    <th class="py-2 px-2 border border-gray-800">Type</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($selectedProducts as $selectedProduct)
                        <tr class="text-sm">
                            <td class="py-2 px-4 border border-gray-800">{{ $selectedProduct->product->name }}</td>
                            <td class="py-2 px-4 border border-gray-800 text-right">{{ number_format($selectedProduct->product->price, 2, '.', ',') }}</td>
                            <td class="py-2 px-4 border border-gray-800 text-right"> {{ $selectedProduct->quantity }}</td>
                            <td class="py-2 px-4 border border-gray-800 text-right"> {{ $selectedProduct->total }} </td>
                            <td class="py-2 px-4 border border-gray-800 "> {{ $selectedProduct->product->productType->name }} </td>
                        </tr>
                    @endforeach

                <tr class="text-sm bg-yellow-300">
                    <td class="py-2 px-4 border border-gray-800">Sub Total</td>
                    <td class="py-2 px-4 border border-gray-800"> </td>
                    <td class="py-2 px-4 border border-gray-800"> </td>
                    <td class="py-2 px-4 border border-gray-800 text-right"> 
                            {{ $sale->total_sales }}
                    </td>
                    <td class="py-2 px-4 border border-gray-800 w-12"> </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection