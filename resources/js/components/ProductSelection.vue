<template>
    <div>
        <div v-if="loading" class="w-full h-96 flex items-center justify-center" >
            <bar-loader color="#a0aec0"></bar-loader>
        </div>
        <div v-else>
            <div class="mb-4">
                <label for="filter">Filter</label>
                <input type="text" id="filter" placeholder="Product Name">
            </div>
            <table class="w-full">
                <thead>
                    <tr class="text-left bg-gray-300 border border-gray-800 text-sm">
                        <th class="py-2 px-2 border border-gray-800">Product Name</th>
                        <th class="py-2 px-2 border border-gray-800">Price</th>
                        <th class="py-2 px-2 border border-gray-800">QTY</th>
                        <th class="py-2 px-2 border border-gray-800">Total</th>
                        <th class="py-2 px-2 border border-gray-800"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="product.id"
                        class="">
                        <td class="py-2 px-4 border border-gray-800 text-sm"> 
                            {{ product.name }} 
                            <span class="text-xs text-gray-500 rounded-full"> {{ product.product_type }} </span>
                        </td>
                        <td class="py-2 px-4 border border-gray-800 w-24 text-xs"> 
                            <currency-format :value="product.price"></currency-format>
                        </td>
                        <td class="py-2 px-4 border border-gray-800 w-12"> 
                            <input v-model="productInput[index].qty" @change="onQtyChange(index, product.price)"
                            class="w-8 focus:outline-none text-xs" type="text" placeholder="0">
                        </td>
                        <td class="py-2 px-4 border border-gray-800 w-12"> 
                            <input v-model="productInput[index].total"
                            class="w-12 focus:outline-none text-xs" type="text" placeholder="0">
                        </td>
                        <td class="py-2 px-4 border border-gray-800 w-12 bg-indigo-500 text-white hover:bg-indigo-600"> 
                            <button class="py-1 px-1 rounded-sm text-xs" 
                                    @click="selectProduct(product, index)" >
                                Select
                            </button> 
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-2">
                <button class="py-1 px-2 mr-1 text-sm font-semibold rounded-sm boder border-gray-500 bg-gray-400 focus:outline-none"
                    :class="meta.current_page === 1 ? 'disabled' : ''"
                    :disabled="meta.current_page === 1 ? true : false"
                    @click="changePage(1)">
                    First
                </button>
                <button class="py-1 px-2 mr-1 text-sm font-semibold rounded-sm boder border-gray-500 bg-gray-400 focus:outline-none" 
                    v-for="n in meta.last_page" :key="n"
                    :disabled="meta.current_page === n ? true : false"
                    :class="meta.current_page === n ? 'disabled' : ''"
                    @click="changePage(n)">
                    {{n}}
                </button>
                <button class="py-1 px-2 mr-1 text-sm font-semibold rounded-sm boder border-gray-500 bg-gray-400 focus:outline-none"
                    :class="meta.current_page === meta.last_page ? 'disabled' : ''"
                    :disabled="meta.current_page === meta.last_page ? true : false"
                    @click="changePage(meta.last_page)">
                    Last
                </button>
            </div>
        </div>
    </div>
</template>

<script>

import BarLoader from './ui/loader/BarLoader';
import CurrencyFormat from './ui/formated/CurrencyFormat';

export default {
    name: 'ProductSelection',
    props: ['user'],
    components: {BarLoader, CurrencyFormat},
    data: function(){

   
        return {
            products: null,
            meta: null,
            links: null,
            loading: true,
            productInput: []
        }
    },
    methods: {
        onQtyChange: function(index, price){
            this.productInput[index].total = this.productInput[index].qty * price;
        },
        changePage: async function(page){
           try {
                const url = backendUrl + '/api/products?api_token=' + this.user.api_token + '&page=' + page;
                const response = await axios.get(url);
                this.products = response.data.data;
                this.meta = response.data.meta;

                //Refresh the Quantity and Total
                for (let index = 0; index <= 10; index++) {
                    this.productInput[index].qty = 0;
                    this.productInput[index].total = 0;
                }

           } catch (error) {
               console.log(error);
           }
        },
        selectProduct: function(product, index){

            const selectedProduct = {
                id: product.id,
                name: product.name,
                price: product.price,
                qty: this.productInput[index].qty,
                total: this.productInput[index].total,
                type: product.product_type,
                code: product.product_type_code
            }

            this.$emit('select', selectedProduct);
        }
    },
    async mounted(){
        try {

            const url = backendUrl + '/api/products?api_token=' + this.user.api_token;
            const response = await axios.get(url);

            this.products = response.data.data;
            this.meta = response.data.meta;
            this.links = response.data.links;

            for (let index = 0; index <= 10; index++) {
                this.productInput.push({
                    qty: 0,
                    total: 0
                });
            }


            this.loading = false;

            console.log(response);

        } catch (error) {
            
            console.log(err);

        }


    }
}
</script>

<style>

</style>