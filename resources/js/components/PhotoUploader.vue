<template>
    <div class="photo__uploader">
        <div class="photo photo__empty" v-if="!$store.getters['auth/currentUser'].photo">
            <svg-vue icon="camera" class="photo__icon"></svg-vue>
        </div>
        <img :src="$store.getters['auth/currentUser'].photo.url" v-else height="60" class="image">
    </div>
</template>

<script>
export default {
    name: "PhotoUploader"
}
</script>

<style scoped lang="scss">
.image {
    border-radius: 50%;
    height: 60px;
    width: 60px;
}
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
