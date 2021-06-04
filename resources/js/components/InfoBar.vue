<template>
    <div class="chat__info">
        <div class="info__section info__section_top">
            <img v-if="chat.photo" :src="chat.photo.url" alt="Awesome chat photo" class="chat__photo">
            <svg-vue icon="chat" v-else class="chat__photo"></svg-vue>
            <div class="chat__title">{{ $store.getters['chats/currentChat'].title }}</div>
            <div class="button__wrapper">
                <button class="chat__button chat__button_rounded">
                    <svg-vue icon="logout" class="button__icon"></svg-vue>
                </button>
                <button class="chat__button chat__button_rounded" @click="setPhoto()">
                    <svg-vue icon="settings" class="button__icon"></svg-vue>
                </button>
            </div>
        </div>
        <div class="info__section info__section_members">
            <div class="members__top">
                <button class="top__button">
                    <svg-vue icon="search" class="button__icon"></svg-vue>
                </button>

                <button class="top__button" @click="$store.dispatch('chats/openModal', 'addMembers')">
                    <svg-vue icon="add_user" class="button__icon"></svg-vue>
                </button>
            </div>
            <div class="members">
                <ul class="participants__list">
                    <li class="participants__item" v-for="item in $store.getters['chats/participants']"
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
        </div>
    </div>
</template>

<script>
export default {
    name: "InfoBar",
    computed: {
        chat() {
            return this.$store.getters['chats/currentChat'];
        }
    },
    methods: {
        selectUser(user) {
            this.$store.commit('chats/SET_SELECTED_USER', user);
            this.$store.dispatch('chats/openModal', 'profile');
        },
        setPhoto() {
            this.$store.commit('chats/SET_TARGET', {target: 'chat', value: this.chat.id});
            this.$store.dispatch('chats/openModal', 'cropper');
        }
    },

}
</script>

<style scoped lang="scss">
.members__top {
    height: 60px;
    display: flex;
    justify-content: space-between;
    padding: 0 15px;

    .top__button {
        border: 0;
        outline: 0;
        background-color: transparent;
        fill: #5B8377;
        cursor: pointer;

        .button__icon {
            height: 30px;
        }
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

.chat__info {
    width: 400px;
    background-color: #68B8A1;
    display: flex;
    flex-direction: column;
    height: 100%;
    max-height: 100vh;
    gap: 15px;
    color: #FFFFFF;
    font-family: Nunito, sans-serif;
    font-size: 14px;
    overflow-y: auto;
}

.chat__button {
    outline: 0;
    border: 0;

    &_rounded {
        background-color: #63B69D;
        border-radius: 50%;
        height: 25px;
        padding: 5px;

        .button__icon {
            height: 15px;
            fill: #508273;
        }
    }
}

.info__section {
    background: #64A793;
    padding: 20px;

    &_top {
        padding-top: 40px;
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 0 0 15px 15px;
        display: flex;
        flex-direction: column;
        align-items: center;

        .chat__title {
            text-align: center;
            font-size: 18px;
            margin-top: 16px;
        }

        .chat__photo {
            width: 165px;
            height: 165px;
            border-radius: 50%;
        }
    }

    &_members {
        padding: 0;
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 15px 15px 0 0;
        flex: 1 1 auto;
    }
}

.button__wrapper {
    align-self: flex-end;
    gap: 15px;
}
</style>
