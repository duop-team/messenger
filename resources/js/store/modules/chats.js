export const namespaced = true;

export const state = {
    loading: false,
    chat: null,
    chatInfo: false,
    messageList: [],
    chatList: []
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
    }
}

export const getters = {
    currentChat(state) {
        return state.chat;
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
    }
}

export const actions = {
    toggleInfo({commit}) {
        commit('SET_CHAT_INFO', !this.getters["chats/infoActive"]);
    },
    clearMessageList({commit}) {
        commit('SET_MESSAGE_LIST', []);
    },
    clearChatList({commit}) {
        commit('SET_CHAT_LIST', []);
    }
}
