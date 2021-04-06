<template>
    <service-layout card-title="Sign in">
        <div slot="card">
            <div class="card__description">
                <p>Please, enter your country, phone number or whatever they want from you</p>
            </div>
            <div class="card__form">
                <form action="#" method="post" @submit.prevent="login">
                    <BaseInput type="email" name="email" v-model="form.email" required="true">Email</BaseInput>
                    <BaseInput type="password" name="password" v-model="form.password" required="true">Password
                    </BaseInput>
                    <div class="form__footer">
                        <div class="form__error" v-show="hasErrors">
                            <img src="/images/error_icon.svg" class="error__img">
                            <div class="error__text">Warning! You did something wrong.</div>
                        </div>
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
            },
            errors: {
            }
        }
    },
    methods: {
        login() {
            authService.login(this.form)
                .then(() => this.$router.replace('/chats'))
                .catch(e => {
                    this.errors = e.response.data.errors;
                });
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
