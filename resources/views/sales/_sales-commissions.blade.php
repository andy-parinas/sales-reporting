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

            @foreach ($salesCommissions as $salesCommission)
                <div class="flex justify-between border-b border-gray-700">
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">{{ $salesCommission->commission->name }}</div>
                    <div class="w-32  px-2 py-1 text-right"> {{ number_format($salesCommission->amount, 2, '.', ',') }} </div>
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
   