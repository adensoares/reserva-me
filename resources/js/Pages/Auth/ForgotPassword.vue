<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Esqueci a Senha" />

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">

            <!-- Logo -->
            <Link href="/">
                <div class="flex items-center mb-10">
                    <h1 class="text-3xl font-semibold">Reserva<span style="color: dodgerblue;">.me</span></h1>
                </div>
            </Link>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um e-mail com um link de redefinição de senha que permitirá que você escolha um novo.
            </div>
    
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ status }}
            </div>
    
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" />
    
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
    
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
    
                <div class="flex justify-end block mt-4">
                    <PrimaryButton class="w-full sm:w-auto justify-center" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Redefinir Senha
                    </PrimaryButton>
                </div>
            </form>
        </div>

    </GuestLayout>
</template>
