<template>
    <div class="search">
        <input type="text" :placeholder="placeholder" :name="name" :id="name"
               :class="{'search__field': true, 'search__field_blank': !iconEnabled}" @input="updateValue">
        <i v-if="iconEnabled" class="search__icon">
            <svg-vue class="icon" icon="search"></svg-vue>
        </i>
    </div>
</template>

<script>
export default {
    name: "SearchField",
    props: {
        iconEnabled: {
            type: Boolean,
            default: false
        },
        name: {
            type: String,
            default: 'search'
        },
        placeholder: {
            type: String,
            default: 'Search...'
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
$placeholder-color: #6EB19E;

.search {
    position: relative;
    display: flex;

    &__icon {
        position: absolute;
        top: 25%;
        left: 7px;
    }
}

.icon {
    fill: $placeholder-color;
    width: 17px;
}

input {
    color: #FFFFFF;
    background-color: #5B8377;
    outline: 0;
    border: 0;
    border-radius: 6px;
    width: 100%;
    height: 100%;
    padding-left: 30px;
    font-family: 'M PLUS 1p', sans-serif;
    font-size: 13px;

    &::placeholder {
        color: $placeholder-color;
        user-select: none;
    }
}

.search__field_blank {
    padding-left: 15px;
    padding-right: 15px;
}
</style>
