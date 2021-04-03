import Login from "./views/Login";
import Register from "./views/Register";
import Home from "./views/Home";

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/login',
            component: Login
        },
        {
            path: '/register',
            component: Register
        }
    ]
}
