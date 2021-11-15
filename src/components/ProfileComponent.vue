<template>
    <div class="mx-auto bg-grey-lightest">
        <div class="min-h-screen flex flex-col">
            <header-component></header-component>
            <div class="flex flex-1" style="width: 1200px;">
                <menu-component></menu-component>
                <table-component></table-component>
            </div>
        </div>
    </div>
</template>
<script>
import MenuComponent from "./MenuComponent";
import TableComponent from "./TableComponent";
import HeaderComponent from "./HeaderComponent";

export default {
    components: {
        HeaderComponent, MenuComponent, TableComponent
    },
    mounted() {
        if (!localStorage.getItem('access_token')) {
            this.$router.push({name: "login"})
        }
    },
    methods: {
        showCreateForm() {
            this.$router.push({name: 'create-edit-form'})
        }
    },
}
</script>
