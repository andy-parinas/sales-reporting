<template>
    <div>
        <div v-if="loading" class="w-full h-96 flex items-center justify-center">
            <bar-loader color="#a0aec0"></bar-loader>
        </div>
         <div v-else class="my-10 px-5 w-288 mx-auto">
                <form method="POST" @submit.prevent="searchProduct">
                    <div class="flex items-center border border-gray-700 rounded">
                            <label for="search" class="pl-2 font-bold text-gray-800 mr-2">Find</label>
                            <input class="py-2 px-4 flex-1 focus:outline-none"
                                id="search" type="text" placeholder="Product Name" v-model="search">
                            <button type="submit"
                                class="border border-blue-700 bg-blue-700 py-2 px-4 text-white hover:bg-blue-600 active:bg-blue-700">
                                Search
                            </button>
                    </div>
                </form>
                <table class="w-full mt-5">
                    <thead>
                        <tr class="text-left bg-gray-300 border border-gray-800 text-sm">
                            <th class="py-2 px-2 border border-gray-800">Product Name</th>
                            <th class="py-2 px-2 border border-gray-800">Type</th>
                            <th class="py-2 px-2 border border-gray-800 text-right">Price</th>
                            <th class="py-2 px-2 border border-gray-800 text-right">Cost</th>
                        </tr>
                    </thead>
                     <tbody>
                        <tr v-for="product in products" :key="product.id"
                            class="bg-white even:bg-gray-100 text-sm">
                            <td class="py-2 px-4 border border-gray-800 text-sm"> 
                                <a :href="'/products/' + product.id" class="text-blue-600 hover:text-blue-700 font-semibold">
                                    {{ product.name }}
                                </a>
                            </td>
                            <td class="py-2 px-4 border border-gray-800 text-sm"> 
                                {{ product.product_type }}
                            </td>
                            <td class="py-2 px-4 border border-gray-800 w-24 text-xs text-right"> 
                                <currency-format :value="product.price"></currency-format>
                            </td>
                            <td class="py-2 px-4 border border-gray-800 w-24 text-xs text-right"> 
                                <currency-format :value="product.cost"></currency-format>
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
    name: 'ProductList',
    props: ['user', 'backend'],
    components: {BarLoader, CurrencyFormat},
    data: function(){
        return {
            loading: true,
            products: [],
            search: '',
            errors: null
        }
    },
    methods: {
        searchProducts: function(){

        },
        changePage: async function(page){
             try {
                const url = this.backend + '/api/products?api_token=' + this.user.api_token 
                            + '&page=' + page
                            + '&search=' + this.search;


                const response = await axios.get(url);
                this.products = response.data.data;
                this.meta = response.data.meta;

           } catch (error) {
               console.log(error);
           }
        },
        searchProduct: async function(){
            try {
                const url = this.backend + '/api/products?api_token=' + this.user.api_token
                            + '&search=' + this.search;

                const response = await axios.get(url);

                this.products = response.data.data;
                this.meta = response.data.meta;

            } catch (error) {
                console.log(error);
            }
        }
    },
    async mounted(){

        try {

            const url = this.backend + '/api/products?api_token=' + this.user.api_token;
            const response = await axios.get(url);

            this.products = response.data.data;
            this.meta = response.data.meta;
            this.links = response.data.links;

            this.loading = false;

            console.log(response.data);

        } catch (error) {
            
            console.log(error);

        }
    }
}
</script>

<style>

</style>