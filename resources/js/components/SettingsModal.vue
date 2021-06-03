<template>
    <div class="modal__inner">
        <div class="modal__section modal__section_top">
            There must be non-implemented features
        </div>
        <div class="modal__section modal__section_middle">
            <button @click="$store.dispatch('auth/logout')">
                <div class="button__content">
                    <svg-vue icon="logout" class="button__icon"></svg-vue>
                    <span>Log out</span>
                </div>
            </button>
        </div>
        <div class="modal__section modal__section_footer">
            <cancel-button @click.native="$store.dispatch('chats/closeAllModals')">Back</cancel-button>
        </div>
    </div>
</template>

<script>
export default {
    name: "SettingsModal"
}
</script>

<style scoped lang="scss">
button {
    width: 100%;
    height: 100%;
    background-color: transparent;
    border: 0;
    outline: 0;
    padding: 15px;
    cursor: pointer;
    transition: .3s;

    &:hover {
        background-color: darken(#64A793, 10%);
    }
}
.button__content {
    color: #FFFFFF;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;

    .button__icon {
        fill: #FFFFFF;
        height: 15px;
        width: 15px;
    }
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
        padding: 0;
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
</style>
