<template>
    <li :class="{'chat__message_sender': isSender}">
        <div class="message__inner">
            <div class="sender__photo" v-if="!isSender">
                <!--TODO: replace placeholder with a real photo-->
                <img src="https://via.placeholder.com/60" alt="Awesome avatar">
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
    props: ['sender'],
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

            .message__text {
                color: #FFFFFF;
            }
        }
    }
}

.message__inner {
    display: flex;
    font-family: Sarabun, sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
}

.sender__photo {
    background: #B0B8C9;
    border-radius: 3px 0px 0px 3px;
    padding: 9px 5px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;

    img {
        margin-top: auto;
        margin-bottom: 0;
        border-radius: 50%;
        width: 45px;
    }
}

.message__content {
    background-color: #C8D1E3;
    border-radius: 0px 3px 3px 0px;
    padding: 10px;
    overflow-wrap: break-word;
    word-break: break-all;

    display: flex;
    flex-direction: column;
    gap: 10px;

    .message__sender {
        color: #D78E53;
    }

    .message__text {
        color: #000;
    }

    p {
        margin: 0;
    }
}
</style>
