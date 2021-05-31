import chatService from "../../services/chat";

export const namespaced = true;

export const state = {
    loading: false,
    messageList: [],
    message: ''
};

export const mutations = {
    SET_LOADING(state, loading) {
        state.loading = loading;
    },
    SET_MESSAGE_LIST(state, list) {
        state.messageList = list;
    },
    PUSH_MESSAGE_LIST(state, value) {
        state.messageList.push(value);
    },
    SET_MESSAGE(state, value) {
        state.message = value;
    }
};

export const getters = {
    messageList(state) {
        return state.messageList;
    },
    message(state) {
        return state.message;
    }
};

export const actions = {
    clearMessageList({commit}) {
        commit('SET_MESSAGE_LIST', []);
    },
    listenChatMessages({commit}, id) {
        Echo.private(`chat.${id}`)
            .listen('MessageSent', e => {
                commit('PUSH_MESSAGE_LIST', e);
            });
    },
    listMessages({getters, commit, dispatch, rootGetters}) {
        commit('SET_LOADING', true);
        chatService.listMessages(rootGetters['chats/currentChat'].id).then(r => {
            commit('SET_LOADING', false);
            dispatch('clearMessageList');
            commit('SET_MESSAGE_LIST', r.data);
        }).catch(() => {
            commit('SET_LOADING', false);
            /* TODO: there must be error handler */
        });
    },
    sendMessage({commit, getters, rootGetters}) {
        chatService.sendMessage(rootGetters['chats/currentChat'].id, {text: getters['message']})
            .then(r => {
                commit('PUSH_MESSAGE_LIST', r.data);
                commit('SET_MESSAGE', '');
            }).catch(/* TODO: Error handler */);
    }
};
