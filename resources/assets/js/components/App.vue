<template>...</template>
<script>
    function Crud({id, color, name}) {
        this.id = id;
        this.color = color;
        this.name = name;
    }

    import LoginComponent from './LoginComponent.vue';

    export default {
        data() {
            return {
                cruds: []
            }
        },
        methods: {
            create() {
                // To do
            },
            read() {
                // To do
            },
            update(id, color) {
                // To do
            },
            del(id) {
                // To do
            }
        },
        components: {
            LoginComponent
        }
    }
</script>