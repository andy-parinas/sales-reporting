<template>
    <div>
        <div v-if="loading" class="w-full h-96 flex items-center justify-center">
            <bar-loader color="#a0aec0"></bar-loader>
        </div>
        <div v-else class="my-10 px-5 w-288 mx-auto">
                <form action="#">
                <div class="flex items-center border border-gray-700 rounded">
                        <label for="search" class="pl-2 font-bold text-gray-800 mr-2">Find</label>
                        <input class="py-2 px-4 flex-1 focus:outline-none"
                            id="search" type="text" placeholder="Report Number">
                        <button class="border border-blue-700 bg-blue-700 py-2 px-4 text-white">Search</button>
                </div>
                </form>
            <table class="w-full mt-5">
                <thead>
                    <tr class="text-left bg-gray-300 border border-gray-800">
                        <th class="py-2 px-2 border border-gray-800">Report Number</th>
                        <th class="py-2 px-2 border border-gray-800">Date</th>
                        <th class="py-2 px-2 border border-gray-800">Tour Agent</th>
                        <th class="py-2 px-2 border border-gray-800">Tour Guide</th>
                        <th class="py-2 px-2 border border-gray-800 text-right">Total Agent Sales</th>
                        <th class="py-2 px-2 border border-gray-800 text-right">Total Agent Commision</th>
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
export default {
    name: 'SalesReportList',
    props: ['user'],
    components: {BarLoader},
    data: function()
    {
        return {
            loading: true,
            reports: null,
            meta: null,
        }
    },
    methods: {
        changePage: async function(page){
           try {
                const url = backendUrl + '/api/sales?api_token=' + this.user.api_token + '&page=' + page;
                const response = await axios.get(url);
                this.reports = response.data.data;
                this.meta = response.data.meta;

           } catch (error) {
               console.log(error);
           }
        }
    },
    async mounted(){

        console.log(this.user.api_token);

        try {
            
            const url = backendUrl + '/api/sales?api_token=' + this.user.api_token

            const response = await axios.get(url);

            this.reports = response.data.data;
            this.meta = response.data.meta;

            this.loading = false

            console.log(response);

        } catch (error) {
            
            console.log(error);
        }
    }
}
</script>

<style>

</style>