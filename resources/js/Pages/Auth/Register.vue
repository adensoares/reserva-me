<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Cadastro" />

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">

            <!-- Logo -->
            <Link href="/">
                <div class="flex items-center mb-10">
                    <h1 class="text-3xl font-semibold">Reserva<span style="color: dodgerblue;">.me</span></h1>
                </div>
            </Link>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <InputLabel for="name" value="Nome" />
    
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
    
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
    
                <div class="mt-4">
                    <InputLabel for="email" value="Email" />
    
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />
    
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
    
                <div class="mt-4">
                    <InputLabel for="password" value="Senha" />
    
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />
    
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
    
                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirmar Senha" />
    
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
    
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>
    
                <div class="block mt-4 sm:flex sm:items-center sm:justify-between">
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 block text-center sm:inline mb-2      sm:mb-0"
                    >
                        Já possui cadastro?
                    </Link>

                    <PrimaryButton class="w-full sm:w-auto justify-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Cadastrar
                    </PrimaryButton>
                </div>
            </form>
        </div>

    </GuestLayout>
</template>
