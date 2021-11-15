<template>
    <header class="bg-nav">
        <div class="flex justify-between">
            <div class="p-1 flex flex-row items-center">
                <a href="#" @click="openDropDown()"
                   class="text-white p-2 no-underline hidden md:block lg:block">
                    {{ greeting }}
                </a>
                <div ref="myDropdown"
                     class="rounded shadow-md bg-white absolute pin-t mr-1 pin-r mt-20 invisible">
                    <ul class="list-reset">
                        <li>
                            <button type="submit" @click="logout" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">
                                Logout
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</template>
<script>
export default {
    computed: {
        greeting() {
           return "Hello "+localStorage.getItem('user_name')
        }
    },
    methods: {
        openDropDown() {
            this.$refs.myDropdown.classList.toggle('invisible');
        },
        logout() {
            localStorage.removeItem('access_token')
            localStorage.removeItem('user')
            this.$router.push({name: 'login'})
        }
    },
}
</script>
