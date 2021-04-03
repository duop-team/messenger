<template>
    <service-layout card-title="Registration">
        <div slot="card">
            <div class="card__form">
                <form action="#" method="post" @submit.prevent="">
                    <BaseInput type="text" name="name" v-model="form.name" required="true">Name</BaseInput>
                    <BaseInput type="text" name="nickname" v-model="form.nickname" required="true">Nickname</BaseInput>
                    <BaseInput type="email" name="email" v-model="form.email" required="true">Email</BaseInput>
                    <BaseInput type="password" name="password" v-model="form.password" required="true">Password</BaseInput>
                    <BaseInput type="password" name="password-confirmation" required="true">Confirm password</BaseInput>
                    <div class="form__footer">
                        <div class="form__error" v-show="!form.errors">
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
            <router-link to="/login" class="links__link">Sign in</router-link>
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
                confirm: '',
                errors: []
            }
        }
    }
}
</script>

<style scoped>

</style>
