<template>
<div>
    <div v-if="loading" class="w-full h-96 flex items-center justify-center">
        <bar-loader color="#a0aec0"></bar-loader>
    </div>
    <div v-else class="px-4 flex justify-around mt-5 items-start">
        <div class="mr-4 w-224">
            <h1 class="mb-2 text-lg font-light" >Enter Product Information</h1>
            <div class="border border-gray-700">
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Product Name</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <input class="w-full focus:outline-none py-2  pl-10 text-gray-800 text-sm"
                            type="text" id="date" placeholder="Product Name" 
                            v-model="productForm.name">
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r border-b py-2  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="guide">Product Type</label>
                    </div>
                    <div class="flex-1 border-b  border-gray-700">
                        <select class="w-full py-2  pl-10 focus:outline-none text-gray-800 text-sm"  
                                type="text" id="guide" placeholder="Guide Name"
                                v-model="productForm.product_type_id">
                            <option disabled value="" > --- Select Product Type ---</option>
                            <option v-for="type in productTypes" :key="type.id" :value="type.id" > {{ type.name }} </option>
                        </select>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-b border-r py-2  border-gray-700 w-32 text-center">
                        <label class="text-sm font-semibold text-gray-800 uppercase" for="grp">Price</label>
                    </div>
                    <div class="flex-1 border-b border-gray-700">
                        <input class="w-full py-2  pl-10 focus:outline-none text-gray-800 text-sm"  
                            id="grp" placeholder="Product Price"
                            v-model.number="productForm.price">
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r py-2  border-b border-gray-700 w-32 text-center">
                        <label class="text-sm  font-semibold text-gray-800 uppercase" for="tc">Cost</label>
                    </div>
                    <div class="flex-1 border-b border-gray-700">
                        <input class="w-full py-2 pl-10 focus:outline-none  text-gray-800 text-sm"
                            type="text" id="cost" placeholder="Product Cost"
                            v-model.number="productForm.cost">
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="pax">Description</label>
                    </div>
                    <div  class="flex-1 border-gray-700 flex items-center">
                        <textarea class="flex-1 py-1 pl-10 border-gray-700 focus:outline-none  text-gray-800 text-sm"
                            id="description" rows="5" placeholder="Product Description" v-model.number="productForm.description"></textarea>
                    </div>
                </div>
            </div>
            <button class="flex items-center w-full mt-5 py-2 px-4 text-white rounded-full justify-center focus:outline-none bg-indigo-600"
                @click="createProduct" >
                Add New Product 
            </button>
        </div>
        <div class="w-144"> 
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
                        <tr v-for="type in productTypes" :key="type.id">
                            <td class="py-2 px-4 border border-gray-800 text-sm"> {{type.name}} </td>
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
                                type="text" id="date" 
                                placeholder="Product Name">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="border-r py-2  border-gray-700 w-32 text-center">
                            <label  class="text-sm font-semibold text-gray-800 uppercase" for="guide">Type Code</label>
                        </div>
                        <div class="flex-1 border-gray-700">
                            <select class="w-full py-2  pl-10 focus:outline-none text-gray-800 text-sm"  
                                    type="text" id="guide" placeholder="Guide Name">
                                <option value="1" > 1 - High Value </option>
                                <option value="1" > 2 - Regular </option>
                            </select>
                        </div>
                    </div>
                </div>
            <button class="flex w-full items-center mt-2 py-2 px-4 text-white rounded justify-center focus:outline-none bg-blue-600 text-sm    " >
                    Add Product Type
                </button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import BarLoader from './ui/loader/BarLoader';

export default {
    name: 'ProductForm',
    props: ['user', 'backend'],
    components: {BarLoader},
    data: function(){
        return {
            loading: true,
            productTypes: [],
            productForm: {
                name: '',
                description: '',
                product_type_id: '',
                price: '',
                cost: ''
            },
            productTypeForm: {

            }
        }
    },
    methods: {
        createProduct: function(){
            console.log(this.productForm);
        }
    },
    async mounted(){
        try {

            const url = this.backend + '/api/product-types?api_token=' + this.user.api_token;
            const response = await axios.get(url);

            this.productTypes = response.data

            this.loading = false;

        } catch (error) {
            
            console.log(error);
        }
    }

}
</script>

<style>

</style>