export const namespaced = true;

export const state = {
    loading: false,
    chat: null,
    chatInfo: false,
    messageList: [],
    chatList: [],
    createChat: false
}

export const mutations = {
    SET_LOADING(state, loading) {
        state.loading = loading;
    },
    SET_CHAT(state, chat) {
        state.chat = chat;
    },
    SET_CHAT_INFO(state, chatInfo) {
        state.chatInfo = chatInfo;

        if (state.createChat && state.chatInfo) {
            state.createChat = false;
        }
    },
    SET_MESSAGE_LIST(state, list) {
        state.messageList = list;
    },
    PUSH_MESSAGE_LIST(state, value) {
        state.messageList.push(value);
    },
    SET_CHAT_LIST(state, list) {
        state.chatList = list;
    },
    PUSH_CHAT_LIST(state, value) {
        state.chatList.push(value);
    },
    SET_CREATE_CHAT(state, value) {
        state.createChat = value;
        if (state.chatInfo && state.createChat) {
            state.chatInfo = false;
        }
    }
}

export const getters = {
    currentChat(state) {
        return state.chat || {};
    },
    loading(state) {
        return state.loading;
    },
    infoActive(state) {
        return state.chatInfo;
    },
    messageList(state) {
        return state.messageList;
    },
    chatList(state) {
        return state.chatList;
    },
    isCreatingChat(state) {
        return state.createChat;
    }
}

export const actions = {
    toggleInfo({commit}) {
        commit('SET_CHAT_INFO', !this.getters["chats/infoActive"]);
    },
    toggleCreateChat({commit}) {
        commit('SET_CREATE_CHAT', !this.getters["chats/isCreatingChat"]);
    },
    clearMessageList({commit}) {
        commit('SET_MESSAGE_LIST', []);
    },
    clearChatList({commit}) {
        commit('SET_CHAT_LIST', []);
    }
}
