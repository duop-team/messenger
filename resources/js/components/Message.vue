<template>
    <div class="chat__message">
        <div class="message__inner">
            <div class="sender__photo">
                <!--TODO: replace placeholder with a real photo-->
                <img src="https://via.placeholder.com/60" alt="Awesome avatar">
            </div>
            <div class="message__content">
                <div class="message__sender">@{{sender}}</div>
                <div class="message__text">
                    <p>
                        <slot></slot>
                    </p>
                </div>
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
.chat__message {
    width: 100%;
}
.message__inner {
    display: flex;
    font-family: Sarabun, sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    max-width: 65%;
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
        width: 60px;
    }
}

.message__content {
    background-color: #C8D1E3;
    border-radius: 0px 3px 3px 0px;
    padding: 10px;
    overflow-wrap: break-word;
    max-width: calc(100% - 50px);
    word-break: break-all;

    display: flex;
    flex-direction: column;
    gap: 10px;

    .message__sender {
        color: #D78E53;
    }

    .message__text {
        color: #000;
    }

    p {
        margin: 0;
    }
}
</style>
