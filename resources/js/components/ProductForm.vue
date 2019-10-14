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
                    <div class="border-b border-r py-1  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="agent">Product Name</label>
                    </div>
                    <div  class="flex-1 border-b border-gray-700" >
                        <input class="w-full focus:outline-none py-2  pl-10 text-gray-800 text-sm"
                            :class="errors && errors.name ? 'bg-red-200' : ''"
                            type="text" id="date" placeholder="Product Name" 
                            v-model="productForm.name">
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r border-b py-1  border-gray-700 w-32 text-center">
                        <label  class="text-sm font-semibold text-gray-800 uppercase" for="guide">Product Type</label>
                    </div>
                    <div class="flex-1 border-b  border-gray-700">
                        <select class="w-full py-2  pl-10 focus:outline-none text-gray-800 text-sm"  
                            :class="errors && errors.product_type_id ? 'bg-red-200' : ''"
                                type="text" id="guide" placeholder="Guide Name"
                                v-model="productForm.product_type_id">
                            <option disabled value="" > --- Select Product Type ---</option>
                            <option v-for="type in productTypes" :key="type.id" :value="type.id" > {{ type.name }} </option>
                        </select>
                    </div>
                </div>
                <div class="flex">
                    <div class="border-b border-r py-1  border-gray-700 w-32 text-center">
                        <label class="text-sm font-semibold text-gray-800 uppercase" for="grp">Price</label>
                    </div>
                    <div class="flex-1 border-b border-gray-700">
                        <input class="w-full py-2  pl-10 focus:outline-none text-gray-800 text-sm"
                            :class="errors && errors.price ? 'bg-red-200' : ''"  
                            id="grp" placeholder="Product Price"
                            v-model.number="productForm.price">
                    </div>
                </div>
                <div class="flex">
                    <div class="border-r py-1  border-b border-gray-700 w-32 text-center">
                        <label class="text-xs font-semibold text-gray-800 uppercase" for="tc">Cost</label>
                    </div>
                    <div class="flex-1 border-b border-gray-700">
                        <input class="w-full py-2 pl-10 focus:outline-none  text-gray-800 text-sm"
                            :class="errors && errors.cost ? 'bg-red-200' : ''"
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
                            :class="errors && errors.description ? 'bg-red-200' : ''"
                            id="description" rows="5" placeholder="Product Description" v-model.number="productForm.description"></textarea>
                    </div>
                </div>
            </div>
            <button v-if="edit" 
                    class="flex items-center w-full mt-5 py-2 px-4 text-white 
                                rounded-full justify-center focus:outline-none bg-indigo-600 hover:bg-indigo-700"
                @click="updateProduct" >
                Update Product 
            </button>
            <button v-else 
                    class="flex items-center w-full mt-5 py-2 px-4 text-white
                             rounded-full justify-center focus:outline-none bg-indigo-600 hover:bg-indigo-700"
                @click="createProduct" >
                Add New Product 
            </button>
        </div>
        <div class="w-144"> 
            <product-type-form  :user="user" :backend="backend" :productTypes="productTypes" 
               @typeCreated="pushProductType" ></product-type-form>
        </div>
    </div>
</div>
</template>

<script>
import BarLoader from './ui/loader/BarLoader';
import ProductTypeForm from './ProductTypeForm';

export default {
    name: 'ProductForm',
    props: ['user', 'backend', 'edit', 'product'],
    components: {BarLoader, ProductTypeForm},
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
          
            errors: null
        }
    },
    methods: {
        createProduct: async function(){

            try {
                    
                const data = {
                    ...this.productForm,
                    api_token: this.user.api_token
                }

                const url =  this.backend + '/api/products';

                const response = await axios.post(url, data);

                window.location.href = '/products/' + response.data.id;

            } catch (error) {
                
                console.log(error.response);

                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                }else {
                    console.log(error);
                }

            }
        },

        updateProduct: async function(){

            try {
                
                 const url =  this.backend + '/api/products/' + this.product.id;

                const data = {
                    ...this.productForm,
                    api_token: this.user.api_token
                }

                const response = await axios.patch(url, data);

                 window.location.href = '/products/' + response.data.id;


            } catch (error) {
                
                console.log(error.response);

                if(error.response && error.response.data && error.response.data.errors ){
                    this.errors = error.response.data.errors
                }else {
                    console.log(error);
                }

            }

        },

        pushProductType: function(productType){
            this.productTypes.push(productType);
        }

    },
    async mounted(){
        try {

            const url = this.backend + '/api/product-types?api_token=' + this.user.api_token;
            const response = await axios.get(url);

            this.productTypes = response.data

            if(this.edit){
                this.productForm = {
                    ...this.product,
                    price: parseFloat((this.product.price).replace(',','')),
                    cost: parseFloat((this.product.cost).replace(',',''))
                }
            }

            this.loading = false;

        } catch (error) {
            
            console.log(error);
        }
    }

}
</script>

<style>

</style>