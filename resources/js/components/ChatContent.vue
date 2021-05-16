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
    width: 100%;
    height: 100%;
    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;
}
</style>
