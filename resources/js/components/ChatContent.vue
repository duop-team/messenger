<template>
    <div class="chat__wrapper">
        <div class="chat__content">
            <chat-header :class="{
                'chat__plate_left': true,
                'chat__plate_right': $store.getters['chats/infoActive']
            }"></chat-header>
            <messages></messages>
            <message-form :class="{
                'chat__plate_left': true,
                'chat__plate_right': $store.getters['chats/infoActive']
            }"></message-form>
        </div>
        <info-bar v-if="$store.getters['chats/infoActive']"></info-bar>
    </div>
</template>

<script>
export default {
    name: "ChatContent"
}
</script>

<style scoped lang="scss">
.chat__wrapper {
    height: 100%;
    width: 100%;
    display: flex;
}

.chat__plate {
    &_left {
        margin-left: -15px;
    }

    &_right {
        margin-right: -15px;
    }
}

.chat__content {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    align-self: stretch;
    z-index: 1;
}


</style>
