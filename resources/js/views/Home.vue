<template>
    <div>
        <h1>You are logged in, @{{ $store.getters.currentUser.nickname }}</h1>
        <span class="links__link" @click="logout">Logout</span>
        <div>
            <form @submit.prevent="sendMessage">
                <input type="text" v-model="message">
                <button type="submit">Send</button>
            </form>
            <br><br>
        </div>
        <button @click="listMessages">List messages</button>
    </div>
</template>

<script>
import chatService from '../services/chat';

export default {
    name: "Home",
    data() {
        return {
            message: ''
        }
    },
    methods: {
        logout() {
            this.$store.dispatch('logout');
        },
        // this shit just for testing
        sendMessage() {
            chatService.sendMessage(1, {text: this.message}).then(r => console.log(r.data));
        },
        listMessages() {
            chatService.listMessages(1).then(r => console.log(r.data));
        }
    }
}
</script>

<style scoped>
div {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

span {
    text-decoration: underline;
    cursor: pointer;
}
</style>
