/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('sales-report-form', require('./components/SalesReportForm.vue').default);
Vue.component('sales-report-list', require('./components/SalesReportList.vue').default);
Vue.component('products-list', require('./components/ProductsList.vue').default);
Vue.component('product-form', require('./components/ProductForm.vue').default);
Vue.component('delete-modal', require('./components/ui/actions/DeleteModal.vue').default);
Vue.component('tour-agent-list', require('./components/TourAgentList.vue').default);
Vue.component('tour-agent-form', require('./components/TourAgentForm.vue').default);
Vue.component('tour-guide-list', require('./components/TourGuideList.vue').default);
Vue.component('tour-guide-form', require('./components/TourGuideForm.vue').default);
Vue.component('user-list', require('./components/UserList.vue').default);
Vue.component('summary-report-form', require('./components/SummaryReportForm.vue').default);
Vue.component('summary-report-list', require('./components/SummaryReportList.vue').default);
Vue.component('tour-commission-list', require('./components/TourCommissionList.vue').default);
Vue.component('tour-commission-dashboard', require('./components/TourCommissionDashboard.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
