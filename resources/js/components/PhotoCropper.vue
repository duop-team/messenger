<template>
    <card>
        <div class="cropper__wrapper">
            <cropper :src="image.src" ref="cropper" stencil-component="circle-stencil" class="cropper"></cropper>
        </div>
        <div class="button__wrapper">
            <rounded-button class="button__upload" @click.native="$refs.file.click()">
                <input type="file" ref="file" @change="loadImage($event)" accept="image/*">
                Load image
            </rounded-button>
            <rounded-button type="button" @click.native="uploadImage">Send image</rounded-button>
        </div>
    </card>
</template>

<script>
import {CircleStencil, Cropper} from 'vue-advanced-cropper';
import 'vue-advanced-cropper/dist/style.css';
import chat from "../services/chat";

function getMimeType(file, fallback = null) {
    const byteArray = (new Uint8Array(file)).subarray(0, 4);
    let header = '';
    for (let i = 0; i < byteArray.length; i++) {
        header += byteArray[i].toString(16);
    }
    switch (header) {
        case "89504e47":
            return "image/png";
        case "47494638":
            return "image/gif";
        case "ffd8ffe0":
        case "ffd8ffe1":
        case "ffd8ffe2":
        case "ffd8ffe3":
        case "ffd8ffe8":
            return "image/jpeg";
        default:
            return fallback;
    }
}

export default {
    name: "PhotoCropper",
    components: {
        Cropper, CircleStencil
    },
    data() {
        return {
            image: {
                src: null,
                type: null
            }
        }
    },
    methods: {
        close() {
            this.$store.commit('chats/SET_TARGET', null);
            this.$store.dispatch('chats/closeAllModals');
        },
        crop() {
            const {canvas} = this.$refs.cropper.getResult();
            canvas.toBlob((blob) => {
                // Do something with blob: upload to a server, download and etc.
            }, this.image.type);
        },
        uploadImage() {
            let {canvas} = this.$refs.cropper.getResult();

            if (canvas) {
                const form = new FormData();
                canvas.toBlob(blob => {
                    form.append('image', blob);
                    let res = this.$store.getters['chats/photoTarget'];
                    if (res.target === 'chat') {
                        chat.setChatPhoto(res.value, form)
                            .then(() => this.close())
                            .catch(e => console.log(e));
                    } else {
                        chat.setUserPhoto(res.value, form)
                            .then(() => this.close()).catch();
                    }
                });
            }
        },
        reset() {
            this.image = {
                src: null,
                type: null
            }
        },
        loadImage(event) {
            // Reference to the DOM input element
            const {files} = event.target;
            // Ensure that you have a file before attempting to read it
            if (files && files[0]) {
                // 1. Revoke the object URL, to allow the garbage collector to destroy the uploaded before file
                if (this.image.src) {
                    URL.revokeObjectURL(this.image.src)
                }
                // 2. Create the blob link to the file to optimize performance:
                const blob = URL.createObjectURL(files[0]);

                // 3. The steps below are designated to determine a file mime type to use it during the
                // getting of a cropped image from the canvas. You can replace it them by the following string,
                // but the type will be derived from the extension and it can lead to an incorrect result:
                //
                // this.image = {
                //    src: blob;
                //    type: files[0].type
                // }

                // Create a new FileReader to read this image binary data
                const reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = (e) => {
                    // Note: arrow function used here, so that "this.image" refers to the image of Vue component
                    this.image = {
                        // Set the image source (it will look like blob:http://example.com/2c5270a5-18b5-406e-a4fb-07427f5e7b94)
                        src: blob,
                        // Determine the image type to preserve it during the extracting the image from canvas:
                        type: getMimeType(e.target.result, files[0].type),
                    };
                };
                // Start the reader job - read file as a data url (base64 format)
                reader.readAsArrayBuffer(files[0]);
            }
        }
    }
}
</script>

<style scoped lang="scss">
.cropper {
    height: 450px;
    width: 700px;
}

.button__wrapper {
    margin-top: 20px;
    display: flex;
    gap: 10px;
    justify-content: flex-end;
}

.button__upload {
    input {
        display: none;
    }
}
</style>
