<template>
    <div>
        <div class="px-4 flex justify-between mt-5">
            <div class="border border-gray-700 flex-1 mr-4">
                <div class="flex">
                    <div class="border-b border-r border-gray-700 p-1 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Tour Agent</label>
                    </div>
                    <div  class="flex-1 p-1 border-b border-gray-700">
                        <input class="w-full pl-10 focus:outline-none"  type="text" id="agent" 
                            placeholder="Tour Agent Name" list="agents">
                            <datalist id="agents">
                                <option value="Internet Explorer"></option>
                                <option value="Firefox"></option>
                                <option value="Chrome"></option>
                                <option value="Opera"></option>
                                <option value="Safari"></option>
                            </datalist>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-b border-r border-gray-700 p-1 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="pax">PAX</label>
                    </div>
                    <div  class="flex-1 p-1 border-b border-gray-700 flex items-center">
                        <input class=" flex-1 pl-10 border-r border-gray-700 focus:outline-none"  
                            type="text" id="pax" placeholder="Adult">
                        <input class=" flex-1 pl-10 focus:outline-none"  type="text" id="pax" 
                            placeholder="Children">
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r border-gray-700 p-1 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="guide">Guide Name</label>
                    </div>
                    <div class="flex-1 p-1 border-gray-700">
                        <input class="w-full pl-10 focus:outline-none"  type="text" id="guide" placeholder="Guide Name">
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
                            <input class="w-full pl-10 focus:outline-none" type="numner" id="grp" placeholder="GRP Code">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="border-r border-gray-700 p-1 w-32 text-center">
                            <label class="text-sm font-semibold text-gray-800 uppercase" for="tc">T/C Name</label>
                        </div>
                        <div class="flex-1 p-1 border-gray-700">
                            <input class="w-full pl-10 focus:outline-none" type="text" id="tc" placeholder="T/C Name">
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

                <selected-product :products="selected_products" 
                    :subtotal="subTotal" 
                    @remove="removeSelection" ></selected-product>

                <deductions 
                    :incentive="guideIncentive" 
                    :delivery="delivery"
                    :service="service" 
                    :subtotal="deductionSubTotal"></deductions>

                <total-sales :commissions="commissions" 
                            :totalSales="subTotal"
                            :deductions="deductionSubTotal"
                            :totalAgentSales="totalAgentSales"></total-sales>

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

export default {
    name: 'SalesReportForm',
    components: {ProductSelection, SelectedProduct, Deductions, TotalSales, CircleLoader},
    props: ['user'],
    data: function(){
        return {
            commissionReference: null,
            creating: false,
            code1Count: 0,
            code1Total: 0,
            code2Total: 0,
            form: {
                    tour_agent_id: null,
                    tour_guide_id: null,
                    tc_name: null,
                    grp_code: null,
                    adult_count: null,
                    children_count: null,
                    total_sales: 0,
                    total_agent_sales: 0,
                    total_commission: 0,
                    gst: 0,
                    grand_total_commission: 0,
                    guide_incentive: 0,
                    delivery: 0,
                    service: 0,
                    total: 0,
                    selected_products: [],
                    sales_commissions: [],
            }
        }
    },
    methods: {
        selectProduct: function(product){


            this.form.selected_products.push(product);

            //convert to integer
            // const qty = parseInt(product.qty)
            // const total = parseInt(product.total);

            this.subTotal = this.subTotal + total

            //Compute Deductions Based on Product Codes
            if(product.code === 1){
                this.code1Count = this.code1Count + product.qty;
                this.code1Total = this.code1Total + product.total;
            }

            if(product.code === 2){
                this.code2Total = this.code2Total + total;
            }

            if(qty >= 1 && total === 0){
                this.service = this.service + (qty * product.cost);
            }

            // Compute for the Deductions
            this.guideIncentive = this.code1Count * 50;
            this.delivery = this.code1Count * 200;
            this.deductionSubTotal = this.guideIncentive + this.delivery + this.service;

            //Compute for Commisions:

            this.commissionReference.forEach(ref => {

                const salesCommission = {
                    id: ref.id,
                    name: ref.name,
                    amount: 0
                }

                if(ref.commission_type === 1) salesCommission.amount = this.code1Total * ref.amount;
                 if(ref.commission_type === 2) salesCommission.amount =this. code2Total * ref.amount;
                if(ref.commission_type === 3) salesCommission.amount = this.subTotal * ref.amount;
                if(ref.commission_type === 4) salesCommission.amount = this.subTotal * ref.amount;
                
                // if(ref.commission_type === 1) this.commissions.code1 = this.code1Total * ref.amount;
                // if(ref.commission_type === 2) this.commissions.code2 =this. code2Total * ref.amount;
                // if(ref.commission_type === 3) this.commissions.guide = this.subTotal * ref.amount;
                // if(ref.commission_type === 4) this.commissions.manager = this.subTotal * ref.amount;

                this.sales_commissions.push(salesCommission);

            });

            this.commissions.total = this.commissions.code1 + this.commissions.code2 
                + this.commissions.guide + this.commissions.manager;

            this.totalAgentSales = this.subTotal - this.deductionSubTotal;
            this.commissions.gst = this.commissions.total * 0.10;
            this.commissions.grandTotal = this.commissions.gst + this.commissions.total;

            console.log(this.commissions);

        },
        removeSelection: function(index){

            const removedProduct = this.selectedProducts.splice(index, 1);

            const qty = parseInt(removedProduct[0].qty);
            const total = parseInt(removedProduct[0].total);

            if(removedProduct[0].code === 1){
                this.code1Count = this.code1Count - qty;
                this.code1Total = this.code1Total - total;
            }

            if(removedProduct[0].code === 2){
                this.code2Total = this.code2Total - total;
            }

            if(qty >= 1 && total === 0){
                this.service = this.service - (qty * removedProduct[0].cost);
            }

            this.subTotal = this.subTotal - total;

            this.guideIncentive = this.code1Count * 50;
            this.delivery = this.code1Count * 200;

            this.deductionSubTotal = this.guideIncentive + this.delivery + this.service;

            this.commissionReference.forEach(ref => {
                
                if(ref.commission_type === 1) this.commissions.code1 = this.code1Total * ref.amount;
                if(ref.commission_type === 2) this.commissions.code2 =this. code2Total * ref.amount;
                if(ref.commission_type === 3) this.commissions.guide = this.subTotal * ref.amount;
                if(ref.commission_type === 4) this.commissions.manager = this.subTotal * ref.amount;

            });

            this.commissions.total = this.commissions.code1 + this.commissions.code2 
                + this.commissions.guide + this.commissions.manager;

            this.totalAgentSales = this.subTotal - this.deductionSubTotal;
            this.commissions.gst = this.commissions.total * 0.10;
            this.commissions.grandTotal = this.commissions.gst + this.commissions.total;


        },

        submit: function(){
            // console.log('submit');
            // window.axios.post('/sales', {}).then(res =>{
            //     window.location.href = '/sales';
            // }).catch(err => {
            //     console.log(err);
            // })
            this.creating = true;
        }
    },
    async mounted(){
        try {
            
            const url =  backendUrl + '/api/commissions?api_token=' + this.user.api_token;
            const response = await axios.get(url);

            this.commissionReference = response.data;

            console.log(this.commissionReference);

        } catch (error) {
            console.log('Error Loading Commissions', error);
        }
    }
   
}
</script>

<style>

</style>