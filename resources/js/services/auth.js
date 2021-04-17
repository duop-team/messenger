export default {
    async login(payload) {
        await axios.post("/login", payload);
    },
    async registerUser(payload) {
        await axios.post("/register", payload);
    },
    async logout() {
        await axios.post('/logout');
    },
    async getAuthUser() {
        return await axios.get('/api/user');
    }
}
