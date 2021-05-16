<template>
    <div class="chat__messages">
        <message v-for="m in $store.getters['chats/messageList']"
                 :key="m.id" :sender="m.sender.nickname">
            {{ m.text }}
        </message>
    </div>
</template>

<script>
export default {
    name: "Messages",
    updated() {
        this.scrollBottom();
    },
    mounted() {
        this.scrollBottom();
    },
    methods: {
        scrollBottom() {
            let obj = document.querySelector('.chat__messages');
            if (obj) {
                obj.scrollTop = obj.scrollHeight;
            }
        }
    }
}
</script>

<style scoped lang="scss">
.chat__messages {
    height: 100%;
    overflow-y: scroll;
    padding: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
</style>
