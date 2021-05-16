<template>
    <div class="root">
        <div class="wrapper">
            <div class="sidebar">
                <div class="sidebar__button" @click="showCreateChat">
                    <div class="button__icon"><span class="material-icons">add</span></div>
                    <div class="button__text">Create chat</div>
                </div>

                <div class="sidebar__button" @click="logout">
                    <div class="button__icon"><span class="material-icons">logout</span></div>
                    <div class="button__text">Logout</div>
                </div>
            </div>
            <div class="chats">
                <div class="chats__list">
                    <chat-item v-for="chat in $store.getters['chats/chatList']" :key="chat.id"
                               :class="['chats__item', ($store.getters['chats/currentChat'].id === chat.id) ? 'is-active' : '']"
                               :title="chat.title"
                               photo_url="http://placehold.jp/60x60.png"
                               @click="selectChat(chat)"></chat-item>
                </div>
            </div>
        </div>
        <div class="chats__content" v-if="$store.getters['chats/currentChat'].id">
            <chat-header
                :class="['header', (!$store.getters['chats/infoActive'] && !$store.getters['chats/isCreatingChat']) ? 'mr-0' : '']"></chat-header>
            <div class="chat">
                <message v-for="m in $store.getters['chats/messageList']" :key="m.id"
                         :sender="m.sender.nickname">{{ m.text }}
                </message>
                <!--                <ul v-for="m in $store.getters['chats/messageList']">-->
                <!--                    <li>{{ m.user_id }}: {{ m.text }}</li>-->
                <!--                </ul>-->
            </div>
            <message-form
                :class="['message__form', (!$store.getters['chats/infoActive'] && !$store.getters['chats/isCreatingChat']) ? 'mr-0' : '']"></message-form>
        </div>
        <div :class="['info', $store.getters['chats/infoActive'] ? 'is-active': '']">
            <div class="info__inner">
                <div class="chat__participants">
                    <form @submit.prevent="addParticipant">
                        <input-field type="text" v-model="search" name="search">Add participant to current chat by
                            nickname
                        </input-field>
                        <rounded-button type="submit">Add</rounded-button>
                    </form>
                </div>
            </div>
        </div>
        <div :class="['info', $store.getters['chats/isCreatingChat'] ? 'is-active': '']">
            <div class="info__inner">
                <div class="chat__create">
                    <form @submit.prevent="createChat">
                        <input-field type="text" v-model="chatName" name="chat_name">Enter title of a new chat:
                        </input-field>
                        <rounded-button type="submit">Create chat</rounded-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import chatService from '../services/chat';

export default {
    name: "Home",
    data() {
        return {
            search: '',
            chatName: ''
        }
    },
    methods: {
        scrollBottom() {
            let obj = document.querySelector('.chat');
            if (obj) {
                obj.scrollTop = obj.scrollHeight;
            }
        },
    },
    created() {
        this.listChats();
        // this.listMessages();


    },
    updated() {
        this.scrollBottom();
    }
}
</script>

<style scoped lang="scss">

.wrapper {
    display: flex;
    flex-direction: row;

    & > * {
        height: 100%;
    }
}

.header {
    margin: 0 -15px;
    flex-basis: 80px;
    min-height: 80px;
}

.message__form {
    flex-basis: 40px;
    max-height: 20%;
    min-height: 40px;
    z-index: 10;
    margin: 0 -15px;
}

.root {
    background: linear-gradient(67.6deg, #32C585 17.95%, #546286 97.28%);
    min-height: 100vh;
    max-height: 100vh;
    min-width: 100vw;
    display: flex;
    justify-content: space-between;
    flex-flow: row nowrap;
    font-family: 'Lexend Deca', sans-serif;
    color: #fff;
}

.sidebar {
    background-color: #63B69D;
    flex-basis: 80px;
    min-width: 80px;
    padding: 10px 0;
    user-select: none;
    display: flex;
    flex-flow: column nowrap;
    justify-content: space-between;

    &__button {
        display: flex;
        justify-content: center;
        flex-flow: column nowrap;
        text-align: center;
        cursor: pointer;
        padding: 10px 0;

        &:hover {
            background-color: darken(#63B69D, 10%);
        }
    }
}

.chats {
    background-color: #64A793;
    color: #301A1A;
    flex-basis: 400px;
    min-width: 400px;

    &__content {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        z-index: 10;
    }

    &__list {
        margin-top: 80px;
    }

    &__item {
        background-color: #D4D4D4;

        &:nth-child(2n) {
            background-color: #e2e2e2;
        }

        &.is-active {
            background-color: #AAC1DF;
        }
    }
}

.chat {
    flex: 1 1 auto;
    overflow-y: scroll;
    padding: 10px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    gap: 10px;
}

.info {
    background-color: #68B8A1;
    display: none;
    flex: 0 0 400px;

    &.is-active {
        display: block;
        margin-left: auto;
    }

    &__inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        margin-top: 80px;

        form {
            display: flex;
            flex-flow: column nowrap;
            gap: 15px;
        }
    }
}

.mr-0 {
    margin-right: 0;
}

</style>
