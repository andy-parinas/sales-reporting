<template>
    <div>
        <div class="px-4 flex justify-between mt-5">
            <div class="border border-gray-700 flex-1 mr-4">
                <div class="flex">
                    <div class="border-b border-r border-gray-700 p-1 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Tour Agent</label>
                    </div>
                    <div  class="flex-1 p-1 border-b border-gray-700">
                        <select class="w-full pl-10 focus:outline-none"  type="text" id="agent" 
                            placeholder="Tour Agent Name" 
                            @change="tourAgentSelect" v-model="form.tour_agent_id" >
                                <option disabled value="" > --- Select Tour Agent ---</option>
                                <option v-for="agent in tourAgents" :key="agent.id"
                                    :value="agent.id">{{ agent.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-b border-r border-gray-700 p-1 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="pax">PAX</label>
                    </div>
                    <div  class="flex-1 p-1 border-b border-gray-700 flex items-center">
                        <input class=" flex-1 pl-10 border-r border-gray-700 focus:outline-none"  
                            type="text" id="pax" placeholder="Adult" v-model.number="form.adult_count" >
                        <input class=" flex-1 pl-10 focus:outline-none"  type="text" id="pax" 
                            placeholder="Children" v-model.number="form.children_count" >
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r border-gray-700 p-1 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="guide">Guide Name</label>
                    </div>
                    <div class="flex-1 p-1 border-gray-700">
                        <select class="w-full pl-10 focus:outline-none"  type="text" id="guide" placeholder="Guide Name"
                                v-model="form.tour_guide_id">
                            <option disabled value="" > --- Select Tour Guide ---</option>
                            <option v-for="guide in tourGuides" :key="guide.id"
                                :value="guide.id">{{ guide.name }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="border border-gray-700 flex-1">
                    <div class="flex">
                        <div class="border-b border-r border-gray-700 p-1 w-32 text-center">
                            <label class="text-sm font-semibold text-gray-800 uppercase" for="date">Date</label>
                        </div>
                        <div class="flex-1 p-1 border-b border-gray-700">
                            <input class="w-full focus:outline-none pl-10" type="date" id="date" 
                                placeholder="Tour Date"  value="2018-07-22" >
                        </div>
                    </div>
                    <div class="flex">
                        <div class="border-b border-r border-gray-700 p-1 w-32 text-center">
                            <label class="text-sm font-semibold text-gray-800 uppercase" for="grp">GRP Code</label>
                        </div>
                        <div class="flex-1 p-1 border-b border-gray-700">
                            <input class="w-full pl-10 focus:outline-none" type="numner" id="grp" placeholder="GRP Code"
                                    v-model="form.grp_code">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="border-r border-gray-700 p-1 w-32 text-center">
                            <label class="text-sm font-semibold text-gray-800 uppercase" for="tc">T/C Name</label>
                        </div>
                        <div class="flex-1 p-1 border-gray-700">
                            <input class="w-full pl-10 focus:outline-none" type="text" id="tc" placeholder="T/C Name"
                                v-model="form.tc_name">
                        </div>
                    </div>
                </div>
        </div>
        <div class="px-4 flex justify-between mt-5 items-start mb-20">
            <div  class="flex-1 mr-4">
                <product-selection :user="user" @select="selectProduct" ></product-selection>
            </div>
            <div class="flex-1">
                <div class="mb-4">
                    <h2>Shopping Details</h2>
                </div>

                <selected-product :products="form.selected_products" 
                    :subtotal="form.total_sales" 
                    @remove="removeSelection" ></selected-product>

                <deductions :deductions="form.sales_deductions" :totalDeductions="form.total_deductions">
                </deductions>

                <total-sales :commissions="form.sales_commissions"
                            :totalSales="form.total_sales"
                            :totalDeduction="form.total_deductions"
                            :totalAgentSales='form.total_agent_sales'
                            :totalCommissions="form.total_commissions"
                            :gst="form.gst"
                            :grandTotal="form.grand_total_commission" >
                </total-sales>

                <button class="flex items-center w-full mt-5 py-2 px-4 bg-indigo-600 text-white rounded-full justify-center focus:outline-none" @click="submit">
                    <div class="text-white w-5 h-5" title="2">
                       <div v-if="creating" >
                           <circle-loader></circle-loader>
                       </div>
                    </div>
                    <div v-if="creating" >Creating Report</div>
                    <div v-else >Create Report</div>
                </button>
                
            </div>
        </div>
    </div>
</template>

<script>
import ProductSelection from './ProductSelection';
import SelectedProduct from './SelectedProduct';
import Deductions from './Deductions';
import TotalSales from './TotalSales';
import CircleLoader from './ui/loader/CircleLoader';
import { async } from 'q';

export default {
    name: 'SalesReportForm',
    components: {ProductSelection, SelectedProduct, Deductions, TotalSales, CircleLoader},
    props: ['user'],
    data: function(){
        return {
            commissionReference: [],
            deductionReference: [],
            tourAgents: [],
            tourGuides: [],
            creating: false,
            code1Count: 0,
            code1Total: 0,
            code2Total: 0,
            form: {
                    tour_agent_id: '',
                    tour_guide_id: '',
                    tc_name: null,
                    grp_code: null,
                    adult_count: '',
                    children_count: '',
                    total_sales: 0,
                    total_agent_sales: 0,
                    total_deductions: 0,
                    total_commissions: 0,
                    gst: 0,
                    grand_total_commission: 0,
                    guide_incentive: 0,
                    delivery: 0,
                    service: 0,
                    total: 0,
                    selected_products: [],
                    sales_commissions: [],
                    sales_deductions: []
            }
        }
    },
    methods: {

        loadSalesCommissionReference: async function()
        {
            try {
                
                const commissionsUrl =  backendUrl + '/api/commissions?api_token=' + this.user.api_token;
                const commissionResponse = await axios.get(commissionsUrl);
                this.commissionReference = commissionResponse.data;

                //initialize the sales_commission
                this.commissionReference.forEach(ref => {

                    const salesCommission = {
                        id: ref.id,
                        name: ref.name,
                        type: ref.commission_type,
                        percentage: ref.amount,
                        amount: 0
                    }

                this.form.sales_commissions.push(salesCommission);

            });
            } catch (error) {
                console.log('Error Loading Commission Reference:', error);
            }

        },

        loadDeductionsReference: async function()
        {
            try {
                
                const deductionUrl = backendUrl + '/api/deductions?api_token=' + this.user.api_token;
                const deductionResponse = await axios.get(deductionUrl);
                this.deductionReference = deductionResponse.data;

                //initialize deductions
                this.deductionReference.forEach(ref => {
                    const deduction = {
                        id: ref.id,
                        name: ref.name,
                        amount: 0,
                        type: ref.type,
                        multiplier: ref.amount
                    }

                    this.form.sales_deductions.push(deduction);
                })


            } catch (error) {
                console.log('Error Loading Deduction Reference:', error);
            }

        },

        loadTourAgents: async function()
        {
            try {
                const url = backendUrl + '/api/agents?api_token=' + this.user.api_token;
                const response = await axios.get(url);

                this.tourAgents = response.data.data;


            } catch (error) {
                console.log('Error Loading Tour Agents:', error);
            }
        },

        tourAgentSelect: async function()
        {
            try {
                
                const url = backendUrl + `/api/agents/${this.form.tour_agent_id}?api_token=${this.user.api_token}`;
                const response = await axios.get(url);

                this.tourGuides = response.data.data.tourGuides;

            } catch (error) {
                console.log('Error Loading Tour Guides:', error);
            }
        },
        computeCommission: function()
        {

            let totalCommissions = 0;

            this.form.sales_commissions.forEach((commission, index) => {

                if(commission.type === 1) {
                    this.form.sales_commissions[index].amount = commission.percentage * this.code1Total;
                }else if(commission.type === 2){
                    this.form.sales_commissions[index].amount = commission.percentage * this.code2Total;
                }else {
                    this.form.sales_commissions[index].amount = commission.percentage * this.form.total_agent_sales;
                }

                totalCommissions =  totalCommissions + this.form.sales_commissions[index].amount;
               

            });

            this.form.total_commission = totalCommissions;
            // this.form.total_agent_sales = this.form.total_sales - this.this.form.total_deductions;
            this.form.gst = this.form.total_commission * 0.10;
            this.form.grand_total_commission = this.form.gst + this.form.total_commission;


        },

        computeDeduction: function(product, action)
        {

            let total = 0;

            this.form.sales_deductions.forEach((deduction, index) => {


                if(deduction.type === 1){

                    this.form.sales_deductions[index].amount = this.code1Count * this.form.sales_deductions[index].multiplier

                }else if(deduction.type === 3 && product.qty >= 1 && product.total === 0){

                    console.log('Type3', deduction.type)

                    if(action === 'add'){
                        this.form.sales_deductions[index].amount = this.form.sales_deductions[index].amount + product.cost;
                    }else {
                        this.form.sales_deductions[index].amount = this.form.sales_deductions[index].amount - product.cost;
                    }

                }

                total = total + deduction.amount;

            })

            this.form.total_deductions = total;

        },

        selectProduct: function(product){

            /**
             * Type1 or Code1 products are Carpets which are high value
             * Type2 or Code2 products are low value
             * 
             * For deduction Type3 this is a service product 
             * service products are free when purchase a high value products
             * deduction amount is the product cost.
             */

            this.form.selected_products.push(product);

            this.form.total_sales = this.form.total_sales + product.total;

            if(product.code === 1) {
                this.code1Total = this.code1Total + product.total;
                this.code1Count = this.code1Count + product.qty;
            }

            if(product.code === 2) this.code2Total = this.code2Total + product.total;

   
            //Compute for Deductions
            this.computeDeduction(product, 'add');

            this.form.total_agent_sales = this.form.total_sales - this.form.total_deductions
          
       
            // //Compute for Commisions:
            this.computeCommission();

        },
        removeSelection: function(index){

            const removedProduct = this.form.selected_products.splice(index, 1);

            if(removedProduct[0].code === 1){
                this.code1Count = this.code1Count - removedProduct[0].qty;
                this.code1Total = this.code1Total - removedProduct[0].total;
            }

            if(removedProduct[0].code === 2){
                this.code2Total = this.code2Total - removedProduct[0].total;
            }


            this.form.total_sales  = this.form.total_sales - removedProduct[0].total;

            this.computeDeduction(removedProduct[0], 'remove');

            this.form.total_agent_sales = this.form.total_sales - this.form.total_deductions

            this.computeCommission();

        },

        submit: async function()
        {
            // console.log('submit');
            // window.axios.post('/sales', {}).then(res =>{
            //     window.location.href = '/sales';
            // }).catch(err => {
            //     console.log(err);
            // })
             this.creating = true;

            // try {
                
            //     const data = {
            //         ...this.form,
            //         api_token: this.user.api_token
            //     }

            //     response = await axios.post(backendUrl + '/api/sales', data)

            //     this.creating = false;

            //     console.log(response.data);

            // } catch (error) {
                
            //     console.log(error);

            //     this.creating = false;
            // }



        }
    },
    async mounted()
    {
        this.loadSalesCommissionReference();

        this.loadDeductionsReference();
    
        this.loadTourAgents();

    }
   
}
</script>

<style>

</style>