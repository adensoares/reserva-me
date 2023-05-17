<template>
    <Head :title="pageTitle" />
  
    <AuthenticatedLayout>
      <h1 class="text-2xl pb-4 font-semibold text-gray-900">{{ pageTitle }}</h1>
  
      <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">

        <div v-if="reservations.length === 0">
          <div class="bg-white text-center rounded-lg shadow-md p-6">
            <p class="text-gray-500 text-lg">Nenhuma reserva agendada no momento.</p>
            <p>:(</p>
          </div>
        </div>

          <div v-else class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50 text-center">
                <tr>
                  <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                  <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Número da Mesa</th>
                  <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Assentos</th>
                  <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                  <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                </tr>
              </thead>
              <tbody class="bg-white text-center divide-y divide-gray-200">
                <tr v-for="reservation in reservations" :key="reservation.id">
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservation.user ? reservation.user.name : '' }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservation.table ? reservation.table.number : '' }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservation.table ? reservation.table.seats : '' }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservationDate(reservation.reservation_time) }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservationTime(reservation.reservation_time) }}</td>
                </tr>
              </tbody>
            </table>
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
      default: 'Painel de Controle',
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