<template>
  <div class="mx-auto w-256 mt-10" >
      <div class="flex items-end justify-start">
          <button class="border-t border-l border-r border-gray-700 text-sm py-2 px-4 focus:outline-none rounded-t mr-1"
            :class="selectedView === 'TOUR_TYPE' ? 'bg-white text-black font-semibold' : 'bg-gray-700 text-white'" 
            @click="toggle('TOUR_TYPE')"> 
            Tour Types 
          </button>
          <button class="border-t border-l border-r border-gray-700 ext-sm py-2 px-4 focus:outline-none rounded-t mr-1" 
            :class="selectedView === 'COMMISSION' ? 'bg-white text-black font-semibold' : 'bg-gray-700 text-white'" 
            @click="toggle('COMMISSION')"> 
            Commissions 
          </button>
          <button class="border-t border-l border-r border-gray-700 text-sm py-2 px-4 focus:outline-none rounded-t"
            :class="selectedView === 'COMMISSION_TYPE' ? 'bg-white text-black font-semibold' : 'bg-gray-700 text-white'" 
            @click="toggle('COMMISSION_TYPE')"> 
            Commission Types 
          </button>
          <div class="flex-1 border-b border-gray-700"></div>
      </div>
          <div class="border-l border-r border-b border-gray-600 pt-8">
            <div class="px-4 mx-8 mb-16 items-start">
              <div v-if="selectedView === 'COMMISSION_TYPE'" class=" w-64 mr-4 w-"> 
                  <commission-type-component :user="user" :backend="backend" ></commission-type-component>           
              </div>
              <div v-if="selectedView === 'TOUR_TYPE'" class="flex-1 mr-4 flex-">
                <tour-type-component :user="user" :backend="backend" ></tour-type-component>
              </div>
              <div v-if="selectedView === 'COMMISSION'" class="flex-1">
                  <commission-component :user="user" :backend="backend" ></commission-component>
              </div>
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
    data: function(){
      return {
        selectedView: 'TOUR_TYPE'
      }
    },
    methods: {
      toggle: function(view){
        this.selectedView = view
      }
    }
}
</script>

<style>

</style>