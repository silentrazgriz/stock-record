<template>
    <div id="app">
        <navigation></navigation>
        <router-view></router-view>
    </div>
</template>

<script>
    import M from 'materialize-css';
    import Navigation from './components/Navigation.vue';

    export default {
        components: {
            Navigation
        }
    };
</script>

<style lang="scss">
    @import 'styles/custom-materialize';
</style>