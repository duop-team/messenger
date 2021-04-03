import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import vuex from 'vuex';

Vue.use(vuex);
Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
