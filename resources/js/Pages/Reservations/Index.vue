<template>
  <Head :title="pageTitle" />

  <AuthenticatedLayout>
    <h1 class="text-2xl pb-4 font-semibold text-gray-900">{{ pageTitle }}</h1>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="px-4 py-6 sm:px-0">
        <div class="flex justify-end mb-4">
          <Link
            v-if="reservations.length === 0"
            :href="route('reservations.create')"
            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
          >
            Fazer Reserva
          </Link>
        </div>

        <div v-if="reservations.length === 0">
          <div class="bg-white text-center rounded-lg shadow-md p-6">
            <p class="text-gray-500 text-lg">Você não possui nenhuma reserva.</p>
            <p>:(</p>
          </div>
        </div>

        <div v-else>
          <!-- <div class="flex justify-end mb-4">
            <Link
                :href="route('reservations.edit', reservation.id)"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
            >
                Editar Reserva
            </Link>
          </div> -->

          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número da Mesa</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assentos</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="reservation in reservations" :key="reservation.id">
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservation.table.number }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservation.table.seats }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservationDate(reservation.reservation_time) }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservationTime(reservation.reservation_time) }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
            <Link
                :href="route('reservations.edit', reservation.id)"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
            >
                Editar Reserva
            </Link>
        </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  reservations: {
    type: Array,
    required: true,
  },
  pageTitle: {
    type: String,
    default: 'Reservas',
  },
});

const formatDateAndTime = (dateTimeString) => {
  const [date, fullTime] = dateTimeString.split(' ');
  const [year, month, day] = date.split('-');
  const [hour, minute] = fullTime.split(':');
  return { date: `${day}/${month}/${year}`, time: `${hour}:${minute}` };
};

const reservationDate = (dateTimeString) => formatDateAndTime(dateTimeString).date;
const reservationTime = (dateTimeString) => formatDateAndTime(dateTimeString).time;
</script>

<style>
/* Adicione aqui seu CSS personalizado se necessário */
</style>
