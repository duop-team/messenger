// import axios from 'axios';
//
// export const authClient = axios.create({
//     // baseURL: 'https://messenger-course.herokuapp.com',
//     baseURL: process.env.VUE_APP_API_URL,
//     withCredentials: true
// });

export default {
    async login(payload) {
        // await authClient.get("/sanctum/csrf-cookie");
        await axios.post("/login", payload);
    },
    async registerUser(payload) {
        // await authClient.get("/sanctum/csrf-cookie");
        await axios.post("/register", payload);
    },
    async logout() {
        await axios.post('/logout');
    },
    async getAuthUser() {
        return await axios.get('/api/user');
    }
}
