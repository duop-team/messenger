<template>
  <div class="chat__form">
    <form @submit.prevent="sendMessage">
      <input type="text" v-model="message" class="message__field"
             placeholder="Write a message and press Enter to send it">
    </form>
  </div>
</template>

<script>
import chatService from "../services/chat";

export default {
  name: "MessageForm",
  data() {
    return {
      message: ''
    }
  },
  methods: {
    sendMessage() {
      // TODO: change chat id
      chatService.sendMessage(this.$store.getters['chats/currentChat'].id, {text: this.message}).then(r => {
        this.$store.commit('chats/PUSH_MESSAGE_LIST', r.data);
        this.message = '';
      });
    }
  }
}
</script>

<style scoped lang="scss">
.chat__form {
  padding: 9px 15px;
  background: #559E89;
  border: 1px solid #5B8377;
  border-radius: 15px 15px 0 0;
  margin-left: -15px;
  //overflow-y: scroll;

  form {
    display: flex;
    flex-flow: row nowrap;
    align-items: center;

    .message__field {
      width: 100%;
      height: 100%;
      font-family: Lexend Deca, sans-serif;
      font-style: normal;
      font-weight: normal;
      font-size: 14px;
      color: #FFFFFF;
      background-color: transparent;
      outline: 0;
      border: 0;

      &::placeholder {
        color: #cccccc;
      }
    }
  }
}


</style>
