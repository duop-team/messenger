<template>
    <div class="card">
        <div class="card__title">{{title}}</div>
        <div class="card__content">
            <slot>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, voluptatibus.</slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "Card",
    props: ['title'],
    methods: {
        submit(e) {
            return this.$emit("submit", e.target.value);
        }
    }
}
</script>

<style scoped>
.card {
    margin: -80px auto 0;
    /*width: 480px;*/
    padding: 25px 45px 32px;
    background: #65B59E;
    mix-blend-mode: normal;
    border: 3px solid #FFC3C3;
    box-sizing: border-box;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
    color: #fff;
    font-family: Sarabun, sans-serif;
}

.card__title {
    font-size: 30px;
    text-align: center;
}

.card__content {
    margin-top: 15px;
    font-size: 16px;
}
</style>
