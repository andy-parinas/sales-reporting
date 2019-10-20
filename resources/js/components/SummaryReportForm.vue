<template>
  <div>
        <div class="w-144 mx-auto flex items-center justify-center">
            <div class="px-4 flex justify-between mt-5">
                <div class="border border-gray-700 flex-1 mr-4">
                    <div class="flex">
                        <div class="border-r border-gray-700 w-32 text-center py-2 ">
                            <label class="text-sm font-semibold text-gray-800 uppercase" for="date">From</label>
                        </div>
                        <div class="flex-1 border-gray-700">
                            <input class="w-full focus:outline-none py-2 px-2 uppercase text-gray-800 text-sm" 
                                type="date" id="date" 
                                placeholder="Tour Date" v-model="fromDate">
                        </div>
                    </div>
                </div>
                <div class="border border-gray-700 flex-1 mr-4">
                    <div class="flex">
                        <div class="border-r border-gray-700 w-32 text-center  py-2">
                            <label class="text-sm font-semibold text-gray-800 uppercase" for="date">To</label>
                        </div>
                        <div class="flex-1border-gray-700">
                            <input class="w-full focus:outline-none py-2 px-2 uppercase text-gray-800 text-sm"
                                type="date" id="date" 
                                placeholder="Tour Date" v-model="toDate" >
                        </div>
                    </div>
                </div>
                <button class="bg-blue-600 py-2 px-2 text-white rounded" @click="getSalesReport" >Go</button>
            </div>
        </div>
        <div class="mx-auto w-288">
            <table class="w-full mt-5">
                <thead>
                    <tr class="text-left bg-gray-300 border border-gray-800 text-xs">
                        <th class="py-2 px-2 border-r border-gray-800 w-24">
                            Date
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800 w-24">
                            GRP/Code
                        </th><th class="py-2 px-2 border-r border-gray-800 w-24">
                            Guide Name
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800 w-16">A</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-16">C</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-16">TC</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-48 text-right">Sales</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-48 text-right">Commission</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-32 text-right">GST</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-48 text-right">Total</th>
                    </tr>
                    <tr  class="bg-white text-xs">
                        <td class="py-2 px-4 border border-gray-800"></td>
                        <td class="py-2 px-4 border border-gray-800"></td>
                        <td class="py-2 px-4 border border-gray-800">TOTAL</td>
                        <td class="py-2 px-4 border border-gray-800">0</td>
                        <td class="py-2 px-4 border border-gray-800">0</td>
                        <td class="py-2 px-4 border border-gray-800">0</td>
                        <td class="py-2 px-4 border border-gray-800 text-right">1000</td>
                        <td class="py-2 px-4 border border-gray-800 text-right">1000</td>
                        <td class="py-2 px-4 border border-gray-800 text-right">1000</td>
                        <td class="py-2 px-4 border border-gray-800 text-right">1000</td>
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
                        <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">0</td>
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
                        <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">0</td>
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
                        <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">0</td>
                    </tr>
                </thead>
            </table>
        </div>
  </div>
</template>

<script>
export default {
    name: 'SummaryReportForm',
    props: ['user', 'backend'],
    data: function(){
        return {
            fromDate: '',
            toDate: ''
        }
    },
    methods: {
        getSalesReport: async function(){
            try {
                
                const url = this.backend + '/api/sales/date?api_token=' + this.user.api_token + '&from=' + this.fromDate + '&to=' + this.toDate;

                const response = await axios.get(url);

                console.log(response);

            } catch (error) {
                

                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                }else {
                    console.log(error);
                }
            }
        }
    }
}
</script>

<style>

</style>