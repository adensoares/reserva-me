<template>
    <GuestLayout>
        <Head :title="pageTitle" />

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg"
        >
            <div class="max-w-7xl mx-auto p-6 lg:p-8 text-center">
                <h1 class="text-3xl font-bold mb-4">Boas <span style="color: dodgerblue;">Vindas</span></h1>
                <p class="text-gray-600 mb-6">Reserva.me é a plataforma oficial de reservas do nosso restaurante</p>

                <div v-if="canLogin" class="flex flex-col space-y-4 sm:space-y-0 sm:flex-row sm:space-x-4 justify-center">
                    
                    <SecondaryButton v-if="canRegister">
                        <Link :href="route('register')" class="block w-full text-center">Cadastre-se</Link>
                    </SecondaryButton>

                    <PrimaryButton>
                        <Link :href="route('login')" class="block w-full text-center">Entrar</Link>
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    pageTitle: {
        type: String,
        default: 'Boas Vindas',
    },
});
</script>
