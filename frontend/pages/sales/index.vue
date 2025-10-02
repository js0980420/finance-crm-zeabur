<template>
  <div class="p-6">
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-900">業務管理</h1>
      <p class="text-gray-600 mt-2">管理客戶關係、追蹤銷售進度和業務報表</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- 客戶管理 -->
      <NuxtLink
        to="/sales/customers"
        class="block p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow"
      >
        <div class="flex items-center">
          <div class="p-3 bg-blue-100 rounded-lg">
            <Icon name="heroicons:users" class="w-6 h-6 text-blue-600" />
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium text-gray-900">客戶管理</h3>
            <p class="text-sm text-gray-500">管理客戶資料和聯絡資訊</p>
          </div>
        </div>
      </NuxtLink>

      <!-- 追蹤管理 -->
      <NuxtLink
        to="/sales/tracking"
        class="block p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow"
      >
        <div class="flex items-center">
          <div class="p-3 bg-green-100 rounded-lg">
            <Icon name="heroicons:clipboard-document-list" class="w-6 h-6 text-green-600" />
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium text-gray-900">追蹤管理</h3>
            <p class="text-sm text-gray-500">客戶追蹤和進度管理</p>
          </div>
        </div>
      </NuxtLink>

      <!-- 追蹤記錄 -->
      <NuxtLink
        to="/sales/tracking-records"
        class="block p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow"
      >
        <div class="flex items-center">
          <div class="p-3 bg-purple-100 rounded-lg">
            <Icon name="heroicons:document-text" class="w-6 h-6 text-purple-600" />
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium text-gray-900">追蹤記錄</h3>
            <p class="text-sm text-gray-500">查看和管理追蹤記錄</p>
          </div>
        </div>
      </NuxtLink>

      <!-- 聯繫行事曆 -->
      <NuxtLink
        to="/sales/contact-calendar"
        class="block p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow"
      >
        <div class="flex items-center">
          <div class="p-3 bg-orange-100 rounded-lg">
            <Icon name="heroicons:calendar-days" class="w-6 h-6 text-orange-600" />
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium text-gray-900">聯繫行事曆</h3>
            <p class="text-sm text-gray-500">管理客戶聯繫時間安排</p>
          </div>
        </div>
      </NuxtLink>

      <!-- 業務統計 -->
      <NuxtLink
        to="/sales/statistics"
        class="block p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow"
      >
        <div class="flex items-center">
          <div class="p-3 bg-red-100 rounded-lg">
            <Icon name="heroicons:chart-bar" class="w-6 h-6 text-red-600" />
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium text-gray-900">業務統計</h3>
            <p class="text-sm text-gray-500">查看業務績效和統計數據</p>
          </div>
        </div>
      </NuxtLink>

      <!-- 業務報表 -->
      <NuxtLink
        to="/sales/reports"
        class="block p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow"
      >
        <div class="flex items-center">
          <div class="p-3 bg-indigo-100 rounded-lg">
            <Icon name="heroicons:document-chart-bar" class="w-6 h-6 text-indigo-600" />
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium text-gray-900">業務報表</h3>
            <p class="text-sm text-gray-500">生成和查看各類業務報表</p>
          </div>
        </div>
      </NuxtLink>
    </div>
  </div>
</template>

<script setup>
definePageMeta({
  layout: 'default'
})
</script>