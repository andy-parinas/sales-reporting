<template>
    <div>
        <div v-if="loading" class="w-full h-96 flex items-center justify-center">
            <bar-loader color="#a0aec0"></bar-loader>
        </div>
        <table v-else class="my-10 px-5 w-224 mx-auto">
            <thead>
                <tr class="text-left bg-gray-300 border border-gray-800 text-sm">
                    <th class="py-2 px-2 border border-gray-800">Tour Guide</th>
                    <th class="py-2 px-2 border border-gray-800">Email</th>
                    <th class="py-2 px-2 border border-gray-800">Phone</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="guide in guides" :key="guide.id"
                    class="bg-white even:bg-gray-100 text-sm">
                    <td class="py-2 px-4 border border-gray-800 text-sm"> 
                        {{ guide.name }}
                    </td>

                    <td class="py-2 px-4 border border-gray-800 text-sm"> 
                        {{ guide.email }}
                    </td>

                    <td class="py-2 px-4 border border-gray-800 text-sm"> 
                        {{ guide.phone }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import BarLoader from './ui/loader/BarLoader';


export default {
    name: 'TourGuideList',
    props: ['user', 'backend'],
    components: { BarLoader},
    data: function(){
        return {
            guides: [],
            loading: true,
            meta: null
        }
    },
    methods: {

    },
    async mounted(){

        try {
            
            const url = this.backend + '/api/guides?api_token=' + this.user.api_token;

            const response = await axios.get(url);

            this.guides = response.data.data;
            this.meta = response.data.meta;

            this.loading = false;

            console.log(response);

        } catch (error) {
             if(error.response && error.response.data && error.response.data.errors ){
                     console.log(error.response);
                }else {
                    console.log(error);
                }
        }
    }
}
</script>

<style>

</style>