<template>
  <div class="p-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">載入中...</h1>
    <p class="text-gray-600">正在重定向到網路進線頁面</p>
  </div>
</template>

<script setup>
// 自動重定向到網路進線頁面
await navigateTo('/cases')
</script>