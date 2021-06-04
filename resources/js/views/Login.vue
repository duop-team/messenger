<template>
    <service-layout card-title="Sign in">
        <div slot="card">
            <form method="post" @submit.prevent="sendCode()" v-if="$store.getters['auth/formStep'] === 'phone'"
                  class="card__form">
                <input-field type="tel" name="phone" v-model="form.phone" required="true" autofocus class="form__field">
                    Phone
                </input-field>
                <div class="form__footer">
                    <loader v-if="$store.getters['auth/loading']"></loader>
                    <div v-else-if="hasErrors" class="form__error">{{ $store.getters['auth/error'] }}</div>
                    <div class="form__submit">
                        <RoundedButton type="submit">Continue</RoundedButton>
                    </div>
                </div>
            </form>

            <form method="post" @submit.prevent="login()" v-else-if="$store.getters['auth/formStep'] === 'code'"
                  class="card__form">
                <input-field type="text" name="code" v-model="form.code" required="true" class="form__field">Code from
                    SMS
                </input-field>
                <div class="form__footer">
                    <loader v-if="$store.getters['auth/loading']"></loader>
                    <div v-else-if="hasErrors" class="form__error">{{ $store.getters['auth/error'] }}</div>
                    <div class="form__submit">
                        <RoundedButton type="submit">Submit</RoundedButton>
                    </div>
                </div>
            </form>
        </div>
        <div slot="content" class="content">
            <div class="content__text">Don’t have account?</div>
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
    watch: {
        form: {
            deep: true,
            handler() {
                if (this.$store.getters['auth/error']) {
                    this.$store.commit('auth/SET_ERROR', '');
                }
            }
        }
    },
    methods: {
        login() {
            this.$store.dispatch('auth/setForm', this.form);
            this.$store.dispatch('auth/login');
        },
        sendCode() {
            this.$store.dispatch('auth/setForm', this.form);
            this.$store.dispatch('auth/checkPhone', 'login').then(() => {
                this.$store.dispatch('auth/setStep', 'code')
            });

            if (!this.hasErrors) {
                this.$store.dispatch('auth/sendCode', {phone: this.form.phone});
            }
        }
    },
    computed: {
        hasErrors() {
            return this.$store.getters['auth/error'];
        }
    }
}
</script>

<style scoped lang="scss">
.content {
    margin-top: 11px;
}
</style>
