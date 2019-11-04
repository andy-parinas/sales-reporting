<template>
    <div>
        <div class="mt-5 mb-2">
            <h1 class="font-light">
                <span v-if="selected">Update/Delete Tour Type</span>
                <span v-else>Add New Tour Type</span>
            </h1>
            <div class="border border-gray-700">
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">
                            Type Name <sup class="text-red-600 font-bold" >*</sup>
                        </label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" :class="errors && errors.name ? 'bg-red-200' : ''" >
                        <input class="w-full focus:outline-none py-2  pl-10 text-gray-800 text-sm bg-transparent"
                            type="text" placeholder="Product Type Name" 
                            v-model="form.name" >
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r py-2  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="guide">Description</label>
                    </div>
                    <div class="flex-1 border-gray-700">
                        <textarea class="w-full focus:outline-none py-2  pl-10 text-gray-800 text-sm"  
                            placeholder="Tour Type Description" name="description" id="description" rows="2" v-model="form.description"></textarea>
                    </div>
                </div>
            </div>
            <div v-if="errors !== null">
                <h3 class="text-red-700 text-sm font-semibold" > </h3>
            </div>
             <div  v-if="selected === true" >
                <button class="flex w-full items-center mt-2 py-2 px-4 text-white rounded justify-center 
                        focus:outline-none bg-blue-600 text-sm hover:bg-blue-700"
                    @click="updateTourType">
                    Update Tour Type
                </button>
                 <button class="flex w-full items-center mt-2 py-2 px-4 text-white rounded justify-center 
                        focus:outline-none bg-red-600 text-sm hover:bg-red-700"
                    @click="deleteTourType">
                    Delete Tour Type
                </button>
                <button class="flex w-full items-center mt-2 py-2 px-4 text-white rounded justify-center 
                                focus:outline-none bg-gray-600 text-sm hover:bg-gray-700"
                    @click="cancel">
                    Cancel
                </button>
            </div>
            <div v-else>
                <button class="flex w-full items-center mt-2 py-2 px-4 text-white rounded justify-center 
                                focus:outline-none bg-blue-600 text-sm hover:bg-blue-700"
                @click="createTourType">
                Add Tour Type
                </button>
            </div>     
        </div>
    </div>
</template>

<script>
export default {
    name: 'TourTypeForm',
    props: ['user', 'backend'],
    data: function(){
        return {
            selectedId: null,
            selectedIndex: null,
            form: {
                name: '',
                description: ''
            },
            selected: false,
            errors: null,
            errorMessage: null
        }
    },
    methods: {

        tourTypeSelected: function(tourType, selectedIndex){
            this.form.name = tourType.name;
            this.form.description = tourType.description;
            this.selectedId = tourType.id;
            this.selected = true;
            this.selectedIndex = selectedIndex;
        },
        createTourType: async function(){

            try {
                
                const url = this.backend + '/api/tour-types';

                const data = {
                    ...this.form,
                    api_token: this.user.api_token
                }

                const response = await axios.post(url, data);

                this.$emit('tourTypeAdded', response.data);
                this.clearfields();
                this.errors = null;

            } catch (error) {
                
                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                    this.errorMessage =  "Errors Check required field"
                    console.log(this.errors);
                }else {
                    this.errorMessage =  "Error Creating Tour Type. Please check with your System Administrator"
                    console.log(error);
                }

                

            }

        },
        updateTourType: async function(){
            try {
                
                const url = this.backend + '/api/tour-types/' + this.selectedId;

                const data = {
                    ...this.form,
                    api_token: this.user.api_token
                }

                const response = await axios.patch(url, data);

                this.$emit('tourTypeUpdated', response.data, this.selectedIndex);


            } catch (error) {
                     
                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                    console.log(this.errors.response);
                }else {
                    this.errors = error;
                    console.log(error);
                }
                this.errorMessage =  "Error Updating Tour Type. Please check with your System Administrator"

            }
        },

        deleteTourType: async function(){

            try {
                
                const url = this.backend + '/api/tour-types/' + this.selectedId + '?api_token=' + this.user.api_token;

                const response = await axios.delete(url);

                this.$emit('tourTypeDeleted', this.selectedIndex);
                this.clearfields();

            } catch (error) {
                
                    
                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                    console.log(this.errors.response);
                }else {
                    this.errors = error;
                    console.log(error);
                }
                this.errorMessage =  "Error Deleting Tour Type. Please check with your System Administrator"

            }
        },
        cancel: function(){
            this.$emit('cancel');

            this.clearfields();
        },

        clearfields: function(){
            
            this.selected = false;
            this.form.name = '';
            this.form.description = '';
            this.errors = null;
        }
    }
}
</script>

<style>

</style>