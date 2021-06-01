<template>
    <div class="chat__item" @click="select">
        <div class="chat__photo">
            <img :src="photo_url" alt="Awesome chat photo" height="60">
        </div>
        <div class="chat__details">
            <div class="chat__title">{{ title }}</div>
            <div class="chat__message">There must be latest message, but i can't get it</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ChatItem",
    props: ["title", "photo_url"],
    methods: {
        select() {
            this.$emit('click');
        }
    }
}
</script>

<style scoped lang="scss">
.chat__item {
    padding: 10px;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    user-select: none;
    cursor: pointer;
    font-family: Nunito, sans-serif;
    background-color: #D4D4D4;

    &:nth-child(2n) {
        background-color: #e2e2e2;
    }

    &.is-active {
        background-color: #AAC1DF;
    }
}

.chat__photo {
    margin-right: 10px;
    max-width: 60px;

    img {
        border-radius: 50%;
    }
}

.chat__title {
    color: #000000;
    font-size: 14px;
    font-weight: 800;
}

.chat__message {
    margin-top: 10px;
    font-size: 13px;
}
</style>
