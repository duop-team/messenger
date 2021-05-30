<template>
    <div class="chat__info">
        <div class="info__section info__section_top">
            <img src="https://via.placeholder.com/165" alt="Awesome chat photo" class="chat__photo">
            <div class="chat__title">{{$store.getters['chats/currentChat'].title}}</div>
            <div class="button__wrapper">
                <button class="chat__button chat__button_rounded">
                    <svg-vue icon="edit" class="button__icon"></svg-vue>
                </button>
                <button class="chat__button chat__button_rounded">
                    <svg-vue icon="settings" class="button__icon"></svg-vue>
                </button>
            </div>
        </div>
        <div class="info__section info__section_members">
            hello world
        </div>
    </div>
</template>

<script>
export default {
    name: "InfoBar"
}
</script>

<style scoped lang="scss">
.chat__info {
    width: 400px;
    background-color: #68B8A1;
    display: flex;
    flex-direction: column;
    height: 100%;
    gap: 15px;
    color: #FFFFFF;
    font-family: Lexend Deca;
    font-size: 14px;
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
            border-radius: 50%;
        }


    }

    &_members {
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 15px 15px 0px 0px;
        flex: 1 1 auto;
    }
}

.button__wrapper {
    align-self: flex-end;
    gap: 15px;
}
</style>
