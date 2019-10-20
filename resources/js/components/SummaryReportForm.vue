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
                                placeholder="Tour Date" v-model="summaryReport.from_date">
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
                                placeholder="Tour Date" v-model="summaryReport.to_date" >
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
                    <tr v-for="item in summary_items" :key="item.id"
                        class="bg-white text-xs">
                        <td class="py-2 px-4 border border-gray-800"> {{ item.tour_date }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ item.grp_code }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ item.tour_guide }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ item.adult_count }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ item.children_count }} </td>
                        <td class="py-2 px-4 border border-gray-800"> 0 </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ item.total_agent_sales }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ item.total_commissions }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ item.gst }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ item.grand_total_commission }} </td>
                    </tr>
                    <tr class="bg-blue-200 text-xs">
                        <td class="py-2 px-4 border border-gray-800"></td>
                        <td class="py-2 px-4 border border-gray-800"></td>
                        <td class="py-2 px-4 border border-gray-800">TOTAL</td>
                        <td class="py-2 px-4 border border-gray-800"> {{ summaryReport.adult_count_total }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ summaryReport.children_count_total }} </td>
                        <td class="py-2 px-4 border border-gray-800"> 0 </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ summaryReport.sales_total }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ summaryReport.agent_commissions_total }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ summaryReport.gst_total }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ summaryReport.total }} </td>
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
                    <tr  class="bg-white text-xs">
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4"></td>
                        <td class="py-2 px-4" colspan="2">
                            <button class="flex items-center w-full mt-5 py-2 px-4 text-white bg-indigo-600
                                        rounded-full justify-center focus:outline-none hover:bg-indigo-700"
                                        @click="createReport"> 
                                Submit 
                            </button>
                        </td>
                    </tr>
                </tbody>
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
            summary_items: [],
            summaryReport: {
                report_number: this.createReportNumber(),
                from_date: '',
                to_date: '',
                summary_items: [],
                adult_count_total: 0,
                children_count_total: 0,
                tc_count: 0,
                sales_total: 0,
                agent_commissions_total: 0,
                gst_total: 0,
                total: 0,
                return: 0,
                duvet_deduction: 0,
                balance: 0
            }
        }
    },
    methods: { 

        createReportNumber: function(){
            const today = new Date();

            return `${today.getFullYear()}${today.getMonth() + 1}${today.getDate()}-${today.getHours()}${today.getMinutes()}${today.getMilliseconds()}`;
        },
        initializedData: function(){
            this.summaryReport.children_count_total = 0;
            this.summaryReport.adult_count_total = 0;
            this.summaryReport.tc_count = 0;
            this.summaryReport.sales_total = 0;
            this.summaryReport.agent_commissions_total = 0;
            this.summaryReport.gst_total = 0;
            this.summaryReport.total = 0;
        },
        getSalesReport: async function(){
            try {
                
                const url = this.backend + '/api/sales/date?api_token=' + this.user.api_token + 
                    '&from=' + this.summaryReport.from_date + '&to=' + this.summaryReport.to_date;

                const response = await axios.get(url);

                this.summary_items = response.data.data;

                this.initializedData();

                this.computeTotal();

                console.log(this.summaryReport.summary_items);

            } catch (error) {
                
                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                }else {
                    console.log(error);
                }
            }
        },
        computeTotal: function(){

            if(this.summary_items.length > 0){
                
                this.summary_items.forEach(item => {

                    const summaryItem = {
                        sales_report_id: item.id
                    }

                    this.summaryReport.summary_items.push(summaryItem);

                    this.summaryReport.adult_count_total = this.summaryReport.adult_count_total + item.adult_count;
                    this.summaryReport.children_count_total = this.summaryReport.children_count_total + item.children_count;
                    this.summaryReport.sales_total = this.summaryReport.sales_total + item.total_agent_sales;
                    this.summaryReport.agent_commissions_total = this.summaryReport.agent_commissions_total + item.total_commissions;
                    this.summaryReport.gst_total = this.summaryReport.gst_total + item.gst;
                    this.summaryReport.total = this.summaryReport.total + item.grand_total_commission;
                });

                console.log(this.summaryReport.summary_items);
            }
        },
        createReport: async function(){
            try {

                console.log('Creating Report');

                const url = this.backend + '/api/summaries';

                const data = {
                    ...this.summaryReport,
                    api_token: this.user.api_token
                }

                const response = await axios.post(url, data);

                console.log(response);

            } catch (error) {

                console.log(error.response);

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