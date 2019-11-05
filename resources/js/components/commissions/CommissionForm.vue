<template>
    <div>
        <div class="mt-5 mb-2">
            <h1 class="font-semibold text-blue-800">
                <span v-if="selected">Update/Delete Commissions</span>
                <span v-else>Add New Commission</span>
            </h1>
            <div class="border border-gray-700">
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">
                            Name <sup class="text-red-600 font-bold" >*</sup>
                        </label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" :class="errors && errors.name ? 'bg-red-200' : ''" >
                        <input class="w-full focus:outline-none py-2  pl-10 text-gray-800 text-sm bg-transparent"
                            type="text" placeholder="Commission Name" 
                            v-model="form.name" >
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r py-2  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="guide">Description</label>
                    </div>
                    <div class="flex-1 border-gray-700">
                        <textarea class="w-full focus:outline-none py-2  pl-10 text-gray-800 text-sm"  
                            placeholder="Commission Description" name="description" id="description" rows="2" v-model="form.description"></textarea>
                    </div>
                </div>
            </div>
             <div v-if="errors !== null">
                <h3 class="text-red-700 text-sm font-semibold" > </h3>
            </div>

            <div  v-if="selected === true" >
                <button class="flex w-full items-center mt-2 py-2 px-4 text-white rounded justify-center 
                        focus:outline-none bg-blue-600 text-sm hover:bg-blue-700"
                        @click="updateCommission">
                    <div v-if="updating" class="flex items-center justify-center"> 
                        <h3 class="mr-1">Updating Commission</h3>
                        <circle-loader></circle-loader>
                    </div>
                    <div v-else > Update Commission</div>       
                </button>
                 <button class="flex w-full items-center mt-2 py-2 px-4 text-white rounded justify-center 
                        focus:outline-none bg-red-600 text-sm hover:bg-red-700"
                        @click="deleteCommission">
                    <div v-if="deleting" class="flex items-center justify-center"> 
                        <h3 class="mr-1">Deleting Commission</h3>
                        <circle-loader></circle-loader>
                    </div>
                    <div v-else >Delete Commission</div>                   
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
                @click="createCommission">
                    <div v-if="inserting" class="flex items-center justify-center"> 
                        <h3 class="mr-1">Creating Commission</h3>
                        <circle-loader></circle-loader>
                    </div>
                    <div v-else >Add Commission</div>
                </button>
            </div>

        </div>
    </div>
</template>

<script>

import CircleLoader from '../ui/loader/CircleLoader';


export default {
    name: 'CommissionForm',
    props: ['user', 'backend'],
    components: { CircleLoader},
    data: function(){
        return {
            commissionId: null,
            form: {
                name: '',
                description: ''
            },
            selected: false,
            errors: null,
            selectedIndex: null,
            inserting: false,
            deleting: false,
            updating: false
        }
    },
    methods: {
        commissionSelected: function(commission, selectedIndex){

            this.form.name = commission.name;
            this.form.description = commission.description;
            this.commissionId = commission.id;
            this.selected = true;
            this.selectedIndex = selectedIndex;
            this.errors = null;
        },
        updateCommission: async function(){

            try {

                const url = this.backend + '/api/commissions/' + this.commissionId;

                const data = {
                    ...this.form,
                    api_token: this.user.api_token
                }

                this.updating = true;
                const response = await axios.patch(url, data);

                this.$emit('commissionUpdated', response.data, this.selectedIndex);
                
                this.updating = false;
                
            } catch (error) {
                
                
                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                    this.errorMessage =  "Errors Check required field"
                    console.log(this.errors);
                }else {
                    this.errorMessage =  "Error Creating Tour Type. Please check with your System Administrator"
                    console.log(error);
                }

                this.updating = false;
            }
        },

        deleteCommission: async function(){

            try {

                const url = this.backend + '/api/commissions/' + this.commissionId + '?api_token=' + this.user.api_token;

                this.deleting = true;
                const response = await axios.delete(url);
                this.$emit('commissionDeleted', this.selectedIndex);
                this.clearFields();
                this.selected = null;
                this.deleting = false;
                
            } catch (error) {


                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                    this.errorMessage =  "Errors Check required field"
                    console.log(this.errors);
                }else {
                    this.errorMessage =  "Error Creating Tour Type. Please check with your System Administrator"
                    console.log(error);
                }

                this.deleting = false;
            }

        },
        createCommission: async function(){

            try {
                const url = this.backend + '/api/commissions';

                const data = {
                    ...this.form,
                    api_token: this.user.api_token
                }

                this.inserting = true;
                const response = await axios.post(url, data);

                this.$emit('commissionCreated', response.data);

                this.clearFields();
                this.inserting = false;

            } catch (error) {

                 if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                    this.errorMessage =  "Errors Check required field"
                    console.log(this.errors);
                }else {
                    this.errorMessage =  "Error Creating Tour Type. Please check with your System Administrator"
                    console.log(error);
                }

                this.inserting = false;
            }

        },
        cancel: function(){
            this.selected = false;
            this.clearFields();
            this.$emit('cancel');
        },

        clearFields: function(){
            this.form.name = '';
            this.form.description = '';
            this.errors = null;
        }
    }
}
</script>

<style>

</style>