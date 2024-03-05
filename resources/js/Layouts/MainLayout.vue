<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Link href="/">Main Page</Link> &nbsp;
    <Link href="/show">Show Page</Link>
    <slot>Default</slot>
</template>

<style scoped>

</style>
