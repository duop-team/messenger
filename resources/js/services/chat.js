export default {
    async sendMessage(chat, payload) {
        return await axios.post(`/api/chat/${chat}/messages`, payload);
    },
    async listMessages(chat) {
        return await axios.get(`/api/chat/${chat}/messages`);
    },
    async listChats() {
        return await axios.get('/api/user/chats');
    },
    async findUser(payload) {
        return await axios.post('/api/user/search', payload);
    },
    async addParticipant(chat, payload) {
        return await axios.post(`/api/chat/${chat}/participants`, payload)
    },
    async createChat(payload) {
        return await axios.post('/api/chats', payload);
    }
}
