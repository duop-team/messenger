<template>
    <button class="sidebar__button">
        <div class="button__inner">
            <div class="button__icon">
                <svg-vue :icon="icon" class="icon"></svg-vue>
            </div>
            <div class="button__text">
                <slot></slot>
            </div>
        </div>
    </button>
</template>

<script>
export default {
    name: "SidebarButton",
    props: {
        icon: {
            type: String,
            required: true
        }
    }
}
</script>

<style scoped lang="scss">
.sidebar__button {
    outline: 0;
    border: 0;
    background-color: transparent;
    cursor: pointer;
    padding: 13px 0;
    width: 100%;

    &:hover {
        background-color: #6DBFA6;
    }

    &:active {
        background-color: #64A793;

        .button__inner {
            color: #386356;
            fill: #386356;
        }
    }
}

.sidebar__button:first-child {
    padding-top: 17px;
}

.button__inner {
    display: flex;
    flex-direction: column;
    gap: 5px;
    text-align: center;
    color: #508273;
    fill: #508273;
}

.button__icon {
    display: flex;
    justify-content: center;
}

.icon {
    height: 30px;
    width: 30px;
}

.button__text {
    font-family: Nunito, sans-serif;
    font-weight: 700;
    font-size: 12px;
}
</style>
