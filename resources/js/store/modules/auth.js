import authService from "../../services/auth";
import router from "../../routes";

export const namespaced = true;

export const state = {
    form: {},
    user: null,
    loading: false
}

export const mutations = {
    SET_USER(state, user) {
        state.user = user;
    },
    SET_LOADING(state, loading) {
        state.loading = loading;
    },
    SET_FORM(state, data) {
        state.form = data;
    }
}


export const getters = {
    isLoggedIn(state) {
        return !!state.user;
    }
    ,
    currentUser(state) {
        return state.user;
    }
    ,
    loading(state) {
        return state.loading;
    },
    formData(state) {
        return state.form;
    }
}

export const actions = {
    setForm({commit}, payload) {
        commit('SET_FORM', payload);
    },
    login({commit, getters}) {
        commit('SET_LOADING', true);
        authService.login(getters['formData'])
            .then(() => {
                commit('SET_LOADING', false);
                commit('SET_FORM', {});
                router.replace('/chats');
            })
            .catch(e => {
                commit('SET_LOADING', false);
                // this.errors = e.response.data.errors;
            });
    },
    register({commit, getters}) {
        commit('SET_LOADING', true);
        authService.registerUser(getters['formData'])
            .then(() => {
                commit('SET_LOADING', false);
                commit('SET_FORM', {});
                router.replace('/chats')
            })
            .catch(e => {
                commit('SET_LOADING', false);
                // this.errors = e.response.data.errors
            })
    },
    logout({commit}) {
        commit('SET_LOADING', true);
        return authService.logout()
            .then(() => {
                commit('SET_LOADING', false);
                commit('SET_USER', null);
                router.replace('/login');
            })
            .catch(e => {
                commit('SET_LOADING', false);
                // console.log(e)
            });
    }
    ,
    getAuthUser({commit}) {
        commit('SET_LOADING', true);
        return authService.getAuthUser()
            .then(response => {
                commit("SET_USER", response.data);
                commit('SET_LOADING', false);
            })
            .catch(error => {
                commit('SET_LOADING', false);
                // console.log(error)
            });

    }
}
