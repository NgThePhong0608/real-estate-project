<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import ListingAddress from "../../Components/ListingAddress.vue";
defineProps({
    listing: Object
})
</script>

<template>
    <div>
        <ListingAddress :listing="listing"></ListingAddress>
        <Link :href="`/listing`"> Go back </Link>
    </div>
</template>

<style scoped>

</style>
