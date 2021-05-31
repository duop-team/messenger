<template>
    <div class="chat__header">
        <div class="header__inner">
            <div class="header__title" @click="showInfo">{{ $store.getters["chats/currentChat"].title }}</div>
            <div class="header__subtitle">There are many members</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ChatHeader",
    methods: {
        showInfo() {
            this.$store.dispatch('chats/toggleInfoBar');
        }
    }
}
</script>

<style scoped lang="scss">
.chat__header {
    background: #559E89;
    border: 1px solid #5B8377;
    box-sizing: border-box;
    border-radius: 0 0 15px 15px;
    min-height: 80px;
    color: #fff;
    font-family: Nunito, sans-serif;
}

.header {
    &__inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        height: 100%;
    }

    &__title {
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
    }

    &__subtitle {
        font-size: 14px;
    }
}
</style>
