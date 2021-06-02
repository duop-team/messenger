<template>
    <service-layout card-title="Registration">
        <div slot="card">
            <form action="#" method="post" @submit.prevent="register">
                <input-field type="text" name="name" v-model="form.name" required="true" class="form__field">Full name</input-field>
                <input-field type="text" name="nickname" v-model="form.nickname" required="true" class="form__field">Nickname</input-field>
                <input-field type="tel" name="phone" v-model="form.phone" required="true" class="form__field">Phone</input-field>
                <button @click="send" type="button">Send code</button>
                <input-field type="text" name="password" v-model="form.code" required="true" class="form__field">Code verification
                </input-field>
                <loader v-if="$store.getters['auth/loading']"></loader>
                <!--TODO: show error and remove it on typing-->
                <div class="form__submit">
                    <RoundedButton type="submit">Submit</RoundedButton>
                </div>
            </form>
        </div>
        <div slot="content" class="content">
            <div class="content__text">Already have account?</div>
            <router-link to="/login" class="content__link" replace>Sign in</router-link>
        </div>
    </service-layout>
</template>

<script>
import auth from "../services/auth";

export default {
    name: "Register",
    data() {
        return {
            form: {
                name: '',
                nickname: '',
                phone: '',
                code: ''
            },
            errors: {}
        }
    },
    methods: {
        register() {
            this.$store.dispatch('auth/setForm', this.form);
            this.$store.dispatch('auth/register');
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

<style scoped>
.content {
    margin-top: 11px;
}
</style>
