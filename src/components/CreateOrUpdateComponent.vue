<template>
    <div class="mx-auto bg-grey-lightest">
        <div class="min-h-screen min-w-full flex flex-col">
            <header-component></header-component>
            <div class="flex flex-1" style="width: 950px;">
                <menu-component></menu-component>
                <main class="bg-white-500 flex-1 p-3 overflow-hidden">
                    <div class="flex flex-col">
                        <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
                            <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
                                <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                                    {{ text }}
                                </div>

                                <div v-if="errors" ref="errorMessage" id="errorMessage"
                                     class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg invisible">
                                    <div v-for="(errors, items) in errors" :key="items">
                                        <ul v-for="error in errors" :key="error" class="text-sm">
                                           <li> {{ error }} </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="p-3">
                                    <form id="form" class="w-full">
                                        <div class="flex flex-wrap">
                                            <div class="w-full">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                    Title
                                                </label>
                                                <input v-model="form.name" class="appearance-none block
                                                w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3
                                                leading-tight focus:outline-none focus:bg-white-500" type="text">
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap">
                                            <div class="w-full">
                                                <label
                                                    class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1">
                                                    Description
                                                </label>
                                                <textarea v-model="form.description" class="appearance-none block w-full bg-gray-200
                                                              text-grey-darker border border-gray-200 rounded py-3 px-4
                                                              leading-tight focus:outline-none focus:bg-white-500
                                                              focus:border-gray-600" cols="3" rows="10">
                                                </textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="flex flex-wrap mt-6">
                                            <div class="w-full">
                                                <button ref="submitBtn" class="flex-shrink-0 bg-teal-500 hover:bg-teal-dark-700
                                                border-teal-500 hover:border-teal-dark text-sm border-4 text-white py-1
                                                px-2 rounded" type="button" @click="buttonEvent()">
                                                    {{ text }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
<script>
import MenuComponent from "../components/MenuComponent";
import HeaderComponent from "../components/HeaderComponent";
import Swal from 'sweetalert2'

export default {
    components: {HeaderComponent, MenuComponent},
    data() {
        return {
            form: {
                name: '',
                description: '',
                user_id: localStorage.getItem('user_id')
            },
            books: [],
            errors: []
        }
    },
    mounted() {
        if (this.$route.params.item) {
            this.form.name = this.$route.params.item.name;
            this.form.description = this.$route.params.item.description;
        }
    },
    computed: {
        text() {
            if (this.$route.params.buttonText) {
                return this.$route.params.buttonText;
            }
            return 'Create'
        },
    },
    methods: {
        buttonEvent() {
            this.$route.params.item ? this.editBook() : this.createBook();
        },
        createBook() {
            let self = this;
            this.$axios.post('/api/books', self.form, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                },
            }).then(function () {
                Swal.fire({
                    title: 'Success',
                    text: 'The book created successfully!',
                    icon: 'success',
                })
                self.$router.push({name: 'profile'})
            }).catch(function (error) {
                self.errors = error.response.data.errors;
                document.querySelector('#errorMessage').classList.toggle('invisible')
            });

        },
        editBook() {
            let self = this;
            this.$axios.put('api/books/' + self.$route.params.item.id, this.form, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                },
            }).then(function (response) {
                self.books = self.books.filter(book => book.id !== response.data.updatedBook.id)
                self.books.push(response.data.updatedBook)

                Swal.fire({
                    title: 'Success',
                    text: 'Updated Successfully!',
                    icon: 'success',
                })
                self.$router.push({name: 'profile'})
            }).catch(function (error) {
                self.errors = error.response.data.errors;
                document.querySelector('#errorMessage').classList.toggle('invisible')
            });
        },
    },
    watch: {
        'form.name'(newTitle) {
            this.form.name = newTitle
        },
        'form.description'(newDescription) {
            this.form.description = newDescription
        },
    }
}
</script>
