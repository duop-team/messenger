<template>
    <div class="message__root">
        <div class="sender__photo">
            <img src="http://placehold.jp/35x35.png" alt="Awesome avatar">
        </div>
        <div class="message__content">
            <div class="message__sender">@{{sender}}</div>
            <div class="message__text">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Message",
    props: ['sender']
}
</script>

<style scoped lang="scss">
.message__root {
    display: flex;
    flex-flow: row nowrap;
    font-family: Sarabun, sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
}

.sender__photo {
    background: #B0B8C9;
    border-radius: 3px 0px 0px 3px;
    padding: 9px 5px;
    display: flex;
    flex-flow: column nowrap;
    justify-content: flex-end;

    img {
        margin-top: auto;
        margin-bottom: 0;
        border-radius: 50%;
    }
}

.message__content {
    background-color: #C8D1E3;
    border-radius: 0px 3px 3px 0px;
    padding: 10px;

    .message__sender {
        color: #D78E53;
    }

    .message__text {
        margin-top: 10px;
        color: #000;
    }
}
</style>
