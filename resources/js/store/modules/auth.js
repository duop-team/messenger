import authService from "../../services/auth";
import router from "../../routes";

export const namespaced = true;

export const state = {
    user: null,
    loading: false
}

export const mutations = {
    SET_USER(state, user) {
        state.user = user;
    },
    SET_LOADING(state, loading) {
        state.loading = loading;
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
    }
}

export const actions = {
    logout({commit}) {
        commit('SET_LOADING', true);
        return authService.logout()
            .then(() => {
                commit('SET_LOADING', false);
                commit('SET_USER', null);
                router.push({path: '/login'});
            })
            .catch(e => {
                commit('SET_LOADING', false);
                console.log(e)
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
                console.log(error)
            });

    }
}
