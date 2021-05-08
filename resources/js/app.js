require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './routes';
import vuex from 'vuex';
import store from './store'

Vue.use(vuex);
Vue.use(VueRouter);

/* Registering custom components */
Vue.component('RoundedButton', require('./components/RoundedButton').default);
Vue.component('InputField', require('./components/InputField').default);
Vue.component('Card', require('./components/Card').default);
Vue.component('ServiceLayout', require('./components/ServiceLayout').default);
Vue.component('MessageForm', require('./components/MessageForm').default);
Vue.component('ChatHeader', require('./components/ChatHeader').default);
Vue.component('ChatItem', require('./components/ChatItem').default);
Vue.component('Message', require('./components/Message').default);

const app = new Vue({
    el: '#app',
    router,
    store
});
