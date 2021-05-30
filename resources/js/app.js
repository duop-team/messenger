require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './routes';
import vuex from 'vuex';
import store from './store'
import SvgVue from 'svg-vue';

Vue.use(vuex);
Vue.use(VueRouter);
Vue.use(SvgVue);

/* Registering custom components */
Vue.component('RoundedButton', require('./components/RoundedButton').default);
Vue.component('InputField', require('./components/InputField').default);
Vue.component('Card', require('./components/Card').default);
Vue.component('ServiceLayout', require('./components/ServiceLayout').default);
Vue.component('MessageForm', require('./components/MessageForm').default);
Vue.component('ChatHeader', require('./components/ChatHeader').default);
Vue.component('ChatItem', require('./components/ChatItem').default);
Vue.component('Message', require('./components/Message').default);
Vue.component('Loader', require('./components/Loader').default);
Vue.component('ChatList', require('./components/ChatList').default);
Vue.component('ChatContent', require('./components/ChatContent').default);
Vue.component('Messages', require('./components/Messages').default);
Vue.component('SidebarButton', require('./components/SidebarButton').default);
Vue.component('SearchField', require('./components/SearchField').default);
Vue.component('CreateChatModal', require('./components/CreateChatModal').default);
Vue.component('CancelButton', require('./components/CancelButton').default);
Vue.component('Modal', require('./components/Modal').default);
Vue.component('InfoBar', require('./components/InfoBar').default);
Vue.component('PhotoUploader', require('./components/PhotoUploader').default);
Vue.component('ParticipantItem', require('./components/ParticipantItem').default);

const app = new Vue({
    el: '#app',
    router,
    store
});
