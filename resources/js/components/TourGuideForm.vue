<template>
    <div class="mt-10 w-160 mx-auto">
        <h1 class="mb-2 text-lg font-light" >Enter Tour Guide Information</h1>
        <div class="border border-gray-700">
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-48 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Agent Name</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <input class="w-full focus:outline-none py-3  pl-10 text-gray-800 text-sm"
                            :class="errors && errors.name ? 'bg-red-200' : ''"
                            type="text" id="date" placeholder=" Enter Agent Name" 
                            v-model="guideForm.name" >
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
                            v-model="guideForm.email">
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
                            v-model="guideForm.phone" >
                    </div>
                </div>
        </div>
          <button v-if="edit"
                class="flex items-center w-full mt-5 py-2 px-4 text-white 
                            rounded-full justify-center focus:outline-none bg-indigo-600 hover:bg-indigo-700"
                @click="update">
            Update 
        </button>
         <button v-else
                class="flex items-center w-full mt-5 py-2 px-4 text-white 
                            rounded-full justify-center focus:outline-none bg-indigo-600 hover:bg-indigo-700"
                @click="submit">
            Submit 
        </button>
    </div>
</template>

<script>
export default {
    name: 'TourGuideForm',
    props: ['user', 'backend', 'edit', 'guides'],
    components: {},
    data: function(){

        return {
            guideForm: {
                name: '',
                email: '',
                phone: ''
            },
            errors: null
        }
    },
    methods: {
        submit: async function(){

        },
        update: async function(){

        }
    },
    mounted(){

    }
}
</script>

<style>

</style>