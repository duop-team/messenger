<template>
    <service-layout card-title="Registration">
        <div slot="card">
            <div class="card__form">
                <form action="#" method="post" @submit.prevent="register">
                    <BaseInput type="text" name="name" v-model="form.name" required="true">Name</BaseInput>
                    <BaseInput type="text" name="nickname" v-model="form.nickname" required="true">Nickname</BaseInput>
                    <BaseInput type="email" name="email" v-model="form.email" required="true">Email</BaseInput>
                    <BaseInput type="password" name="password" v-model="form.password" required="true">Password
                    </BaseInput>
                    <BaseInput type="password" name="password_confirmation" v-model="form.password_confirmation" required="true">Confirm password</BaseInput>
                    <div class="form__footer">
                        <div v-if="$store.getters['auth/loading']">
                            <img src="/images/loader.svg" alt="Loading..." height="40">
                        </div>
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
            <div class="links__text">Already have the account?</div>
            <router-link to="/login" class="links__link" replace>Sign in</router-link>
        </div>
    </service-layout>
</template>

<script>
import authService from "../services/auth";

export default {
    name: "Register",
    data() {
        return {
            form: {
                name: '',
                nickname: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: {}
        }
    },
    methods: {
        register() {
            authService.registerUser(this.form)
                .then(() => this.$router.replace('/chats'))
                .catch(e => {
                    this.errors = e.response.data.errors
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

<style scoped>

</style>
