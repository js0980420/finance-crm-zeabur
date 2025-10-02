<template>
    <div class="space-y-6">
      <!-- 頁面標題 -->
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl font-bold text-gray-900">{{ pageConfig.title }}</h1>
          <p class="text-gray-600 mt-2">{{ pageConfig.description }}</p>
        </div>
        <button
          @click="openAddModal"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
          <PlusIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
          {{ pageConfig.addButtonText }}
        </button>
      </div>
  
      <!-- 進線列表 -->
      <DataTable
        :title="pageConfig.tableTitle"
        :columns="leadTableColumns"
        :data="filteredLeads"
        :loading="loading"
        :error="loadError"
        :search-query="searchQuery"
        :search-placeholder="pageConfig.searchPlaceholder"
        :show-search-icon="false"
        :current-page="currentPage"
        :items-per-page="itemsPerPage"
        loading-text="載入中..."
        :empty-text="pageConfig.emptyText"
        @search="handleSearch"
        @refresh="loadLeads"
        @retry="loadLeads"
        @page-change="handlePageChange"
        @page-size-change="handlePageSizeChange"
        @cell-change="handleCellChange"
        @assign-user="openAssignModal"
        @edit-line-name="openLineNameModal"
        @view-item="viewLead"
        @edit-item="onEdit"
        @convert-item="openConvert"
        @delete-item="onDelete"
      >
        <!-- Filter Controls -->
        <template #filters>
          <select
            v-if="authStore.hasPermission && authStore.hasPermission('customer_management')"
            v-model="selectedAssignee"
            class="px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option value="all">全部承辦</option>
            <option value="null">未指派</option>
            <option v-for="u in users" :key="u.id" :value="u.id">{{ u.name }}</option>
          </select>
  
          <!-- 測試進線通知按鈕 -->
          <button
            @click="simulateNewLeadNotification"
            class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors duration-200 flex items-center space-x-2"
          >
            <BellIcon class="w-4 h-4" />
            <span>測試進線通知</span>
          </button>
        </template>
  
        <!-- Action Buttons -->
        <template #actions>
          <!-- 可以在這裡添加新增案件等按鈕 -->
        </template>
  
      </DataTable>
  
      <!-- Add Modal -->
      <div v-if="addModalOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 mt-0" @click.self="closeAddModal">
        <div class="bg-white rounded-lg p-6 w-full max-w-3xl mx-4 max-h-[90vh] overflow-y-auto">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">新增進線</h3>
          <form @submit.prevent="saveAddModal" class="grid grid-cols-1 md:grid-cols-2 gap-4">
  
            <!-- 案件狀態 (預設為pending) -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">案件狀態</label>
              <select v-model="addForm.case_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500" disabled>
                <option value="pending">待處理</option>
              </select>
            </div>
  
            <!-- 時間 (預設當下時間) -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">時間</label>
              <input v-model="addForm.created_at" type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500" readonly />
            </div>
  
            <!-- Dynamic Fields -->
            <div v-for="field in ADD_LEAD_FORM_CONFIG" :key="field.key" :class="{ 'md:col-span-2': field.type === 'textarea' }">
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                {{ field.label }}
                <span v-if="field.required" class="text-red-500">*</span>
              </label>
  
              <!-- User Select -->
              <select v-if="field.type === 'user_select'" v-model="addForm[field.key]" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">未指派</option>
                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
              </select>
  
              <!-- Website Select -->
              <select v-else-if="field.type === 'website_select'" v-model="addForm[field.key]" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">請選擇網站</option>
                <option v-for="option in WEBSITE_OPTIONS" :key="option.value" :value="option.value">{{ option.label }}</option>
              </select>
  
              <!-- Generic Select -->
              <select v-else-if="field.type === 'select'" v-model="addForm[field.key]" :required="field.required" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">請選擇</option>
                <option v-for="option in field.options" :key="option.value" :value="option.value">{{ option.label }}</option>
              </select>
  
              <!-- Textarea -->
              <textarea v-else-if="field.type === 'textarea'" v-model="addForm[field.key]" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="請描述客戶的諮詢需求..."></textarea>
  
              <!-- Other Inputs (text, email, tel) -->
              <input v-else v-model="addForm[field.key]" :type="field.type" :required="field.required" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>
  
            <!-- 按鈕 -->
            <div class="md:col-span-2 flex justify-end space-x-4 pt-4 border-t">
              <button type="button" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50" @click="closeAddModal">取消</button>
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed" :disabled="addModalSaving" @click="console.log('Button clicked')">
                {{ addModalSaving ? '新增中...' : '新增' }}
              </button>
            </div>
          </form>
        </div>
      </div>
  
      <!-- Edit Modal - 使用統一的 CaseEditModal 組件 -->
      <CaseEditModal
        :isOpen="editOpen"
        :case="editingCase"
        @close="closeEdit"
        @save="saveEdit"
      />
  
      <!-- 舊的自定義編輯視窗（已棄用，保留作為參考） -->
      <div v-if="false" class="fixed inset-0 bg-black/50 z-50" @click.self="closeEdit">
        <div class="bg-white h-full w-full overflow-hidden flex flex-col">
          <!-- 標題欄 -->
          <div class="flex items-center justify-between p-6 border-b bg-gray-100">
            <h3 class="text-xl font-semibold text-gray-900">編輯進線</h3>
            <button type="button" @click="closeEdit" class="text-gray-500 hover:text-gray-700">
              <XMarkIcon class="w-6 h-6" />
            </button>
          </div>
  
          <!-- 主要內容區域 - 6區塊水平布局 -->
          <div class="flex-1 overflow-hidden">
            <form @submit.prevent="saveEdit" class="h-full flex">
  
              <!-- 第1區塊：基本資訊（顯示欄位）-->
              <div class="flex-1 border-r overflow-y-auto p-6 bg-gray-50">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gray-50 py-2">基本資訊</h4>
                <div class="space-y-4">
                  <!-- 1. 進線狀態 -->
                  <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1">進線狀態</label>
                    <select v-model="form.case_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                      <option v-for="opt in CASE_STATUS_OPTIONS" :key="opt.value" :value="opt.value">{{ opt.label }}</option>
                    </select>
                  </div>
  
                  <!-- 2. 時間 -->
                  <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1">時間</label>
                    <input v-model="form.created_at" type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" readonly />
                  </div>
  
                  <!-- 3. 承辦業務 -->
                  <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1">承辦業務</label>
                    <select v-model="form.assigned_to" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                      <option value="">未指派</option>
                      <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                    </select>
                  </div>
  
                  <!-- 4. 來源管道 -->
                  <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1">來源管道</label>
                    <select v-model="form.channel" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                      <option v-for="opt in CHANNEL_OPTIONS" :key="opt.value" :value="opt.value">{{ opt.label }}</option>
                    </select>
                  </div>
  
                  <!-- 5. 姓名 -->
                  <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1">姓名</label>
                    <input v-model="form.customer_name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-gray-500 focus:border-gray-500" />
                  </div>
  
                  <!-- 6. LINE資訊 -->
                  <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1">LINE資訊</label>
                    <div class="space-y-2">
                      <input v-model="form.line_user_info.display_name" placeholder="LINE顯示名稱" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-gray-500 focus:border-gray-500" />
                      <input v-model="form.line_id" placeholder="LINE加好友ID" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-gray-500 focus:border-gray-500" />
                    </div>
                  </div>
  
                  <!-- 7. 諮詢項目 -->
                  <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1">諮詢項目</label>
                    <select v-model="form.loan_purpose" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-gray-500 focus:border-gray-500">
                      <option value="">請選擇諮詢項目</option>
                      <option v-for="option in PURPOSE_OPTIONS" :key="option.value" :value="option.value">{{ option.label }}</option>
                    </select>
                  </div>
  
                  <!-- 8. 網站 -->
                  <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1">網站</label>
                    <select v-model="form.website" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                      <option value="">請選擇網站</option>
                      <option v-for="option in WEBSITE_OPTIONS" :key="option.value" :value="option.value">{{ option.label }}</option>
                    </select>
                  </div>
  
                  <!-- 9. 聯絡資訊 -->
                  <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-1">聯絡資訊</label>
                    <div class="space-y-2">
                      <input v-model="form.email" type="email" placeholder="Email" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-gray-500 focus:border-gray-500" />
                      <input v-model="form.mobile_phone" type="tel" placeholder="手機號碼" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-gray-500 focus:border-gray-500" />
                    </div>
                  </div>
                </div>
              </div>
  
              <!-- 第2區塊：個人資料 -->
              <div class="flex-1 border-r overflow-y-auto p-6 bg-gray-100">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gray-100 py-2">{{ HIDDEN_FIELDS_CONFIG.personal.title }}</h4>
                <div class="space-y-4">
                  <div v-for="field in HIDDEN_FIELDS_CONFIG.personal.fields" :key="field.key">
                    <label class="block text-sm font-semibold text-gray-900 mb-1">
                      {{ field.label }}
                      <span v-if="field.required" class="text-red-500">*</span>
                    </label>
  
                    <!-- 文字輸入 -->
                    <input
                      v-if="field.type === 'text' || field.type === 'email'"
                      v-model="form[field.key]"
                      :type="field.type"
                      :readonly="field.readonly"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      :class="{ 'bg-gray-100': field.readonly }"
                    />
  
                    <!-- 數字輸入 -->
                    <input
                      v-else-if="field.type === 'number'"
                      v-model.number="form[field.key]"
                      type="number"
                      min="0"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
  
                    <!-- 日期輸入 -->
                    <input
                      v-else-if="field.type === 'date'"
                      v-model="form[field.key]"
                      type="date"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
  
                    <!-- 選擇框 -->
                    <select
                      v-else-if="field.type === 'select'"
                      v-model="form[field.key]"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                      <option value="">請選擇</option>
                      <option v-for="option in field.options" :key="option" :value="option">
                        {{ option }}
                      </option>
                    </select>
  
                    <!-- 布林值 -->
                    <label v-else-if="field.type === 'boolean'" class="inline-flex items-center space-x-2 mt-2">
                      <input type="checkbox" v-model="form[field.key]" class="rounded" />
                      <span class="text-sm">是</span>
                    </label>
  
                    <!-- 自定義欄位處理 -->
                    <div v-else-if="field.type === 'custom'" class="text-sm text-gray-500">
                      自定義欄位將顯示在下方
                    </div>
                  </div>
                </div>
              </div>
  
              <!-- 第3區塊：聯絡資訊 -->
              <div class="flex-1 border-r overflow-y-auto p-6 bg-gray-200">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gray-200 py-2">{{ HIDDEN_FIELDS_CONFIG.contact.title }}</h4>
                <div class="space-y-4">
                  <div v-for="field in HIDDEN_FIELDS_CONFIG.contact.fields" :key="field.key">
                    <label class="block text-sm font-semibold text-gray-900 mb-1">
                      {{ field.label }}
                      <span v-if="field.required" class="text-red-500">*</span>
                    </label>
  
                    <!-- 文字輸入 -->
                    <input
                      v-if="field.type === 'text' || field.type === 'email'"
                      v-model="form[field.key]"
                      :type="field.type"
                      :readonly="field.readonly"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      :class="{ 'bg-gray-100': field.readonly }"
                    />
  
                    <!-- 數字輸入 -->
                    <input
                      v-else-if="field.type === 'number'"
                      v-model.number="form[field.key]"
                      type="number"
                      min="0"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
  
                    <!-- 日期輸入 -->
                    <input
                      v-else-if="field.type === 'date'"
                      v-model="form[field.key]"
                      type="date"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
  
                    <!-- 選擇框 -->
                    <select
                      v-else-if="field.type === 'select'"
                      v-model="form[field.key]"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                      <option value="">請選擇</option>
                      <option v-for="option in field.options" :key="option" :value="option">
                        {{ option }}
                      </option>
                    </select>
  
                    <!-- 布林值 -->
                    <label v-else-if="field.type === 'boolean'" class="inline-flex items-center space-x-2 mt-2">
                      <input type="checkbox" v-model="form[field.key]" class="rounded" />
                      <span class="text-sm">是</span>
                    </label>
                  </div>
                </div>
              </div>
  
              <!-- 第4區塊：公司資料 -->
              <div class="flex-1 border-r overflow-y-auto p-6 bg-gray-50">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gray-50 py-2">{{ HIDDEN_FIELDS_CONFIG.company.title }}</h4>
                <div class="space-y-4">
                  <div v-for="field in HIDDEN_FIELDS_CONFIG.company.fields" :key="field.key">
                    <label class="block text-sm font-semibold text-gray-900 mb-1">
                      {{ field.label }}
                      <span v-if="field.required" class="text-red-500">*</span>
                    </label>
  
                    <!-- 選擇框 -->
                    <select
                      v-if="field.type === 'select'"
                      v-model="form[field.key]"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                      <option value="">請選擇</option>
                      <option v-for="option in field.options" :key="option" :value="option">
                        {{ option }}
                      </option>
                    </select>
  
                    <!-- 文字輸入 -->
                    <input
                      v-else-if="field.type === 'text' || field.type === 'email'"
                      v-model="form[field.key]"
                      :type="field.type"
                      :readonly="field.readonly"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      :class="{ 'bg-gray-100': field.readonly }"
                    />
  
                    <!-- 數字輸入 -->
                    <input
                      v-else-if="field.type === 'number'"
                      v-model.number="form[field.key]"
                      type="number"
                      min="0"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
  
                    <!-- 布林值 -->
                    <label v-else-if="field.type === 'boolean'" class="inline-flex items-center space-x-2 mt-2">
                      <input type="checkbox" v-model="form[field.key]" class="rounded" />
                      <span class="text-sm">是</span>
                    </label>
                  </div>
                </div>
              </div>
  
              <!-- 第5區塊：緊急聯絡人 -->
              <div class="flex-1 border-r overflow-y-auto p-6 bg-gray-100">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gray-100 py-2">{{ HIDDEN_FIELDS_CONFIG.emergency.title }}</h4>
                <div class="space-y-4">
                  <div v-for="field in HIDDEN_FIELDS_CONFIG.emergency.fields" :key="field.key">
                    <label class="block text-sm font-semibold text-gray-900 mb-1">
                      {{ field.label }}
                      <span v-if="field.required" class="text-red-500">*</span>
                    </label>
  
                    <!-- 選擇框 -->
                    <select
                      v-if="field.type === 'select'"
                      v-model="form[field.key]"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                      <option value="">請選擇</option>
                      <option v-for="option in field.options" :key="option" :value="option">
                        {{ option }}
                      </option>
                    </select>
  
                    <!-- 文字輸入 -->
                    <input
                      v-else-if="field.type === 'text'"
                      v-model="form[field.key]"
                      :type="field.type"
                      :readonly="field.readonly"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      :class="{ 'bg-gray-100': field.readonly }"
                    />
  
                    <!-- 布林值 -->
                    <label v-else-if="field.type === 'boolean'" class="inline-flex items-center space-x-2 mt-2">
                      <input type="checkbox" v-model="form[field.key]" class="rounded" />
                      <span class="text-sm">是</span>
                    </label>
                  </div>
                </div>
              </div>
  
              <!-- 第6區塊：其他資訊 & 自定義欄位 -->
              <div class="flex-1 overflow-y-auto p-6 bg-gray-200">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gray-200 py-2">{{ HIDDEN_FIELDS_CONFIG.other.title }}</h4>
                <div class="space-y-4">
                  <div v-for="field in HIDDEN_FIELDS_CONFIG.other.fields.filter(f => f.type !== 'custom')" :key="field.key">
                    <label class="block text-sm font-semibold text-gray-900 mb-1">
                      {{ field.label }}
                      <span v-if="field.required" class="text-red-500">*</span>
                    </label>
  
                    <!-- 選擇框 -->
                    <select
                      v-if="field.type === 'select'"
                      v-model="form[field.key]"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                      <option value="">請選擇</option>
                      <option v-for="option in field.options" :key="option" :value="option">
                        {{ option }}
                      </option>
                    </select>
  
                    <!-- 文字輸入 -->
                    <input
                      v-else-if="field.type === 'text'"
                      v-model="form[field.key]"
                      :type="field.type"
                      :readonly="field.readonly"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      :class="{ 'bg-gray-100': field.readonly }"
                    />
  
                    <!-- 數字輸入 -->
                    <input
                      v-else-if="field.type === 'number'"
                      v-model.number="form[field.key]"
                      type="number"
                      min="0"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                  </div>
  
                  <!-- 自定義欄位 -->
                  <div v-if="caseFields.length" class="border-t pt-4">
                    <h5 class="text-md font-medium text-gray-800 mb-3">自定義欄位</h5>
                    <div class="space-y-4">
                      <div v-for="cf in caseFields" :key="cf.id">
                        <label class="block text-sm font-semibold text-gray-900 mb-1">{{ cf.label }} <span v-if="cf.is_required" class="text-red-500">*</span></label>
                        <input
                          v-if="['text','number','decimal','date'].includes(cf.type)"
                          :type="cf.type === 'decimal' ? 'number' : (cf.type === 'number' ? 'number' : (cf.type === 'date' ? 'date' : 'text'))"
                          :step="cf.type === 'decimal' ? 'any' : undefined"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          :required="cf.is_required"
                          v-model="customFieldValues[cf.key]"
                        />
                        <textarea
                          v-else-if="cf.type === 'textarea'"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          :required="cf.is_required"
                          v-model="customFieldValues[cf.key]"
                          rows="2"
                        ></textarea>
                        <select
                          v-else-if="cf.type === 'select'"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          :required="cf.is_required"
                          v-model="customFieldValues[cf.key]"
                        >
                          <option value="">請選擇</option>
                          <option v-for="opt in (cf.options||[])" :key="opt" :value="opt">{{ opt }}</option>
                        </select>
                        <div v-else-if="cf.type === 'multiselect'">
                          <div class="flex flex-wrap gap-2">
                            <label v-for="opt in (cf.options||[])" :key="opt" class="inline-flex items-center text-sm">
                              <input type="checkbox" :value="opt" v-model="customFieldValues[cf.key]" class="mr-1" />
                              <span>{{ opt }}</span>
                            </label>
                          </div>
                        </div>
                        <label v-else-if="cf.type === 'boolean'" class="inline-flex items-center space-x-2 mt-2">
                          <input type="checkbox" v-model="customFieldValues[cf.key]" />
                          <span class="text-sm">是/否</span>
                        </label>
                      </div>
                    </div>
                  </div>
  
                  <!-- 備註 -->
                  <div class="border-t pt-4">
                    <label class="block text-sm font-semibold text-gray-900 mb-1">備註</label>
                    <textarea v-model="form.notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                  </div>
  
                  <!-- 操作按鈕 -->
                  <div class="border-t pt-4 flex justify-start space-x-3">
                    <button type="button" class="px-4 py-2 border border-gray-300 rounded-lg" @click="closeEdit">取消</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" :disabled="saving">{{ saving ? '儲存中...' : '儲存' }}</button>
                  </div>
                </div>
              </div>
  
            </form>
          </div>
        </div>
      </div>
  
      <!-- View Modal -->
      <div v-if="viewOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 mt-0" @click.self="closeView">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">進線詳情</h3>
            <button
              @click="closeView"
              class="text-gray-400 hover:text-gray-600"
            >
              ✕
            </button>
          </div>
  
          <div v-if="selectedLead" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">網站</label>
                <p class="text-gray-900">{{ getWebsiteName(selectedLead) }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">來源管道</label>
                <p class="text-gray-900">{{ selectedLead.channel || 'wp_form' }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">時間</label>
                <p class="text-gray-900">{{ formatDate(selectedLead.created_at) }} {{ formatTime(selectedLead.created_at) }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">承辦業務</label>
                <p class="text-gray-900">{{ selectedLead.assignee?.name || '未指派' }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="text-gray-900">{{ selectedLead.email || '未提供' }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">LINE ID</label>
                <p class="text-gray-900">{{ selectedLead.line_id || '未提供' }}</p>
              </div>
            </div>
  
            <div v-if="selectedLead.notes">
              <label class="block text-sm font-medium text-gray-700">備註</label>
              <p class="text-gray-900 whitespace-pre-wrap">{{ selectedLead.notes }}</p>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Convert Modal -->
      <div v-if="convertOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 mt-0" @click.self="closeConvert">
        <div class="bg-white rounded-lg p-6 w-full max-w-lg">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">送件（建立案件）</h3>
          <form @submit.prevent="doConvert" class="space-y-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
              <div>
                <label class="block text-sm font-semibold text-gray-900 mb-1">貸款金額</label>
                <input v-model.number="convertForm.loan_amount" required type="number" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-900 mb-1">貸款類型</label>
                <input v-model="convertForm.loan_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-900 mb-1">備註</label>
                <textarea v-model="convertForm.notes" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
              </div>
            </div>
            <div class="flex justify-end space-x-3 pt-2">
              <button type="button" class="px-4 py-2 border border-gray-300 rounded-lg" @click="closeConvert">取消</button>
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">送件</button>
            </div>
          </form>
        </div>
      </div>
  
      <!-- Assign Modal -->
      <div v-if="assignOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 mt-0" @click.self="closeAssign">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">指派承辦業務</h3>
          <form @submit.prevent="doAssign" class="space-y-4">
            <div v-if="assignLead" class="mb-4">
              <div class="text-sm text-gray-900 font-semibold mb-2">進線資訊：</div>
              <div class="bg-gray-50 p-3 rounded-lg">
                <div class="text-sm text-gray-900"><span class="font-medium">進線編號：</span>{{ generateCaseNumber(assignLead) }}</div>
                <div class="text-sm text-gray-900"><span class="font-medium">Email：</span>{{ assignLead.email || '未提供' }}</div>
                <div class="text-sm text-gray-900"><span class="font-medium">LINE ID：</span>{{ assignLead.line_id || '未提供' }}</div>
              </div>
            </div>
  
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-2">選擇承辦業務 <span class="text-red-500">*</span></label>
              <select
                v-model="assignForm.assigned_to"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="">請選擇業務人員</option>
                <option v-for="user in users.filter(u => u.roles?.[0]?.name === 'staff')" :key="user.id" :value="user.id">
                  {{ user.name || user.email }} (業務)
                </option>
              </select>
            </div>
  
            <div class="flex justify-end space-x-3 pt-4">
              <button
                type="button"
                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
                @click="closeAssign"
              >
                取消
              </button>
              <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                :disabled="saving || !assignForm.assigned_to"
              >
                {{ saving ? '指派中...' : '確認指派' }}
              </button>
            </div>
          </form>
        </div>
      </div>
  
      <!-- LINE Name Edit Modal -->
      <div v-if="lineNameModalOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 mt-0" @click.self="closeLineNameModal">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">編輯LINE名稱</h3>
          <form @submit.prevent="saveLineNameModal" class="space-y-4">
            <div v-if="lineNameLead" class="mb-4">
              <div class="text-sm text-gray-900 font-semibold mb-2">LINE使用者資訊：</div>
              <div class="bg-gray-50 p-3 rounded-lg flex items-center space-x-3">
                <img
                  v-if="lineNameLead.line_user_info?.picture_url"
                  :src="lineNameLead.line_user_info.picture_url"
                  :alt="lineNameLead.line_user_info.display_name || 'LINE用戶'"
                  class="w-10 h-10 rounded-full object-cover"
                  @error="$event.target.style.display='none'"
                />
                <div v-else class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white text-sm">
                  L
                </div>
                <div>
                  <div class="text-sm text-gray-900 font-medium">{{ lineNameLead.line_user_info?.display_name || '未設定名稱' }}</div>
                  <div class="text-xs text-gray-500">進線編號：{{ generateCaseNumber(lineNameLead) }}</div>
                </div>
              </div>
            </div>
  
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-2">LINE名稱 <span class="text-red-500">*</span></label>
              <input
                v-model="lineNameForm.display_name"
                required
                maxlength="100"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="請輸入LINE名稱"
              />
            </div>
  
            <div class="flex justify-end space-x-3 pt-4">
              <button
                type="button"
                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
                @click="closeLineNameModal"
              >
                取消
              </button>
              <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                :disabled="saving || !lineNameForm.display_name?.trim()"
              >
                {{ saving ? '儲存中...' : '儲存' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import {
    EyeIcon,
    PencilIcon,
    ArrowRightIcon,
    TrashIcon,
    DocumentTextIcon,
    PlusCircleIcon,
    CheckCircleIcon,
    ChartBarIcon,
    PlusIcon,
    BellIcon
  } from '@heroicons/vue/24/outline'
  
  // 明確匯入組件
  import StatsCard from '~/components/StatsCard.vue'
  import DataTable from '~/components/DataTable.vue'
  import CaseEditModal from '~/components/cases/CaseEditModal.vue'
  import { formatters } from '~/utils/tableColumns'
  import { useMockDataStore } from '~/stores/mockData'
  import { useNotificationsStore } from '~/stores/notifications'
  import { useCases } from '~/composables/useCases'
  import { useWebsiteInfo } from '~/composables/useWebsiteInfo'
  import { useCaseManagement } from '~/composables/useCaseManagement'
  
  definePageMeta({ middleware: 'auth' })
  
  // 引入統一的案件管理配置
  const { PAGE_CONFIGS, getPageConfig, getTableColumnsForPage, ADD_LEAD_FORM_CONFIG, CASE_STATUS_OPTIONS, CHANNEL_OPTIONS, WEBSITE_OPTIONS, PURPOSE_OPTIONS,
    addCase, // 從 useCaseManagement 引入
    generateCaseForCurrentPage, // 從 useCaseManagement 引入
    getDisplaySource, // 從 useCaseManagement 引入
    generateCaseNumber, // 從 useCaseManagement 引入
    getRoleLabel // 從 useCaseManagement 引入
  } = useCaseManagement()
  
  // 當前頁面配置 (網路進線 -> 'pending')
  const pageConfig = computed(() => getPageConfig('pending'))
  
  // 表格配置
  const leadTableColumns = computed(() => getTableColumnsForPage('pending'))
  
  // ===========================================
  // 欄位配置區域 - 統一管理所有欄位排序與結構
  // ===========================================
  
  // 由於使用 getTableColumnsForPage，不再需要 MAIN_TABLE_COLUMNS
  // const MAIN_TABLE_COLUMNS = UNIFIED_TABLE_COLUMNS.filter(col => !col.hidden && col.key !== 'business_level')
  
  const authStore = useAuthStore()
  const notificationsStore = useNotificationsStore()
  const { alert, success, error: showError, confirm } = useNotification()
  const { list: listCases, updateOne: updateCase, removeOne: removeCase, convertToCase } = useCases()
  const { getUsers } = useUsers()
  
  // 使用統一的案件管理
  // const {
  //   addCase,
  //   generateCaseForCurrentPage,
  //   getDisplaySource,
  //   generateCaseNumber,
  //   getRoleLabel
  // } = useCaseManagement()
  const { list: listCustomFields } = useCustomFields()
  const { refreshBadges } = useSidebarBadges()
  
  // Point 50: Website API integration
  const { get: apiGet } = useApi()
  
  // 搜尋和篩選
  const searchQuery = ref('')
  const selectedAssignee = ref('all')
  
  // 載入狀態
  const loading = ref(false)
  const loadError = ref(null)
  
  // 進線數據
  const leads = ref([])
  const users = ref([])
  const caseStats = ref({
    pending: 0,
    today: 0,
    thisWeek: 0,
    processingRate: 0
  })
  
  // Point 50: Website data
  const websites = ref([])
  const websiteOptions = ref([])
  
  const { getWebsiteInfo, getWebsiteName } = useWebsiteInfo(websites)
  
  // 模態窗口狀態
  const editOpen = ref(false)
  const editingCase = ref(null)
  const viewOpen = ref(false)
  const convertOpen = ref(false)
  const assignOpen = ref(false)
  const lineNameModalOpen = ref(false)
  const addModalOpen = ref(false)
  const addModalSaving = ref(false)
  const selectedLead = ref(null)
  const convertLead = ref(null)
  const assignLead = ref(null)
  const lineNameLead = ref(null)
  
  // 表單提交狀態
  const saving = ref(false)
  
  // Pagination
  const currentPage = ref(1)
  const itemsPerPage = ref(5) // Default to 5 items per page as requested
  
  const totalPages = computed(() => Math.ceil(filteredLeads.value.length / itemsPerPage.value))
  
  // 自定義欄位
  const caseFields = ref([])
  const customFieldValues = reactive({})
  
  // LINE名稱編輯相關狀態 (已改為modal方式)
  
  // 選項配置 - 使用統一的來源管道選項
  
  
  
  // 表單數據 - 包含所有欄位
  const form = reactive({
    // 基本資料
    page_url: '',
    website_domain: '',
    channel: 'wp_form',
    case_status: 'pending',
    created_at: '',
    assigned_to: null,
    customer_name: '',
    email: null,
    mobile_phone: '',
    line_id: '',
    line_user_info: {},
    loan_purpose: '',
    ip_address: null,
    notes: '',
  
    // 個人資料
    birth_date: '',
    id_number: '',
    education: '',
  
    // 聯絡資訊
    region: '',
    registered_address: '',
    home_phone: '',
    address_same: false,
    mailing_address: '',
    mobile_phone: '',
    residence_duration: '',
    residence_owner: '',
    telecom_provider: '',
  
    // 其他資訊
    case_number: '',
    required_amount: null,
  
    // 公司資料
    company_email: '',
    company_name: '',
    company_phone: '',
    company_address: '',
    job_title: '',
    monthly_income: null,
    new_labor_insurance: false,
    employment_duration: '',
  
    // 緊急聯絡人
    contact1_name: '',
    contact1_relationship: '',
    contact1_phone: '',
    contact1_available_time: '',
    contact1_confidential: false,
    contact2_name: '',
    contact2_relationship: '',
    contact2_phone: '',
    contact2_confidential: false,
    contact2_available_time: '',
    referrer: ''
  })
  
  const convertForm = reactive({
    loan_amount: null,
    loan_type: '',
    notes: ''
  })
  
  const assignForm = reactive({
    assigned_to: null
  })
  
  const lineNameForm = reactive({
    display_name: ''
  })
  
  const addForm = reactive({
    case_status: 'pending',
    created_at: '',
    assigned_to: null,
    source_channel: '',
    customer_name: '',
    line_name: '',
    line_id: '',
    consultation_items: '',
    website_domain: '',
    email: '',
    phone: ''
  })
  
  // 過濾數據
  const filteredLeads = computed(() => {
    let filtered = leads.value
  
    // 搜尋過濾
    if (searchQuery.value && searchQuery.value.length >= 2) {
      const query = searchQuery.value.toLowerCase()
      filtered = filtered.filter(lead => {
        return (
          lead.email?.toLowerCase().includes(query) ||
          lead.line_id?.toLowerCase().includes(query) ||
          lead.payload?.['頁面_URL']?.toLowerCase().includes(query) ||
          lead.source?.toLowerCase().includes(query) ||
          lead.assignee?.name?.toLowerCase().includes(query)
        )
      })
    }
  
    // 承辦業務過濾
    if (selectedAssignee.value && selectedAssignee.value !== 'all') {
      if (selectedAssignee.value === 'null') {
        filtered = filtered.filter(lead => !lead.assigned_to)
      } else {
        filtered = filtered.filter(lead => lead.assigned_to === parseInt(selectedAssignee.value))
      }
    }
  
    return filtered
  })
  
  // 自定義欄位
  const visibleCaseFields = computed(() => caseFields.value.filter(f => f.is_visible))
  
  // 載入數據 - 改為客戶端分頁實現
  const loadLeads = async () => {
    loading.value = true
    loadError.value = null
  
    try {
      const config = useRuntimeConfig()
  
      // 如果是 mock 模式，使用中央資料庫
      if (config.public.apiBaseUrl === '/mock-api') {
        console.log('loadLeads: Running in mock mode.')
        const mockDataStore = useMockDataStore()
        // 過濾出待處理狀態的案件
        const filteredLeads = mockDataStore.leads.filter(lead => {
          const status = lead.case_status || lead.status || 'pending'
          return status === 'pending'
        })
        leads.value = filteredLeads
        console.log('loadLeads: All leads in store:', mockDataStore.leads.length)
        console.log('loadLeads: Filtered pending leads:', filteredLeads.length)
        console.log('loadLeads: Filtered leads from mock store:', filteredLeads)
        loading.value = false
        // 確保 badges 刷新
        console.log('loadLeads: Refreshing badges...')
        await refreshBadges()
        return
      }
  
      // API 模式的原有邏輯
      // 首頁顯示所有待處理案件 (pending)
      const { items, meta, success: ok } = await listCases({
        case_status: 'pending',
        per_page: 1000  // 獲取大量數據以支持客戶端分頁
      })
  
      if (ok) {
        leads.value = items || []
  
        // 計算統計數據
        const total = leads.value.length
        const today = new Date()
        const todayCount = leads.value.filter(lead => {
          const leadDate = new Date(lead.created_at)
          return leadDate.toDateString() === today.toDateString()
        }).length
  
        const thisWeekCount = leads.value.filter(lead => {
          const leadDate = new Date(lead.created_at)
          const weekStart = new Date(today)
          weekStart.setDate(today.getDate() - today.getDay())
          return leadDate >= weekStart
        }).length
  
        caseStats.value = {
          pending: total,
          today: todayCount,
          thisWeek: thisWeekCount,
          processingRate: total > 0 ? Math.round((thisWeekCount / total) * 100) : 0
        }
      }
    } catch (err) {
      loadError.value = '載入進線數據失敗'
      console.error('Load leads error:', err)
    } finally {
      loading.value = false
    }
  }
  
  const loadUsers = async () => {
    try {
      const { success: ok, users: list } = await getUsers({ per_page: 250 })
      if (ok && Array.isArray(list)) users.value = list
    } catch (e) {
      console.warn('Load users failed:', e)
    }
  }
  
  const loadCaseFields = async () => {
    const { success, items } = await listCustomFields('case')
    if (success) caseFields.value = items
  }
  
  // Point 50: Load websites for dropdown options from website management system
  const loadWebsites = async () => {
    try {
      const { data, error } = await apiGet('/websites/options')
      if (!error && Array.isArray(data)) {
        websites.value = data
        websiteOptions.value = data.map(website => ({
          value: website.domain,
          label: website.name, // 網站名稱 from management system
          website: website
        }))
  
      } else {
        console.warn('Failed to load websites from management system:', error)
      }
    } catch (e) {
      console.warn('Load websites failed:', e)
    }
  }
  
  // DataTable event handlers
  const handleSearch = (query) => {
    searchQuery.value = query
    currentPage.value = 1 // Reset to first page when searching
  }
  
  const handlePageChange = (page) => {
    currentPage.value = page
  }
  
  const handlePageSizeChange = (size) => {
    itemsPerPage.value = size
    currentPage.value = 1 // Reset to first page
  }
  
  // Pagination methods
  const nextPage = () => {
    if (currentPage.value < totalPages.value) {
      currentPage.value++
    }
  }
  
  const previousPage = () => {
    if (currentPage.value > 1) {
      currentPage.value--
    }
  }
  
  const goToPage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
      currentPage.value = page
    }
  }
  
  // Generate visible page numbers for pagination
  const getVisiblePages = () => {
    const pages = []
    const maxVisible = 7
  
    if (totalPages.value <= maxVisible) {
      for (let i = 1; i <= totalPages.value; i++) {
        pages.push(i)
      }
    } else {
      if (currentPage.value <= 4) {
        for (let i = 1; i <= 5; i++) {
          pages.push(i)
        }
        pages.push('...')
        pages.push(totalPages.value)
      } else if (currentPage.value >= totalPages.value - 3) {
        pages.push(1)
        pages.push('...')
        for (let i = totalPages.value - 4; i <= totalPages.value; i++) {
          pages.push(i)
        }
      } else {
        pages.push(1)
        pages.push('...')
        for (let i = currentPage.value - 1; i <= currentPage.value + 1; i++) {
          pages.push(i)
        }
        pages.push('...')
        pages.push(totalPages.value)
      }
    }
  
    return pages;
  }
  
  // 搜尋防抖
  let searchTimer;
  watch([searchQuery, selectedAssignee], () => {
    clearTimeout(searchTimer)
    searchTimer = setTimeout(() => {
      // Reset to first page when search or filter changes
      currentPage.value = 1
      // 搜尋過濾已經在 computed 中處理
    }, 300)
  })
  
  // 客戶端分頁不需要在頁面變化時重新載入數據
  
  // 使用 DataTable 內建的分頁功能，不需要手動分頁
  
  // 模態窗口控制
  const viewLead = (lead) => {
    selectedLead.value = lead
    viewOpen.value = true
  }
  
  const closeView = () => {
    viewOpen.value = false
    selectedLead.value = null
  }
  
  // 編輯功能 - 簡化版本
  const onEdit = (lead) => {
    editingCase.value = { ...lead }
    editOpen.value = true
  }
  
  const closeEdit = () => {
    editOpen.value = false
    editingCase.value = null
  }
  
  const saveEdit = async (updatedCase) => {
    saving.value = true
    try {
      const { updateOne } = useCases()
      const { error } = await updateOne(updatedCase.id, updatedCase)
  
      if (!error) {
        editOpen.value = false
        editingCase.value = null
        await loadLeads()
        success('案件更新成功')
      } else {
        showError(error?.message || '更新失敗')
      }
    } catch (err) {
      showError('系統錯誤，請稍後再試')
      console.error('Update case error:', err)
    } finally {
      saving.value = false
    }
  }
  
  // ======================================
  // 舊的編輯邏輯已被統一的 CaseEditModal 替代
  // 保留下方代碼僅作為參考，實際上已不再使用
  // ======================================
  /*
  const oldSaveEdit = async () => {
    if (!editingId.value) return
  
    saving.value = true
    try {
      // Point 50: Handle website_domain selection
      let finalPageUrl = form.page_url
      if (form.website_domain && form.website_domain !== 'other') {
        const selectedWebsite = websites.value.find(w => w.domain === form.website_domain)
        if (selectedWebsite) {
          finalPageUrl = selectedWebsite.url
        }
      }
  
      // 處理承辦業務指派
      const assignedUser = form.assigned_to ? users.value.find(u => u.id === form.assigned_to) : null
  
      const payload = {
        channel: form.channel,
        status: form.case_status,
        email: form.email,
        mobile_phone: form.mobile_phone,
        line_id: form.line_id,
        line_user_info: form.line_user_info,
        loan_purpose: form.loan_purpose,
        ip_address: form.ip_address,
        assigned_to: form.assigned_to,
        assignee: assignedUser ? {
          id: assignedUser.id,
          name: assignedUser.name,
          email: assignedUser.email
        } : null,
        notes: form.notes,
        customer_name: form.customer_name,
        payload: {
          '頁面_URL': finalPageUrl,
          'LINE_ID': form.line_id,
          '貸款需求': form.loan_purpose,
          '備註': form.notes,
  
          // 個人資料
          '出生年月日': form.birth_date,
          '身份證字號': form.id_number,
          '最高學歷': form.education,
  
          // 聯絡資訊
          '房屋區域': form.region,
          '戶籍地址': form.registered_address,
          '室內電話': form.home_phone,
          '通訊地址是否同戶籍地': form.address_same,
          '通訊地址': form.mailing_address,
          '通訊電話': form.mobile_phone,
          '現居地住多久': form.residence_duration,
          '居住地持有人': form.residence_owner,
          '電信業者': form.telecom_provider,
  
          // 其他資訊
          '資金需求': form.required_amount,
  
          // 公司資料
          '電子郵件': form.company_email,
          '公司名稱': form.company_name,
          '公司電話': form.company_phone,
          '公司地址': form.company_address,
          '職稱': form.job_title,
          '月收入': form.monthly_income,
          '有無新轉勞保': form.new_labor_insurance,
          '目前公司在職多久': form.employment_duration,
  
          // 緊急聯絡人
          '聯絡人①姓名': form.contact1_name,
          '聯絡人①關係': form.contact1_relationship,
          '聯絡人①電話': form.contact1_phone,
          '方便聯絡時間': form.contact1_available_time,
          '是否保密': form.contact1_confidential,
          '聯絡人②姓名': form.contact2_name,
          '聯絡人②關係': form.contact2_relationship,
          '聯絡人②電話': form.contact2_phone,
          '聯絡人②是否保密': form.contact2_confidential,
          '聯絡人②方便聯絡時間': form.contact2_available_time,
          '介紹人': form.referrer,
  
          ...customFieldValues
        }
      }
  
      const { error } = await updateCase(editingId.value, payload)
  
      if (!error) {
        editOpen.value = false
        await loadLeads()
        success('進線資料更新成功')
      } else {
        showError(error?.message || '更新失敗')
      }
    } catch (err) {
      showError('系統錯誤，請稍後再試')
      console.error('Update case error:', err)
    } finally {
      saving.value = false
    }
  }
  */
  // ======================================
  
  const onDelete = async (lead) => {
    const confirmed = await confirm(`確定刪除編號 ${lead.id} 的進線嗎？`)
    if (!confirmed) return
  
    try {
      const { error } = await removeCase(lead.id)
      if (!error) {
        await loadLeads()
        success(`編號 ${lead.id} 的進線已刪除`)
      } else {
        showError(error?.message || '刪除失敗')
      }
    } catch (err) {
      showError('系統錯誤，請稍後再試')
      console.error('Delete lead error:', err)
    }
  }
  
  // 轉送件
  const openConvert = (lead) => {
    if (!lead.customer_id) {
      showError('此進線尚未綁定客戶，請先建立/綁定客戶後再送件')
      return
    }
    convertLead.value = lead
    Object.assign(convertForm, { loan_amount: null, loan_type: '', notes: '' })
    convertOpen.value = true
  }
  
  const closeConvert = () => {
    convertOpen.value = false
    convertLead.value = null
  }
  
  const doConvert = async () => {
    if (!convertLead.value) return
  
    try {
      const { error } = await convertToCase(convertLead.value.id, convertForm)
      if (!error) {
        convertOpen.value = false
        await loadLeads()
        success('進線轉換案件成功')
      } else {
        showError(error?.message || '轉換失敗')
      }
    } catch (err) {
      showError('系統錯誤，請稍後再試')
      console.error('Convert lead error:', err)
    }
  }
  
  // 指派業務
  const openAssignModal = (lead) => {
    assignLead.value = lead
    assignForm.assigned_to = lead.assigned_to || null
    assignOpen.value = true
  }
  
  const closeAssign = () => {
    assignOpen.value = false
    assignLead.value = null
    assignForm.assigned_to = null
  }
  
  const doAssign = async () => {
    if (!assignLead.value || !assignForm.assigned_to) {
      showError('請選擇承辦業務')
      return
    }
  
    saving.value = true
    try {
      const assignedUser = users.value.find(u => u.id === assignForm.assigned_to)
      const { error } = await updateCase(assignLead.value.id, {
        assigned_to: assignForm.assigned_to,
        assignee: assignedUser ? {
          id: assignedUser.id,
          name: assignedUser.name,
          email: assignedUser.email
        } : null
      })
  
      if (!error) {
        assignOpen.value = false
        await loadLeads()
        success(`已成功指派給 ${assignedUser?.name || '未知業務'}`)
      } else {
        showError(error?.message || '指派失敗')
      }
    } catch (err) {
      showError('系統錯誤，請稍後再試')
      console.error('Assign lead error:', err)
    } finally {
      saving.value = false
    }
  } 
  
  // LINE名稱編輯方法
  const openLineNameModal = (lead) => {
    lineNameLead.value = lead
    lineNameForm.display_name = lead.line_user_info?.display_name || ''
    lineNameModalOpen.value = true
  }
  
  const closeLineNameModal = () => {
    lineNameModalOpen.value = false
    lineNameLead.value = null
    lineNameForm.display_name = ''
  }
  
  const saveLineNameModal = async () => {
    if (!lineNameLead.value || !lineNameForm.display_name?.trim()) {
      showError('名稱不能為空')
      return
    }
  
    saving.value = true
    try {
      const { $api } = useNuxtApp()
  
      const { data, error } = await $api.put(`/leads/${lineNameLead.value.id}/line-name`, {
        editable_name: lineNameForm.display_name.trim()
      })
  
      if (!error && data?.success) {
        if (lineNameLead.value.line_user_info) {
          lineNameLead.value.line_user_info.display_name = lineNameForm.display_name.trim()
          lineNameLead.value.line_user_info.editable_name = lineNameForm.display_name.trim()
        }
  
        lineNameModalOpen.value = false
        await loadLeads()
        success(`LINE用戶名稱已更新：${data.old_name} → ${data.new_name}`)
      } else {
        showError(data?.message || error?.message || '更新失敗')
      }
    } catch (error) {
      showError('更新失敗，請稍後再試')
      console.error('Save LINE name error:', error)
    }
  }
  
  // 新增進線模態函數
  const openAddModal = () => {
    // 重置表單
    Object.assign(addForm, {
      case_status: 'pending',
      created_at: new Date().toISOString().slice(0, 16), // 當前時間
      assigned_to: null,
      source_channel: '',
      customer_name: '',
      line_name: '',
      line_id: '',
      consultation_items: '',
      website_domain: '',
      email: '',
      phone: ''
    })
    addModalOpen.value = true
  }
  
  const closeAddModal = () => {
    addModalOpen.value = false
  }
  
  const saveAddModal = async () => {
    console.log('saveAddModal called', { addForm })
  
    // 驗證必填欄位
    if (!addForm.customer_name?.trim()) {
      showError('客戶姓名為必填項目')
      return
    }
    if (!addForm.source_channel) {
      showError('來源管道為必填項目')
      return
    }
  
    addModalSaving.value = true
    try {
      // 準備案件資料
      const assignedUser = addForm.assigned_to ? users.value.find(u => u.id === addForm.assigned_to) : null
  
      const newCaseData = {
        customer_name: addForm.customer_name.trim(),
        email: addForm.email || null,
        phone: addForm.phone || null,
        line_id: addForm.line_id || null,
        line_user_info: addForm.line_name ? {
          display_name: addForm.line_name,
          editable_name: addForm.line_name
        } : {},
        channel: addForm.source_channel,
        loan_purpose: addForm.consultation_items || null,
        assigned_to: addForm.assigned_to || null,
        assignee: assignedUser ? {
          id: assignedUser.id,
          name: assignedUser.name,
          email: assignedUser.email
        } : null,
        case_status: 'pending',
        payload: {
          '頁面_URL': addForm.website_domain || '',
          '貸款需求': addForm.consultation_items || '',
          'LINE_ID': addForm.line_id || '',
          'LINE顯示名稱': addForm.line_name || ''
        }
      }
  
      // 使用統一的addCase方法
      const { success: ok, data: newCase } = await addCase(newCaseData)
  
      if (ok && newCase) {
        await loadLeads()
        addModalOpen.value = false
        success(`新增進線 #${newCase.id} 成功！`)
      } else {
        showError('新增失敗，請稍後再試')
      }
  
    } catch (error) {
      console.error('Save add modal error:', error)
      showError('新增失敗，請稍後再試')
    } finally {
      addModalSaving.value = false
    }
  }
  
  // 狀態切換對應區塊路由映射
  const getStatusRouteMapping = (status) => {
    const statusOption = CASE_STATUS_NAVIGATION_OPTIONS.find(opt => opt.value === status)
    return statusOption ? statusOption.route : '/' // Default to main cases page if status not found
  }
  
  // 統一的欄位變更處理器
  const handleCellChange = async ({ item, columnKey, newValue, column }) => {
    console.log('handleCellChange called:', { columnKey, newValue, item })
  
    switch (columnKey) {
      case 'case_status':
        await updateLeadStatus(item, newValue)
        break
      case 'channel':
        await updateChannel(item.id, newValue)
        break
      case 'purpose':
        await updatePurpose(item.id, newValue)
        break
      case 'website_name':
        await updateWebsite(item, newValue)
        break
      default:
        console.warn('Unhandled column change:', columnKey, newValue)
    }
  }
  
  // 更新進線狀態
  const updateLeadStatus = async (item, newStatus) => {
    try {
      const config = useRuntimeConfig()
  
      // 使用 mock 模式，直接更新中央資料庫
      if (config.public.apiBaseUrl === '/mock-api') { // 目前強制使用 mock 模式
        console.log('Using mock mode for updateLeadStatus', { itemId: item.id, newStatus })
        const mockDataStore = useMockDataStore()
        const updatedLead = mockDataStore.updateLeadCaseStatus(item.id, newStatus)
        console.log('Mock update result:', updatedLead)
  
        if (updatedLead) {
          // 重新載入列表以反映狀態變更
          await loadLeads()
  
          const statusLabel = CASE_STATUS_OPTIONS.find(opt => opt.value === newStatus)?.label
          success(`進線狀態已更新為：${statusLabel}`)
  
          // 刷新側邊欄計數
          await refreshBadges()
  
          // 如果狀態改變不是 pending (待處理)，提示用戶可以切換到對應區塊
          if (newStatus !== 'pending') {
            const targetRoute = getStatusRouteMapping(newStatus)
            if (targetRoute) {
              // 延遲顯示提示，讓用戶看到成功訊息後再提示
              setTimeout(async () => {
                const shouldNavigate = await confirm(
                  `進線已移至「${statusLabel}」區塊，是否前往查看？`,
                  '前往查看',
                  '留在此頁'
                )
                if (shouldNavigate) {
                  await navigateTo(targetRoute)
                }
              }, 1500)
            }
          }
  
          return
        } else {
          // Mock store 中找不到對應的項目
          console.error('Item not found in mock store:', item.id)
          showError('更新失敗：找不到對應的案件')
          return
        }
      }
  
      // API 模式的原有邏輯 (目前不會執行到這裡)
      const { patch } = useApi()
      const { data, error } = await patch(`/leads/${item.id}/case-status`, {
        case_status: newStatus
      })
  
      if (error) {
        showError('更新進線狀態失敗')
        return
      }
  
      // 更新本地數據並從列表移除
      const index = leads.value.findIndex(lead => lead.id === item.id)
      if (index !== -1) {
        leads.value.splice(index, 1)
      }
  
      const statusLabel = CASE_STATUS_OPTIONS.find(opt => opt.value === newStatus)?.label
      success(`進線狀態已更新為：${statusLabel}`)
  
      // 刷新側邊欄計數
      await refreshBadges()
  
      // 如果狀態改變不是 pending (待處理)，提示用戶可以切換到對應區塊
      if (newStatus !== 'pending') {
        const targetRoute = getStatusRouteMapping(newStatus)
        if (targetRoute) {
          // 延遲顯示提示，讓用戶看到成功訊息後再提示
          setTimeout(async () => {
            const shouldNavigate = await confirm(
              `進線已移至「${statusLabel}」區塊，是否前往查看？`,
              '前往查看',
              '留在此頁'
            )
            if (shouldNavigate) {
              await navigateTo(targetRoute)
            }
          }, 1500)
        }
      }
  
    } catch (error) {
      showError('更新狀態失敗，請稍後再試')
      console.error('Update lead status error:', error)
    }
  }
  
  const updateWebsite = async (item, newWebsite) => {
    try {
      const { patch } = useApi()
      const { error } = await patch(`/leads/${item.id}`, {
        payload: { ...item.payload, '頁面_URL': newWebsite }
      })
  
      if (error) {
        showError('更新網站失敗')
        return
      }
          if (!item.payload) {
        item.payload = {};
      }
      item.payload['頁面_URL'] = newWebsite
      success(`網站已更新為：${newWebsite}`)
    } catch (error) {
      showError('更新網站失敗，請稍後再試')
      console.error('Update website error:', error)
    }
  }
  
  // 自定義欄位處理
  const preloadCustomFieldsFromLead = (lead) => {
    const payload = lead?.payload || {}
    caseFields.value.forEach(cf => {
      const key = cf.key
      if (payload && Object.prototype.hasOwnProperty.call(payload, key)) {
        customFieldValues[key] = payload[key]
      } else if (cf.default_value) {
        customFieldValues[key] = cf.default_value
      } else {
        customFieldValues[key] = cf.type === 'multiselect' ? [] : (cf.type === 'boolean' ? false : '')
      }
    })
  }
  
  // 工具函數 - 已移至 useCaseManagement.js 統一管理
  
  const formatDate = (d) => new Date(d).toLocaleDateString('zh-TW', { year: 'numeric', month: '2-digit', day: '2-digit' })
  const formatTime = (d) => new Date(d).toLocaleTimeString('zh-TW', { hour: '2-digit', minute: '2-digit' })
  
  const formatCustomFieldValue = (val, cf) => {
    if (cf.type === 'multiselect') return Array.isArray(val) ? val.join(', ') : (val || '-')
    if (cf.type === 'boolean') return val ? '是' : '否'
    return val ?? '-'
  }
  
  // 頁面載入
  onMounted(async () => {
    await loadWebsites() // Ensure websites are loaded first
    await Promise.all([loadUsers(), loadLeads(), loadCaseFields(), refreshBadges()])
  })
  
  // 組件銷毀時清理
  onUnmounted(() => {
    clearTimeout(searchTimer)
  })
  
  // 設定頁面標題
  useHead({
    title: pageConfig.value.title
  })
  
  // 模擬新進線通知
  const simulateNewLeadNotification = () => {
    console.log('simulateNewLeadNotification function executed.')
    console.log('測試通知按鈕被點擊了')
    console.log('notificationsStore:', notificationsStore)
    console.log('addNotification 函數:', notificationsStore.addNotification)
  
    try {
      notificationsStore.addNotification({
        type: 'user',
        title: '網路進線有新案件',
        message: '請業務盡快與該客戶聯絡',
        priority: 'high',
        icon: 'UserPlusIcon',
        autoRemove: false
      })
      console.log('通知已添加到 store')
      success('已發送新進線通知！')
    } catch (error) {
      console.error('添加通知時發生錯誤:', error)
      showError('發送通知失敗')
    }
  }
  
  // Add mock lead function
  const addMockLead = async () => {
    const config = useRuntimeConfig()
  
    // 如果是 mock 模式，使用中央資料庫
    if (config.public.apiBaseUrl === '/mock-api') {
      const mockDataStore = useMockDataStore()
  
      const newLead = {
        customer_name: `假客戶${Date.now()}`,
        email: `mock${Date.now()}@example.com`,
        phone: `09${String(Math.floor(Math.random() * 100000000)).padStart(8, '0')}`,
        line_id: `mocklineid${Date.now()}`,
        channel: 'wp_form',
        source: `http://mock-website-${Date.now()}.com`,
        case_status: 'pending', // 預設為待處理
        assigned_to: null,
        payload: {
          '頁面_URL': `http://mock-website-${Date.now()}.com`,
          '需求金額': Math.floor(Math.random() * 1000000) + 100000,
          '房屋地址': `假地址${Math.floor(Math.random() * 999)}號`
        }
      }
  
      console.log('addMockLead: Starting to add new lead.')
      const newAddedLead = mockDataStore.addLead(newLead)
      console.log('addMockLead: New lead added to store:', newAddedLead)
      // 刷新側邊欄計數
      console.log('addMockLead: Refreshing badges...')
      await refreshBadges()
      // 強制重新載入進線數據以更新列表
      console.log('addMockLead: Calling loadLeads to refresh table...')
  
      // 重新載入
      await loadLeads()
  
      // 強制觸發響應式更新
      await nextTick()
  
      console.log('addMockLead: loadLeads completed. Current leads count:', leads.value.length)
      success(`新增假進線 #${newAddedLead.id} 成功！`)
      return
    }
  
    // 原有的邏輯保持不變（用於非 mock 模式）
    const newId = leads.value.length > 0 ? Math.max(...leads.value.map(l => l.id)) + 1 : 1;
    const newLead = {
      id: newId,
      customer_name: `假客戶${newId}`,
      email: `mock${newId}@example.com`,
      phone: `09${String(newId).padStart(8, '0')}`,
      line_id: `mocklineid${newId}`,
      channel: 'wp_form',
      source: `http://mock-website-${newId}.com`,
      case_status: 'pending', // 預設為待處理
      created_at: new Date().toISOString(),
      updated_at: new Date().toISOString(),
      assigned_to: null,
      payload: {
        '頁面_URL': `http://mock-website-${newId}.com`,
        '需求金額': Math.floor(Math.random() * 1000000) + 100000,
        '房屋地址': `假地址${newId}號`
      }
    };
    leads.value.push(newLead);
    success(`新增假進線 #${newId} 成功！`);
  };
  
  // Update channel function
  const updateChannel = async (caseId, newChannel) => {
    try {
      // Here you would make an API call to update the channel
      // For now, update the local data
      const leadIndex = leads.value.findIndex(c => c.id === caseId);
      if (leadIndex !== -1) {
        leads.value[leadIndex].channel = newChannel;
        success('來源管道更新成功');
      }
    } catch (error) {
      console.error('更新來源管道失敗:', error);
      showError('更新來源管道失敗');
    }
  };
  
  // Update purpose function
  const updatePurpose = async (caseId, newPurpose) => {
    try {
      // Here you would make an API call to update the purpose
      // For now, update the local data
      const leadIndex = leads.value.findIndex(c => c.id === caseId);
      if (leadIndex !== -1) {
        if (!leads.value[leadIndex].payload) {
          leads.value[leadIndex].payload = {};
        }
        leads.value[leadIndex].payload['貸款需求'] = newPurpose;
        success('諮詢項目更新成功');
      }
    } catch (error) {
      console.error('更新諮詢項目失敗:', error);
      showError('更新諮詢項目失敗');
    }
  };
  
  
  </script>
  
  <style scoped>
  /* Ensure tooltips appear above everything */
  .group:hover .group-hover\:block {
    z-index: 50;
  }
  </style>