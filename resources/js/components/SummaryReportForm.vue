<template>
  <div>

        <!-- IF Form is on Edit Mode -->
        <div v-if="edit"  class="mx-auto w-288">
            <div class="border border-gray-700 flex-1 mt-10 mb-5 w-168">
                <div class="flex">
                    <div class="border-b border-r border-gray-700 w-48 text-center  bg-gray-200">
                        <div  class="text-sm font-semibold text-gray-800 uppercase py-1" for="agent">Title</div>
                    </div>
                    <div  class="flex-1 border-b border-gray-700 py-1 pl-10 text-sm text-gray-800" >
                        <input class="w-full focus:outline-none py-1  pl-1 text-gray-800 text-sm bg-transparent"
                                type="text" id="date" placeholder="Product Name" 
                                v-model="summaryReport.title">
                    </div>
                </div>
                <div class="flex  bg-gray-200">
                    <div class="border-b border-r border-gray-700 w-48 text-center">
                        <div  class="text-sm font-semibold text-gray-800 uppercase py-1" for="agent">Report Number </div>
                    </div>
                    <div  class="flex-1 border-b border-gray-700 py-1 pl-10 text-sm text-gray-800 " >
                        {{ summaryReport.report_number}}
                    </div>
                </div>
                <div class="flex  bg-gray-200">
                    <div class="border-r border-gray-700 w-48 text-center">
                        <div  class="text-sm font-semibold text-gray-800 uppercase py-1" for="pax">From / To</div>
                    </div>
                    <div  class="flex-1 border-gray-700 flex items-center">
                        <div class="flex-1 py-1 pl-10 border-r border-gray-700 focus:outline-none  text-gray-800 text-sm">
                            {{ summaryReport.from_date}}
                        </div>
                        <div class="flex-1 py-1 pl-10 focus:outline-none  text-gray-800 text-sm">
                            {{ summaryReport.to_date }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- IF Form is on Create Mode -->
        <div v-else class="w-144 mx-auto" >
            <div class="flex items-center justify-center">
                <div class="px-4 flex justify-between mt-5">
                    <div class="border border-gray-700 flex-1 mr-4">
                        <div class="flex">
                            <div class="border-r border-gray-700 w-32 text-center py-2 ">
                                <label class="text-sm font-semibold text-gray-800 uppercase" for="date">From</label>
                            </div>
                            <div class="flex-1 border-gray-700" :class="errors && errors.from_date ? 'bg-red-200' : ''">
                                <input class="w-full focus:outline-none py-2 px-2 uppercase text-gray-800 text-sm bg-transparent" 
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
                            <div class="flex-1border-gray-700" :class="errors && errors.to_date ? 'bg-red-200' : ''">
                                <input class="w-full focus:outline-none py-2 px-2 uppercase text-gray-800 text-sm bg-transparent"
                                    type="date" id="date" 
                                    placeholder="Tour Date" v-model="summaryReport.to_date" >
                            </div>
                        </div>
                    </div>
                    <button class="bg-blue-600 py-2 px-2 text-white rounded" @click="getSalesReport" >Go</button>
                </div>
            </div>
            <div v-if="noResults" class="mt-2 mb-3  flex items-center justify-center">
                <h1 class="text-red-700 font-semibold text-lg mr-3">No Results Found</h1>
                <h3 class="text-gray-800">Please select another date range</h3>
            </div>
            <div  v-if="errors" class="mt-2 mb-3  flex items-center justify-center">
                <h1 class="text-red-700 font-semibold text-lg mr-3">Error Connecting</h1>
                <h3 class="text-gray-800">Please check your internet or report to I.T.</h3>
            </div>
        </div>
        <div class="mx-auto w-288">
            <div v-if="!edit" class="border border-gray-700 mt-10 mb-5 " :class="errors && errors.title ? 'bg-red-200' : 'bg-green-200'"> 
                <div class="flex">
                    <div class="border-r py-1  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Report Title</label>
                    </div>
                    <div  class="flex-1 border-gray-700" >
                        <input class="w-full focus:outline-none py-2  pl-10 text-gray-800 text-sm bg-transparent"
                            type="text" id="date" placeholder="Product Name" 
                            v-model="summaryReport.title">
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
                        </th><th class="py-2 px-2 border-r border-gray-800 w-40">
                            Guide Name
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800 w-16">A</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-16">C</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-16">TC</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-24 text-right">Sales</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-24 text-right">Commission</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-24 text-right">GST</th>
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
                        <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">
                            <input type="text" class="w-full bg-transparent px-2 text-right"
                                placeholder="0"
                                v-model.number="summaryReport.return">
                        </td>
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
                        <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">
                            <input type="text" class="w-full bg-transparent px-2 text-right"
                                placeholder="0"
                                v-model.number="summaryReport.duvet_deduction">
                        </td>
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
                        <td class="bg-yellow-300 py-2 px-4 border border-gray-800 text-right">
                             <input type="text" class="w-full bg-transparent px-2 text-right"
                                placeholder="0" disabled
                                v-model.number="summaryReport.balance">
                        </td>
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
                            <button v-if="edit" class="flex items-center w-full mt-5 py-2 px-4 text-white bg-indigo-600
                                        rounded-full justify-center focus:outline-none hover:bg-indigo-700"
                                        @click="updateReport"> 
                                Update 
                            </button>
                             <button v-else class="flex items-center w-full mt-5 py-2 px-4 text-white bg-indigo-600
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
    props: ['user', 'backend', 'edit', 'summary', 'items'],
    data: function(){
        return {
            summary_items: [],
            summaryReport: {
                title: '',
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
            },
            errors: null,
            noResults: false
        }
    },
    watch: {
        'summaryReport.return': function(newvalue, oldValue){
            this.summaryReport.balance = (this.summaryReport.total - (newvalue + this.summaryReport.duvet_deduction)).toFixed(2);
        },
         'summaryReport.duvet_deduction': function(newvalue, oldValue){
            this.summaryReport.balance = (this.summaryReport.total - (newvalue + this.summaryReport.return)).toFixed(2);
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

                this.noResults = false;
                this.errors = null;
                
                const url = this.backend + '/api/sales/date?api_token=' + this.user.api_token + 
                    '&from=' + this.summaryReport.from_date + '&to=' + this.summaryReport.to_date;

                const response = await axios.get(url);

                this.summary_items = response.data.data;

                this.initializedData();

                this.computeTotal();

                if(this.summary_items.length === 0){
                    this.noResults = true;
                }else {
                    this.noResults = false;
                }

            } catch (error) {
                
                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                    console.log(this.errors);
                }else {
                    this.errors = 'Unknown Error';
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
                    this.summaryReport.balance = this.summaryReport.total - (this.summaryReport.return + this.summaryReport.duvet_deduction);
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

                window.location.href = '/summaries/' + response.data.id;

            } catch (error) {

                console.log(error.response);

                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                    console.log(this.errors);
                }else {
                    console.log(error);
                }
            }
        },

        updateReport: async function(){
            
            try {

                 const data = {
                    ...this.summaryReport,
                    api_token: this.user.api_token
                }
                
                const url = this.backend + '/api/summaries/' + this.summary.id;

                const response = await axios.patch(url, data);

                window.location.href = '/summaries/' + response.data.id;

            } catch (error) {

                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                    console.log(this.errors);
                }else {
                    console.log(error);
                }
            }
        }
    },

    mounted(){

        if(this.edit){

            this.items.forEach(item => {
                this.summary_items.push(item.sales_report);
            });

            this.summaryReport = {
                ...this.summary
            }

        }
    }
}
</script>

<style>

</style>