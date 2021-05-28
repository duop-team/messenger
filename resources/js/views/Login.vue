<template>
    <service-layout card-title="Sign in">
        <div slot="card">
            <div class="card__description">
                <p>Please, enter your country, phone number or whatever they want from you</p>
            </div>
            <div class="card__form">
                <form method="post" @submit.prevent="login">
                    <input-field type="tel" name="phone" v-model="form.email" required="true" autofocus>Phone
                    </input-field>
                    <button @click="send" type="button">Send code</button>
                    <input-field type="text" name="code" v-model="form.code" required="true">Password
                    </input-field>
                    <div class="form__footer">
                        <loader v-if="$store.getters['auth/loading']"></loader>
                        <!--TODO: show error and remove it on typing-->
                        <div class="form__submit">
                            <RoundedButton type="submit">Submit</RoundedButton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div slot="content" class="content">
            <div class="content__text">Don’t have an account?</div>
            <router-link to="/register" class="content__link" replace>Sign up</router-link>
        </div>
    </service-layout>
</template>

<script>
import auth from "../services/auth";

export default {
    name: "Login",
    data() {
        return {
            form: {
                email: '',
                code: ''
            }
        }
    },
    methods: {
        login() {
            this.$store.dispatch('auth/setForm', this.form);
            this.$store.dispatch('auth/login');
        },
        send() {
            auth.code().then(r => console.log(r));
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
.content {
    margin-top: 11px;
}
</style>
