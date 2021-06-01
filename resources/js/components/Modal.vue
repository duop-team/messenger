<template>
    <div class="modal" @click.self="closeModal()">
        <div class="modal__content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modal",
    methods: {
        closeModal() {
            this.$store.dispatch('chats/closeModal');
        }
    }
}
</script>

<style scoped lang="scss">
.modal {
    position: fixed;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, .5);
    display: none;
    z-index: 100;

    &.is-active {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
}
</style>
