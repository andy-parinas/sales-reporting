@extends('layouts.app')


@section('content')
    <div class="flex content-center items-center justify-between flex-wrap bg-gray-200 h-24 border-b border-gray-300">
        <div class="px-4 py-2">
            <h1 class="text-4xl font-bold uppercase text-gray-800" >Summary Report Details</h1>
        </div>
        <div  class="px-4 py-2 flex items-center">
            <a href="{{ route('summaries.edit', ['summary' => $summary->id])}}" 
                class="uppercase text-sm font-semibold bg-blue-700 py-2 px-4 rounded text-white mr-2 hover:bg-blue-600">Edit</a>

            <delete-modal url="{{ route('summaries.api.destroy', ['summary' => $summary->id])}}" 
                    back="{{route('summaries.index')}}"
                    :user="{{ auth()->user() }}" ></delete-modal>
        </div>
    </div>
    <div class="mx-auto w-288">

        <div class="border border-gray-700 flex-1 mt-10 mb-5 w-144 bg-green-200">
            <div class="flex">
                <div class="border-b border-r border-gray-700 w-48 text-center">
                    <div  class="text-sm font-semibold text-gray-800 uppercase py-1" for="agent">Report Number </div>
                </div>
                <div  class="flex-1 border-b border-gray-700 py-1 pl-10 " >
                    {{ $summary->report_number}}
                </div>
            </div>
            <div class="flex">
                <div class="border-r border-gray-700 w-48 text-center">
                    <div  class="text-sm font-semibold text-gray-800 uppercase py-1" for="pax">From / To</div>
                </div>
                <div  class="flex-1 border-gray-700 flex items-center">
                    <div class="flex-1 py-1 pl-10 border-r border-gray-700 focus:outline-none  text-gray-800 text-sm">
                        {{ $summary->from_date}}
                    </div>
                    <div class="flex-1 py-1 pl-10 focus:outline-none  text-gray-800 text-sm">
                        {{ $summary->to_date }}
                    </div>
                </div>
            </div>
        </div>

        <table class="w-full mt-5">
            <thead>
                <tr class="text-left bg-gray-300 border border-gray-800 text-xs">
                    <th class="py-2 px-2 border-r border-gray-800 w-32">
                        Date
                    </th>
                    <th class="py-2 px-2 border-r border-gray-800 w-32">
                        GRP/Code
                    </th><th class="py-2 px-2 border-r border-gray-800 w-32">
                        Guide Name
                    </th>
                    <th class="py-2 px-2 border-r border-gray-800 w-16">A</th>
                    <th class="py-2 px-2 border-r border-gray-800 w-16">C</th>
                    <th class="py-2 px-2 border-r border-gray-800 w-16">TC</th>
                    <th class="py-2 px-2 border-r border-gray-800 w-32 text-right">Sales</th>
                    <th class="py-2 px-2 border-r border-gray-800 w-32 text-right">Commission</th>
                    <th class="py-2 px-2 border-r border-gray-800 w-32 text-right">GST</th>
                    <th class="py-2 px-2 border-r border-gray-800 w-32 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr class="bg-white text-xs">
                    <td class="py-2 px-4 border border-gray-800"> {{ $item->salesReport->tour_date }} </td>
                    <td class="py-2 px-4 border border-gray-800"> {{ $item->salesReport->grp_code }} </td>
                    <td class="py-2 px-4 border border-gray-800"> {{ $item->salesReport->tourGuide->name }} </td>
                    <td class="py-2 px-4 border border-gray-800"> {{ $item->salesReport->adult_count }} </td>
                    <td class="py-2 px-4 border border-gray-800"> {{ $item->salesReport->children_count }} </td>
                    <td class="py-2 px-4 border border-gray-800"> 0 </td>
                    <td class="py-2 px-4 border border-gray-800 text-right"> {{ $item->salesReport->total_agent_sales }} </td>
                    <td class="py-2 px-4 border border-gray-800 text-right"> {{ $item->salesReport->total_commissions }} </td>
                    <td class="py-2 px-4 border border-gray-800 text-right"> {{ $item->salesReport->gst }} </td>
                    <td class="py-2 px-4 border border-gray-800 text-right"> {{ $item->salesReport->grand_total_commission }} </td>
                </tr>
                @endforeach
                <tr class="bg-blue-200 text-xs">
                    <td class="py-2 px-4 border border-gray-800"></td>
                    <td class="py-2 px-4 border border-gray-800"></td>
                    <td class="py-2 px-4 border border-gray-800">TOTAL</td>
                    <td class="py-2 px-4 border border-gray-800"> {{ $summary->adult_count_total }} </td>
                    <td class="py-2 px-4 border border-gray-800"> {{ $summary->children_count_total }} </td>
                    <td class="py-2 px-4 border border-gray-800"> 0 </td>
                    <td class="py-2 px-4 border border-gray-800 text-right"> {{ $summary->sales_total }} </td>
                    <td class="py-2 px-4 border border-gray-800 text-right"> {{ $summary->agent_commissions_total }} </td>
                    <td class="py-2 px-4 border border-gray-800 text-right"> {{ $summary->gst_total }} </td>
                    <td class="py-2 px-4 border border-gray-800 text-right"> {{ $summary->total }} </td>
                </tr>
                <tr  class="text-xs">
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">Return</td>
                    <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">{{$summary->return}}</td>
                </tr>
                    <tr  class="bg-white text-xs">
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">Deduction</td>
                    <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">{{$summary->duvet_deduction}}</td>
                </tr>
                <tr  class="bg-white text-xs">
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="py-2 px-4"></td>
                    <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">Balance</td>
                    <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">{{$summary->balance}}</td>
                </tr>
            </tbody>
        </table>
    </div>


@endsection