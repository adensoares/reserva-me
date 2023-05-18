<script setup>
import { ref, onMounted  } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const showSidebar = ref(window.innerWidth > 640); 

onMounted(() => {
    window.addEventListener('resize', () => {
        showSidebar.value = window.innerWidth > 640; 
    });
});

</script>

<style>
.logo span {
    color: dodgerblue;
}
</style>

<template>
    <div class="flex flex-col h-screen sm:flex-row bg-gray-200">
            <div class="fixed m-4 mr-0 inset-0 flex z-40 bg-gray-600 bg-opacity-50 sm:static sm:bg-transparent" v-show="showSidebar" @click.self="showSidebar = false">
                <aside class="fixed sm:relative w-64 h-full bg-white shadow rounded overflow-y-auto transition-transform transform translate-x-0 sm:translate-x-0 sm:block" :class="showSidebar ? 'translate-x-0 sm:block' : '-translate-x-full sm:hidden'" style="transition: transform .3s ease-out">
                    <!-- Logo -->
                    <Link :href="route('reservations.index')">
                        <div class="p-6 flex items-center ">
                            <h1 class="logo text-3xl font-semibold">Reserva<span>.me</span></h1>
                        </div>
                    </Link>

                    <!-- Sidebar -->
                    <nav class="space-y-2">
                        <div>
                            <div v-if="$page.props.auth.user.is_admin">
                                <Link :href="route('dashboard')" class="block py-2 px-6 m-4 hover:bg-gray-200 rounded ">Painel de Controle</Link>
                            </div>
                            <Link :href="route('reservations.index')" v-if="!$page.props.auth.user.is_admin" class="block py-2 px-6 m-4  hover:bg-gray-200 rounded">Reservas</Link>
                        </div>

                        <div class="mt-auto"> 
                            <hr class="mx-4">
                            <Link :href="route('logout')" method="post" class="block py-2 px-6 m-4 hover:bg-gray-200 rounded">Sair</Link>
                        </div>
                    </nav>
                </aside>
            </div>            

        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Topbar -->
            <header class="flex items-center justify-between p-6 m-4 shadow bg-white rounded">
                <div class="flex items-center space-x-4">
                    
                    <button class="" @click="showSidebar = !showSidebar">
                        <!-- ícone do menu -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

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
