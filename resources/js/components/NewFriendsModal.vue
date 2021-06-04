<template>
    <form class="modal__inner">
        <div class="modal__section modal__section_top">
            <search-field placeholder="Find a friend..." name="find_user" @input="searchUser()"
                          class="search__field" :icon-enabled="true" v-model="query"></search-field>
        </div>

        <div class="modal__section_list">
            <loader v-if="$store.getters['chats/loading']"></loader>
            <ul v-else class="participants__list">
                <li class="participants__item" v-for="item in fondUsers"
                    :key="item.nickname" @click="selectUser(item)">
                    <div class="participant__photo">
                        <img :src="item.photo.url" v-if="item.photo" class="photo">
                        <svg-vue icon="frog" class="photo" v-else></svg-vue>
                    </div>
                    <div class="participant__name">
                        <div class="participant__nickname">@{{ item.nickname }}</div>
                        <div class="participant__status">Non-implemented status</div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="modal__section modal__section_footer">
            <cancel-button @click.native="close()">Close</cancel-button>
        </div>
    </form>
</template>

<script>
export default {
    name: "NewFriendsModal",
    data() {
        return {
            query: ''
        }
    },
    methods: {
        close() {
            this.$store.commit('chats/SET_FOND_USERS', null);
            this.$store.dispatch('chats/closeAllModals');
        },
        searchUser() {
            if (this.query.length > 1) {
                this.$store.dispatch('chats/searchUser', this.query);
            } else {
                this.$store.commit('chats/SET_FOND_USERS', null);
            }
        },
        selectUser(user) {
            this.$store.commit('chats/SET_SELECTED_USER', user);
            this.$store.dispatch('chats/openModal', 'profile');
        }
    },
    computed: {
        fondUsers() {
            return this.$store.getters['chats/getFondUsers'];
        }
    }
}
</script>

<style scoped lang="scss">
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
        justify-content: stretch;
        align-items: stretch;
    }

    &_footer {
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search__field {
        height: 35px;
        width: 100%;
    }
}

.participant {
    &__photo {
        max-width: 60px;

        .photo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
    }

    &__name {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 5px;
    }

    &__nickname {
        font-family: "Mplus 1p", sans-serif;
        color: #000000;
        font-size: 14px;
        font-weight: 500;
    }

    &__status {
        font-size: 11px;
        font-family: Nunito, sans-serif;
        color: #768978;
    }

    &s__list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    &s__item {
        display: flex;
        align-items: center;
        gap: 20px;
        background-color: #E2E2E2;
        padding: 5px 20px 5px 10px;
        transition: .3s;
        user-select: none;
        cursor: pointer;

        &:nth-child(2n) {
            background-color: #EAE9E9;
        }

        &:hover {
            background-color: #A1D9C9;
        }
    }
}
</style>
