<template>
  <div>
      {{ result }}
  </div>
</template>

<script>
export default {
    name: 'CurrencyFormat',
    props: ['value'],
    computed: {
        result: function(){
              const options = { 
                minimumFractionDigits: 2,
                maximumFractionDigits: 2 
            };
            return Number(this.value).toLocaleString('en', options);
        }
    }
}
</script>

<style>

</style>