<script setup>
import Box from "../../Components/UI/Box.vue";
import Price from "../../Components/Price.vue";
import ListingSpace from "../../Components/ListingSpace.vue";
import ListingAddress from "../../Components/ListingAddress.vue";
import {Link} from '@inertiajs/inertia-vue3';

defineProps({
    listings: Array
})
</script>

<template>
    <h1 class="text-3xl mb-4">Your listing</h1>
    <section class="mb-4">
        Filter
    </section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings" :key="listing.id">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div>
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium"/>
                        <ListingSpace :listing="listing"/>
                    </div>
                    <ListingAddress :listing="listing"/>
                </div>
                <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                    <Link class="btn-outline font-medium text-xs">Preview</Link>
                    <Link class="btn-outline font-medium text-xs">Edit</Link>
                    <Link class="btn-outline font-medium text-xs">Delete</Link>
                </div>
            </div>
        </Box>
    </section>

</template>

<style scoped>

</style>