<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { computed} from "vue";
// page.props.value.flash.success
const page = usePage();
const flashMessage = computed(
    () => page.props.value.flash.success
);
</script>

<template>
    <Link href="/">Main Page</Link> &nbsp;
    <Link href="/show">Show Page</Link>
    <div v-if="flashMessage" class="success">
        {{ flashMessage }}
    </div>
    <slot>Default</slot>
</template>

<style scoped>
.success{
    background-color: green;
    color: white;
}
</style>
