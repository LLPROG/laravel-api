
require('./bootstrap');
import 'bootstrap';
import { values } from 'lodash';

window.Vue = require('vue');
window.Axios = require('axios');

import VueRouter from 'vue-router';
import App from './views/App.vue';
import PageHome from './pages/PageHome.vue';
import PageAbout from './pages/PageAbout.vue';
import BlogIndex from './pages/BlogIndex.vue';
import BlogShow from './pages/BlogShow.vue';


Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: PageHome
        },
        {
            path: '/about',
            name: 'about',
            component: PageAbout
        },
        {
            path: '/blog',
            name: 'blogIndex',
            component: BlogIndex
        },
        {
            path: '/blog/:slug',
            name: 'blogShow',
            component: BlogShow,
            props: true,
        },
    ],
})

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});

