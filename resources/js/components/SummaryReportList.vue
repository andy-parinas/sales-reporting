<template>
    <div>
        <div v-if="loading && !withError" class="w-full h-96 flex items-center justify-center">
            <bar-loader color="#a0aec0"></bar-loader>
        </div>
        <div v-else-if="!loading && withError" class="w-full h-96 flex items-center justify-center">
            <div>
                <h1 class="text-red-700 font-semibold text-lg">Error Connecting</h1>
                <h3 class="text-gray-800">Please check your internet connection or report to IT</h3>
            </div>
        </div>
         <div v-else class="my-10 px-5 w-288 mx-auto">
            <form method="POST" @submit.prevent="searchSummary" >
                <div class="flex items-center border border-gray-700 rounded">
                        <label for="search" class="pl-2 font-bold text-gray-800 mr-2">Find</label>
                        <input class="py-2 px-4 flex-1 focus:outline-none"
                            id="search" type="text" placeholder="Summary Report Title" v-model="search">
                        <button class="border border-blue-700 bg-blue-700 py-2 px-4 text-white">
                            Search
                        </button>
                </div>
            </form>
             <table class="w-full mt-5">
                <thead>
                    <tr class="text-left bg-gray-300 border border-gray-800">
                        <th class="py-2 px-2 border-r border-gray-800 w-56">
                            <button class="text-gray-800 font-bold flex w-full focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('title')">
                                <span class="mr-1">Report Title</span>
                                <sort-up v-if="sortCol==='title' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='title' && sortDir==='desc'"></sort-down>
                            </button>
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800 w-48">
                            <button class="text-gray-800 font-bold flex w-full focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('selectedCommission')">
                                <span class="mr-1">Commission</span>
                                <sort-up v-if="sortCol==='selected_commission' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='selected_commission' && sortDir==='desc'"></sort-down>
                            </button>
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800 w-32">
                             <button class="text-gray-800 font-bold flex items-start w-full focus:outline-none hover:text-gray-700" 
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('from_date')">
                                <span class="mr-1">From</span>
                                <sort-up v-if="sortCol==='from_date' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='from_date' && sortDir==='desc'"></sort-down>
                            </button>
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800 w-32">
                             <button class="text-gray-800 font-bold flex items-center w-full focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('to_date')">

                                <span class="mr-1">To</span>
                                <sort-up v-if="sortCol==='to_date' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='to_date' && sortDir==='desc'"></sort-down>

                            </button>
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800 text-right w-48">
                             <button class="text-gray-800 font-bold flex items-center w-full justify-end focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('total_sales')">

                                <span class="mr-1">Sales Total</span>
                                <sort-up v-if="sortCol==='total_sales' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='total_sales' && sortDir==='desc'"></sort-down>

                            </button>
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800 text-right w-48">
                             <button class="text-gray-800 font-bold flex items-center w-full justify-end focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('commission')">

                                <span class="mr-1">Commission Total</span>
                                <sort-up v-if="sortCol==='commission' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='commission' && sortDir==='desc'"></sort-down>

                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="summary in summaries" :key="summary.title" class="bg-white even:bg-gray-100 text-sm" >
                        <td class="py-2 px-4 border border-gray-800"> 
                            <a :href="'/summaries/' + summary.id" class="text-blue-700 font-semibold hover:text-blue-800"> {{ summary.title}} </a>
                        </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ summary.name }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ summary.from_date }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ summary.to_date }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> <currency-format :value="summary.sales_total" ></currency-format> </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> <currency-format :value="summary.commission" ></currency-format> </td>
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
import SortUp from './ui/icons/SortUp';
import SortDown from './ui/icons/SortDown';
import CurrencyFormat from './ui/formated/CurrencyFormat';

export default {
    name: 'SummaryReportList',
    props: ['user', 'backend'],
    components: { BarLoader, SortUp, SortDown, CurrencyFormat},
    data: function(){
        return {
            loading: true,
            summaries: [],
            meta: null,
            withError: false,
            sortDir: 'desc',
            sortCol: 'from_date',
            search: ''
        }
    },
    methods: {
        sort: async function(column){

            try {

                this.sortCol = column;

                if(this.sortDir === 'asc'){
                    this.sortDir = 'desc'
                }else {
                    this.sortDir = 'asc'
                }
                
                const url = this.backend + '/api/summaries?api_token=' + this.user.api_token 
                    + '&sort=' + this.sortCol 
                    + '&direction=' + this.sortDir
                    + '&search=' + this.search;

                const response = await axios.get(url);

                this.summaries = response.data.data;
                const meta = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page
                }
                this.meta = meta;
                
            } catch (error) {
                console.log(error);
            }

        },
        
        searchSummary: async function(){
            
            try {
                const url = this.backend + '/api/summaries?api_token=' + this.user.api_token + '&search=' + this.search;

                const response = await axios.get(url);

                this.summaries = response.data.data;
                const meta = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page
                }
                this.meta = meta;



            } catch (error) {
                console.log(error);
            }
        },
        changePage: async function(page){
           try {
                const url = this.backend + '/api/summaries?api_token=' + this.user.api_token 
                + '&page=' + page  
                + '&sort=' + this.sortCol 
                + '&direction=' + this.sortDir
                + '&search=' + this.search;

                const response = await axios.get(url);
                this.summaries = response.data.data;
                const meta = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page
                }
                this.meta = meta;

           } catch (error) {
               console.log(error);
           }
        },
    },
    async mounted(){

        try {

            const url = this.backend + '/api/summaries?api_token=' + this.user.api_token;

            const response = await axios.get(url);

            const meta = {
                current_page: response.data.current_page,
                last_page: response.data.last_page
            }

            this.meta = meta;

            this.summaries = response.data.data;
            this.loading = false;
            this.withError = false;

            console.log(response);

            
        } catch (error) {
            this.withError = true;
            this.loading = false;

             if(error.response && error.response.data && error.response.data.errors ){
                console.log(error.response);
            }else {
                console.log(error);
            }
        }
    }
}
</script>

<style>

</style>