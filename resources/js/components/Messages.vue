<template>
    <div class="chat__messages">
        <ul>
            <li v-for="m in $store.getters['chats/messageList']">
                <message :key="m.id" :sender="m.sender.nickname">{{ m.text }}
                </message>
            </li>
        </ul>

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
    overflow-y: scroll;
    padding: 10px;
    flex: 1 1 auto;
}

ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
</style>
