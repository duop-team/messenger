<template>
    <div>
        <label :for="name">
            <slot></slot>
        </label>
        <input :type="type" :id="name" :name="name" :value="value" :required="required.valueOf()" autofocus="autofocus" @input="updateValue">
    </div>
</template>

<script>
export default {
    name: "BaseInput",
    props: {
        'name': {
            type: String,
            required: true
        },
        'type': {
            type: String,
            required: true
        },
        'required': {
            default: false
        },
        'value': {
            type: [String, Number]
        },
        'placeholder': {
            type: [String, Number],
            default: ''
        },
        'autofocus': {
            type: Boolean
        }
    },
    methods: {
        updateValue(e) {
            return this.$emit("input", e.target.value);
        }
    }
}
</script>

<style scoped>

div {
    margin-top: 20px;
}
input {
    padding: 5px 0;
    font-family: Sarabun, sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    width: 100%;
    background-color: transparent;
    border: 0;
    border-bottom: 1px solid #FFFFFF;;
    outline: 0;
    color: #fff;
}

input[type=password] {
    letter-spacing: 0.1em;
}

label {
    font-family: Sarabun, sans-serif;
    font-size: 16px;
    margin-bottom: 0;
}
</style>
