<template>
    <ul class="chats__list">
        <chat-item v-for="chat in $store.getters['chats/chatList']" :key="chat.id"
                   :class="[($store.getters['chats/currentChat'].id === chat.id) ? 'is-active' : '']"
                   :title="chat.title" :photo_url="chat.photo ? chat.photo.url : ''"
                   @click="$store.dispatch('chats/selectChat', chat)"></chat-item>
    </ul>
</template>

<script>
export default {
    name: "ChatList",
    mounted() {
        this.$store.dispatch('chats/getChatList');
    }
}
</script>

<style scoped lang="scss">
.chats__list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
}
</style>
