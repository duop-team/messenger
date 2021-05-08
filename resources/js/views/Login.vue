<template>
    <service-layout card-title="Sign in">
        <div slot="card">
            <div class="card__description">
                <p>Please, enter your country, phone number or whatever they want from you</p>
            </div>
            <div class="card__form">
                <form method="post" @submit.prevent="login" autocomplete="off" autofocus>
                    <input-field type="email" name="email" v-model="form.email" required="true" autofocus>Email</input-field>
                    <input-field type="password" name="password" v-model="form.password" required="true">Password</input-field>
                    <div class="form__footer">
                        <div v-if="$store.getters['auth/loading']">
                            <img src="/images/loader.svg" alt="Loading..." height="40">
                        </div>
                        <!--TODO: show error and remove it on typing-->
                        <div class="form__submit">
                            <RoundedButton type="submit">Submit</RoundedButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div slot="content" class="links">
            <div class="links__text">Don’t have an account?</div>
            <router-link to="/register" class="links__link" replace>Sign up</router-link>
        </div>
    </service-layout>
</template>

<script>
import authService from '../services/auth';
import {isNavigationFailure} from "vue-router/src/util/errors";
import {NavigationFailureType} from "vue-router";

export default {
    name: "Login",
    data() {
        return {
            form: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        login() {
            this.$store.dispatch('auth/setForm', this.form);
            this.$store.dispatch('auth/login');
        }
    },
    computed: {
        hasErrors() {
            return Object.keys(this.errors).length > 0;
        }
    }
}
</script>

<style scoped lang="scss">
</style>
