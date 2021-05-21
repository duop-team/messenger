import chatService from "../../services/chat";

export const namespaced = true;

export const state = {
    loading: false,
    chat: null,
    chatInfo: false,
    messageList: [],
    chatList: [],
    createChat: false,
    createChatForm: {
        title: '',
        /* TODO: another fields such as participants, description, etc */
    },
    fondUsers: []
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
    },
    SET_NEW_CHAT(state, data) {
        state.createChatForm = data;
    },
    SET_FOND_USERS(state, data) {
        state.fondUsers = data;
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
    },
    newChatForm(state) {
        return state.createChatForm;
    },
    getFondUsers(state) {
        return state.fondUsers;
    }
}

export const actions = {
    toggleInfoBar({commit, getters}) {
        commit('SET_CHAT_INFO', !getters["infoActive"]);
    },
    toggleCreateChat({commit, getters}) {
        commit('SET_CREATE_CHAT', !getters["isCreatingChat"]);
    },
    clearMessageList({commit}) {
        commit('SET_MESSAGE_LIST', []);
    },
    clearChatList({commit}) {
        commit('SET_CHAT_LIST', []);
    },
    getChatList({commit, dispatch}) {
        commit('SET_LOADING', true);
        dispatch('clearChatList');

        chatService.listChats().then(r => {
            commit('SET_LOADING', false);
            commit('SET_CHAT_LIST', r.data);
        }).catch(() => {
            commit('SET_LOADING', false);
            /* TODO: There must be error handler */
        });
    },
    selectChat({commit, getters, dispatch}, chat) {
        Echo.leave(`chat.${getters['currentChat'].id}`);

        commit('SET_CHAT', chat);

        dispatch('listenChatMessages', chat.id);
        dispatch('listMessages');
    },
    listenChatMessages({commit}, id) {
        Echo.private(`chat.${id}`)
            .listen('MessageSent', e => {
                commit('PUSH_MESSAGE_LIST', e.message);
            });
    },
    listMessages({getters, commit, dispatch}) {
        commit('SET_LOADING', true);
        chatService.listMessages(getters['currentChat'].id).then(r => {
            commit('SET_LOADING', false);
            dispatch('clearMessageList');
            commit('SET_MESSAGE_LIST', r.data.data); /* FIXME: fix typo on backend */
        }).catch(() => {
            commit('SET_LOADING', false);
            /* TODO: there must be error handler */
        });
    },
    createChat({getters, commit, dispatch}) {
        commit('SET_LOADING', true);
        chatService.createChat(getters['newChatForm']).then(r => {
            commit('SET_LOADING', false);
            alert(`Chat ${r.data.title} is created`);
            dispatch('getChatList');
            /* TODO: prevent reloading of full list */
            dispatch('toggleCreateChat');
        }).catch(() => {
            commit('SET_LOADING', false);
            /* TODO: there must be error handler */
        });
    },
    addParticipant({getters}, nickname) {
        chatService.findUser({nickname: nickname}).then(r => {
            chatService.addParticipant(getters['currentChat'].id, {user_id: r.data.id})
                .then(res => alert('Participant added'))
                .catch(() => alert('That user already a participant'))
        }).catch(() => alert('This user doesn\'t exists'))
        /* TODO: Error handlers!!! */
    },
    searchUser({commit}, nickname) {
        commit('SET_LOADING', true);
        chatService.findUser({nickname: nickname}).then(r => {
            commit('SET_LOADING', false);
            // console.log(r.data);
            commit('SET_FOND_USERS', r.data);
        });
    }
}
