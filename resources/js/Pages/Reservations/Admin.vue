<template>
  <AuthenticatedLayout>
    <h1 class="text-2xl pb-4 font-semibold text-gray-900">Painel Administrativo de Reservas</h1>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="px-4 py-6 sm:px-0">
        <div class="shadow overflow-hidden sm:rounded-md">
          <div class="px-4 py-5 bg-white sm:p-6">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Mesa
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Horário de Início
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Horário de Término
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Usuário
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="reservation in reservations" :key="reservation.id">
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservation.table.name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservation.start_time }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservation.end_time }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ reservation.user.name }}</td>
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
import { Head } from '@inertiajs/vue3';

defineProps({
  reservations: {
    type: Array,
    required: true,
  },
});

// Outras lógicas e métodos necessários para a página
</script>

<style>
/* Adicione aqui seu CSS personalizado se necessário */
</style>
