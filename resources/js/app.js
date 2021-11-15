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
import RegisterComponent from "../../frontend/src/components/RegisterComponent";
import LoginComponent from "../../frontend/src/components/LoginComponent";
import ProfileComponent from "../../frontend/src/components/ProfileComponent";
import CreateOrUpdateComponent from "../../frontend/src/components/CreateOrUpdateComponent"

Vue.use(VueRouter)
Vue.config.productionTip = false
Vue.prototype.$axios = axios

const router = new VueRouter({
    routes: [
        {
            path: "/",
            name: "register",
            component: RegisterComponent,
        },
        {
            path: "/login",
            name: "login",
            component: LoginComponent,
        },
        {
            path: "/profile",
            name: "profile",
            component: ProfileComponent,
        },
        {
            path: "/create",
            name: "create-edit-form",
            component: CreateOrUpdateComponent,
        },
    ]
});

new Vue({
    el: '#app',
    router,
});
