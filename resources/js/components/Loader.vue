<template>
    <div :style="{width: size + 'px', height: size + 'px'}">
    </div>
</template>

<script>
export default {
    name: "Loader",
    props: {
        'size': {
            default: 40
        }
    }
}
</script>

<style scoped>
div {
    content: url(../../img/loader.svg);
    /*height: 40px;*/
    /*width: 40px;*/
}
</style>
