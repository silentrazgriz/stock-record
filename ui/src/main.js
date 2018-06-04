import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './App.vue';
import Home from './pages/Home.vue';
import Login from './pages/Login.vue';

Vue.use(VueRouter);

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

const router = new VueRouter({
    hashbang: false,
    mode: 'history',
    routes
});

const app = new Vue({
    router,
    render: h => h(App)
}).$mount('#app');