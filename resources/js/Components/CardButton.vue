<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  title: String,
  description: String,
  buttonText: String,
  url: String,
  isSelected: {
    type: Boolean,
    default: false
  }
});

const emit = defineEmits(['click']);

const handleClick = () => {
  emit('click', props.url);
};
</script>

<template>
  <div class="m-4 bg-white overflow-hidden shadow rounded-lg cursor-pointer" @click="handleClick">
    <div class="p-4">
      <div class="flex items-center">
        <div class="ml-1 w-0 flex-1">
          <h2 class="text-lg leading-7 font-semibold text-gray-900">
            {{ title }}
          </h2>
          <p class="mt-1 text-sm text-gray-500">
            {{ description }}
          </p>
        </div>
      </div>
    </div>
    <div class="border-t border-gray-200 bg-gray-50 px-4 py-4 sm:px-6">
      <div class="-mt-px w-0 flex-1 flex">
        <div class="ml-3 relative inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:border-indigo-700 active:bg-indigo-700 transition ease-in-out duration-150" :class="{'border-indigo-500': isSelected, 'border-gray-300': !isSelected}">
          {{ buttonText }}
        </div>
      </div>
    </div>
  </div>
</template>
