<template>
    <div>
        <div v-if="loading" class="flex items-center py-4 px-8 bg-gray-600 mt-5 text-white rounded text-sm">
            <h3 class="mr-1">Loading Deductions</h3>
            <circle-loader></circle-loader>
        </div>
        <div v-else 
            class="flex border border-gray-700 mt-5 items-start text-sm bg-orange-300">
            <div class="">
                <h2 class="border-b border-gray-700 px-2 py-1 font-semibold uppercase">Deductions</h2>
            </div>
    
            <div class="flex-1 border-l border-gray-700 ">
                <div v-for="(deduction, index) in deductions" :key="deduction.id"
                    class="flex justify-between border-b border-gray-700">
                    <div class="flex-1 border-gray-700 border-r px-2 py-1">{{deduction.name}}</div>
                    <div class="w-32  px-2 py-1 text-right"> 
                        <!-- <currency-format :value="deduction.amount"></currency-format>     -->
                        <input type="text" class="bg-transparent text-right w-24"
                                v-model.number="input[deduction.deduction_id]" 
                                @change="changeDeduction(deduction.deduction_id, index)" />
                    </div>
                </div>
                <div class="flex justify-between font-semibold bg-orange-400">
                    <div class="flex-1 border-gray-700 border-r  px-2 py-1">Sub Total</div>
                    <div class="w-32  px-2 py-1 text-right"> 
                        <currency-format :value="total_deductions" ></currency-format>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import CurrencyFormat from './ui/formated/CurrencyFormat';
import CircleLoader from './ui/loader/CircleLoader';

export default {
    name: 'Deductions',
    props: [ 'backend', 'user', 'edit', 'salesDeductions' ,'totalDeductions'],
    components: {CurrencyFormat, CircleLoader},
    data: function(){
        return {
            deductions: [],
            input: {},
            productByType: {
               count: [0, 0],
               total: [0, 0]
            },
            total_deductions: 0,
            loading: true,
            error: null
        }
    },
    methods: {

        computeProductCount: function(product, action){

            if(action === 'add'){
                    
                if(product.code === 1){
                    this.productByType.count[0] = this.productByType.count[0] + product.quantity;
                    this.productByType.total[0] = this.productByType.total[0] + product.total;
                }else {
                    this.productByType.count[1] = this.productByType.count[1] + product.quantity;
                    this.productByType.total[1] = this.productByType.total[1] + product.total;
                }

            }else {

                 if(product.code === 1){
                    this.productByType.count[0] = this.productByType.count[0] - product.quantity;
                    this.productByType.total[0] = this.productByType.total[0] - product.total;
                }else {
                    this.productByType.count[1] = this.productByType.count[1] - product.quantity;
                    this.productByType.total[1] = this.productByType.total[1] - product.total;
                }

            }

        },

        computeDeduction: function(product, action){

            console.log('Computing Deduction [Deductions.Vue]', product, action)

            this.computeProductCount(product, action);

            let total = 0;

            this.deductions.forEach((deduction, index) => {


                if(deduction.type === 1){

                    this.input[deduction.deduction_id] = this.productByType.count[0] * this.deductions[index].multiplier
                    this.deductions[index].amount = this.input[deduction.deduction_id]

                }else if(deduction.type === 3 && product.quantity >= 1 && product.total === 0){

                    if(action === 'add'){
                        this.input[deduction.deduction_id] = this.deductions[index].amount + product.cost
                        this.deductions[index].amount = this.input[deduction.deduction_id];

                    }else {
                        this.input[deduction.deduction_id] = this.deductions[index].amount - product.cost
                        this.deductions[index].amount = this.input[deduction.deduction_id];
                    }

                }

                total = total + deduction.amount;

            })

            this.total_deductions = total;

            this.$emit('deductionComputed', this.total_deductions, this.deductions);
        },

        changeDeduction: function(deductionId, index){

            this.deductions[index].amount = this.input[deductionId];

             let total = 0;

            this.deductions.forEach((deduction, index) => {
                 total = total + deduction.amount;
            });


            this.total_deductions = total;

            this.$emit('deductionComputed', this.total_deductions, this.deductions);


        },

        getSalesDeductionsFromParent: function(salesDeductions, totalDeductions){

            const sales_deductions = [];

            this.salesDeductions.forEach((deduction, index) => {

                const deductionObject = {
                    id: deduction.id,
                    deduction_id: deduction.deduction_id,
                    name: deduction.name,
                    amount: deduction.amount,
                    type: deduction.type,
                    multiplier: deduction.multiplier
                }

                this.$set(this.input, deduction.deduction_id, deduction.amount)
                this.$set(this.deductions, index, deductionObject)
            })

            this.total_deductions = totalDeductions;

            this.loading = false;

            console.log('Method', this.deductions);

        }


    },

    async mounted(){
        if(!this.edit){

          try {
                        
                const deductionUrl = this.backend + '/api/deductions?api_token=' + this.user.api_token;
                const deductionResponse = await axios.get(deductionUrl);
    
                const deductionReference = deductionResponse.data;
                
                const sales_deductions = []
                //initialize deductions
                deductionReference.forEach(ref => {
                    const deduction = {
                        deduction_id: ref.id,
                        name: ref.name,
                        amount: 0,
                        type: ref.type,
                        multiplier: ref.amount
                    }
    
                    this.$set(this.input, ref.id, 0)
                    sales_deductions.push(deduction);
                })
    
                this.deductions = sales_deductions;
                this.loading = false;
        
            } catch (error) {
                    console.log('Error Loading Deduction Reference:', error);
            }
        }

    }

}
</script>

<style>

</style>