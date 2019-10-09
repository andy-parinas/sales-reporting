<template>
    <div>
        <div v-if="loading" class="w-full h-96 flex items-center justify-center">
            <bar-loader color="#a0aec0"></bar-loader>
        </div>
        <div v-else class="my-10 px-5 w-288 mx-auto">
                <form method="POST" @submit.prevent="searchReport">
                <div class="flex items-center border border-gray-700 rounded">
                        <label for="search" class="pl-2 font-bold text-gray-800 mr-2">Find</label>
                        <input class="py-2 px-4 flex-1 focus:outline-none"
                            id="search" type="text" placeholder="Report Number" v-model="search">
                        <button class="border border-blue-700 bg-blue-700 py-2 px-4 text-white">
                            Search
                        </button>
                </div>
                </form>
            <table class="w-full mt-5">
                <thead>
                    <tr class="text-left bg-gray-300 border border-gray-800">
                        <th class="py-2 px-2 border-r border-gray-800">
                            <button class="text-gray-800 font-bold flex w-full focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('report_number')">
                                <span class="mr-1">Report Number</span>
                                <sort-up v-if="sortCol==='report_number' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='report_number' && sortDir==='desc'"></sort-down>
                            </button>
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800">
                             <button class="text-gray-800 font-bold flex items-start w-full focus:outline-none hover:text-gray-700" 
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('tour_date')">
                                <span class="mr-1">Date</span>
                                <sort-up v-if="sortCol==='tour_date' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='tour_date' && sortDir==='desc'"></sort-down>
                            </button>
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800">
                             <button class="text-gray-800 font-bold flex items-center w-full focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('tour_agent')">
                                <span class="mr-1">Tour Agent</span>
                                <sort-up v-if="sortCol==='tour_agent' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='tour_agent' && sortDir==='desc'"></sort-down>
                            </button>
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800">
                             <button class="text-gray-800 font-bold flex items-center w-full focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('tour_guide')">
                                <span class="mr-1">Tour Guide</span>
                                <sort-up v-if="sortCol==='tour_guide' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='tour_guide' && sortDir==='desc'"></sort-down>
                            </button>
                        </th>
                        <th class="py-2 px-2 border-r border-gray-800 text-right">
                             <button class="text-gray-800 font-bold flex items-center w-full justify-end focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('total_agent_sales')">
                                <span class="mr-1">Total Agent Sales</span>
                                <sort-up v-if="sortCol==='total_agent_sales' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='total_agent_sales' && sortDir==='desc'"></sort-down>
                            </button>
                        </th>
                        <th class="py-2 px-2 border border-gray-800 text-right">
                             <button class="text-gray-800 font-bold flex items-center w-full justify-end focus:outline-none hover:text-gray-700"
                                :class="sortDir == 'desc' ? 'items-start' : 'items-end'"
                                @click="sort('total_commissions')">
                                <span class="mr-1">Total Agent Commision</span>
                                <sort-up v-if="sortCol==='total_commissions' && sortDir==='asc'" ></sort-up>
                                <sort-down v-else-if="sortCol==='total_commissions' && sortDir==='desc'"></sort-down>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="report in reports" :key="report.id"
                        class="bg-white even:bg-gray-100 text-sm">
                        <td class="py-2 px-4 border border-gray-800">
                            <a :href="'/sales/' + report.id" class="text-blue-700 font-semibold hover:text-blue-800"> {{ report.report_number }} </a>
                        </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ report.tour_date }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ report.tour_agent }} </td>
                        <td class="py-2 px-4 border border-gray-800"> {{ report.tour_guide }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right"> {{ report.total_agent_sales }} </td>
                        <td class="py-2 px-4 border border-gray-800 text-right">{{ report.total_commissions }}</td>
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
import SortIcon from './ui/icons/Sort';
import SortUp from './ui/icons/SortUp';
import SortDown from './ui/icons/SortDown';

export default {
    name: 'SalesReportList',
    props: ['user'],
    components: {BarLoader, SortIcon,SortUp,SortDown},
    data: function()
    {
        return {
            loading: true,
            reports: null,
            meta: null,
            sortCol: 'tour_date',
            sortDir: 'desc',
            search: ''
        }
    },
    methods: {
        changePage: async function(page){
           try {
                const url = backendUrl + '/api/sales?api_token=' + this.user.api_token 
                + '&page=' + page  
                + '&sort=' + this.sortCol 
                + '&direction=' + this.sortDir
                + '&search=' + this.search;

                const response = await axios.get(url);
                this.reports = response.data.data;
                const meta = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page
                }
                this.meta = meta;

           } catch (error) {
               console.log(error);
           }
        },
        sort: async function(column){

            try {

                this.sortCol = column;

                if(this.sortDir === 'asc'){
                    this.sortDir = 'desc'
                }else {
                    this.sortDir = 'asc'
                }
                
                const url = backendUrl + '/api/sales?api_token=' + this.user.api_token 
                    + '&sort=' + this.sortCol 
                    + '&direction=' + this.sortDir
                    + '&search=' + this.search;

                const response = await axios.get(url);

                this.reports = response.data.data;
                const meta = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page
                }
                this.meta = meta;
                
            } catch (error) {
                console.log(error);
            }

        },
        searchReport: async function(){
            
            try {
                const url = backendUrl + '/api/sales?api_token=' + this.user.api_token + '&search=' + this.search;

                const response = await axios.get(url);

                this.reports = response.data.data;
                const meta = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page
                }
                this.meta = meta;

            } catch (error) {
                console.log(error);
            }
        }
    },
    async mounted(){

        console.log(this.user.api_token);

        try {
            
            const url = backendUrl + '/api/sales?api_token=' + this.user.api_token + '&sort=' + this.sortCol + '&direction=' + this.sortDir;

            const response = await axios.get(url);

            console.log(response.data.data);

            const meta = {
                current_page: response.data.current_page,
                last_page: response.data.last_page
            }

            this.reports = response.data.data;
            this.meta = meta;

            this.loading = false

        } catch (error) {
            
            console.log(error);
        }
    }
}
</script>

<style>

</style>