<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style>
.logo span {
    color: dodgerblue;
}
</style>

<template>
    <div class="flex flex-col h-screen bg-gray-200 md:flex-row">
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex flex-col items-center justify-between p-6 m-4 shadow bg-white rounded md:flex-row">
                <div class="flex items-center space-x-4">
                    <!-- Logo -->
                    <Link href="/">
                        <div class="flex items-center ">
                            <h1 class="logo text-3xl font-semibold">Reserva<span>.me</span></h1>
                        </div>
                    </Link>
                </div>
                <div class="flex flex-col items-center space-y-2 mt-2 md:mt-0 md:space-y-0 md:flex-row md:space-x-4">
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

