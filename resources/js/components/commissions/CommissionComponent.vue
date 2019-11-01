<template>
    <div>
        <h1 class="text-lg font-semibold" >Commissions</h1>
        <div v-if="loading" class="w-full h-32 flex items-center justify-center">
            <bar-loader color="#a0aec0"></bar-loader>
        </div>
       <div v-else>
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-300 border border-gray-800 text-sm">
                        <th class="py-2 px-2 border border-gray-800" >Name</th>
                        <th class="py-2 px-2 border border-gray-800">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="commission in commissions" :key="commission.id"
                        class="bg-white even:bg-gray-100 text-sm">
                        <td class="py-2 px-4 border border-gray-800 text-sm">
                            {{ commission.name }}
                        </td>
                        <td class="py-2 px-4 border border-gray-800 text-sm">
                            {{ commission.description }}
                        </td>
                    </tr>
                </tbody>    
            </table>    
       </div>
    </div>
</template>

<script>

import BarLoader from '../ui/loader/BarLoader';

export default {
    name: 'CommissionComponent',
    props: ['user', 'backend'],
    components:{ BarLoader},
    data: function(){

        return {
            commissions: [],
            loading: true,
            errors: false
        }

    },
    async mounted(){
        try {

            const commissionUrl = this.backend + '/api/commissions?api_token=' + this.user.api_token
            const commissionResponse = await axios.get(commissionUrl);

            this.commissions = commissionResponse.data;

            this.loading = false;
            this.errors = false;

        } catch (error) {
            console.log(error);
            this.errors = true;
            this.loading = true;
        }
    }
}
</script>

<style>

</style>