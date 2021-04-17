import VueRouter from 'vue-router'
import store from './store/index';
import Login from "./views/Login";
import Register from "./views/Register";
import Home from "./views/Home";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/chats'
        },
        {
            path: '/login',
            component: Login
        },
        {
            path: '/register',
            component: Register
        },
        {
            path: '/chats',
            meta: {
                requiresAuth: true
            },
            component: Home
        },
        {
            path: '*',
            redirect: '/'
        }
    ]
});

router.beforeEach((to, from, next) => {
    const authUser = store.getters["auth/currentUser"];
    const reqAuth = to.matched.some((record) => record.meta.requiresAuth);
    const loginQuery = { path: "/login" };

    if (reqAuth && !authUser) {
        store.dispatch("auth/getAuthUser").then(() => {
            if (!store.getters["auth/currentUser"]) next(loginQuery);
            else next();
        });
    } else {
        next();
    }
});

export default router;
