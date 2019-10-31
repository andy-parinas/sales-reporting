<template>
    <div>
        <div v-if="loading" class="w-full h-96 flex items-center justify-center">
            <bar-loader color="#a0aec0"></bar-loader>
        </div>
        <div  v-else >
            <div v-for="tourType in tourTypes" :key="tourType.id" class="mt-5">
                <h1 class="text-gray-800 font-light text-lg"> {{ tourType.name }} </h1>
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-300 border border-gray-800 text-sm">
                            <td class="py-2 px-2 border border-gray-800 w-56"> Commission Type </td>
                            <td v-for="commission in commissions" :key="commission.id"
                                class="py-2 px-2 border border-gray-800 w-16" >
                                {{ commission.name }}
                            </td>
                            <!-- <td class="py-2 px-2 border border-gray-800 w-32"></td> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="commissionType in commissionTypes" :key="commissionType.id"
                            class="bg-white even:bg-gray-100 text-sm" >
                            <td class="py-2 px-4 border border-gray-800 text-sm"> {{ commissionType.name }} </td>
                            <td v-for="commission in commissions" :key="commission.id"
                                class="py-2 px-4 border border-gray-800 text-sm">
                                {{ getTourCommissionAmount(tourType.id, commissionType.id,commission.id ) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import BarLoader from './ui/loader/BarLoader';

export default {
    name: 'TourCommissionList',
    props: ['tour-commissions', 'user', 'backend'],
    components: { BarLoader},
    data: function(){
        return {
            commissions: [],
            tourTypes: [],
            commissionTypes: [],
            loading: true
        }
    },
    methods: {
        filterTourCommissions: function(tourTypeId, commissionTypeId, commissionId){
            return this.tourCommissions.filter(tourCommission => {
                return tourCommission.commission_type_id === commissionTypeId 
                    && tourCommission.tour_type_id === tourTypeId && tourCommission.commission_id === commissionId;
            })
        },

        getTourCommissionAmount: function(tourTypeId, commissionTypeId, commissionId){
            const commissions = this.tourCommissions.filter(tourCommission => {
                return tourCommission.commission_type_id === commissionTypeId 
                    && tourCommission.tour_type_id === tourTypeId && tourCommission.commission_id === commissionId;
            })

            if (commissions.length > 0) {
                return (commissions[0].amount * 100).toFixed(2)
            }else {
                return 0.00;
            }
        }
    },
    async mounted(){
        
        try {
            
            const tourTypeUrl = this.backend + '/api/tour-types?api_token=' + this.user.api_token
            const commissionTypeUrl = this.backend + '/api/commission-types?api_token=' + this.user.api_token
            const commissionUrl = this.backend + '/api/commissions?api_token=' + this.user.api_token

            const tourTypeResponse = await axios.get(tourTypeUrl);
            const commissionTypeResponse = await axios.get(commissionTypeUrl);
            const commissionResponse = await axios.get(commissionUrl);

            this.commissions = commissionResponse.data;
            this.tourTypes = tourTypeResponse.data;
            this.commissionTypes = commissionTypeResponse.data

            this.loading = false;

        } catch (error) {
            
            console.log(error);
        }




    }
}
</script>

<style>

</style>