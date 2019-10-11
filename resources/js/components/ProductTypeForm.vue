<template>
    <div>
        <h1 class="mb-2 text-lg font-light" >Available Product Types</h1>
        <div>
            <table class="w-full">
                <thead>
                    <tr class="text-left bg-gray-300 border border-gray-800 text-sm">
                        <th class="py-2 px-2 border border-gray-800 font-normal">Type Name</th>
                        <th class="py-2 px-2 border border-gray-800 font-normal">Code</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(type, index) in productTypes" :key="type.id">
                        <td class="py-2 px-4 border border-gray-800 text-sm"> 
                            <input type="radio" :id="type.id" name="selection" :value="index" v-model="selected" 
                                @change="typeSelected" >
                            <label :for="type.id">{{type.name}} </label>
                            
                        </td>
                        <td class="py-2 px-4 border border-gray-800 text-sm"> {{type.code}} </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-xs mt-1">
            <div>Code 1 - High Value Products</div>
            <div>Code 2 - Regular Value Products</div>
        </div>
        <div class="mt-5 mb-2">
            <h1 class="text-lg font-light" >Add New Product Type</h1>
            <div class="border border-gray-700">
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Type Name</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <input class="w-full focus:outline-none py-2  pl-10 text-gray-800 text-sm"
                            type="text" placeholder="Product Type Name" 
                            v-model="productTypeForm.name" >
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r py-2  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="guide">Type Code</label>
                    </div>
                    <div class="flex-1 border-gray-700">
                        <select class="w-full py-2  pl-10 focus:outline-none text-gray-800 text-sm"  
                                type="text" id="guide" placeholder="Guide Name" v-model="productTypeForm.code">
                            <option disabled value="" > --- Select Type Code ---</option>
                            <option value="1" > 1 - High Value </option>
                            <option value="2" > 2 - Regular </option>
                        </select>
                    </div>
                </div>
            </div>
            <div  v-if="selected !== null" >
                <button class="flex w-full items-center mt-2 py-2 px-4 text-white rounded justify-center 
                                focus:outline-none bg-blue-600 text-sm hover:bg-blue-700"
                    @click="update">
                    Update Product Type
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
                @click="createProductType">
                Add Product Type
                </button>
           </div>
           
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductTypeForm',
    props: ['user', 'backend', 'productTypes'],
    data: function(){
        return {
            productTypeForm: {
                name: '',
                code: ''
            },
            selected: null
        }
    },
    methods: {
        
        createProductType: async function(){

            try {

                const data = {
                    ...this.productTypeForm,
                    api_token: this.user.api_token
                }

                const url =  this.backend + '/api/product-types';

                const response = await axios.post(url, data);

                this.$emit('typeCreated', response.data);


            } catch (error) {
                console.log(error);
            }
        },
        typeSelected: function(){
            this.productTypeForm.name = this.productTypes[this.selected].name
            this.productTypeForm.code = this.productTypes[this.selected].code
        },
        update: async function(){

            try {

                const data = {
                    ...this.productTypeForm,
                    api_token: this.user.api_token
                }

                const url =  this.backend + '/api/product-types/' + this.productTypes[this.selected].id;

                const response = await axios.patch(url, data);

                this.productTypes[this.selected].name = response.data.name;
                this.productTypes[this.selected].code = response.data.code;

            } catch (error) {
                console.log(error);
            }
        },
        cancel: function(){
            this.selected = null;
            this.productTypeForm.name = '';
            this.productTypeForm.code = '';
        }
    }
}
</script>

<style>

</style>