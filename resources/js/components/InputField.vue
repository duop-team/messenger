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

<style scoped>

.input {
    position: relative;
    margin-top: 28px;
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
    border-bottom: 1px solid #FFFFFF;
    border-radius: 0;
    outline: 0;
    color: #fff;
}

input[type=password] {
    letter-spacing: 0.1em;
}

input::placeholder {
    color: transparent;
}
span {
    /*content: '';*/
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

}

input:focus ~ label,
input:not(:placeholder-shown) ~ label {
    top: -18px;
    left: 0;
}

input:focus ~ span,
input:not(:placeholder-shown) ~ span {
    width: 100%;
}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
textarea:-webkit-autofill,
textarea:-webkit-autofill:hover,
textarea:-webkit-autofill:focus,
select:-webkit-autofill,
select:-webkit-autofill:hover,
select:-webkit-autofill:focus {
    background-color: #65B59E !important;
    -webkit-box-shadow: 0 0 0 1000px #65B59E inset !important;
    -webkit-text-fill-color: white !important;
}
</style>
