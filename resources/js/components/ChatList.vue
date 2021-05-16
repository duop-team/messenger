<template>
    <ul>
        <li>
            <chat-item v-for="chat in source" :key="chat.id"
                       :class="['chat__item', ($store.getters['chats/currentChat'].id === chat.id) ? 'is-active' : '']"
                       :title="chat.title"
                       @click=""></chat-item>
        </li>
    </ul>
</template>

<script>
export default {
    name: "ChatList",
    props: {
        'source': {
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped lang="scss">
ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
</style>
