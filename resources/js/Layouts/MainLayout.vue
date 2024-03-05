<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
// page.props.value.flash.success
const page = usePage();
const flashMessage = computed(
    () => page.props.value.flash.success
);
const user = computed(() => page.props.value.user);
</script>

<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="`/listing`">Listing</Link> &nbsp;&nbsp;
                </div>
                <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
                    <Link :href="`/listing`">Real Estate</Link> &nbsp;&nbsp;
                </div>
                <div v-if="user" class="flex items-center gap-4">
                    <div class="text-sm text-gray-500">{{ user.name }}</div>
                    <Link :href="`/listing/create`" class="btn-primary">+ New Listing</Link>
                    <div>
                        <Link :href="`/logout`" method="DELETE" as="button">Logout</Link>
                    </div>
                </div>
                <div v-else>
                    <Link :href="`/login`" as="button">Sign in</Link>
                    <!-- <Link :href="`/register`">Register</Link> -->
                </div>
            </nav>
        </div>
    </header>
    <main class="container mx-auto p-4 w-full">
        <div v-if="flashMessage"
            class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
            {{ flashMessage }}
        </div>
        <slot>Default</slot>
    </main>
</template>

