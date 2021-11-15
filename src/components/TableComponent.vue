<template>
    <div class="flex flex-1  flex-col md:flex-row lg:flex-row mx-2">
        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                Books
                <i v-if="!books.length" class="fa fa-2x fa-plus-circle" @click="showCreateForm"></i>
            </div>

            <div class="p-3">
                <table class="table-responsive w-full rounded">
                    <thead>
                    <tr>
                        <th class="border w-1/4 px-4 py-2">Book Name</th>
                        <th class="border w-1/6 px-4 py-2">Book Description</th>
                        <th class="border w-1/6 px-4 py-2">User</th>
                        <th class="border w-1/6 px-4 py-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="book in books" v-bind:id="book.id" v-bind:key="book.id">
                        <td class="border px-4 py-2">{{ book.name }}</td>
                        <td class="border px-4 py-2">{{ book.description }}</td>
                        <td class="border px-4 py-2">{{book.user_id}}</td>
                        <td class="border px-4 py-2">
                            <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-red-500" type="submit"
                               @click="showCreateForm">
                                Create
                            </a>
                            <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-red-500" type="submit"
                               @click="showEditForm(book)">
                                Edit
                            </a>
                            <a class="bg-teal-300 cursor-pointer rounded p-1 mx-1 text-red-500" type="submit"
                               @click="deleteBook(book.id)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import Swal from "sweetalert2";

export default {
    data() {
        return {
            books: [],
        }
    },
    mounted() {
        this.$axios.get('api/books/',{
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem('access_token')
            }
        }).then((response) => this.books = response.data.books);

    },
    methods: {
        showCreateForm() {
            this.$router.push({
                name: 'create-edit-form',
                params: {
                    "buttonText": "Create Book",
                }})
        },
        showEditForm(book) {
            this.$router.push({
                name: 'create-edit-form',
                params: {
                    "item": book,
                    "buttonText": "Edit Book",
                }
            });
        },
        deleteBook(id) {
            let self = this;
            Swal.fire({
                title: 'Are you sure you want to delete?',
                icon: 'info',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                showCancelButton: true
            }).then(function (response) {
                if (response.isConfirmed) {
                    self.$axios.delete('/api/books/' + id,{
                        headers: {
                            'Authorization': 'Bearer '+localStorage.getItem('access_token')
                        }
                    }).then(function (response) {
                        self.books = self.books.filter(book => book.id !== id)
                        Swal.fire({
                            title: 'Success',
                            text: response.data.message,
                            icon: 'success',
                        })

                    }).catch(function () {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error',
                            icon: 'error',
                        })
                    })
                }
            })

        },
    },
}
</script>
