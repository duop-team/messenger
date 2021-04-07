<template>
    <div class="root">
        <section class="header">
            <h1 class="header__title">Messenger</h1>
        </section>
        <section class="content">
            <card :title="cardTitle">
                <slot name="card"></slot>
            </card>
            <div class="content__additional">
                <slot name="content"></slot>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: "ServiceLayout",
    props: ['cardTitle']
}
</script>

<style scoped lang="scss">
.root {
    min-height: 100vh;
}

.header {
    height: 350px;
    padding: 40px 0;
    background-image: url(../../img/figures.svg), linear-gradient(67.6deg, #32C585 17.95%, #546286 97.28%);
    background-repeat: no-repeat;
    background-position: right bottom;
    background-size: contain;

    &__title {
        font-family: Comfortaa, cursive;
        font-size: 64px;
        line-height: 1.1;
        text-align: center;
        color: #fff;
        box-sizing: border-box;
        text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    }
}

.content {
    padding-bottom: 5px;
}

</style>
