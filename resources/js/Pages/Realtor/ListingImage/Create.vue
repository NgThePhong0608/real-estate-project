<template>
    <Box>
        <template #header>Upload new images</template>
        <form @submit.prevent="upload">
            <section class="flex items-center gap-2 my-4">
                <input type="file"
                       class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
                       multiple @input="addFiles">
                <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                        :disabled="!canUpload">Upload
                </button>
                <button type="reset" class="btn-outline" @click="reset">Reset</button>
            </section>
            <div v-if="imageErrors.length" class="input-error">
                <div v-for="(error, index) in imageErrors" :key="index">{{ error }}</div>
            </div>
        </form>
    </Box>
    <Box v-if="listing.images.length" class="mt-4">
        <template #header>Current Listing Images</template>
        <section class="mt-4 grid grid-cols-4 gap-4">
            <div
                v-for="image in listing.images" :key="image.id"
                class="flex flex-col justify-between">
                <img :src="image.src" class="w-full h-32 object-cover rounded-md" alt="Listing images">
                <Link
                    :href="`/realtor/listing/${listing.id}/image/${image.id}`"
                    method="DELETE"
                    as="button"
                    class="mt-2 btn-outline text-xs"
                >
                    Delete
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import Box from '../../../Components/UI/Box.vue'
import {useForm} from "@inertiajs/inertia-vue3";
import {computed} from "vue";
import {Inertia} from "@inertiajs/inertia";
import NProgess from "nprogress";
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps({
    listing: Object
})

Inertia.on('progress', (event) => {
    if (event.detail.progress.percentage) {
        NProgess.set((event.detail.progress.percentage / 100) * 0.9);
    }
})

const form = useForm({
    images: [],

})

const canUpload = computed(() => form.images.length > 0)
const imageErrors = computed(() => Object.values(form.errors))
const upload = () => {
    form.post('/realtor/listing/' + props.listing.id + '/image', {
        onSuccess: () => form.reset('images'),
    })
}

const addFiles = (event) => {
    for (const image of event.target.files) {
        form.images.push(image)
    }
}

const reset = () => {
    form.reset('images')
}
</script>
