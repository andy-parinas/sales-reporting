<div class="my-10 px-5 w-288 mx-auto">
    <div class="px-4 flex justify-between mt-5">
        <div class="border border-gray-700 flex-1 mr-4">
            <div class="flex">
                <div class="border-b border-r border-gray-700 w-32 text-center">
                    <div  class="text-sm font-semibold text-gray-800 uppercase py-1" for="agent">Tour Agent</div>
                </div>
                <div  class="flex-1 border-b border-gray-700 py-1 pl-10 " >
                    {{ $sale->tourAgent->name }}
                </div>
            </div>
            <div class="flex">
                <div class="border-b border-r border-gray-700 w-32 text-center">
                    <div  class="text-sm font-semibold text-gray-800 uppercase py-1" for="pax">PAX</div>
                </div>
                <div  class="flex-1 border-b border-gray-700 flex items-center">
                    <div class="flex-1 py-1 pl-10 border-r border-gray-700 focus:outline-none  text-gray-800 text-sm">
                        {{ $sale->adult_count}}
                    </div>
                    <div class="flex-1 py-1 pl-10 focus:outline-none  text-gray-800 text-sm">
                        {{ $sale->children_count }}
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="border-r border-gray-700 w-32 text-center">
                    <div  class="text-sm font-semibold text-gray-800 uppercase py-1" for="guide">Guide Name</div>
                </div>
                <div class="flex-1 border-gray-700 py-1 pl-10  text-sm">
                        {{ $sale->tourGuide->name }}
                </div>
            </div>
        </div>
        <div class="border border-gray-700 flex-1">
                <div class="flex">
                    <div class="border-b border-r border-gray-700 w-32 text-center">
                        <div class="text-sm font-semibold text-gray-800 uppercase py-1" for="date">Date</div>
                    </div>
                    <div class="flex-1  border-b border-gray-700">
                        <div class="w-full focus:outline-none py-1 pl-10 uppercase text-gray-800 text-sm">
                            {{ $sale->tour_date }}
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-b border-r border-gray-700 w-32 text-center">
                        <div class="text-sm font-semibold text-gray-800 uppercase py-1" for="grp">GRP Code</div>
                    </div>
                    <div class="flex-1 border-b border-gray-700">
                        <div class="w-full py-1 pl-10 focus:outline-none text-gray-800 text-sm">
                                {{ $sale->grp_code }}
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r border-gray-700 w-32 text-center">
                        <div class="text-sm font-semibold text-gray-800 uppercase py-1 " for="tc">T/C Name</div>
                    </div>
                    <div class="flex-1border-gray-700">
                        <div class="w-full py-1 pl-10 text-gray-800 text-sm">
                            {{ $sale->tc_name }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>