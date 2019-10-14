@extends('layouts.app')


@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Product Details</h1>
        </div>
        <div  class="px-4 py-2 flex items-center">
            <a href="{{ route('products.edit', ['product' => $product->id])}} " 
                class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white mr-2 hover:bg-blue-600">
                Edit
            </a>
            <delete-modal url="{{ route('products.api.destroy', ['product' => $product->id])}}" 
                    back="{{route('products.index')}}"
                        :user="{{ auth()->user() }}" ></delete-modal>
        </div>
    </div>
    <div class="my-10 px-5 w-224 mx-auto">
            <div class="border border-gray-700">
                <div class="flex">
                    <div class="border-b border-r py-1  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Product Name</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <div class="w-full focus:outline-none py-2  pl-10 text-gray-800 text-sm">
                            {{ $product->name }}
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r border-b py-1  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="guide">Product Type</label>
                    </div>
                    <div class="flex-1 border-b  border-gray-700">
                        <div class="w-full py-2  pl-10 focus:outline-none text-gray-800 text-sm">
                            {{ $product->productType->name }}
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-b border-r py-1  border-gray-700 w-32 text-center">
                        <label class="text-sm font-semibold text-gray-800 uppercase" for="grp">Price</label>
                    </div>
                    <div class="flex-1 border-b border-gray-700">
                        <div class="w-full py-2  pl-10 focus:outline-none text-gray-800 text-sm">
                            {{ $product->price }}
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r py-1  border-b border-gray-700 w-32 text-center">
                        <label class="text-xs font-semibold text-gray-800 uppercase" for="tc">Cost</label>
                    </div>
                    <div class="flex-1 border-b border-gray-700">
                        <div class="w-full py-2 pl-10 focus:outline-none  text-gray-800 text-sm">
                            {{ $product->cost }}
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="pax">Description</label>
                    </div>
                    <div  class="flex-1 border-gray-700 flex items-center">
                        <div class="flex-1 py-1 pl-10 border-gray-700 focus:outline-none  text-gray-800 text-sm">
                            {{ $product->description}}
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
