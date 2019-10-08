<template>
    <div class="flex border border-gray-700 mt-5 items-start text-sm bg-green-200">
        <div class="flex-1">
            <div class="flex justify-between border-b border-gray-700">
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Sales</div>
                <div class="w-32  px-2 py-1"> 
                    <currency-format :value="totalSales" ></currency-format>
                </div>
            </div>
            <div class="flex justify-between border-b-2 border-gray-700">
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Deductions</div>
                <div class="w-32  px-2 py-1"> 
                    <currency-format :value="totalDeduction" ></currency-format>
                </div>
            </div>
            <div class="flex justify-between border-b border-gray-700" >
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Agent Sales</div>
                <div class="w-32  px-2 py-1">
                    <currency-format :value="totalAgentSales" ></currency-format>
                </div>
            </div>

            <div class="flex justify-between border-b border-gray-700"
                v-for="commission in commissions" :key="commission.id" >
                <div class="flex-1 border-gray-700 border-r px-2 py-1">{{ commission.name }}</div>
                <div class="w-32  px-2 py-1">
                    <currency-format :value="commission.amount"></currency-format>
                </div>
            </div>

            <div class="flex justify-between border-b border-gray-700 h-8" >
                <div class="flex-1 border-gray-700 border-r px-2 py-1"></div>
                <div class="w-32  px-2 py-1">  </div>
            </div>
            <div class="flex justify-between border-b border-gray-700" >
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Total Agent Commission</div>
                <div class="w-32  px-2 py-1">
                    <currency-format :value="totalCommissions"></currency-format>
                </div>
            </div>
            <div class="flex justify-between border-b border-gray-700" >
                <div class="flex-1 border-gray-700 border-r px-2 py-1">GST</div>
                <div class="w-32  px-2 py-1">
                    <currency-format :value="gst"></currency-format>
                </div>
            </div>
            <div class="flex justify-between font-semibold bg-green-400">
                <div class="flex-1 border-gray-700 border-r  px-2 py-1">Grand Total Agent Commission</div>
                <div class="w-32  px-2 py-1">
                    <currency-format :value="grandTotal"></currency-format>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import CurrencyFormat from './ui/formated/CurrencyFormat';

export default {
    name: 'TotalSales',
    props: ['commissions', 'totalCommissions', 'gst', 'grandTotal', 'totalSales', 'totalDeduction', 'totalAgentSales'],
    components: {CurrencyFormat}
}
</script>

<style>

</style>