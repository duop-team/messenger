<template>
    <button type="button" class="cancel-btn">
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: "CancelButton",
    methods: {
        // click() {
        //     this.$emit('click');
        // }
    }
}
</script>

<style scoped lang="scss">
.cancel-btn {
    cursor: pointer;
    font-size: 16px;
    font-family: Sarabun;
    user-select: none;
    border: 0;
    outline: 0;
    background-color: transparent;
    color: #FFFFFF;
}
</style>
