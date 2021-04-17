export default {
    async sendMessage(chat, payload) {
        return await axios.post(`/api/chats/${chat}/messages/send`, payload);
    },
    async listMessages(chat) {
        return await axios.get(`/api/chats/${chat}/messages`);
    },
    async listChats() {
        return await axios.get('/api/user/chats');
    },
    async findUser(payload) {
        return await axios.post('/api/users/search', payload);
    },
    async addParticipant(chat, payload) {
        return await axios.post(`/api/chats/${chat}/participants/create`, payload)
    },
    async createChat(payload) {
        return await axios.post('/api/chats/create', payload);
    }
}
