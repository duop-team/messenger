<template>
    <form @submit.prevent="send()" class="message__form">
        <button type="button" class="form__button">
            <svg-vue icon="attach" class="form__icon"></svg-vue>
        </button>
        <input type="text" v-model="message" class="message__field"
               placeholder="Write a message...">
        <button type="submit" class="form__button" :disabled="!message">
            <svg-vue icon="send" class="form__icon"></svg-vue>
        </button>
    </form>
</template>

<script>
export default {
    name: "MessageForm",
    data() {
        return {
            message: ''
        }
    },
    methods: {
        send() {
            this.$store.commit('messages/SET_MESSAGE', this.message);
            this.$store.dispatch('messages/sendMessage');
            this.message = '';
        }
    }
}
</script>

<style scoped lang="scss">
.message__form {
    background: #559E89;
    border: 1px solid #5B8377;
    border-radius: 15px 15px 0 0;
    padding: 10px;

    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    gap: 10px;

    .form__button {
        background-color: transparent;
        border: 0;
        outline: 0;
        fill: #FFFFFF;
        cursor: pointer;

        .form__icon {
            height: 21px;
            transition: .3s;
        }

        &:disabled {
            fill: #5B8377;
        }
    }

    .message__field {
        width: 100%;
        height: 100%;
        font-family: Nunito, sans-serif;
        font-size: 15px;
        color: #FFFFFF;
        background-color: transparent;
        outline: 0;
        border: 0;

        &::placeholder {
            color: darken(#FFFFFF, 10%);
        }
    }
}


</style>
