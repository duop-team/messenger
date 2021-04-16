export default {
    async sendMessage(chat, payload) {
        return await axios.post(`/api/chats/${chat}/messages/send`, payload);
    },
    async listMessages(chat) {
        return await axios.get(`/api/chats/${chat}/messages`);
    }
}
