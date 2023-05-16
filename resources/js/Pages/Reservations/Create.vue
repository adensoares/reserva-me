<template>
  <AuthenticatedLayout>
    <h1 class="text-2xl pb-4 font-semibold text-gray-900">Criar Reserva</h1>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="px-4 py-6 sm:px-0">
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <form @submit.prevent="submit">
              <h2 class="mb-4 text-lg font-medium text-gray-700">Escolha uma mesa</h2>
              
              <!-- Tables -->
              <div class="grid grid-cols-5 gap-4 mb-4">
                <div v-for="table in props.tables" :key="table.id" class="border-2 p-4 rounded-lg cursor-pointer" :class="{'border-indigo-500': form.table_id === table.id, 'border-gray-300': form.table_id !== table.id}" @click="selectTable(table.id)">
                  <p class="text-center text-xl font-semibold">{{ table.number }}</p>
                  <p class="text-center text-sm text-gray-500">Assentos: {{ table.seats }}</p>
                </div>
              </div>
              
              <div class="mb-4">
                <InputLabel for="date" value="Data" />
                <input type="date" v-model="form.date" id="date" required class="mt-1 block w-full">
                <InputError class="mt-2" :message="form.errors.date" />
              </div>

              <div class="mb-4">
                <InputLabel for="reservation_time" value="Hora da Reserva" />
                <input type="time" v-model="form.reservation_time" id="reservation_time" required class="mt-1 block w-full">
                <InputError class="mt-2" :message="form.errors.reservation_time" />
              </div>

               <!-- Campo oculto para enviar o user_id -->
               <input type="hidden" v-model="form.user_id">

               <div class="mb-4" v-if="form.errors.overlap">
                  <p class="text-red-500">{{ form.errors.overlap }}</p>
              </div>

              <PrimaryButton class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Criar Reserva
              </PrimaryButton>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


defineProps({
  tables: {
    type: Array,
    required: true,
  },
});

const { props } = usePage();
const form = useForm({
  user_id: props.auth.user.id,
  table_id: null,
  date: '',
  reservation_time: '',
});

const selectTable = (tableId) => {
  form.table_id = tableId;
};

const submit = () => {
  form.post(route('reservations.store'));
};
</script>

<style>
/* Adicione aqui seu CSS personalizado se necessário */
</style>

  