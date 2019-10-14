<template>
  <div>
       <div class="relative">
            <button id="navbarDropdown"
                    class="uppercase text-sm font-semibold bg-red-700 py-2 px-4 rounded text-white hover:bg-red-600"
                    @click="modal = !modal">
                Delte
            </button>
       </div>
        <div v-if="modal" 
            class="bg-black absolute top-0 left-0 h-screen w-full z-10 opacity-50">    
        </div>
        <div v-if="modal" class="absolute top-0 left-0 h-screen w-full z-30 absolute bg-transparent">
            <div class="bg-white shadow rounded py-10 px-10  mt-64 w-144 mx-auto">
                <div v-if="success" class="flex items-center justify-center">
                    <h1 class="text-gray-800 font-light text-xl mr-2" >Successfully Deleted Item.</h1>
                    <a :href="back" class="py-2 px-4 bg-green-600 text-white rounded hover:bg-green-700 mr-1" >OK</a>
                </div> 
                <div v-else-if="failed" class="flex flex-col justify-between items-start">
                    <h1 class="text-red-800 font-semibold text-xl" >Failed Deleting Item.</h1>
                    <h2  class="text-gray-800 font-light text-lg">Make Sure that Item is not referenced. Otherwise Contact your IT</h2>
                    <button class="py-2 px-4 bg-gray-600 text-white rounded hover:bg-gray-700 mr-1 mt-2"
                            @click="modal = false" >OK</button>
                </div>
                <div v-else class="flex items-center justify-center">
                    <h1 class="text-gray-800 font-light text-xl mr-2" >Are Your Sure You Want to Delete?</h1>
                    <button class="py-2 px-4 bg-red-600 text-white rounded hover:bg-red-700 mr-1" @click="deleteData" >Yes</button>
                    <button class="py-2 px-4 bg-gray-600 text-white rounded hover:bg-gray-700" @click="modal = !modal">No</button>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
export default {
    name: 'DeleteModal',
    props: ['url', 'user', 'back'],
    data: function(){
        return {
            modal: false,
            success: false,
            failed: false
        }
    },
    methods: {
        deleteData: async function(){

            try {
                
                const data = {
                    api_token: this.user.api_token
                }

                const deleteUrl = this.url + '?api_token=' + this.user.api_token

                const response = await axios.delete(deleteUrl);

                this.failed = false;
                this.success = true;

            } catch (error) {
                
                console.log(error.response);

                this.failed = true;

            }
        }
    },
    mounted(){
        console.log(this.back);
        console.log(this.user.api_token);
    }
}
</script>

<style>

</style>