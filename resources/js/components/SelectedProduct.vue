<template>
   <table class="w-full">
        <thead>
            <tr class="text-left bg-gray-300 border border-gray-800 text-sm">
                <th class="py-2 px-2 border border-gray-800">Selected Product</th>
                <th class="py-2 px-2 border border-gray-800">Price</th>
                <th class="py-2 px-2 border border-gray-800">QTY</th>
                <th class="py-2 px-2 border border-gray-800">Total</th>
                <th class="py-2 px-2 border border-gray-800">Type</th>
                <th class="py-2 px-2 border border-gray-800"></th>
            </tr>
        </thead>
        <tbody>
                <tr v-for="(product, index) in products" :key="product.id + Math.random()" class="text-xs">
                    <td class="py-2 px-4 border border-gray-800">{{ product.name }}</td>
                    <td class="py-2 px-4 border border-gray-800 w-24"> 
                        <currency-format :value="product.price" ></currency-format>
                        <!-- {{ Number.parseFloat(product.price).toFixed(2) }}  -->
                    </td>
                    <td class="py-2 px-4 border border-gray-800 w-12"> {{ product.quantity }}</td>
                    <td class="py-2 px-4 border border-gray-800 w-12"> 
                        <currency-format :value="product.total" ></currency-format>
                        <!-- {{ Number.parseFloat(product.total).toFixed(2) }} -->
                    </td>
                    <td class="py-2 px-4 border border-gray-800 w-12"> {{ product.type }} </td>
                    <td class="py-2 px-4 border border-gray-800 w-10 bg-orange-500 hover:bg-orange-600">
                        <button class="text-xs text-white focus:outline-none"
                                @click="removeProduct(index)">
                            Remove
                        </button>
                    </td>
                </tr>
            <tr class="text-xs bg-yellow-300">
                <td class="py-2 px-4 border border-gray-800">Sub Total</td>
                <td class="py-2 px-4 border border-gray-800 w-24"> </td>
                <td class="py-2 px-4 border border-gray-800 w-12"> </td>
                <td class="py-2 px-4 border border-gray-800 w-12"> 
                    <currency-format :value="subtotal" ></currency-format>
                </td>
                <td class="py-2 px-4 border border-gray-800 w-12"> </td>
                <td class="py-2 px-4 border border-gray-800 w-12"> </td>
            </tr>
        </tbody>
    </table>
</template>

<script>

import CurrencyFormat from './ui/formated/CurrencyFormat';

export default {
    name: 'SelectedProduct',
    components: {CurrencyFormat},
    props: ['products', 'subtotal'],
    methods: {
        removeProduct: function(index){
            this.$emit('remove', index);
        }
    },
}
</script>

<style>

</style>