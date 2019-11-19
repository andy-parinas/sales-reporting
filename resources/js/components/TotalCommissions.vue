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
                                    {{ computedCommissions[type.code][commission.id] }}
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
                        <currency-format :value="totalAgentCommission"></currency-format>
                    </div>
                </div>
                <div class="flex justify-between border-b border-gray-700" >
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">GST</div>
                    <div class="w-32  px-2 py-1 text-right">
                        <currency-format :value="totalGST"></currency-format>
                    </div>
                </div>
                <div class="flex justify-between font-semibold bg-green-400">
                    <div class="flex-1 border-gray-700 border-r  px-2 py-1">Grand Total Agent Commission</div>
                    <div class="w-32  px-2 py-1 text-right">
                        <currency-format :value="grandTotalCommission"></currency-format>
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
    props: ['user', 'backend',  'totalSales', 'totalDeduction', 'totalAgentSales', 'edit', 'salesCommissions', 'tourAgentId', 'tourTypeId', 'totalProductsByCode'],
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
            totalByCommission: {},
            totalAgentCommission: 0,
            totalGST: 0,
            grandTotalCommission: 0,
        }
    },
    methods: {

        log: function(object){
            console.log('Loading Views', object)
        },

        /**
         * Will load the TourCommissions need in computing the commission
         * called in the mounted lifecycle.
         */
        loadTourCommissions: async function(tourAgentId, tourTypeId){
              
            try {

                console.log('###### Loading Tour Commissions #############');

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

            } catch (error) {
                
                this.message = 'Error loading Tour Commissions, please check with System Adminastrator'
                this.error = true;
                console.error('Error getting TourCommission', error);
            }

        },

        /**
         * Initialized the computed commission based on the product selected.
         * called in the mounted lifecycle
         * 
         * this also initializes the totalProducts databa object to dynammically create properties based on commissionTypes.
         * 
         */
        initializeComputedCommission: function(){


            /**
             *  commissions are based on the TourType, CommissionType, Commission/Commission Name
             * 
             * Create a computedCommissions object that has the property:
             *  computedCommission = {
             *      [commissionType.code] : {
             *          [commission.id]: [computed commission]
             *      }
             *  }
             *  
             *  The object can easily be referenced in the template or when computing for the commissions
             *  using the commissionType.code which is also the same as product.code. When product is added or removed
             *  computed commission can be accessed using the product.code of the added or removed product.
             *  
             * computedCommissions[product.code][commission.id] = <Computation Here>
             * 
             */
            this.commissionTypes.map(ct => {
                
                //Initializing a commissionType Object
                const commissionTypeObject = {}

                // Looping through the commissions
                this.commissions.map(c => {
                    
                    //creating a property of Commission.id in the CommissionType object
                    commissionTypeObject[c.id] = 0;
                    // this.totalByCommission[c.id] = 0;
                    this.$set(this.totalByCommission, c.id, 0)
                })

                // Creating a property of commissionType.code in the ComputedCommission object
                // this.computedCommissions[ct.code] = commissionTypeObject;
                this.$set(this.computedCommissions, ct.code,commissionTypeObject )
                // this.totalProducts[ct.code] = 0;
                this.$set(this.totalProducts, ct.code, 0);
            })

        },

        /**
         * Computes the total commissions by commission types
         * This is called in computeCommission
         * also called in mounted lifecycle when edit mode.
         */
        computeTotalCommissions: function(){

             let totalAgentCommission = 0

 
            this.commissions.map(c => {
                
                // Loop Through each commisionTypes adding the same commission for each type
                let total = 0;
                this.commissionTypes.map(ct => {
                    
                    total = total + this.computedCommissions[ct.code][c.id]

                })

                this.totalByCommission[c.id] = total;   

                totalAgentCommission = totalAgentCommission + this.totalByCommission[c.id];
            })

            this.totalAgentCommission = totalAgentCommission;
            this.totalGST = this.totalAgentCommission * 0.10;
            this.grandTotalCommission = this.totalAgentCommission + this.totalGST;
            

        },

        /**
         * Compute Commission is called whenever a product is added or removed
         * See addCommission and deductCommission
         */
        computeCommissions: function(selectedProduct){


            this.commissions.map(c => {
                this.computedCommissions[selectedProduct.code][c.id] = parseFloat((this.totalProducts[selectedProduct.code] * this.input[selectedProduct.code][c.id]).toFixed(2));
            })


            this.computeTotalCommissions();
            
            const salesCommissions = this.createSalesCommissions();

            this.$emit('salesCommissionChanged', salesCommissions, this.totalAgentCommission, this.totalGST, this.grandTotalCommission);

        },
        
        /**
         * Called whenever a product is added
         * Called from the Parent (SalesReportForm)
         */
        addCommission: function(selectedProduct){


            this.totalProducts[selectedProduct.code] = this.totalProducts[selectedProduct.code] + selectedProduct.total;
            
            this.computeCommissions(selectedProduct);

            this.createSalesCommissions();
            
        },


         /**
         * Called whenever a product is removed
         * Called from the Parent (SalesReportForm)
         */
        deductCommission: function(selectedProduct){


            this.totalProducts[selectedProduct.code] = this.totalProducts[selectedProduct.code] - selectedProduct.total;

            this.computeCommissions(selectedProduct);

            this.createSalesCommissions();

        },

        findTourCommission: function(commissionTypeId, commissionId){

            const tourCommission = this.tourCommissions.filter(tc => tc.commission_type_id === commissionTypeId && tc.commission_id === commissionId);

            return tourCommission[0];

        },


        getTourCommissionAmount: function(commissionTypeId, commissionId){

            // const tourCommission = this.tourCommissions.filter(tc => tc.commission_type_id === commissionTypeId && tc.commission_id === commissionId);
            const tourCommission = this.findTourCommission(commissionTypeId, commissionId)

            let amount = 0

            if(tourCommission){
                amount = tourCommission.amount
            }


            return parseFloat(amount);

        },

        findTourCommissionByCode: function(commissionTypeCode, commissionId){

            // const tourCommission = this.tourCommissions.filter(tc => tc.commission_type.code === commissionTypeCode && tc.commission_id === commissionId);
            const tourCommission = this.tourCommissions.filter(tc => {

                return tc.commission_type.code == commissionTypeCode && tc.commission_id == commissionId
            });


            return tourCommission[0];

        },

        createSalesCommissions: function(){

            const salesCommissions = [];

            if(this.edit){

                this.salesCommissions.map(sc => {
                    salesCommissions.push({
                        ...sc,
                        amount: this.computedCommissions[sc.tour_commission.commission_type.code][sc.tour_commission.commission.id]
                    })
                })

            }else {
                
                

                for(let c in this.computedCommissions){

                    for(let i in this.computedCommissions[c]){

                        const tourCommission = this.findTourCommissionByCode(c, i);

                        if(tourCommission){

                            salesCommissions.push({
                                tour_commission_id: tourCommission.id,
                                amount: this.computedCommissions[c][i]
                            })

                        }
            
                    }
                }

            }

            console.log('Created Sales Commission', salesCommissions);

            return salesCommissions;

        },

        loadSalesCommissions: function(salesCommissions){

            salesCommissions.map(sc => {

                this.computedCommissions[sc.tour_commission.commission_type.code][sc.tour_commission.commission.id] = sc.amount;


            })

        }


    },
    async mounted(){

        try {

            // Start of Getting the required data from the backend
            this.message = 'Loading Commission Type'
            
            const commissionTypeUrl = this.backend + '/api/commission-types?api_token=' + this.user.api_token;
            const commissionUrl = this.backend + '/api/commissions?api_token=' + this.user.api_token;

            const commissionTypeResponse = await axios.get(commissionTypeUrl);
            const commissionResponse = await axios.get(commissionUrl) 

            this.commissionTypes = commissionTypeResponse.data;
            this.commissions = commissionResponse.data;

            // End of Data aquistion from the Backend
            // Start initializing the data model to be used by the templates and computation


            if(this.commissionTypes.length === 0 || this.commissions.length === 0 ){

                this.message = 'No Commission Types or Commissions. Please check database.'
                this.error = true;

            }else {

                this.initializeComputedCommission();


                if(this.tourAgentId && this.tourTypeId){

                    await this.loadTourCommissions(this.tourAgentId , this.tourTypeId);

                }else {
                    this.message = "Must have TourAgent and TourTypeLoaded when Editing."
                    this.error = true;
                }

                /**
                 *  ####  Edit Mode #####
                 */
                if(this.edit){

                     this.salesCommissions.map(sc => {

                        this.computedCommissions[sc.tour_commission.commission_type.code][sc.tour_commission.commission.id] = sc.amount;

                    })

                    this.computeTotalCommissions();

                    

                    this.message = null;
                    this.error = false;

                    this.commissionTypes.map(ct => {
                        this.totalProducts[ct.code] = this.totalProductsByCode[ct.code];
                    })

                    console.log('Total Products', this.totalProducts);


                }else {
                    
                    this.message = 'Commission Types Loaded. Please Select Tour Agent and Tour Type to load the Tour Commission'
                    this.error = false;

                }

            }
            console.log(this.user);


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