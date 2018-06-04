import Vue from 'vue';
import VueRouter from 'vue-router';
import Axios from 'axios';

import App from './App.vue';
import Home from './pages/Home.vue';
import Login from './pages/Login.vue';

import store from './store';

Vue.use(VueRouter);
const axios = Axios.create();

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/login',
        component: Login
    }
];

const token = localStorage.getItem('access-token');
if (token) {
    axios.defaults.headers.common.Authorization = token;
}
console.log(this.$axios);
axios.defaults.baseURL = 'http://localhost:8000/';

const router = new VueRouter({
    hashbang: false,
    mode: 'history',
    routes
});

new Vue({
    router,
    store,
    axios,
    render: h => h(App)
}).$mount('#app');

console.log(this.$axios);