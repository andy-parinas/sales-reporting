<div class="my-10 px-5 w-288 mx-auto">
    <div class="flex border border-gray-700 mt-5 items-start text-sm bg-orange-300">
        <div class="">
            <h2 class="border-b border-gray-700 px-2 py-1 font-semibold uppercase">Deductions</h2>
        </div>
        <div class="flex-1 border-l border-gray-700 ">

            @foreach ($salesDeductions as $salesDeduction)
                <div class="flex justify-between border-b border-gray-700">
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">{{$salesDeduction->deduction->name}}</div>
                    <div class="w-32  px-2 py-1 text-right"> {{ $salesDeduction->amount }} </div>
                </div>
            @endforeach

            <div class="flex justify-between font-semibold bg-orange-400">
                <div class="flex-1 border-gray-700 border-r  px-2 py-1">Sub Total</div>
                <div class="w-32 px-2 py-1"> 
                    <div class="w-32 px-4 py-1 text-right">{{ $sale->total_deductions }}</div>
                </div>
            </div>
        </div>
    </div>
</div>