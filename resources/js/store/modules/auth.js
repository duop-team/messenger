import authService from "../../services/auth";
import router from "../../routes";

export const namespaced = true;

export const state = {
    form: {},
    user: null,
    loading: false,
    formType: 'auth',
    formStep: 'phone'
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
    },
    SET_FORM_TYPE(state, data) {
        state.form = data;
        if (data === 'login') {
            state.formStep = 'phone';
        } else {
            state.formStep = 'names';
        }
    },
    SET_STEP(state, data) {
        state.formStep = data;
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
    },
    formStep(state) {
        return state.formStep;
    }
}

export const actions = {
    switchForm({commit}, type) {
        switch (type) {
            case 'login':
                commit('SET_STEP', 'phone');
                break;

            case 'register':
                commit('SET_STEP', 'names');
                break;

            default:
                return;
        }

        commit('SET_FORM_TYPE', type);
    },
    setStep({commit}, value) {
        commit('SET_STEP', value);
    },
    setForm({commit}, payload) {
        commit('SET_FORM', payload);
    },
    sendCode({commit}, payload) {
        authService.code(payload).then(r => {
            commit('SET_STEP', 'code')
        });
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
    },
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
