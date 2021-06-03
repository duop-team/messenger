<template>
    <li :class="{'chat__message_sender': isSender}">
        <div class="message__inner">
            <div class="sender__photo" v-if="!isSender">
                <img v-if="photo" :src="photo" alt="Awesome avatar">
                <svg-vue icon="frog" class="photo"></svg-vue>
            </div>
            <div class="message__content">
                <div class="message__sender" v-if="!isSender">@{{ sender }}</div>
                <div class="message__text">
                    <p>
                        <slot></slot>
                    </p>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
export default {
    name: "Message",
    props: ['photo', 'sender'],
    computed: {
        isSender() {
            return this.sender === this.$store.getters['auth/currentUser'].nickname
        }
    }
}
</script>

<style scoped lang="scss">
.chat__message {
    max-width: 65%;

    &_sender {
        align-self: flex-end;
        .message__content {
            background-color: #5F9D8A;
            border-radius: 3px;

            .message__text {
                color: #FFFFFF;
            }
        }
    }
}

.message__inner {
    display: flex;
    font-family: 'M PLUS 1p', sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
}

.sender__photo {
    background: #B0B8C9;
    border-radius: 3px 0 0 3px;
    padding: 9px 5px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;

    .photo {
        margin-top: auto;
        margin-bottom: 0;
        border-radius: 50%;
        width: 45px;
    }
}

.message__content {
    background-color: #C8D1E3;
    border-radius: 0 3px 3px 0;
    padding: 10px;
    overflow-wrap: break-word;
    word-break: break-all;

    display: flex;
    flex-direction: column;
    gap: 10px;

    .message__sender {
        color: #D78E53;
        font-family: Sarabun, sans-serif;
    }

    .message__text {
        color: #000;
    }

    p {
        margin: 0;
    }
}
</style>
