<template>
    <service-layout card-title="Registration">
        <div slot="card">
            <div class="card__form">
                <form action="#" method="post" @submit.prevent="register">
                    <input-field type="text" name="name" v-model="form.name" required="true">Name</input-field>
                    <input-field type="text" name="nickname" v-model="form.nickname" required="true">Nickname</input-field>
                    <input-field type="email" name="email" v-model="form.email" required="true">Email</input-field>
                    <input-field type="password" name="password" v-model="form.password" required="true">Password
                    </input-field>
                    <input-field type="password" name="password_confirmation" v-model="form.password_confirmation" required="true">Confirm password</input-field>
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
            <div class="links__text">Already have account?</div>
            <router-link to="/login" class="links__link" replace>Sign in</router-link>
        </div>
    </service-layout>
</template>

<script>
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
            this.$store.dispatch('auth/setForm', this.form);
            this.$store.dispatch('auth/register');
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
