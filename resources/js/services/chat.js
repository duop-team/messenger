import  {authClient} from './auth'

export default {
    async sendMessage(chat, payload) {
        await authClient.post(`/chats/${chat}/send`, payload);
    },
    async listMessages(chat) {
        await authClient.get(`/chats/${chat}`);
    }
}
