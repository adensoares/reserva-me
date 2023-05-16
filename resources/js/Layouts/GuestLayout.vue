<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex h-screen bg-gray-200">
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between p-6 m-4 shadow bg-white rounded">
                <div class="flex items-center space-x-4">
                    <!-- Logo -->
                    <Link href="/">
                        <div class="flex items-center ">
                            <h1 class="text-3xl font-semibold">Reserva<span style="color: dodgerblue;">.me</span></h1>
                        </div>
                    </Link>
                </div>
                <div class="flex items-center space-x-4">
                    <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Entrar</Link>
                    <Link :href="route('register')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Cadastre-se</Link>
                </div>
            </header>


            <!-- Main content -->
            <main class="flex items-center justify-center flex-1 overflow-x-hidden overflow-y-auto p-6 bg-white m-4 mt-0 rounded ">
                <slot />
            </main>
        </div>
    </div>
   
</template>
