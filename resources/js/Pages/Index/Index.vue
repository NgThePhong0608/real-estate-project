<template>
    <MainLayout>
        <div>Index</div>
        <Link href="/show">Show page</Link>
        <div> The message is {{ message }} </div>
    </MainLayout>
</template>

<script setup>
import { Link} from "@inertiajs/inertia-vue3";
import MainLayout from "../../Layouts/MainLayout.vue";
defineProps({
    message: String
})

</script>
