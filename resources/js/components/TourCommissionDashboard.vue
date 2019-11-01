<template>
  <div>
      <div class="px-4 flex justify-between mt-5 items-start">
        <div class=" w-64 mr-4 w-"> 
            <commission-type-component :user="user" :backend="backend" ></commission-type-component>           
        </div>
        <div class="flex-1 mr-4 flex-">
           <tour-type-component :user="user" :backend="backend" ></tour-type-component>
        </div>
        <div class="flex-1">
            <commission-component :user="user" :backend="backend" ></commission-component>
        </div>
      </div>
  </div>
</template>

<script>

import TourTypeComponent from './commissions/TourTypeComponent';
import CommissionTypeComponent from './commissions/CommissionTypeComponent';
import CommissionComponent from './commissions/CommissionComponent';

export default {
    name: 'TourcommissionDashboard',
    props: ['user', 'backend'],
    components: { TourTypeComponent, CommissionTypeComponent, CommissionComponent },
    data: function() {
        return {
            tourTypes: [],
            commissionTypes: [],
            commissions: []
        }
    },
    async mounted(){

        try {
            



        } catch (error) {
            console.log(error);

        }
    }
}
</script>

<style>

</style>