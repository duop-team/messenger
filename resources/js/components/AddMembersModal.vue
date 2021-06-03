<template>
    <form class="modal__inner" @submit.prevent="addMembers()">
        <div class="modal__section modal__section_top">
            <search-field placeholder="Find a friend..." name="find_user"
                          class="search__field"
                          :icon-enabled="true" @input="searchUser()" v-model="query"></search-field>
        </div>

        <div class="modal__section_list">
            <loader v-if="$store.getters['chats/loading']"></loader>
            <ul v-else class="users__list">
                <participant-item v-for="item in $store.getters['chats/getFondUsers']" :key="item.nickname"
                                  :photo="item.photo ? item.photo.url : ''"
                                  :nickname="item.nickname" type="addMembers"></participant-item>
            </ul>
        </div>
        <div class="modal__section modal__section_footer">
            <cancel-button @click.native="$store.dispatch('chats/closeModal')">Cancel</cancel-button>
            <rounded-button type="submit">Add members</rounded-button>
        </div>
    </form>
</template>

<script>
export default {
    name: "AddMembersModal",
    data() {
        return {
            query: ''
        }
    },
    methods: {
        addMembers() {
            this.$store.dispatch('chats/addParticipants');
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
        width: 100%;
    }
}

.users__list {
    list-style: none;
    margin: 0;
    padding: 0;
    align-self: stretch;
    overflow-y: scroll;
    flex: 1 1 auto;

    //li {
    //    margin: 0;
    //    padding: 0;
    //}
}

</style>
