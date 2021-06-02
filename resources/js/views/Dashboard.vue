<template>
    <div class="dashboard">
        <aside class="dashboard__sidebar">
            <div class="sidebar__menu">
                <sidebar-button icon="profile" @click.native="$store.dispatch('auth/logout')">My profile</sidebar-button>
                <sidebar-button icon="settings">Settings</sidebar-button>
                <sidebar-button icon="create_chat"
                                @click.native="$store.dispatch('chats/openModal', 'createChat')">
                    Create chat
                </sidebar-button>
            </div>
            <div class="sidebar__list">
                <div class="sidebar__search">
                    <search-field v-model="query" :icon-enabled="true"></search-field>
                </div>
                <chat-list></chat-list>
            </div>
        </aside>
        <main class="dashboard__content">
            <loader size="100" v-if="$store.getters['chats/loading'] && !modalActive"></loader>
            <chat-content v-else-if="isSelectedChat"></chat-content>
        </main>
        <modal :class="{'is-active': this.modalActive}">
            <create-chat-modal v-if="modal === 'createChat'"></create-chat-modal>
            <photo-cropper v-else-if="modal === 'cropper'"></photo-cropper>
        </modal>
    </div>
</template>

<script>
export default {
    name: "Dashboard",
    computed: {
        isSelectedChat() {
            return Object.entries(this.$store.getters['chats/currentChat']).length > 0;
        },
        modal() {
            return this.$store.getters['chats/currentModal']
        },
        modalActive() {
            return this.$store.getters['chats/currentModal'];
        }
    },
    data() {
        return {
            query: '',
        }
    }
}
</script>

<style scoped lang="scss">
.dashboard {
    display: flex;
    flex-flow: row nowrap;
    align-items: stretch;

    max-width: 100vw;
    max-height: 100vh;
    background: linear-gradient(67.6deg, #32C585 17.95%, #546286 97.28%);

    & > * {
        max-height: 100vh;
        height: 100vh;
    }
}

.dashboard__sidebar {
    display: flex;
    flex-flow: row nowrap;
    align-items: stretch;
    max-width: 480px;
    flex: 1 0 auto;
    background-color: #64A793;

    & > * {
        height: 100%;
    }

    .sidebar__menu {
        width: 100%;
        max-width: 80px;
        background-color: #63B69D;
    }

    .sidebar__search {
        padding: 22px 40px 22px 25px;

        & > * {
            height: 36px;
        }
    }

    .sidebar__list {
        width: 480px;
    }
}

.dashboard__content {
    display: flex;
    justify-content: center;
    align-items: center;
    flex: 1 1 auto;
}
</style>
