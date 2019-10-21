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
         <div v-else class="my-10 px-5 w-224 mx-auto">
             <table class="w-full mt-5">
                <thead>
                    <tr class="text-left bg-gray-300 border border-gray-800">
                        <th class="py-2 px-2 border-r border-gray-800 w-48">
                            <button class="text-gray-800 font-bold flex w-full focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('report_number')">
                                <span class="mr-1">Report Number</span>
                                <sort-up v-if="sortCol==='report_number' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='report_number' && sortDir==='desc'"></sort-down>
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
                                @click="sort('total')">

                                <span class="mr-1">Total</span>
                                <sort-up v-if="sortCol==='total' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='total' && sortDir==='desc'"></sort-down>

                            </button>
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800 text-right w-48">
                             <button class="text-gray-800 font-bold flex items-center w-full justify-end focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('balance')">

                                <span class="mr-1">Balance</span>
                                <sort-up v-if="sortCol==='balance' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='balance' && sortDir==='desc'"></sort-down>

                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="summary in summaries" :key="summary.id" class="bg-white even:bg-gray-100 text-sm" >
                        <td class="py-2 px-4 border border-gray-800"> 
                            <a :href="'/summaries/' + summary.id" class="text-blue-700 font-semibold hover:text-blue-800"> {{ summary.report_number}} </a>
                        </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ summary.from_date }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ summary.to_date }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ summary.total }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ summary.balance }} </td>
                    </tr>
                </tbody>
             </table>
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
            sortDir: '',
            sortCol: '',

        }
    },
    methods: {
        sort: function(column){

        }
    },
    async mounted(){

        try {

            const url = this.backend + '/api/summaries?api_token=' + this.user.api_token;

            const response = await axios.get(url);

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