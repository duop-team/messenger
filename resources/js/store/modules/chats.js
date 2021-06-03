import chatService from "../../services/chat";

export const namespaced = true;

export const state = {
    loading: false,
    chat: null,
    participants: [],
    newMembers: [],
    chatInfo: false,
    chatList: [],
    createChat: false,
    createChatForm: {
        title: '',
        participants: []
    },
    fondUsers: [],
    modal: '',
    openedModals: []
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
    SET_PARTICIPANTS(state, list) {
        state.participants = list;
    },
    PUSH_PARTICIPANTS(state, list) {
        state.participants = list;
    },
    PUSH_CHAT_LIST(state, value) {
        state.chatList.push(value);
    },
    SET_NEW_MEMBERS(state, list) {
        state.newMembers = list;
    },
    SET_CREATE_CHAT(state, value) {
        state.createChat = value;
    },
    SET_NEW_CHAT(state, data) {
        state.createChatForm = data;
    },
    SET_FOND_USERS(state, data) {
        state.fondUsers = data;
    },
    SET_MODAL(state, value) {
        state.modal = value;
    },
    SET_MODALS(state, data) {
        state.openedModals = data;
    }
}

export const getters = {
    currentChat(state) {
        return state.chat || {};
    },
    participants(state) {
        return state.participants;
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
    newMembers(state) {
        return state.newMembers;
    },
    getFondUsers(state) {
        return state.fondUsers;
    },
    currentModal(state) {
        return state.modal;
    },
    openedModals(state) {
        return state.openedModals;
    }
}

export const actions = {
    toggleInfoBar({commit, getters}) {
        commit('SET_CHAT_INFO', !getters["infoActive"]);
    },
    closeAllModals({commit}) {
        commit('SET_MODAL', '');
        commit('SET_MODALS', []);
    },
    closeModal({commit, getters}) {
        let modals = getters['openedModals'];
        if (modals) {
            commit('SET_MODAL', modals.pop());
            commit('SET_MODALS', modals);
        }
    },
    openModal({getters, commit}, value) {
        let modals = getters['openedModals'];
        if (getters['currentModal']) {
            modals.push(getters['currentModal']);
        }
        commit('SET_MODAL', value);
        commit('SET_MODALS', modals);
    },
    clearChatList({commit}) {
        commit('SET_CHAT_LIST', []);
    },
    async getChatList({commit, dispatch}) {
        commit('SET_LOADING', true);
        dispatch('clearChatList');

        await chatService.listChats().then(r => {
            commit('SET_LOADING', false);
            commit('SET_CHAT_LIST', r.data);
        }).catch(() => {
            commit('SET_LOADING', false);
            /* TODO: There must be error handler */
        });
    },
    selectChat({commit, getters, dispatch}, chat) {
        Echo.leave(`chat.${getters['currentChat'].id}`);
        commit('SET_PARTICIPANTS', []);

        commit('SET_CHAT', chat);

        this.dispatch('messages/listenChatMessages', chat.id);
        this.dispatch('messages/listMessages');
        dispatch('retrieveParticipants', chat.id);
    },
    async retrieveParticipants({commit}, chat) {
        await chatService.retrieveParticipants(chat).then(r => {
            commit('SET_PARTICIPANTS', r.data[0]);
        });
    },
    createChat({getters, commit, dispatch}) {
        commit('SET_LOADING', true);
        chatService.createChat(getters['newChatForm']).then(r => {
            commit('SET_LOADING', false);
            dispatch('getChatList');
            /* TODO: prevent reloading of full list */
            dispatch('toggleCreateChat');
        }).catch(() => {
            commit('SET_LOADING', false);
            /* TODO: there must be error handler */
        });
    },
    addParticipants({getters, dispatch}) {
        chatService.addParticipant(getters['currentChat'].id, {users: getters['newMembers']})
            .then(() => {
                dispatch('retrieveParticipants', getters['currentChat'].id);
            })
            .catch(() => {
                dispatch('retrieveParticipants');
            })
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
