<template>
  <div class="alert alert-info">
    🐳 Hello Vue is working! (time: {{ now }})
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const now = ref(new Date().toLocaleTimeString());

onMounted(() => {
  setInterval(() => now.value = new Date().toLocaleTimeString(), 1000);
});
</script>
