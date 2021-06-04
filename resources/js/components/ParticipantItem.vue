<template>
    <li class="participants__item">
        <div class="participant__info">
            <div class="participant__photo">
                <img :src="photo" v-if="photo" class="photo">
                <svg-vue icon="frog" class="photo" v-else></svg-vue>
            </div>
            <div class="participant__name">
                <div class="participant__nickname">{{ nickname }}</div>
                <div class="participant__status">Non-implemented status</div>
            </div>
        </div>
        <label class="participant__button">
            <input type="checkbox" class="button__checkbox" @input="onChange">
        </label>
    </li>
</template>

<script>
export default {
    name: "ParticipantItem",
    props: {
        photo: {
            type: String
        },
        nickname: {
            type: String
        },
        type: {
            type: String,
            default: 'newChat'
        }
    },
    methods: {
        onChange(e) {
            switch (this.type) {
                case 'newChat':
                    let form = this.$store.getters['chats/newChatForm'];
                    let participants = form.participants;

                    if (e.target.checked) {
                        form.participants.push(this.nickname);
                    } else {
                        form.participants = participants.filter(i => i !== this.nickname);
                    }

                    this.$store.commit('chats/SET_NEW_CHAT', form);

                    break;
                case 'addMembers':
                    let data = this.$store.getters['chats/newMembers'];
                    let members = data;

                    if (e.target.checked) {
                        data.push(this.nickname);
                    } else {
                        data = members.filter(i => i !== this.nickname);
                    }

                    this.$store.commit('chats/SET_NEW_MEMBERS', data);

                    break;
            }
        }
    }
}
</script>

<style scoped lang="scss">
.participant {
    &__button {
        cursor: pointer;
        height: 30px;
        width: 30px;
        border-radius: 50%;

        .checkmark {
            position: absolute;
            top: 7px;
            left: 7px;
            height: 17px;
            width: 17px;
        }

        .button__checkbox {
            height: 30px;
            width: 30px;
        }

        .button__icon {
            height: 16px;
        }
    }

    &s__item {
        display: flex;
        justify-content: space-between;
        background-color: #E2E2E2;
        padding: 5px 20px 5px 10px;
        transition: .3s;
        align-items: center;

        &:nth-child(2n) {
            background-color: #EAE9E9;
        }

        &:hover {
            background-color: #A1D9C9;
        }
    }

    &__info {
        display: flex;
        gap: 15px;
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
}

.photo {
    width: 60px;
    border-radius: 50%;
}
</style>
