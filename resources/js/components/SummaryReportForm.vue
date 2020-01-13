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
        <div v-else class="mx-auto w-288">
            <div class="mt-10">            
                <div class="flex items-center">
                    <div class="mr-5">
                        <h1>Generate Report For</h1>
                    </div>
                    <div class="mr-5">
                        <input type="radio" name="selection" value="TOUR_AGENT" v-model="selectedReport" @click="selectReport('TOUR_AGENT')">
                        <label > Tour Agent </label>
                    </div>
                    <div>
                        <input type="radio" name="selection" value="TOUR_GUIDE" v-model="selectedReport" @click="selectReport('TOUR_GUIDE')" >
                        <label > Tour Guide </label>
                    </div>
                </div>
            </div>
            <div>
                <div class="mt-10 flex items-center">
                    <div   v-if="selectedReport === 'TOUR_AGENT'" class="flex items-center flex-1 mr-5">
                        <label class="w-32 mr-2" for="agent">Tour Agent</label>
                        <select class="w-full py-1 pl-10 focus:outline-none text-gray-800 text-sm border border-gray-800" 
                                type="text" id="agent" placeholder="Tour Agent Name" @change="tourAgentSelected" v-model="selectedTourAgent" >

                            <option disabled value="" > --- Select Tour Agent ---</option>
                            <option v-for="agent in tourAgents" :key="agent.id"
                                :value="agent.id">{{ agent.name }}</option>
                        </select>
                    </div>
                    <div  v-if="selectedReport === 'TOUR_GUIDE'" class="flex items-center flex-1  mr-5">
                        <label class="mr-2 w-32" for="guide">Tour Guides</label>
                        <select class="w-full py-1 pl-10 focus:outline-none text-gray-800 text-sm border border-gray-800"   
                                type="text" id="guide" placeholder="Guide Name" @change="tourGuideSelected" v-model="selectedTourGuide" >
                            <option disabled value="" > --- Select Tour Guide ---</option>
                            <option v-for="guide in tourGuides" :key="guide.id"
                                :value="guide.id">{{ guide.name }}</option>
                        </select>
                    </div>
                     <div  v-if="selectedReport" class="flex items-center flex-1">
                        <label class="mr-2 w-32" for="commission">Commissions</label>
                        <select class="w-full py-1 pl-10 focus:outline-none text-gray-800 text-sm border border-gray-800" 
                                type="text" id="commission" placeholder="Commission" @change="commissionSelected" v-model="summaryReport.commission_id" >

                            <option disabled value="" > --- Select Commission ---</option>
                            <option v-for="commission in commissions" :key="commission.id"
                                :selected="commission.name === 'TG' && selectedReport==='TOUR_GUIDE'"
                                :disabled="(selectedReport==='TOUR_AGENT' && commission.name === 'TG') || (selectedReport==='TOUR_GUIDE' && commission.name !== 'TG')"
                                :value="commission.id">{{ commission.name }} </option>
                        </select>
                    </div>
                </div>

                <div v-if="selectedReport">
                    <div  class="flex items-center mt-5">
                        <div class="flex items-center flex-1 mr-5">
                            <label class="w-32 mr-2" for="agent">From Date</label>
                            <input class="w-full py-1 pl-10 focus:outline-none text-gray-800 text-sm border border-gray-800 uppercase"  
                                        type="date" id="date" 
                                        placeholder="Tour Date" v-model="summaryReport.from_date">
                        </div>
                        <div class="flex items-center flex-1">
                            <label class="w-32 mr-2" for="agent">To Date</label>
                            <input class="w-full py-1 pl-10 focus:outline-none text-gray-800 text-sm border border-gray-800 uppercase" 
                                        type="date" id="date" 
                                        placeholder="Tour Date" v-model="summaryReport.to_date" >
                        </div>
                    </div>
                    <div class="flex mt-5">
                        <button class="bg-blue-600 py-2 px-2 text-white rounded flex-1" @click="getSalesReport" >Generate Report</button>
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

            </div>


            
            <div v-if="!edit" class="border border-gray-700 mt-10 mb-5 " :class="errors && errors.title ? 'bg-red-200' : 'bg-green-200'"> 
                <div class="flex">
                    <div class="border-r py-1  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Report Title</label>
                    </div>
                    <div  class="flex-1 border-gray-700" >
                        <input class="w-full focus:outline-none py-2  pl-10 text-gray-800 text-sm bg-transparent"
                            type="text" id="date" placeholder="Report Title" 
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

                        <th class="py-2 px-2 border-r border-gray-800 w-16">A</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-16">C</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-16">TC</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-24 text-right">Sales</th>
                        <th class="py-2 px-2 border-r border-gray-800 w-24 text-right">Commmission</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in summaryReport.summary_items" :key="item.id"
                        class="bg-white text-xs">
                        <td class="py-2 px-4 border border-gray-800"> {{ item.tour_date }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ item.adult_count }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ item.children_count }} </td>
                        <td class="py-2 px-4 border border-gray-800"> 0 </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ item.total_agent_sales }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ item.commission }} </td>
                    </tr>
                    <tr class="bg-blue-200 text-xs">
                        <!-- <td class="py-2 px-4 border border-gray-800"></td>
                        <td class="py-2 px-4 border border-gray-800"></td> -->
                        <td class="py-2 px-4 border border-gray-800">TOTAL</td>
                        <td class="py-2 px-4 border border-gray-800"> {{ summaryReport.adult_count_total }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ summaryReport.children_count_total }} </td>
                        <td class="py-2 px-4 border border-gray-800"> 0 </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ summaryReport.sales_total }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ summaryReport.commission }} </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex mt-5" v-if="formIsValid">
                <button class="py-2 px-2 text-white rounded flex-1" @click="createSummaryReport"
                    :class="success? 'bg-green-600' : 'bg-blue-600'" >
                    <span v-if="saving" >Creating Report</span>
                    <span v-else >Create Report</span>
                </button>
            </div>
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
                commission_id: 0,
                commission: 0,

            },
            saving: false,
            success: false,
            errors: null,
            noResults: false,
            selectedReport: null,
            tourGuides: [],
            tourAgents: [],
            commissions: [],
            reportable: '',
            reportable_id: '',
            selectedTourAgent: '',
            selectedTourGuide: '',
            selectedCommission: ''
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

    computed: {
        formIsValid: function(){

            return (this.selectedTourGuide || this.selectedTourAgent) && this.summaryReport.commission_id && this.summaryReport.summary_items.length > 0
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
            this.summaryReport.commission = 0;
            this.summaryReport.gst_total = 0;
            this.summaryReport.total = 0;
            this.summaryReport.summary_items = [];
        },
        getSalesReport: async function(){
            try {

                this.noResults = false;
                this.errors = null;
                
                const url = this.backend + '/api/sales/date?api_token=' + this.user.api_token + 
                    '&from=' + this.summaryReport.from_date + '&to=' + this.summaryReport.to_date + 
                    '&agent=' + this.selectedTourAgent + '&guide=' + this.selectedTourGuide;

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

                   

                    this.summaryReport.adult_count_total = this.summaryReport.adult_count_total + item.adult_count;
                    this.summaryReport.children_count_total = this.summaryReport.children_count_total + item.children_count;
                    this.summaryReport.sales_total = parseFloat((this.summaryReport.sales_total + item.total_agent_sales).toFixed(2));
                    // this.summaryReport.agent_commissions_total = this.summaryReport.agent_commissions_total + item.total_commissions;
                    this.summaryReport.gst_total = this.summaryReport.gst_total + item.gst;
                    this.summaryReport.total = parseFloat((this.summaryReport.total + item.grand_total_commission).toFixed(2));
                    this.summaryReport.balance = this.summaryReport.total - (this.summaryReport.return + this.summaryReport.duvet_deduction);

                    let itemCommission = 0;

                    // console.log(item)

                    item.sales_commissions.forEach(sc => {

                        if(sc.tour_commission.commission.id === this.summaryReport.commission_id){
                            itemCommission = itemCommission + sc.amount
                        }

                    })

                    this.summaryReport.commission = parseFloat((this.summaryReport.commission + itemCommission).toFixed(2));


                     const summaryItem = {
                        sales_report_id: item.id,
                        tour_date: item.tour_date,
                        adult_count: item.adult_count,
                        children_count: item.children_count,
                        total_agent_sales: item.total_agent_sales,
                        commission: parseFloat(itemCommission.toFixed(2))
                    }

                    this.summaryReport.summary_items.push(summaryItem);


                });

                console.log('Summary Items', this.summaryReport.summary_items);

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
        },

        loadTourAgents: async function(){

            try {
                const url = this.backend + '/api/agents?api_token=' + this.user.api_token;
                const response = await axios.get(url);

                this.tourAgents = response.data.data;


            } catch (error) {
                console.log('Error Loading Tour Agents:', error);
            }

        },
        loadTourGuides: async function(){

              try {
                
                const url = this.backend + `/api/guides?api_token=${this.user.api_token}`;
                const response = await axios.get(url);

                this.tourGuides = response.data.data;

            } catch (error) {
                console.log('Error Loading Tour Guides:', error);
            }

        },
        loadCommissions: async function(){

            try {
                
                const url = this.backend + '/api/commissions?api_token=' + this.user.api_token
                const response = await axios.get(url);

                this.commissions = response.data;


            } catch (error) {
                console.log('Error Loading Tour Commissions:', error);
            }

        },

        tourAgentSelected: function(){
            this.reportable_id = this.selectedTourAgent;
        },

        tourGuideSelected: function(){
            this.reportable_id = this.selectedTourGuide;
        },
        commissionSelected: function(){
            console.log(this.summaryReport.commission_id);
        },
        selectReport: function(report){
            if(report === 'TOUR_GUIDE'){
                this.selectedCommission = '';
                this.selectedTourAgent = '';

                this.reportable = 'GUIDE';

            }

            if(report === 'TOUR_AGENT' ){
                this.selectedCommission = '';
                this.selectedTourGuide = '';

                this.reportable = 'AGENT';

            }
        },

        createSummaryReport: async function(){
            try {

                this.saving = true;
                    
                const url = this.backend + '/api/summaries?reportable=' + this.reportable + '&id=' + this.reportable_id

                const data = {
                    ...this.summaryReport,
                    api_token: this.user.api_token
                }

                console.log(data);

                const response = await axios.post(url, data);
                this.saving = false;
                this.success = true;
                this.errors = null;

            } catch (error) {
                
                console.error(error);
            }


        }
    },

    mounted(){

        this.loadTourAgents();

        this.loadTourGuides();

        this.loadCommissions();

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