window.Vue = require('vue');
window.Axios = require('axios');

Vue.component('user-list', require('./components/user-list.vue'));

const app = new Vue({
    el: '#app'
});
