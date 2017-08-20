window.Axios = require('axios');
window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter);

const BlogListComponent = Vue.component('blog-list', require('./components/blog-list.vue'));
const BlogEditComponent = Vue.component('blog-edit', require('./components/blog-edit.vue'));
const BlogCreateComponent = Vue.component('blog-create', require('./components/blog-create.vue'));

const router = new VueRouter(
    {
        routes: [
            {path: '/', component: BlogListComponent},
            {path: '/create', component: BlogCreateComponent},
            {path: '/edit/:id', component: BlogEditComponent},
        ]
    }
);

const app = new Vue({
    router: router,
    el: '#app'
});