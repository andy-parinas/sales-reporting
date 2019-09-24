<template>
  <div class="flex-1 mr-4">
        <div class="mb-4">
            <label for="filter">Filter</label>
            <input type="text" id="filter" placeholder="Product Name">
        </div>
        <table class="w-full">
            <thead>
                <tr class="text-left bg-gray-300 border border-gray-800 text-sm">
                    <th class="py-2 px-2 border border-gray-800">Product Name</th>
                    <th class="py-2 px-2 border border-gray-800">Price</th>
                    <th class="py-2 px-2 border border-gray-800">QTY</th>
                    <th class="py-2 px-2 border border-gray-800">Total</th>
                    <th class="py-2 px-2 border border-gray-800"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-xs">
                    <td class="py-2 px-4 border border-gray-800">Carpet KK A30</td>
                    <td class="py-2 px-4 border border-gray-800 w-24"> 4950.00 </td>
                    <td class="py-2 px-4 border border-gray-800 w-12"> <input class="w-8 focus:outline-none" type="text" placeholder="0"></td>
                    <td class="py-2 px-4 border border-gray-800 w-12"> <input class="w-12 focus:outline-none" type="text" placeholder="0"></td>
                    <td class="py-2 px-4 border border-gray-800 w-12"> <button>Select</button> </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: 'ProductSelection',
    props: ['user'],
    mounted(){
        const appHeaders = {
            headers: {
                'Content-Type': 'application/json'
            }
        }
        console.log(this.user)
        axios.get('http://localhost:8000/api/products?api_token=' + this.user.api_token).then(response => {
            console.log(response);
        }).catch(err =>{
            console.log(err);
        })
    }
}
</script>

<style>

</style>