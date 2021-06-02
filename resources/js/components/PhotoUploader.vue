<template>
    <div class="photo__uploader">
        <div class="photo photo__empty">
            <svg-vue icon="camera" class="photo__icon"></svg-vue>
        </div>
    </div>
</template>

<script>
export default {
    name: "PhotoUploader"
}
</script>

<style scoped lang="scss">
.photo {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px;

    &__uploader {
        background-color: #E2E2E2;
        border-radius: 50%;
    }

    &__empty {
        width: 60px;
        height: 60px;
    }

    &__icon {
        height: 30px;
        fill: #C4C4C4;
    }
}
</style>
