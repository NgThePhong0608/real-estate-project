<template>
    <div>
        You need to verify your email address. An email with a verification link has been sent to you.
    </div>
    <div>
        <Link :href="`/email/verification-notification`" method="post" as="button"
            class="text-indigo-600 dark:text-indigo-400">
        Resend verification email!
        </Link>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>