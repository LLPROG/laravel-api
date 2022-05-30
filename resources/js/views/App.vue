
<template>
    <div class="container">

        <router-link :to="{ name: 'home'}">Home</router-link>
        <router-link :to="{ name: 'about'}">About</router-link>
        <router-link :to="{ name: 'blogIndex'}">Blog</router-link>

        <router-view></router-view>
    </div>
</template>

<script>

export default {
    name: 'App',
}
</script>

<style scoped>

</style>
