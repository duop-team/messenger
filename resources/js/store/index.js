import Vue from 'vue';
import Vuex from 'vuex';
import * as auth from './modules/auth';
import * as chats from './modules/chats'
import * as messages from './modules/messages'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        chats,
        messages
    }
});
