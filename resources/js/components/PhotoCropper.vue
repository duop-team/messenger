<template>
    <card>
        <cropper :src="img" ref="cropper" stencil-component="circle-stencil" class="cropper"></cropper>
        <rounded-button type="button" @click.native="uploadImage">Send image</rounded-button>
    </card>
</template>

<script>
import {CircleStencil, Cropper} from 'vue-advanced-cropper';
import 'vue-advanced-cropper/dist/style.css';
import chat from "../services/chat";


export default {
    name: "PhotoCropper",
    components: {
        Cropper, CircleStencil
    },
    data() {
        return {
            img: 'https://images.unsplash.com/photo-1485178575877-1a13bf489dfe?ixlib=rb-1.2.1&auto=format&fit=crop&w=991&q=80'
        }
    },
    methods: {
        uploadImage() {
            let {canvas} = this.$refs.cropper.getResult();

            if (canvas) {
                const form = new FormData();
                canvas.toBlob(blob => {
                    form.append('image', blob);
                    chat.setChatPhoto(1, form)
                        .then(r => console.log(r))
                        .catch(e => console.log(e));
                });
            }

        }
    }
}
</script>

<style scoped lang="scss">
.cropper {
    height: 500px;
}
</style>
