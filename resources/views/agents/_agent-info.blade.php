<h1 class="mb-2 text-lg font-light" >Tour Agent Information</h1>
<div class="border border-gray-700">
    <div class="flex">
        <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
            <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Agent Name</label>
        </div>
        <div  class="flex-1 border-b border-gray-700" >
            <div class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm">
                {{ $agent->name }}
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
            <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Address</label>
        </div>
        <div  class="flex-1 border-b border-gray-700" >
            <div class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm">
                {{ $agent->address }}
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
            <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">E-Mail Address</label>
        </div>
        <div  class="flex-1 border-b border-gray-700" >
            <div class="w-full focus:outline-none py-3 pl-10 text-gray-800 text-sm">
                {{ $agent->email }}
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="border-r py-2  border-gray-700 w-48 text-center">
            <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Contact Number</label>
        </div>
        <div  class="flex-1 border-gray-700" >
            <div class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm">
                {{ $agent->phone }}
            </div>
        </div>
    </div>
</div>