<script setup>
import { ref } from 'vue';

const props = defineProps({
  table: {
    type: Object,
    required: true
  },
  isSelected: {
    type: Boolean,
    default: false
  }
});

const emit = defineEmits(['select']);

const selectTable = () => {
  emit('select', props.table.id);
};
</script>

<template>
  <div 
    class="border-2 p-4 rounded-lg cursor-pointer"
    :class="{'border-indigo-500': isSelected, 'border-gray-300': !isSelected}"
    @click="selectTable"
  >
    <p class="text-center text-xl font-semibold">{{ table.number }}</p>
    <p class="text-center text-sm text-gray-500">Assentos: {{ table.seats }}</p>
  </div>
</template>
