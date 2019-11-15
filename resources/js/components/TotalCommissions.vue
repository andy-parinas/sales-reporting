<template>
    <div>
        <div v-if="message" 
            class="flex border border-gray-700 mt-5 items-center text-sm text-white py-4 px-8 rounded"
            :class="error? 'bg-red-600' : 'bg-gray-600'">
            <p> {{ message}} </p>
        </div>
        <div v-else class="flex border border-gray-700 mt-5 items-start text-sm bg-green-200">
            <div class="flex-1">
                <div class="flex justify-between border-b border-gray-700">
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Sales</div>
                    <div class="w-32  px-2 py-1 text-right"> 
                        <currency-format :value="totalSales" ></currency-format>
                    </div>
                </div>
                <div class="flex justify-between border-b-2 border-gray-700">
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">Deductions</div>
                    <div class="w-32  px-2 py-1 text-right"> 
                        <currency-format :value="totalDeduction" ></currency-format>
                    </div>
                </div>
                <div class="flex justify-between border-b border-gray-700" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Agent Sales</div>
                    <div class="w-32  px-2 py-1 text-right">
                        <currency-format :value="totalAgentSales" ></currency-format>
                    </div>
                </div>
                <div class="flex justify-between border-b border-gray-700"
                    v-for="type in commissionTypes" :key="type.id" >
                    <div class="flex-1 border-gray-700 border-r flex">
                        <div class="border-r border-gray-700 px-2 py-1 w-48">{{ type.name }}</div>
                        <div class="flex-1">
                            <div v-for="commission in commissions" :key="commission.id" 
                                class="border-b border-gray-700 flex items-center justify-between">
                                <div class="flex-1 px-2 py-1 "> {{ commission.name }} </div>
                                <div class="flex-1 px-2 py-1 text-right"> 
                                    <input type="number" class="w-full bg-transparent text-right" v-model.number="input[type.code][commission.id]" >
                                </div>
                                <div class="w-32 text-right border-l border-gray-700 px-2 py-1">
                                    {{ computedCommissions[type.id][commission.id] }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="flex justify-between border-b border-gray-700 h-8" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1"></div>
                    <div class="w-32  px-2 py-1">  </div>
                </div>
                <div v-for="commission in commissions" :key="commission.name" class="flex justify-between border-b border-gray-700" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1 font-semibold"> Total {{commission.name}} </div>
                    <div class="w-32  px-2 py-1 text-right">
                        <currency-format :value="totalByCommission[commission.id]"></currency-format>
                    </div>
                </div>
                
                <div class="flex justify-between border-b border-gray-700 h-8" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1"></div>
                    <div class="w-32  px-2 py-1">  </div>
                </div>

                <div class="flex justify-between border-b border-gray-700" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Agent Commission</div>
                    <div class="w-32  px-2 py-1 text-right">
                        <currency-format :value="totalCommissions"></currency-format>
                    </div>
                </div>
                <div class="flex justify-between border-b border-gray-700" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">GST</div>
                    <div class="w-32  px-2 py-1 text-right">
                        <currency-format :value="gst"></currency-format>
                    </div>
                </div>
                <div class="flex justify-between font-semibold bg-green-400">
                    <div class="flex-1 border-gray-700 border-r  px-2 py-1">Grand Total Agent Commission</div>
                    <div class="w-32  px-2 py-1 text-right">
                        <currency-format :value="grandTotal"></currency-format>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CurrencyFormat from './ui/formated/CurrencyFormat';

export default {
    name: 'TotalCommissions',
    props: ['user', 'backend', 'totalCommissions', 'gst', 'grandTotal', 'totalSales', 'totalDeduction', 'totalAgentSales'],
    components: {CurrencyFormat},
    data: function()
    {
        return {
            tourCommissions: [],
            message: 'Loading Data...',
            error: false,
            commissionTypes: [],
            commissions: [],
            computedCommissions: {},
            input: {},
            totalProducts: {},
            totalByCommission: {}
        }
    },
    methods: {

        loadTourCommissions: async function(tourAgentId, tourTypeId){
              
            try {

                this.message = 'Loading Tour Commission ... '
                
                // Get the Tourcommission associated with the TourAgent and TourType
                const url = this.backend + '/api/tour-commissions?api_token=' + this.user.api_token 
                                + '&tourAgent=' + tourAgentId
                                + '&tourType=' + tourTypeId

                const response = await axios.get(url);

                this.tourCommissions = response.data;

                if(this.tourCommissions.length === 0){
                    this.message = 'No Tour Commission found please add tour commission for the Tour Agent'
                }else {
                    this.message = null
                    this.error = false;

                    //Load the Input data model with the correct commission percentage based on the tourCommissions
                    this.commissionTypes.map(ct => {
                       
                       const inputObject = {}

                        this.commissions.map(c => {

                            inputObject[c.id] = this.getTourCommissionAmount(ct.id, c.id);
                        })

                        // Will use the commisstionType.code for object properties
                        // For easier reference when computing for the commission based on productType
                        // ProductType and CommissionType Code correspond accordingly.
                        this.input[ct.code] = inputObject;

                    })


                }

                console.log('Input', this.input);

            } catch (error) {
                
                this.message = 'Error loading Tour Commissions, please check with System Adminastrator'
                this.error = true;
                console.error('Error getting TourCommission', error);
            }

        },
        
        addCommission: function(selectedProduct){

            // console.log(`${this.totalProducts[selectedProduct.code]} + ${selectedProduct.total} = ${this.totalProducts[selectedProduct.code]}`)

            this.totalProducts[selectedProduct.code] = this.totalProducts[selectedProduct.code] + selectedProduct.total;

            //Loop Through the commissions
            this.commissions.map(c => {

                this.computedCommissions[selectedProduct.code][c.id] = parseFloat((this.totalProducts[selectedProduct.code] * this.input[selectedProduct.code][c.id]).toFixed(2));
                // console.log(`${this.totalProducts[selectedProduct.code]} * ${this.input[selectedProduct.code][c.id]} = ${this.computedCommissions[selectedProduct.code][c.id]}`)


                // this.totalByCommission[c.id] = this.totalByCommission[c.id] + this.computedCommissions[selectedProduct.code][c.id];
                let total = 0;
                this.commissionTypes.map(ct => {
                    total = total + this.computedCommissions[ct.code][c.id]
                })

                this.totalByCommission[c.id] = total;   

            })
        },


        deductCommission: function(selectedProduct){

            // console.log('Deducting Commissions');

            this.totalProducts[selectedProduct.code] = this.totalProducts[selectedProduct.code] - selectedProduct.total;

            //Loop Through the commissions
            this.commissions.map(c => {

                this.computedCommissions[selectedProduct.code][c.id] = parseFloat((this.totalProducts[selectedProduct.code] * this.input[selectedProduct.code][c.id]).toFixed(2));
                // console.log(`${this.totalProducts[selectedProduct.code]} * ${this.input[selectedProduct.code][c.id]} = ${this.computedCommissions[selectedProduct.code][c.id]}`)


                // this.totalByCommission[c.id] = this.totalByCommission[c.id] + this.computedCommissions[selectedProduct.code][c.id];
                let total = 0;
                this.commissionTypes.map(ct => {
                    total = total + this.computedCommissions[ct.code][c.id]
                })

                this.totalByCommission[c.id] = total;   

            })

        },

        getTourCommissionAmount: function(commissionTypeId, commissionId){

            const tourCommission = this.tourCommissions.filter(tc => tc.commission_type_id === commissionTypeId && tc.commission_id === commissionId);

            let amount = 0
            if(tourCommission[0]){
                amount = tourCommission[0].amount
            }


            return parseFloat(amount);

        }
    },
    async mounted(){

        try {

            this.message = 'Loading Commission Type'
            
            const commissionTypeUrl = this.backend + '/api/commission-types?api_token=' + this.user.api_token;
            const commissionUrl = this.backend + '/api/commissions?api_token=' + this.user.api_token;

            const commissionTypeResponse = await axios.get(commissionTypeUrl);
            const commissionResponse = await axios.get(commissionUrl) 

            this.commissionTypes = commissionTypeResponse.data;
            this.commissions = commissionResponse.data;

            if(this.commissionTypes.length === 0 || this.commissions.length === 0 ){
                this.message = 'No Commission Types or Commissions. Please check database.'
                this.error = true;
            }else {
                this.message = 'Commission Types Loaded. Please Select Tour Agent and Tour Type to load the Tour Commission'
                this.error = false;

                //Initialized the computerCommission Model

                this.commissionTypes.map(ct => {
                       
                       const commissionTypeObject = {}

                        this.commissions.map(c => {

                            commissionTypeObject[c.id] = 0;
                            this.totalByCommission[c.id] = 0;
                        })

                    // Will use the commisstionType.code for object properties
                    // For easier reference when computing for the commission based on productType
                    // ProductType and CommissionType Code correspond accordingly.
                    this.computedCommissions[ct.code] = commissionTypeObject;
                    this.totalProducts[ct.code] = 0;
                })


                console.log('computedCommissions:', this.computedCommissions);

            }

        } catch (error) {
              this.message = 'Error loading Commissions Types, please check with System Adminastrator'
            this.error = true;
            console.error('Error getting TourCommission', error);
        }


    }

}
</script>

<style>

</style>