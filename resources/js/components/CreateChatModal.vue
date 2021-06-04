<template>
    <form class="modal__inner" @submit.prevent="createChat">
        <div class="modal__section modal__section_top">
            <!-- Removed because it isn't possible to set photo before chat is created -->
<!--            <photo-uploader class="chat__photo" @click.native="$store.dispatch('chats/openModal', 'cropper')"></photo-uploader>-->
            <input-field type="text" name="chat_title" required="true" v-model="title">Chat name</input-field>
        </div>

        <div class="modal__section modal__section_middle">
            <search-field placeholder="Find a friend..." name="find_user"
                          class="search__field" :icon-enabled="true" v-model="query"></search-field>
        </div>

        <div class="modal__section_list">
            <loader v-if="$store.getters['chats/loading']"></loader>
            <ul class="users__list" v-else>
                <participant-item v-for="item in results" :key="item.nickname"
                                  :photo="item.photo ? item.photo.url : ''"
                                  :nickname="item.nickname"></participant-item>
            </ul>
        </div>
        <div class="modal__section modal__section_footer">
            <cancel-button @click.native="$store.dispatch('chats/closeAllModals')">Cancel</cancel-button>
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
            query: '',
            selected: []
        }
    },
    computed: {
        results() {
            if (this.query !== '') {
                return this.$store.getters['chats/friendsList'].filter(f => f.nickname.includes(this.query));
            }

            return this.$store.getters['chats/friendsList'];
        }
    },
    methods: {
        close() {
            this.$store.commit('chats/SET_NEW_CHAT', {title: '', participants: []});
            this.$store.dispatch('chats/closeAllModals')
        },
        createChat() {
            let form = this.$store.getters['chats/newChatForm'];
            form.title = this.title;
            this.$store.commit('chats/SET_NEW_CHAT', form);
            this.$store.dispatch('chats/createChat').then(() => this.close());
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
.chat__photo {
    width: 60px;
    height: 60px;
}

.modal__inner {
    width: 480px;
    max-width: 420px;
    max-height: 100vh;
    background-color: #68B7A0;
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    color: #FFFFFF;
}

.modal__section {
    background-color: #64A793;
    padding: 20px;

    &_top {
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 5px 5px 15px 15px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    &_middle {
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    }

    &_list {
        background-color: transparent;
        min-height: 300px;
        max-height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
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

.users__list {
    list-style: none;
    margin: 0;
    padding: 0;
    align-self: stretch;
    overflow-y: scroll;
    flex: 1 1 auto;
}
</style>
