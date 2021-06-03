<template>
    <ul class="chat__messages">
        <message class="chat__message" v-for="m in $store.getters['messages/messageList']" :key="m.id"
                 :sender="m.sender.nickname" :photo="m.sender.photo ? m.sender.photo.url : ''">
            {{ m.text }}
        </message>
    </ul>
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
    overflow-y: scroll;
    flex: 1 1 auto;
    list-style: none;
    margin: 0;
    padding: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
</style>
