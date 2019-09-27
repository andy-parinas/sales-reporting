<template>
   <table class="w-full">
        <thead>
            <tr class="text-left bg-gray-300 border border-gray-800 text-sm">
                <th class="py-2 px-2 border border-gray-800">Selected Product</th>
                <th class="py-2 px-2 border border-gray-800">Price</th>
                <th class="py-2 px-2 border border-gray-800">QTY</th>
                <th class="py-2 px-2 border border-gray-800">Total</th>
                <th class="py-2 px-2 border border-gray-800">Type</th>
            </tr>
        </thead>
        <tbody>
                <tr v-for="product in products" :key="product.id" class="text-xs">
                    <td class="py-2 px-4 border border-gray-800">{{ product.name }}</td>
                    <td class="py-2 px-4 border border-gray-800 w-24"> {{ product.price }} </td>
                    <td class="py-2 px-4 border border-gray-800 w-12"> {{ product.qty }}</td>
                    <td class="py-2 px-4 border border-gray-800 w-12"> {{ product.total }}</td>
                    <td class="py-2 px-4 border border-gray-800 w-12"> {{ product.type }} </td>
                </tr>
            <tr class="text-xs bg-yellow-300">
                <td class="py-2 px-4 border border-gray-800">Sub Total</td>
                <td class="py-2 px-4 border border-gray-800 w-24"> </td>
                <td class="py-2 px-4 border border-gray-800 w-12"> </td>
                <td class="py-2 px-4 border border-gray-800 w-12"> {{ subtotal }} </td>
                <td class="py-2 px-4 border border-gray-800 w-12"> </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: 'SelectedProduct',
    props: ['products', 'subtotal']
}
</script>

<style>

</style>