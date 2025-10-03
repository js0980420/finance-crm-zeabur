<template>
  <div v-if="isInitializing" class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="text-center">
      <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
      <p class="text-gray-600">載入中...</p>
    </div>
  </div>
  <NuxtLayout v-else>
    <NuxtPage />
  </NuxtLayout>
</template>

<script setup>
const authStore = useAuthStore()
const isInitializing = ref(true)

// 在應用啟動時初始化身份驗證
onMounted(async () => {
  if (process.client) {
    await authStore.waitForInitialization()
    isInitializing.value = false
  }
})

useHead({
  title: '融資貸款公司 CRM 系統',
  meta: [
    { name: 'description', content: '專為中租經銷商設計的融資貸款客戶關係管理系統，整合汽車、機車、手機貸款業務' },
    { name: 'color-scheme', content: 'light' }
  ],
  htmlAttrs: {
    class: 'light',
    'data-theme': 'light'
  },
  bodyAttrs: {
    class: 'light'
  }
})
</script>