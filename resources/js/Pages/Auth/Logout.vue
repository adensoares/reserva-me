<template>
    <button @click="logout">Logout</button>
  </template>
  
  <script>
  export default {
    methods: {
      logout() {
        this.$inertia.post('/logout');
      },
    },
  };
  </script>