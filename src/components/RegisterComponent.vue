<template>
    <div class="bg-white p-5 mt-5 rounded">
        <h3 class="pt-4 text-2xl text-center">Create an Account!</h3>
        <form class="px-8 pt-6 pb-8 mb-4 bg-white" @submit.prevent="register" ref="registerForm">
            <div class="mb-4 md:flex md:justify-between">
                <div class="mb-4 md:mr-2 md:mb-0">
                    <label class="block mb-2 text-sm font-bold text-gray-700">
                        Full Name
                    </label>
                    <input type="text" v-model="form.name" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded
                      shadow appearance-none focus:outline-none focus:shadow-outline"/>
                </div>
                <div class="md:ml-2">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                        Email
                    </label>
                    <input type="text" name="email" id="email" v-model="form.email"
                           class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow
                                  appearance-none focus:outline-none focus:shadow-outline"/>
                </div>
            </div>
            <div class="mb-4 md:flex md:justify-between">
                <div class="mb-4 md:mr-2 md:mb-0">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                        Password
                    </label>
                    <input type="password" id="password" name="password" v-model="form.password"
                           class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border
                           rounded shadow appearance-none focus:outline-none focus:shadow-outline"/>
                </div>
                <div class="md:ml-2">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password_confirmation">
                        Confirm Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           v-model="form.password_confirmation"
                           class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow
                           appearance-none focus:outline-none focus:shadow-outline"/>
                </div>
            </div>
            <div class="mb-6 text-center">
                <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full
                hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Register Account
                </button>
            </div>
            <hr class="mb-6 border-t"/>
            <div class="text-center">
                <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                   @click="redirectToLogin">
                    Already have an account? Login!
                </a>
            </div>
        </form>
    </div>
</template>

<script>
import Swal from 'sweetalert2'

export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    mounted() {
        this.$refs.registerForm.reset();
    },
    methods: {
        redirectToLogin() {
            this.$router.push({name: 'login'})
        },
        register() {
            let self = this;
            this.$axios.post('/register', this.form)
                .then(function () {
                    Swal.fire({
                        title: 'Success',
                        text: 'The user register successfully!',
                        icon: 'success',
                    });
                    self.$router.push({name: 'login'});
                }).catch(function () {
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                });
            });
        },
    },
    watch: {
        'form.name'(newName) {
            this.form.name = newName;
        },
        'form.email'(newEmail) {
            this.form.newEmail = newEmail;
        },
        'form.password'(newPassword) {
            this.form.password = newPassword;
        },
        'form.password_confirmation'(newConfirmPassword) {
            this.form.password_confirmation = newConfirmPassword;
        },
    }
}
</script>
