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
    async retrieveParticipants(chat) {
        return await axios.get(`/api/chat/${chat}/participants`);
    },
    async retrieveFriends() {
        return await axios.get(`/api/user/friends`);
    },
    async addFriend(payload) {
        return await axios.post('/api/user/friends', payload);
    },
    async findUser(payload) {
        return await axios.post('/api/user/search', payload);
    },
    async addParticipant(chat, payload) {
        return await axios.post(`/api/chat/${chat}/participants`, payload)
    },
    async createChat(payload) {
        return await axios.post('/api/chats', payload);
    },
    async setChatPhoto(chat, payload) {
        return await axios.post(`/api/chat/${chat}/media`, payload, {
            'headers': {
                'Content-Type': 'multipart/form-data'
            }
        });
    },
    async setUserPhoto(chat, payload) {
        return await axios.post(`/api/user/${chat}/media`, payload, {
            'headers': {
                'Content-Type': 'multipart/form-data'
            }
        });
    }
}
