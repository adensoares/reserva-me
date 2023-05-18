<template>
  <Head :title="pageTitle" />
  <AuthenticatedLayout>
    <h1 class="text-2xl px-4 font-semibold text-gray-900">{{ pageTitle }}</h1>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
      <div class="px-4 py-6 sm:px-0">
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <form @submit.prevent="submit">
              <h2 class="mb-4 text-lg font-medium text-gray-700">Escolha uma mesa</h2>
              
              <!-- Tables -->
              <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-4">
                <TableCard
                  v-for="table in tables"
                  :key="table.id"
                  :table="table"
                  :isSelected="form.table_id === table.id"
                  @select="selectTable"
                />
              </div>
              
              <div class="mb-4">
                <InputLabel for="date" value="Data" />
                <input type="date" :min="today" v-model="form.date" id="date" required class="mt-1 block w-full">
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
import { Head, usePage, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TableCard from '@/Components/TableCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';



defineProps({
  tables: {
    type: Array,
    required: true,
  },
  pageTitle: {
    type: String,
    default: 'Criar Reserva',
  },
});

const { props } = usePage();

const form = useForm({
  user_id: props.auth.user.id,
  table_id: null,
  date: '',
  reservation_time: '',
});

const today = new Date().toISOString().split("T")[0];

const selectTable = (tableId) => {
  form.table_id = tableId;
};

const submit = () => {
  form.post(route('reservations.store'));
};
</script>

<style>
</style>

  