<template>
    <div class="mt-10 w-224 mx-auto">
        <h1 class="mb-2 text-lg font-light" >Enter Tour Agent Information</h1>
        <div class="border border-gray-700">
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Agent Name</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <input class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm"
                            :class="errors && errors.name ? 'bg-red-200' : ''"
                            type="text" id="date" placeholder=" Enter Agent Name" 
                            v-model="agentForm.name" >
                    </div>
                </div>
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Address</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <input class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm"
                            :class="errors && errors.name ? 'bg-red-200' : ''"
                            type="text" id="date" placeholder="Street, City, State"
                            v-model="agentForm.address" >
                    </div>
                </div>
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">E-Mail Address</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <input class="w-full focus:outline-none py-3 pl-10 text-gray-800 text-sm"
                            :class="errors && errors.name ? 'bg-red-200' : ''"
                            type="text" id="date" placeholder="agent@email.com" 
                            v-model="agentForm.email">
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Contact Number</label>
                    </div>
                    <div  class="flex-1 border-gray-700" >
                        <input class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm"
                            :class="errors && errors.name ? 'bg-red-200' : ''"
                            type="text" id="date" placeholder="1234-5678"
                            v-model="agentForm.phone" >
                    </div>
                </div>
        </div>
         <button
                class="flex items-center w-full mt-5 py-2 px-4 text-white 
                            rounded-full justify-center focus:outline-none bg-indigo-600 hover:bg-indigo-700"
                @click="submit">
            Submit 
        </button>
    </div>
</template>

<script>
export default {
    name: 'TourAgentForm',
    props: ['user', 'backend'],
    data: function(){
        return {
            agentForm: {
                name: '',
                address: '',
                email: '',
                phone: ''
            },
            errors: null
        }
    },
    methods: {

        submit: async function(){

            try {
                
                const data = {
                    ...this.agentForm,
                    api_token: this.user.api_token
                }

                const url = this.backend + '/api/agents';

                const response = await axios.post(url,data);

                window.location.href = '/agents/' + response.data.id;

            } catch (error) {
                 
                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                     console.log(error.response);
                }else {
                    console.log(error);
                }
            }
        }
    }
}
</script>

<style>

</style>