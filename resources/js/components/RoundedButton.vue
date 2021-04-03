<template>
    <button :type="type">
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: "RoundedButton",
    props: {
        'type': {
            type: String,
            default: ''
        }
    }
}
</script>

<style scoped>
button {
    padding: 10px 45px;
    background: linear-gradient(180deg, #E26363 0%, #DE796B 100%);
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 32px;
    outline: 0;
    color: #FFFFFF;
    transition: background,color .3s;
    border: 2px solid #E26664;
    cursor: pointer;
}

button:hover {
    background: #FFFFFF;
    color: #E26664;
}
</style>
