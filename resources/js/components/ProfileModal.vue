<template>
    <form v-if="$store.getters['chats/currentModal'] === 'myProfile'" class="modal__inner"
          @submit.prevent="updateProfile()">
        <div class="modal__section modal__section_top">
            <!-- TODO: add avatar uploading feature -->
            <photo-uploader class="user__photo" target="user" :value="currentUser.id"
                            @click.native="setPhoto()"></photo-uploader>
            <input-field type="text" name="full_name" required="true" v-model="form.fullName">Full name</input-field>
        </div>
        <div class="modal__section modal__section_middle">
            <div class="user__contacts">
                <div class="contacts__item">
                    <div class="user__label">Phone</div>
                    <div class="user__data">{{ $store.getters['auth/currentUser'].phone }}</div>
                </div>
                <div class="contacts__item">
                    <div class="user__label">Nickname</div>
                    <div class="user__data">@{{ $store.getters['auth/currentUser'].nickname }}</div>
                </div>
            </div>
        </div>
        <div class="modal__section modal__section_footer">
            <cancel-button @click.native="$store.dispatch('chats/closeAllModals')">Cancel</cancel-button>
            <rounded-button type="submit">Save</rounded-button>
        </div>
    </form>
    <div class="modal__inner profile" v-else-if="$store.getters['chats/currentModal'] === 'profile'">
        <div class="modal__section modal__section_top">
            <img :src="user.photo.url" class="user__photo" v-if="user.photo">
            <svg-vue icon="frog" class="user__photo" v-else></svg-vue>
            <div class="user__name">{{ user.full_name }}</div>
        </div>
        <div class="modal__section modal__section_middle">
            <div class="user__contacts">
                <div class="contacts__item">
                    <div class="user__label">Phone</div>
                    <div class="user__data">{{ user.phone }}</div>
                </div>
                <div class="contacts__item">
                    <div class="user__label">Nickname</div>
                    <div class="user__data">@{{ user.nickname }}</div>
                </div>
            </div>
        </div>
        <div class="modal__section modal__section_middle button">
            <button @click="$store.dispatch('chats/addFriend')"
                    v-if="!$store.getters['chats/friendsList'].some(f => f.nickname === user.nickname)">
                <span class="button__content">
                    <svg-vue icon="star" class="button__icon"></svg-vue>
                    <span class="button__text">Add to friends list</span>
                </span>
            </button>
            <button v-else>
                <span class="button__content red">
                    <svg-vue icon="remove" class="button__icon"></svg-vue>
                    <span class="button__text">Remove from friends list</span>
                </span>
            </button>
        </div>
        <div class="modal__section modal__section_footer">
            <cancel-button @click.native="$store.dispatch('chats/closeModal')">Back</cancel-button>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProfileModal",
    data() {
        return {
            form: {
                fullName: this.$store.getters['auth/currentUser'].full_name,
                bio: '',
            }
        }
    },
    methods: {
        setPhoto() {
            this.$store.commit('chats/SET_TARGET', {target: 'user', value: this.currentUser.id});
            this.$store.dispatch('chats/openModal', 'cropper');
        },
        updateProfile() {
            this.$store.dispatch('chats/closeAllModals');
        }
    },
    computed: {
        user() {
            return this.$store.getters['chats/selectedUser'];
        },
        currentUser() {
            return this.$store.getters['auth/currentUser'];
        }
    }
}
</script>

<style scoped lang="scss">
.profile {
    .user__photo {
        width: 100px;
        height: 100px;
    }
}

.user__photo {
    width: 60px;
    height: 60px;
}

.user__name {
    font-size: 18px;
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
    font-family: Nunito, sans-serif;
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

        &.button {
            padding: 0;

            .button__icon {
                height: 10px;
                width: 10px;
            }

            button {
                background-color: transparent;
                border: 0;
                outline: 0;
                width: 100%;
                padding: 15px;
                cursor: pointer;
                transition: .3s;

                .button__content {
                    display: flex;
                    align-items: baseline;
                    gap: 5px;
                    justify-content: center;
                    fill: #BACE6B;
                    color: #BACE6B;

                    &.red {
                        color: #C55A5A;
                    }
                }

                &:hover {
                    background-color: darken(#64A793, 10%);
                }

                &:active {
                    background-color: darken(#64A793, 20%);
                }
            }
        }
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
}

.user__contacts {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    flex-wrap: wrap;

    .contacts__item {
        display: flex;
        gap: 10px;
        align-items: baseline;
        font-size: 14px;

        .user__label {
            color: #bdcbbe;
        }
    }
}
</style>
