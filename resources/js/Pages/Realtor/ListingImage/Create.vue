<template>
    <form :action="`/realtor/listing/${listing.id}/image`" method="post" enctype="multipart/form-data">
        <input type="file" multiple name="files">
        <button type="submit">Send</button>
    </form>
</template>

<script setup>
defineProps({
    listing: Object
})
</script>