<template>
    <div>
        <div class="px-4 flex justify-between mt-5">
            <div class="border border-gray-700 flex-1 mr-4">
                <div class="flex">
                    <div class="border-b border-r border-gray-700 p-1 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Tour Agent</label>
                    </div>
                    <div  class="flex-1 p-1 border-b border-gray-700">
                        <input class="w-full text-center focus:outline-none"  type="text" id="agent" placeholder="Tour Agent Name">
                    </div>
                </div>
                <div class="flex">
                    <div class="border-b border-r border-gray-700 p-1 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="pax">PAX</label>
                    </div>
                    <div  class="flex-1 p-1 border-b border-gray-700 flex items-center">
                        <input class=" flex-1 text-center border-r border-gray-700 focus:outline-none"  type="text" id="pax" placeholder="Adult">
                        <input class=" flex-1 text-center focus:outline-none"  type="text" id="pax" placeholder="Children">
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r border-gray-700 p-1 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="guide">Guide Name</label>
                    </div>
                    <div class="flex-1 p-1 border-gray-700">
                        <input class="w-full text-center focus:outline-none"  type="text" id="guide" placeholder="Guide Name">
                    </div>
                </div>
            </div>
            <div class="border border-gray-700 flex-1">
                    <div class="flex">
                        <div class="border-b border-r border-gray-700 p-1 w-32 text-center">
                            <label class="text-sm font-semibold text-gray-800 uppercase" for="date">Date</label>
                        </div>
                        <div class="flex-1 p-1 border-b border-gray-700">
                            <input class="w-full text-center focus:outline-none" type="text" id="date" placeholder="Tour Date">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="border-b border-r border-gray-700 p-1 w-32 text-center">
                            <label class="text-sm font-semibold text-gray-800 uppercase" for="grp">GRP Code</label>
                        </div>
                        <div class="flex-1 p-1 border-b border-gray-700">
                            <input class="w-full text-center focus:outline-none" type="numner" id="grp" placeholder="GRP Code">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="border-r border-gray-700 p-1 w-32 text-center">
                            <label class="text-sm font-semibold text-gray-800 uppercase" for="tc">T/C Name</label>
                        </div>
                        <div class="flex-1 p-1 border-gray-700">
                            <input class="w-full text-center focus:outline-none" type="text" id="tc" placeholder="T/C Name">
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>