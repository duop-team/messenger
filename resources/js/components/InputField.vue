<template>
    <div class="input">
        <input placeholder="workaround" :type="type" :id="name" :name="name" :value="value" :required="required.valueOf()" :autofocus="autofocus" @input="updateValue">
        <label :for="name">
            <slot></slot>
        </label>
        <span></span>
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

<style scoped lang="scss">

.input {
    position: relative;
    width: 100%;
}

input {
    padding: 5px 0;
    font-family: Nunito, sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    width: 100%;
    background-color: transparent;
    border: 0;
    border-bottom: 1px solid #FFFFFF;
    border-radius: 0;
    outline: 0;
    color: #fff;

    &[type=password] {
        letter-spacing: 0.1em;
    }

    &::placeholder {
        color: transparent;
        user-select: none;
    }

    &:-webkit-autofill,
    &:-webkit-autofill:hover,
    &:-webkit-autofill:focus {
        background-color: #65B59E !important;
        -webkit-box-shadow: 0 0 0 1000px #65B59E inset !important;
        -webkit-text-fill-color: white !important;
    }

    &:focus ~ label,
    &:not(:placeholder-shown) ~ label {
        top: -18px;
        left: 0;
        color: #66C8FF;
    }

    &:focus ~ span,
    &:not(:placeholder-shown) ~ span {
        width: 100%;
    }
}

span {
    background-color: #66C8FF;
    display: block;
    width: 0;
    height: 3px;
    transition: .4s;
    position: absolute;
    bottom: 0;
}

label {
    font-family: Sarabun, sans-serif;
    font-size: 16px;
    margin-bottom: 0;
    position: absolute;
    top: 15%;
    left: 5px;
    transition: .4s;
    user-select: none;
    cursor: text;
}
</style>
