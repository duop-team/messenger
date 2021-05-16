<template>
    <div class="dashboard">
        <aside class="dashboard__sidebar">
            <div class="sidebar__menu">
            </div>
            <div class="sidebar__list">
                <chat-list></chat-list>
            </div>
        </aside>
        <main class="dashboard__content">
            <loader size="100" v-if="$store.getters['chats/loading']"></loader>
            <chat-content v-else-if="isSelectedChat"></chat-content>
        </main>
    </div>
</template>

<script>
export default {
    name: "Dashboard",
    computed: {
        isSelectedChat() {
            return Object.entries(this.$store.getters['chats/currentChat']).length > 0;
        }
    }
}
</script>

<style scoped lang="scss">
.dashboard {
    display: flex;
    flex-flow: row nowrap;

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
    width: 100%;
    max-width: 480px;
    background-color: #64A793;

    & > * {
        height: 100%;
    }

    .sidebar__menu {
        width: 80px;
        background-color: #63B69D;
    }

    .sidebar__list {
        width: 100%;
    }
}

.dashboard__content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
}
</style>
