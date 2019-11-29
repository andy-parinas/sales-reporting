<div class="my-10 px-5 w-288 mx-auto">
    <div class="flex border border-gray-700 mt-5 items-start text-sm bg-green-200">
        <div class="flex-1">
            <div class="flex justify-between border-b border-gray-700">
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Sales</div>
                <div class="w-32  px-2 py-1 text-right"> {{ number_format($sale->total_sales, 2, '.', ',') }} </div>
            </div>
            <div class="flex justify-between border-b-2 border-gray-700">
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Deductions</div>
                <div class="w-32  px-2 py-1 text-right"> {{ number_format($sale->total_deductions, 2, '.', ',') }} </div>
            </div>
            <div class="flex justify-between border-b border-gray-700" >
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Agent Sales</div>
                <div class="w-32  px-2 py-1 text-right"> {{ number_format($sale->total_agent_sales, 2, '.', ',') }}</div>
            </div>

            {{-- @dump($commissionTypes) --}}

            @foreach ($commissionTypes as $commissionType)
                <div class="flex justify-between border-b border-gray-700">
                        <div class="flex-1 border-gray-700 border-r flex">
                                <div class="border-r border-gray-700 px-2 py-1 w-48">{{ $commissionType->name }}</div>
                                <div class="flex-1">
                                    @foreach ($salesCommissions as $salesCommission)
                                        <div class="flex items-center justify-between">
                                                @if ($salesCommission->tourCommission->commissionType->id == $commissionType->id )
                                                    <div class="border-b border-gray-700 flex-1 px-2 py-1 "> {{  $salesCommission->tourCommission->commission->name }} </div>
                                                    <div class="border-b border-gray-700 flex-1 px-2 py-1 text-right"> {{  $salesCommission->percentage * 100 }} % </div>
                                                    <div class="border-b border-l border-gray-700 w-32  px-2 py-1 text-right"> {{ number_format($salesCommission->amount, 2, '.', ',') }} </div>
                                                @endif
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                </div>
            @endforeach

            <div class="flex justify-between border-b border-gray-700 h-8" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1"></div>
                    <div class="w-32  px-2 py-1">  </div>
                </div>

            @foreach ($totalByCommissions as $key => $value)
                <div class="flex justify-between border-b border-gray-700">
                        <div class="border-r border-gray-700 px-2 py-1 w-48"></div>
                    <div class="flex-1 border-gray-700 border-r px-2 py-1 font-semibold"> Total {{ $key}} </div>
                    <div class="w-32  px-2 py-1 text-right"> {{ $value }} </div>
                </div>
            @endforeach


            <div class="flex justify-between border-b border-gray-700 h-8" >
                <div class="flex-1 border-gray-700 border-r px-2 py-1"></div>
                <div class="w-32  px-2 py-1">  </div>
            </div>
            <div class="flex justify-between border-b border-gray-700" >
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Agent Commission</div>
                <div class="w-32  px-2 py-1 text-right"> {{ number_format($sale->total_commissions, 2, '.', ',') }} </div>
            </div>
            <div class="flex justify-between border-b border-gray-700" >
                <div class="flex-1 border-gray-700 border-r px-2 py-1">GST</div>
                <div class="w-32  px-2 py-1 text-right"> {{ number_format($sale->gst, 2, '.', ',') }} </div>
            </div>
            <div class="flex justify-between font-semibold bg-green-400">
                <div class="flex-1 border-gray-700 border-r  px-2 py-1">Grand Total Agent Commission</div>
                <div class="w-32  px-2 py-1 text-right"> {{ number_format($sale->grand_total_commission, 2, '.', ',')  }} </div>
            </div>
        </div>
    </div>
</div>
   