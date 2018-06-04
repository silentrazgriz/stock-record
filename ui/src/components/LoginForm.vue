<template>
    <div id="login-form" class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input id="email" type="email" class="validate" required
                        v-model="credentials.email"/>
                    <label for="email">Email</label>
                    <span class="helper-text" data-error="Invalid email">Please input your email</span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="password" type="password" class="validate" required
                        v-model="credentials.password"/>
                    <label for="password">Password</label>
                    <span class="helper-text" data-error="Password must not be empty">Please input your password</span>
                </div>
            </div>
            <div class="row">
                <div class="col s12 right-align">
                    <button class="btn waves-effect waves-light" type="submit">Login</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                credentials: {
                    email: '',
                    password: ''
                }
            };
        }
    }
</script>

<style lang="scss">
</style>