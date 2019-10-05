<template>
   <div class="flex border border-gray-700 mt-5 items-start text-sm bg-orange-300">
        <div class="">
            <h2 class="border-b border-gray-700 px-2 py-1 font-semibold uppercase">Deductions</h2>
        </div>
        <div class="flex-1 border-l border-gray-700 ">
            <div v-for="deduction in deductions" :key="deduction.id"
                class="flex justify-between border-b border-gray-700">
                <div class="flex-1 border-gray-700 border-r px-2 py-1">{{deduction.name}}</div>
                <div class="w-32  px-2 py-1"> 
                    <currency-format :value="deduction.amount"></currency-format>    
                </div>
            </div>
            <div class="flex justify-between font-semibold bg-orange-400">
                <div class="flex-1 border-gray-700 border-r  px-2 py-1">Sub Total</div>
                <div class="w-32  px-2 py-1"> 
                    <currency-format :value="totalDeductions" ></currency-format>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import CurrencyFormat from './ui/formated/CurrencyFormat';

export default {
    name: 'Deductions',
    props: ['deductions', 'totalDeductions'],
    components: {CurrencyFormat}
}
</script>

<style>

</style>