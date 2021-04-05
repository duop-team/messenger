<template>
    <div>
        <h1>You are logged in, @{{$store.getters.currentUser.nickname}}</h1>
        <span class="links__link" @click="logout">Logout</span>
    </div>
</template>

<script>
export default {
    name: "Home",
    methods: {
        logout() {
            this.$store.dispatch('logout');
        }
    }
}
</script>

<style scoped>
div {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

span {
    text-decoration: underline;
    cursor: pointer;
}
</style>
