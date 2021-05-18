<template>
    <div class="chat__content">
        <chat-header></chat-header>
        <messages></messages>
        <message-form></message-form>
    </div>
</template>

<script>
export default {
    name: "ChatContent"
}
</script>

<style scoped lang="scss">
.chat__content {
    height: 100%;
    flex: 1;
    display: flex;
    flex-direction: column;
}
</style>
