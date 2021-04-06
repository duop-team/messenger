import Vue from 'vue';
import Vuex from 'vuex';
import authService from './services/auth';
import router from "./routes";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        }
    },
    getters: {
        isLoggedIn(state) {
            return !!state.user;
        },
        currentUser(state) {
            return state.user;
        }
    },
    actions: {
        logout(context) {
            return authService.logout()
                .then(() => {
                    context.commit('setUser', null);
                    router.push({path: '/login'});
                })
                .catch(e => console.log(e));
        },
        getAuthUser(context) {
            return authService.getAuthUser()
                .then(response => {
                    console.log(response);
                    context.commit("setUser", response.data);
                })
                .catch(error => console.log(error));

        }
    }
});
