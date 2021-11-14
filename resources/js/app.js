/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

import Vue from 'vue'
import '../../frontend/src/assets/css/app.css'
import '@fortawesome/fontawesome-free/css/all.css'
import VueRouter from 'vue-router'
import Register from "../../frontend/src/components/Register";
import Login from "../../frontend/src/components/Login";
import Profile from "../../frontend/src/components/Profile";
import CreateForm from "../../frontend/src/components/CreateForm"

Vue.use(VueRouter)
Vue.config.productionTip = false
Vue.prototype.$axios = axios

const router = new VueRouter({
    routes: [
        {
            path: "/",
            name: "register",
            component: Register,
        },
        {
            path: "/login",
            name: "login",
            component: Login,
        },
        {
            path: "/profile",
            name: "profile",
            component: Profile,
        },
        {
            path: "/create",
            name: "create-edit-form",
            component: CreateForm,
        },
    ]
});

new Vue({
    el: '#app',
    router,

});
