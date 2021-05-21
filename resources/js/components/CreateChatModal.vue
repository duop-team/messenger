<template>
    <form class="modal__inner" @submit.prevent="createChat">
        <div class="modal__section modal__section_top">
            <!-- TODO: add avatar uploading feature -->
            <input-field type="text" name="chat_title" required="true" v-model="title">Chat name</input-field>
        </div>

        <div class="modal__section modal__section_middle">
            <search-field placeholder="Find a friend... (currently not supported)" name="find_user"
                          class="search__field"
                          :icon-enabled="true" @input="searchUser()" v-model="query"></search-field>
        </div>

        <div class="modal__section_list">
            <loader v-if="$store.getters['chats/loading']"></loader>
            <ul v-else>
                <!-- TODO: selecting friend to add as participant -->
                <li v-for="item in $store.getters['chats/getFondUsers']" :key="item.id">
                    {{ item.nickname }}
                </li>
            </ul>
        </div>
        <div class="modal__section modal__section_footer">
            <cancel-button @click.native="$store.dispatch('chats/toggleCreateChat')">Cancel</cancel-button>
            <rounded-button type="submit">Create</rounded-button>
        </div>
    </form>
</template>

<script>
export default {
    name: "CreateChatModal",
    data() {
        return {
            title: '',
            query: ''
        }
    },
    methods: {
        createChat() {
            this.$store.commit('chats/SET_NEW_CHAT', {title: this.title});
            this.$store.dispatch('chats/createChat');
        },
        searchUser() {
            if (this.query.length > 1) {
                this.$store.dispatch('chats/searchUser', this.query);
            } else {
                this.$store.commit('chats/SET_FOND_USERS', null);
            }
        }
    }
}
</script>

<style scoped lang="scss">
.modal__inner {
    width: 480px;
    max-width: 420px;
    background-color: #68B7A0;
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    color: #FFFFFF;
}

.modal__section {
    background-color: #64A793;
    padding: 15px;

    &_top {
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px 5px 15px 15px;
    }

    &_middle {
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }

    &_list {
        background-color: transparent;
        min-height: 150px;
        max-height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        ul {
            justify-self: flex-start;
        }
    }

    &_footer {
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search__field {
        height: 35px;
    }
}
</style>
