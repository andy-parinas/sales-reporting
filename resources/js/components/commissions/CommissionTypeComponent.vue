<template>
    <div>
        <!-- <h1 class="text-lg font-semibold" >Commission Types</h1> -->
        <div v-if="loading" class="w-full h-32 flex items-center justify-center">
            <bar-loader color="#a0aec0"></bar-loader>
        </div>
        <div v-else>
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-300 border border-gray-800 text-sm">
                        <th class="py-2 px-2 border border-gray-800" >Name</th>
                        <th class="py-2 px-2 border border-gray-800">Code</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="commissionType in commissionTypes" :key="commissionType.id"
                        class="bg-white even:bg-gray-100 text-sm">
                        <td class="py-2 px-4 border border-gray-800 text-sm">
                            {{ commissionType.name }}
                        </td>
                        <td class="py-2 px-4 border border-gray-800 text-sm">
                            {{ commissionType.code }}
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
    name: 'CommissionTypeComponent',
    props: ['user', 'backend'],
    components: { BarLoader},
    data: function(){
        return {
            commissionTypes: [],
            loading: true,
            errors: false
        }
    },
    async mounted(){
        try {

            const commissionTypeUrl = this.backend + '/api/commission-types?api_token=' + this.user.api_token
            const commissionTypeResponse = await axios.get(commissionTypeUrl);

            this.commissionTypes = commissionTypeResponse.data
            this.loading = false;
            this.errors =false;

        } catch (error) {
            console.log(error),
            this.errors = true;
            this.loading = false;
        }
    }
}
</script>

<style>

</style>