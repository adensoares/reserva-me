<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
      <Head title="Entrar" />
  
      <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
      </div>
  
      <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
        <!-- Logo -->
        <Link href="/">
          <div class="flex items-center mb-10">
            <h1 class="text-3xl font-semibold">Reserva<span style="color: dodgerblue;">.me</span></h1>
          </div>
        </Link>
  
        <form @submit.prevent="submit" class="space-y-4">
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
  
          <div class="mt-4">
            <InputLabel for="password" value="Senha" />
  
            <TextInput
              id="password"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password"
              required
              autocomplete="current-password"
            />
  
            <InputError class="mt-2" :message="form.errors.password" />
          </div>
  
          <div class="block mt-4 sm:flex sm:items-center sm:justify-between">
            <label class="flex items-center">
              <Checkbox name="remember" v-model:checked="form.remember" />
              <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Lembrar-me</span>
            </label>
  
            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 block text-center sm:inline mt-4 sm:mt-0"
            >
              Esqueceu a senha?
            </Link>
          </div>
        
          <div class="flex justify-end">
            <PrimaryButton
            class="w-full sm:w-auto justify-center"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Entrar
          </PrimaryButton>
          </div>
          
        </form>
      </div>
    </GuestLayout>
  </template>
  
