<template>
    <div>
        <div v-if="loading" class="w-full h-96 flex items-center justify-center">
            <bar-loader color="#a0aec0"></bar-loader>
        </div>
        <div  v-else >
            <div v-if="savingMessage" class="bg-blue-700 text-white py-2 px-2 rounded flex items-center">
                <h1 class="mr-4">{{ savingMessage }} </h1>
                <circle-loader color="#FFFFFF"></circle-loader>
            </div>
            <div v-if="successMessage" class="bg-green-700 text-white py-2 px-2 rounded flex items-center justify-between">
                <h1 class="mr-4"> {{ successMessage }}  </h1>
                <button @click="successMessage = null" >X</button>
            </div>
            <div v-if="errorMessage" class="bg-red-700 text-white py-2 px-2 rounded flex items-center justify-between">
                <h1 class="mr-4"> {{ errorMessage }}  </h1>
                <button @click="errorMessage = null" >X</button>
            </div>
            <div v-for="(tourType, tourTypeIndex) in tourTypes" :key="tourType.id" class="mt-5">
                <h1 class="text-gray-800 font-light text-lg"> {{ tourType.name }} </h1>
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-300 border border-gray-800 text-sm">
                            <th class="py-2 px-2 border border-gray-800 w-40"> Commission Type </th>
                            <th v-for="commission in commissions" :key="commission.id"
                                class="py-2 px-2 border border-gray-800 w-12" >
                                {{ commission.name }}
                            </th>
                            <th class="w-16"></th>
                            <!-- <td class="py-2 px-2 border border-gray-800 w-32"></td> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(commissionType, commissionTypeIndex) in commissionTypes" :key="commissionType.id"
                            class="text-sm" :class="(editX === tourTypeIndex && editY === commissionTypeIndex) ? 'bg-yellow-100': 'bg-white even:bg-gray-100' " >
                            <td class="py-2 px-4 border border-gray-800 text-sm"> {{ commissionType.name }}   </td>
                            <td v-for="commission in commissions" :key="commission.id"
                                class="border border-gray-800 text-sm text-right">
                                <input class="bg-transparent outline-none text-xs text-right py-2 px-1 w-16"
                                        :class="(editX === tourTypeIndex && editY === commissionTypeIndex)? 'text-gray-900 font-semibold' : 'text-gray-700'"
                                        type="text" :disabled="!(editX === tourTypeIndex && editY === commissionTypeIndex)"
                                        v-model.number ="input[tourType.id][commissionType.id][commission.id]" 
                                        @change="onTourCommissionChanged(tourType.id, commissionType.id, commission.id)" >
                            </td>
                            <td class="border border-gray-800 text-sm px-1 w-32" >
                               <div class="w-full  flex">
                                    <button v-if="editX === tourTypeIndex && editY === commissionTypeIndex"
                                        class="text-white text-xs bg-blue-500 py-1 px-2 w-full rounded focus:outline-none mr-1" 
                                        @click="saveTourCommission(tourType.id, commissionType.id)" >
                                        Save
                                </button>
                                <button v-if="editX === tourTypeIndex && editY === commissionTypeIndex"
                                    class="text-white text-xs bg-gray-600 py-1 px-2 w-full rounded focus:outline-none"
                                    @click="cancelEdit" >
                                    Cancel
                                </button>
                                <button v-else
                                    class="text-white text-xs bg-yellow-700 py-1 px-2 w-full rounded mr-1 focus:outline-none"
                                    @click="editRow(tourTypeIndex, commissionTypeIndex)">
                                    Edit
                                </button>
                               </div>
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
import CircleLoader from './ui/loader/CircleLoader';

export default {
    name: 'TourCommissionList',
    props: ['tour-commissions', 'user', 'backend', 'agent-id'],
    components: { BarLoader, CircleLoader},
    data: function(){
        return {
            commissions: [],
            tourTypes: [],
            commissionTypes: [],
            loading: true,
            input: {},
            changedTourCommissions: [],
            editX:null,
            editY: null,
            savingMessage: null,
            successMessage: null,
            errorMessage: null
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
        },

        onTourCommissionChanged: function(tourTypeId, commissionTypeId, commissionId){
            const data = {
                tourTypeId,
                commissionTypeId,
                commissionId
            }
            this.changedTourCommissions.push(data);
        },

        saveTourCommission: function(tourTypeId, commissionTypeId){

            this.changedTourCommissions.map(async tc => {
                
                const tourCommission = this.filterTourCommissions(tc.tourTypeId, tc.commissionTypeId, tc.commissionId)[0];

                if(tourCommission){

                    const url = this.backend + '/api/tour-commissions/' + tourCommission.id

                    const data = {
                        amount: this.input[tc.tourTypeId][tc.commissionTypeId][tc.commissionId] / 100,
                        api_token: this.user.api_token
                    }

                    try {

                        this.sendSavingMessage(`Updating TourCommissions`)

                        const res = await axios.patch(url, data)

                        this.sendSuccessMessage('Tour Commission successfully updated');
                        
                    } catch (error) {
                        this.sendErrorMessage('Error updating Tour Commission, make sure fields are correct. Otherwise report to System Administrator');
                        console.log("Error updating tour commision", err);
                    }

                }else {

                    const url = this.backend + '/api/tour-commissions/'

                    const data = {
                        tour_agent_id: this.agentId,
                        tour_type_id: tc.tourTypeId,
                        commission_type_id: tc.commissionTypeId,
                        commission_id: tc.commissionId,
                        amount: this.input[tc.tourTypeId][tc.commissionTypeId][tc.commissionId] / 100,
                        api_token: this.user.api_token
                    }

                    try {

                        this.sendSavingMessage(`Creating TourCommissions`)

                        const res = await axios.post(url, data)

                        this.sendSuccessMessage('Tour Commission successfully created');
                        
                    } catch (error) {
                        this.sendErrorMessage('Error Creating Tour Commission, make sure fields are correct. Otherwise report to System Administrator');
                        console.log("Error Creating tour commision", err);
                    }

                }


            })

            // //simulate success or failed. Clear the changeCommission array
            // this.changedTourCommissions.splice(0, this.changedTourCommissions.length);

            console.log(this.changedTourCommissions);

        },

        editRow: function(tourTypeIndex, commissionTypeIndex){
            this.changedTourCommissions.splice(0, this.changedTourCommissions.length);
            this.editX = tourTypeIndex;
            this.editY = commissionTypeIndex;
        },
        cancelEdit: function(){
            this.changedTourCommissions.splice(0, this.changedTourCommissions.length);
            this.editX = null;
            this.editY = null;
        },
        initializedInput: function(){

            this.tourTypes.map(tourType => {

                const tourTypeObject = {}

                this.commissionTypes.map(commissionType => {

                    const commissionTypeObject = {}

                    this.commissions.map(commission => {

                        commissionTypeObject[commission.id] = this.getTourCommissionAmount(tourType.id, commissionType.id, commission.id)
        
                    })

                    tourTypeObject[commissionType.id] = commissionTypeObject;
                })

                this.input[tourType.id] = tourTypeObject;
            })

            console.log(this.input);


        },

        sendSuccessMessage: function(message){
            this.savingMessage = null;
            this.errorMessage = null;
            this.successMessage = message;
        },
        sendErrorMessage: function(message){
            this.savingMessage = null;
            this.successMessage = null;
            this.errorMessage = message;
        },
        sendSavingMessage: function(message){
            this.savingMessage = message;
            this.errorMessage = null;
            this.successMessage = null;
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

            this.initializedInput();

            console.log(this.tourCommissions);

        } catch (error) {
            
            console.log(error);
        }




    }
}
</script>

<style>

</style>