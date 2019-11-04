<template>
    <div>
        <h1 class="text-lg font-semibold" >Tour Types</h1>
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
                        <tr v-for="(tourType, index) in tourTypes" :key="tourType.id" 
                            class="bg-white even:bg-gray-100 text-sm">
                            <td class="py-2 px-4 border border-gray-800 text-sm"> 
                                <input type="radio" :id="tourType.id" name="selection" :value="index"  v-model="selectedTypeIndex"
                                @change="tourTypeSelected(index)" >
                                 <label :for="tourType.id">{{ tourType.name }}  </label>
                            </td>
                            <td class="py-2 px-4 border border-gray-800 text-sm"> 
                                {{ tourType.description }} 
                            </td>
                        </tr>    
                    </tbody> 
                </table>
                <div v-if="successMessage">
                    <div class="px-4 py-2 border-green-500 bg-green-700 text-white font-semibold rounded my-2 flex items-center justify-between text-sm">
                        <div>{{ successMessage }}</div>
                        <button @click="clearMessage" >X</button>
                    </div>
                </div>
                <tour-type-form ref="tourTypeForm" :user="user"  :backend="backend"
                    @tourTypeAdded="tourTypeInsert"
                    @tourTypeUpdated="tourTypeUpdate"
                    @tourTypeDeleted="tourTypeDelete"
                    @cancel="clearSelection"  ></tour-type-form>
        </div>
    </div>
</template>

<script>

import BarLoader from '../ui/loader/BarLoader';
import TourTypeForm from './TourTypeForm';

export default {
    name: 'TourTypeComponent',
    props: ['user', 'backend'],
    components: { BarLoader, TourTypeForm},
    data: function(){
        return {
            tourTypes: [],
            loading: true,
            errors: false,
            selectedTypeIndex: null,
            selectedType: null,
            successMessage: null
        }
    },
    methods: {
        tourTypeSelected: function(index){
        
            this.selectedType = this.tourTypes[this.selectedTypeIndex];
            
            this.$refs.tourTypeForm.tourTypeSelected(this.selectedType, index);


        },
        clearSelection(){
            this.selectedTypeIndex = null
            this.selectedType = null;
        },
        tourTypeInsert: function(data){

            this.tourTypes.push(data);
            this.successMessage = 'Tour Type Successfully Created'
        },
        tourTypeUpdate: function(data, index){

            this.tourTypes[index].name = data.name;
            this.tourTypes[index].description = data.description;
            this.successMessage = 'Tour Type Successfully Updated'

        },
        tourTypeDelete: function(index){
            this.tourTypes.splice(index, 1);
            this.clearSelection();
            this.successMessage = 'Tour Type Successfully Deleted'

        },
        clearMessage: function(){
            this.successMessage = null;
        }
    },
    async mounted(){
        try {
            const tourTypeUrl = this.backend + '/api/tour-types?api_token=' + this.user.api_token

            const tourTypeResponse = await axios.get(tourTypeUrl);

            this.tourTypes = tourTypeResponse.data;
            this.loading = false;
            this.errors = false;

        } catch (error) {
            console.log(error);
            this.errors = true;
            this.loading = false;
        }
    },
}
</script>

<style>

</style>