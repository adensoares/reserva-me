<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    pageTitle: {
      type: String,
      default: 'Dashboard'
    }
});
</script>



<template>
    <Head :title="pageTitle" />

    <AuthenticatedLayout>
        <h1 class="text-2xl pb-4 font-semibold text-gray-900">{{pageTitle}}</h1>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
        </div>
    </AuthenticatedLayout>
</template>
