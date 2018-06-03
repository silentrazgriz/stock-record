import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: Vue.component('App', require('./App.vue')),
        children: [
            {
                path: 'login',
                component: Vue.component('Login', require('./pages/LoginPage.vue'))
            }
        ]
    },
];

const router = new VueRouter({
    hashbang: false,
    mode: 'history',
    routes
});

const app = new Vue({
    router
}).$mount('#app');