<template>
    <div class="bg-white p-5 mt-5 rounded">
        <h3 class="pt-4 text-2xl text-center">LogIn</h3>
        <form class="px-8 pt-6 pb-8 mb-4 bg-white" @submit.prevent="login" id="login-form">
            <div class="mb-4 md:flex md:justify-between">
                <div class="mb-4 md:mr-2 md:mb-0">
                    <label class="block mb-2 text-sm font-bold text-gray-700">
                        Email
                    </label>
                    <input type="text" name="email" id="email" v-model="form.email"
                           class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow
                                  appearance-none focus:outline-none focus:shadow-outline"/>
                </div>
                <div class="md:ml-2">
                    <label class="block mb-2 text-sm font-bold text-gray-700">
                        Password
                    </label>
                    <input type="password" id="password" name="password" v-model="form.password"
                           class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border
                           rounded shadow appearance-none focus:outline-none focus:shadow-outline"/>
                </div>
            </div>
            <div class="mb-6 text-center">
                <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full
                hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Login Account
                </button>
            </div>
            <hr class="mb-6 border-t"/>
            <div class="text-center">
                <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                   @click="redirectToRegister">
                    Don't have an account? Sign up
                </a>
            </div>
        </form>
    </div>
</template>
<script>
import Swal from "sweetalert2";

export default {
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
        }
    },
    mounted() {
        document.querySelector('#login-form').reset();
    },
    methods: {
        redirectToRegister() {
            this.$router.push({name: 'register'})
        },
        login() {
            let self = this;
            this.$axios.get('/login', {
                params: {
                    email: this.form.email,
                    password: this.form.password
                }
            }).then(function (response) {
                localStorage.clear();
                localStorage.setItem('access_token', response.data.access_token);
                localStorage.setItem('user_id', response.data.user.id);
                localStorage.setItem('user_name', response.data.user.name);

                Swal.fire({
                    title: 'Logged Successfully',
                    icon: 'success',
                }).then(function () {
                    self.$router.push({name: "profile"})
                });
            }).catch(function () {
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                });
            });
        },
    }
}
</script>
