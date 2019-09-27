<template>
   <div class="flex border border-gray-700 mt-5 items-start text-sm bg-red-200">
        <div class="">
            <h2 class="border-b border-gray-700 px-2 py-1 font-semibold uppercase">Deductions</h2>
        </div>
        <div class="flex-1 border-l border-gray-700 ">
            <div class="flex justify-between border-b border-gray-700">
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Guide Incentive</div>
                <div class="w-32  px-2 py-1"> 
                    <currency-format :value="incentive"></currency-format>    
                </div>
            </div>
            <div class="flex justify-between border-b border-gray-700">
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Delivery</div>
                <div class="w-32  px-2 py-1"> 
                    <currency-format :value="delivery"></currency-format>
                </div>
            </div>
            <div class="flex justify-between border-b border-gray-700" >
                <div class="flex-1 border-gray-700 border-r px-2 py-1">Service</div>
                <div class="w-32  px-2 py-1"> 
                    <currency-format :value="service"></currency-format>
                </div>
            </div>
            <div class="flex justify-between font-semibold bg-red-400">
                <div class="flex-1 border-gray-700 border-r  px-2 py-1">Sub Total</div>
                <div class="w-32  px-2 py-1"> 
                    <currency-format :value="subtotal"></currency-format>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import CurrencyFormat from './ui/formated/CurrencyFormat';

export default {
    name: 'Deductions',
    props: ['incentive', 'delivery', 'service', 'subtotal'],
    components: {CurrencyFormat}
}
</script>

<style>

</style>