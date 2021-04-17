<template>
    <div class="send__form">
        <form @submit.prevent="sendMessage">
            <input type="text" v-model="message" class="message__field"
                   placeholder="Write a message and press Enter to send it">
        </form>
    </div>
</template>

<script>
import chatService from "../services/chat";

export default {
    name: "MessageForm",
    data() {
        return {
            message: ''
        }
    },
    methods: {
        sendMessage() {
            // TODO: change chat id
            chatService.sendMessage(this.$store.getters['chats/currentChat'].id, {text: this.message}).then(r => {
                // this.messagesList.push(r.data);
                this.$store.commit('chats/PUSH_MESSAGE_LIST', r.data.data);
                this.message = '';
                console.log(r)
            });
        }
    }
}
</script>

<style scoped lang="scss">
.send__form {
    padding: 9px 15px;
    background: #559E89;
    border: 1px solid #5B8377;
    border-radius: 15px 15px 0 0;
    //overflow-y: scroll;

    form {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;

        .message__field {
            width: 100%;
            height: 100%;
            font-family: Lexend Deca, sans-serif;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            color: #88E4C9;
            background-color: transparent;
            outline: 0;
            border: 0;

            &::placeholder {
                color: #88E4C9;
            }
        }
    }
}


</style>
