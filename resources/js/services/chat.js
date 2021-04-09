import  {authClient} from './auth'

export default {
    async sendMessage(chat, payload) {
        return await authClient.post(`/api/chats/${chat}/send`, payload);
    },
    async listMessages(chat) {
        return await authClient.get(`/api/chats/${chat}`);
    }
}
