<template>
    <card>
        <slot name="content">
            Hello world for image cropper
        </slot>
    </card>
</template>

<script>
export default {
name: "PhotoCropper"
}
</script>

<style scoped lang="scss">
.cropper {
    padding: 100px;
}
</style>
