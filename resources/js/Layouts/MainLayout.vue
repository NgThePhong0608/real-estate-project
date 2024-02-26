<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

let timer = ref(0);
setInterval(() => {
    timer.value++
}, 1000);

</script>

<template>
    <Link href="/">Main Page</Link> &nbsp;
    <Link href="/show">Show Page</Link>
    <div>The page with time {{ timer }}</div>
    <slot></slot>
</template>

<style scoped>

</style>
