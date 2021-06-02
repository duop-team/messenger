<template>
    <service-layout card-title="Sign in">
        <div slot="card">
            <div class="card__description">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, consequuntur?</p>
            </div>
            <div class="card__form">
                <form method="post" @submit.prevent="sendCode()" v-if="$store.getters['auth/formStep'] === 'phone'">
                    <input-field type="tel" name="phone" v-model="form.phone" required="true" autofocus class="form__field">Phone
                    </input-field>
                    <div class="form__footer">
                        <loader v-if="$store.getters['auth/loading']"></loader>
                        <!--TODO: show error and remove it on typing-->
                        <div class="form__submit">
                            <RoundedButton type="submit">Submit</RoundedButton>
                        </div>
                    </div>
                </form>

                <form method="post" @submit.prevent="login()" v-if="$store.getters['auth/formStep'] === 'code'">
                    <input-field type="text" name="code" v-model="form.code" required="true" class="form__field">Code from SMS
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
export default {
    name: "Login",
    beforeMount() {
        this.$store.dispatch('auth/switchForm', 'login');
    },
    data() {
        return {
            form: {
                phone: '',
                code: ''
            }
        }
    },
    methods: {
        login() {
            this.$store.dispatch('auth/setForm', this.form);
            this.$store.dispatch('auth/login');
        },
        sendCode() {
            this.$store.dispatch('auth/sendCode', this.form.code)
                .then(() => this.$store.dispatch('auth/setStep', 'code'))
                .catch();
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
