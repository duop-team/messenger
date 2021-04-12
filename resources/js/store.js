import Vue from 'vue';
import Vuex from 'vuex';
import authService from './services/auth';
import router from "./routes";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null,
        loading: false
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        SET_LOADING(state, loading) {
            state.loading = loading;
        }
    },
    getters: {
        isLoggedIn(state) {
            return !!state.user;
        },
        currentUser(state) {
            return state.user;
        },
        loading(state) {
            return state.loading;
        }
    },
    actions: {
        logout(context) {
            context.commit('SET_LOADING', true);
            return authService.logout()
                .then(() => {
                    context.commit('SET_LOADING', false);
                    context.commit('SET_USER', null);
                    router.push({path: '/login'});
                })
                .catch(e => {
                    context.commit('SET_LOADING', false);
                    console.log(e)
                });
        },
        getAuthUser(context) {
            context.commit('SET_LOADING', true);
            return authService.getAuthUser()
                .then(response => {
                    context.commit("SET_USER", response.data);
                    context.commit('SET_LOADING', false);
                })
                .catch(error => {
                    context.commit('SET_LOADING', false);
                    console.log(error)
                });

        }
    }
});
