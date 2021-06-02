export default {
    async login(payload) {
        await axios.get("/sanctum/csrf-cookie");
        await axios.post("/login", payload);
    },
    async registerUser(payload) {
        await axios.get("/sanctum/csrf-cookie");
        await axios.post("/register", payload);
    },
    async logout() {
        await axios.post('/logout');
    },
    async getAuthUser() {
        return await axios.get('/api/user');
    },
    async code(payload) {
        await axios.get("/sanctum/csrf-cookie");
        await axios.post("/api/code", payload);
    }
}
