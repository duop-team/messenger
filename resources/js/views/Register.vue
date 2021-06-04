<template>
    <service-layout card-title="Registration">
        <div slot="card">
            <form action="#" method="post" @submit.prevent="setNames" class="card__form"
                  v-if="$store.getters['auth/formStep'] === 'names'">
                <input-field type="text" name="name" v-model="form.name" required="true" class="form__field">Full name
                </input-field>
                <input-field type="text" name="nickname" v-model="form.nickname" required="true" class="form__field">
                    Nickname
                </input-field>
                <div class="form__footer">
                    <loader v-if="$store.getters['auth/loading']"></loader>
                    <div v-else-if="hasErrors" class="form__error">{{ $store.getters['auth/error'] }}</div>
                    <div class="form__submit">
                        <RoundedButton type="submit">Continue</RoundedButton>
                    </div>
                </div>
            </form>

            <form action="#" method="post" @submit.prevent="sendCode" class="card__form"
                  v-else-if="$store.getters['auth/formStep'] === 'phone'">
                <input-field type="tel" name="phone" v-model="form.phone" required="true" class="form__field">Phone
                </input-field>
                <div class="form__footer">
                    <loader v-if="$store.getters['auth/loading']"></loader>
                    <div v-else-if="hasErrors" class="form__error">{{ $store.getters['auth/error'] }}</div>
                    <div class="form__submit">
                        <RoundedButton type="submit">Continue</RoundedButton>
                    </div>
                </div>
            </form>

            <form action="#" method="post" @submit.prevent="register" class="card__form"
                  v-else-if="$store.getters['auth/formStep'] === 'code'">
                <input-field type="text" name="password" v-model="form.code" required="true" class="form__field">Code
                    verification
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
            <div class="content__text">Already have account?</div>
            <router-link to="/login" class="content__link" replace>Sign in</router-link>
        </div>
    </service-layout>
</template>

<script>
export default {
    name: "Register",
    beforeMount() {
        this.$store.dispatch('auth/switchForm', 'register');
    },
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
        register() {
            this.$store.dispatch('auth/setForm', this.form);
            this.$store.dispatch('auth/register');
        },
        sendCode() {
            this.$store.dispatch('auth/setForm', this.form);
            this.$store.dispatch('auth/checkPhone', 'register').then(() => {
                this.$store.dispatch('auth/setStep', 'code')
            });

            if (!this.hasErrors) {
                this.$store.dispatch('auth/sendCode', {phone: this.form.phone});
            }
        },
        setNames() {
            this.$store.dispatch('auth/setForm', this.form);
            this.$store.dispatch('auth/checkNickname').then(() => {
                this.$store.dispatch('auth/setStep', 'phone');
            });
        }
    },
    computed: {
        hasErrors() {
            return this.$store.getters['auth/error'];
        }
    }
}
</script>

<style scoped>
.content {
    margin-top: 11px;
}
</style>
