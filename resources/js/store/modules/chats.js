import chatService from "../../services/chat";

export const namespaced = true;

export const state = {
    loading: false,
    chat: null,
    chatInfo: false,
    chatList: [],
    createChat: false,
    createChatForm: {
        title: '',
        participants: []
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
    },
    SET_CHAT_LIST(state, list) {
        state.chatList = list;
    },
    PUSH_CHAT_LIST(state, value) {
        state.chatList.push(value);
    },
    SET_CREATE_CHAT(state, value) {
        state.createChat = value;
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

        this.dispatch('messages/listenChatMessages', chat.id);
        // dispatch('listMessages');
        this.dispatch('messages/listMessages');
    },
    createChat({getters, commit, dispatch}) {
        commit('SET_LOADING', true);
        chatService.createChat(getters['newChatForm']).then(r => {
            commit('SET_LOADING', false);
            // alert(`Chat ${r.data.title} is created`);
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
    searchUser({commit, rootGetters}, nickname) {
        commit('SET_LOADING', true);
        chatService.findUser({nickname: nickname}).then(r => {
            commit('SET_LOADING', false);
            let users = r.data;
            commit('SET_FOND_USERS',
                users.filter(u => u.nickname !== rootGetters['auth/currentUser'].nickname));
        });
    }
}
