<template>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><router-link to="/">Home</router-link></li>
                    <li><router-link to="/login">Login</router-link></li>
                </ul>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-nav">
            <li class="sidenav-header light-green darken-1"><a href="#" class="white-text">Menu</a></li>
            <li><router-link to="/">Home</router-link></li>
            <li><router-link to="/login">Login</router-link></li>
        </ul>
    </div>
</template>

<script>
    export default {
        mounted() {
            let elems = document.querySelectorAll('.sidenav');
            M.Sidenav.init(elems);
        }
    }
</script>

<style lang="scss">
    nav ul a {
        padding: 0 30px;
    }
    .router-link-exact-active {
        background: rgba(0, 0, 0, 0.1);
    }
    .navbar-fixed {
        margin-bottom: 15px;
        z-index: 998;
    }
</style>