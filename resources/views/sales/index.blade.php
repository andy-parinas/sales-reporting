@extends('layouts.app')

@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Sales Reports</h1>
        </div>
        <div  class="px-4 py-2">
            <a href="{{ route('sales.create')}}" class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white hover:bg-blue-600">Create Sales Report</a>
        </div>
    </div>
    <div class="my-10 px-5 w-256 mx-auto">
            <form action="#">
               <div class="flex items-center border border-gray-700 rounded">
                    <label for="search" class="pl-2 font-bold text-gray-800">Find</label>
                    <input class="py-2 px-4 flex-1 focus:outline-none"
                        id="search" type="text" placeholder="Report Number">
                    <button class="border border-blue-700 bg-blue-700 py-2 px-4 text-white">Search</button>
               </div>
            </form>
        <table class="w-full mt-5">
            <thead>
                <tr class="text-left bg-gray-300 border border-gray-800">
                    <th class="py-2 px-2 border border-gray-800">Report Number</th>
                    <th class="py-2 px-2 border border-gray-800">Date</th>
                    <th class="py-2 px-2 border border-gray-800">Tour Agent</th>
                    <th class="py-2 px-2 border border-gray-800">Tour Guide</th>
                    <th class="py-2 px-2 border border-gray-800">Total Agent Sales</th>
                    <th class="py-2 px-2 border border-gray-800">Total Agent Commision</th>
                </tr>
                <tbody>
                    @for ($i = 0; $i < 20; $i++)
                        <tr class="bg-white even:bg-gray-100">
                            <td class="py-2 px-4 border border-gray-800">
                                <a href="{{ route('sales.show', ['sale' => 1])}}" class="text-blue-700 font-semibold hover:text-blue-800">20192409-{{$i}}</a>
                            </td>
                            <td class="py-2 px-4 border border-gray-800">24/09/2019</td>
                            <td class="py-2 px-4 border border-gray-800">Harbour City</td>
                            <td class="py-2 px-4 border border-gray-800">Andy Parinas</td>
                            <td class="py-2 px-4 border border-gray-800">2,500.00</td>
                            <td class="py-2 px-4 border border-gray-800">1,500.00</td>
                        </tr>
                    @endfor
                </tbody>
            </thead>
        </table>
     
    </div>
@endsection