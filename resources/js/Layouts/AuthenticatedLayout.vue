<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex h-screen bg-gray-200">
        <div class="w-64 shadow bg-white m-4 rounded">
            <!-- Logo -->
            <Link :href="route('reservations.index')">
                <div class="p-6 flex items-center ">
                    <h1 class="text-3xl font-semibold">Reserva<span style="color: dodgerblue;">.me</span></h1>
                </div>
            </Link>

            <!-- Sidebar -->
            <nav class="space-y-2">
                <div>
                    <Link :href="route('dashboard')" class="block py-2 px-6 m-4 hover:bg-gray-200 rounded ">Painel de Controle</Link>
                    <hr class="mx-4">
                    <Link :href="route('reservations.index')" class="block py-2 px-6 m-4  hover:bg-gray-200 rounded">Reservas</Link>
                    <Link :href="route('reservations.index')" class="block py-2 px-6 m-4 hover:bg-gray-200 rounded">Usuários</Link>
                </div>

                <div class="mt-auto"> 
                    <hr class="mx-4">
                    <Link :href="route('logout')" method="post" class="block py-2 px-6 m-4 hover:bg-gray-200 rounded">Sair</Link>
                </div>
            </nav>
        </div>

        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Topbar -->
            <header class="flex items-center justify-between p-6 m-4 ml-0 shadow bg-white rounded">
                <div class="flex items-center space-x-4">
                    <!-- Aqui você pode adicionar mais conteúdo para o topo, se necessário -->
                </div>

                <Dropdown>
                    <template #trigger>
                        <button class="flex items-center focus:outline-none">
                            <span>Olá, {{ $page.props.auth.user.name }}</span>

                            <!-- ícone de dropdown -->
                            <svg class="h-5 w-5 ml-2 -mr-1 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </template>

                    <template #content>
                        <DropdownLink :href="route('profile.edit')">Perfil</DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button">Sair</DropdownLink>
                    </template>
                </Dropdown>
            </header>


            <!-- Main content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto pb-4 pr-4 pl-0">
                <slot />
            </main>
        </div>
    </div>
</template>
