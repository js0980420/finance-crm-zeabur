<template>
  <div class="space-y-6">
    <!-- 頁面標題 -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">核准撥款</h1>
        <p class="text-gray-600 mt-2">已核准並完成撥款的案件</p>
      </div>
    </div>

    <!-- 進線列表 -->
    <DataTable
      title="網路進線列表"
      :columns="leadTableColumns"
      :data="filteredLeads"
      :loading="loading"
      :error="loadError"
      :search-query="searchQuery"
      search-placeholder="搜尋姓名/手機/Email/LINE/網站... (至少2個字符)"
      :show-search-icon="false"
      :current-page="currentPage"
      :items-per-page="itemsPerPage"
      loading-text="載入中..."
      empty-text="沒有網路進線案件"
      @search="handleSearch"
      @refresh="loadLeads"
      @retry="loadLeads"
      @page-change="handlePageChange"
      @page-size-change="handlePageSizeChange"
    >
      <!-- Filter Controls -->
      <template #filters>
        <select
          v-if="authStore.hasPermission && authStore.hasPermission('customer_management')"
          v-model="selectedAssignee"
          class="px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        >
          <option value="all">全部承辦</option>
          <option value="null">未指派</option>
          <option v-for="u in users" :key="u.id" :value="u.id">{{ u.name }}</option>
        </select>
      </template>

      <!-- Action Buttons -->
      <template #actions>
        <!-- 可以在這裡添加新增案件等按鈕 -->
      </template>

      <!-- Case Status Cell -->
      <template #cell-case_status="{ item }">
        <select
          :value="item.case_status || 'pending'"
          @change="updateLeadStatus(item, $event.target.value)"
          class="w-full px-1 py-0.5 text-xs border border-gray-300 rounded bg-white text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
        >
          <option v-for="option in CASE_STATUS_NAVIGATION_OPTIONS" :key="option.value" :value="option.value">
            {{ option.label }}
          </option>
        </select>
      </template>

      <!-- Case Number Cell -->
      <template #cell-case_number="{ item }">
        <div class="text-sm font-medium text-gray-900">
          {{ generateCaseNumber(item) }}
        </div>
      </template>

      <!-- Website Cell -->
      <template #cell-website="{ item }">
        <select
          :value="getWebsiteInfo(item.payload?.['頁面_URL'] || item.source).name"
          @change="updateWebsite(item, $event.target.value)"
          class="w-full px-1 py-0.5 text-xs border border-gray-300 rounded bg-white text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
        >
          <option v-for="option in WEBSITE_OPTIONS" :key="option" :value="option">
            {{ option }}
          </option>
        </select>
      </template>

      <!-- Channel Cell -->
      <template #cell-channel="{ item }">
        <select
          :value="item.channel"
          @change="updateChannel(item.id, $event.target.value)"
          class="w-full px-2 py-1 text-sm border border-gray-300 rounded bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        >
          <option value="wp_form">網站表單</option>
          <option value="lineoa">官方LINE</option>
          <option value="email">email</option>
          <option value="phone">專線</option>
        </select>
      </template>

      <!-- DateTime Cell -->
      <template #cell-datetime="{ item }">
        <div>
          <div class="text-sm text-gray-900">{{ formatDate(item.created_at) }}</div>
          <div class="text-xs text-gray-500">{{ formatTime(item.created_at) }}</div>
        </div>
      </template>

      <!-- Assignee Cell -->
      <template #cell-assignee="{ item }">
        <div class="flex items-center space-x-2">
          <span class="text-sm text-gray-900">{{ item.assignee?.name || '未指派' }}</span>
          <button
            v-if="!item.assignee && authStore.hasPermission && authStore.hasPermission('customer_management')"
            @click="openAssignModal(item)"
            class="inline-flex items-center justify-center w-6 h-6 text-blue-600 hover:text-white hover:bg-blue-600 rounded transition-colors duration-200 relative group"
            title="指派業務"
          >
            <Icon name="heroicons:user-plus" class="w-4 h-4" />
            <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
              指派業務
            </span>
          </button>
        </div>
      </template>

      <!-- Contact Info Cell -->
      <template #cell-contact_info="{ item }">
        <div>
          <div class="text-sm text-gray-900">{{ item.email || '未提供' }}</div>
          <div class="text-xs text-gray-500">{{ item.phone || '未提供' }}</div>
        </div>
      </template>

      <!-- LINE Info Cell -->
      <template #cell-line_info="{ item }">
        <div v-if="item.line_user_info && item.is_line_user_id" class="flex items-center space-x-2">
          <!-- LINE 頭像 -->
          <img
            v-if="item.line_user_info.picture_url"
            :src="item.line_user_info.picture_url"
            :alt="item.line_user_info.display_name || 'LINE用戶'"
            class="w-6 h-6 rounded-full object-cover"
            @error="$event.target.style.display='none'"
          />
          <div v-else class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center text-white text-xs">
            L
          </div>
          <!-- LINE 名稱 -->
          <div class="flex-1 min-w-0">
            <div class="flex items-center space-x-1">
              <span class="text-xs font-medium text-gray-900 truncate">
                {{ item.line_user_info.display_name || '未設定名稱' }}
              </span>
              <button
                @click="openLineNameModal(item)"
                class="text-blue-500 hover:text-blue-700 text-xs"
                title="編輯LINE名稱"
              >
                ✏️
              </button>
            </div>
          </div>
        </div>
        <div v-else-if="item.line_id && !item.is_line_user_id" class="flex items-center space-x-2">
          <div class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center text-white text-xs">
            @
          </div>
          <span class="text-xs text-gray-900">{{ item.line_id }}</span>
        </div>
        <div v-else class="text-xs text-gray-400">
          未綁定
        </div>
      </template>

      <!-- Location Cell -->
      <template #cell-location="{ item }">
        <div>
          <div class="text-sm text-gray-900">
            {{ item.payload?.['房屋區域'] || item.payload?.['所在地區'] || '未提供' }}
          </div>
          <div class="text-xs text-gray-500 truncate max-w-[120px]">
            {{ item.payload?.['房屋地址'] || '' }}
          </div>
        </div>
      </template>

      <!-- Amount Cell -->
      <template #cell-amount="{ item }">
        <span class="text-sm text-gray-900">
          {{ item.payload?.['資金需求'] || '未填寫' }}
        </span>
      </template>

      <!-- Purpose Cell -->
      <template #cell-purpose="{ item }">
        <select
          :value="item.payload?.['貸款需求'] || ''"
          @change="updatePurpose(item.id, $event.target.value)"
          class="w-full px-2 py-1 text-sm border border-gray-300 rounded bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        >
          <option value="">請選擇</option>
          <option value="房屋貸款">房屋貸款</option>
          <option value="土地貸款">土地貸款</option>
          <option value="企業貸款">企業貸款</option>
          <option value="個人信貸">個人信貸</option>
          <option value="汽車貸款">汽車貸款</option>
          <option value="其他">其他</option>
        </select>
      </template>

      <!-- Custom Fields Cell -->
      <template #cell-custom_fields="{ item }">
        <div v-if="visibleCaseFields.length > 0" class="space-y-1">
          <div v-for="cf in visibleCaseFields.slice(0, 2)" :key="cf.id" class="text-xs">
            <span class="text-gray-500">{{ cf.label }}:</span>
            <span class="text-gray-900 ml-1">
              {{ formatCustomFieldValue(item.payload?.[cf.key], cf) }}
            </span>
          </div>
          <div v-if="visibleCaseFields.length > 2" class="text-xs text-gray-400">
            +{{ visibleCaseFields.length - 2 }} 個欄位
          </div>
        </div>
        <span v-else class="text-xs text-gray-400">無自定義欄位</span>
      </template>

      <!-- Actions Cell -->
      <template #cell-actions="{ item }">
        <div class="flex items-center space-x-2 justify-end">
          <!-- 查看 -->
          <button
            @click="viewLead(item)"
            class="group relative inline-flex items-center justify-center p-2 text-blue-600 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200"
            title="查看詳情"
          >
            <EyeIcon class="w-4 h-4" />
            <!-- Tooltip -->
            <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
              查看詳情
            </div>
          </button>

          <!-- 編輯 -->
          <button
            @click="onEdit(item)"
            class="group relative inline-flex items-center justify-center p-2 text-gray-600 hover:text-white hover:bg-gray-600 rounded-lg transition-all duration-200"
            title="編輯"
          >
            <PencilIcon class="w-4 h-4" />
            <!-- Tooltip -->
            <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
              編輯
            </div>
          </button>

          <!-- 轉送件 -->
          <button
            v-if="item.customer_id"
            @click="openConvert(item)"
            class="group relative inline-flex items-center justify-center p-2 text-purple-600 hover:text-white hover:bg-purple-600 rounded-lg transition-all duration-200"
            title="轉送件"
          >
            <ArrowRightIcon class="w-4 h-4" />
            <!-- Tooltip -->
            <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
              轉送件
            </div>
          </button>

          <!-- 刪除 -->
          <button
            @click="onDelete(item)"
            class="group relative inline-flex items-center justify-center p-2 text-red-600 hover:text-white hover:bg-red-600 rounded-lg transition-all duration-200"
            title="刪除"
          >
            <TrashIcon class="w-4 h-4" />
            <!-- Tooltip -->
            <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
              刪除
            </div>
          </button>
        </div>
      </template>
    </DataTable>

    <!-- Edit Modal -->
    <div v-if="editOpen" class="fixed inset-0 bg-black/50 z-50" @click.self="closeEdit">
      <div class="bg-white h-full w-full overflow-hidden flex flex-col">
        <!-- 標題欄 -->
        <div class="flex items-center justify-between p-6 border-b bg-gray-50">
          <h3 class="text-xl font-semibold text-gray-900">編輯進線</h3>
          <button type="button" @click="closeEdit" class="text-gray-400 hover:text-gray-600">
            <XMarkIcon class="w-6 h-6" />
          </button>
        </div>

        <!-- 主要內容區域 - 6區塊水平布局 -->
        <div class="flex-1 overflow-hidden">
          <form @submit.prevent="saveEdit" class="h-full flex">

            <!-- 第1區塊：基本資訊（顯示欄位）-->
            <div class="flex-1 border-r overflow-y-auto p-6 bg-blue-50">
              <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-blue-50 py-2">基本資訊</h4>
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
                    <option value="wp_form">網站表單</option>
                    <option value="lineoa">官方LINE</option>
                    <option value="email">email</option>
                    <option value="phone">專線</option>
                  </select>
                </div>

                <!-- 5. 姓名 -->
                <div>
                  <label class="block text-sm font-semibold text-gray-900 mb-1">姓名</label>
                  <input v-model="form.customer_name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" readonly />
                </div>

                <!-- 6. LINE資訊 -->
                <div>
                  <label class="block text-sm font-semibold text-gray-900 mb-1">LINE資訊</label>
                  <div class="space-y-2">
                    <input v-model="form.line_display_name" placeholder="LINE顯示名稱" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" readonly />
                    <input v-model="form.line_id" placeholder="LINE加好友ID" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" readonly />
                  </div>
                </div>

                <!-- 7. 諮詢項目 -->
                <div>
                  <label class="block text-sm font-semibold text-gray-900 mb-1">諮詢項目</label>
                  <input v-model="form.loan_purpose" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" readonly />
                </div>

                <!-- 8. 網站 -->
                <div>
                  <label class="block text-sm font-semibold text-gray-900 mb-1">網站</label>
                  <select v-model="form.website" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option v-for="i in 10" :key="i" :value="`G${i}`">G{{ i }}</option>
                  </select>
                </div>

                <!-- 9. 聯絡資訊 -->
                <div>
                  <label class="block text-sm font-semibold text-gray-900 mb-1">聯絡資訊</label>
                  <div class="space-y-2">
                    <input v-model="form.email" type="email" placeholder="Email" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" readonly />
                    <input v-model="form.phone" type="tel" placeholder="手機號碼" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" readonly />
                  </div>
                </div>
              </div>
            </div>

            <!-- 第2區塊：個人資料 -->
            <div class="flex-1 border-r overflow-y-auto p-6 bg-green-50">
              <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-green-50 py-2">{{ HIDDEN_FIELDS_CONFIG.personal.title }}</h4>
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
            <div class="flex-1 border-r overflow-y-auto p-6 bg-yellow-50">
              <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-yellow-50 py-2">{{ HIDDEN_FIELDS_CONFIG.contact.title }}</h4>
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
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:focus:border-blue-500"
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
            <div class="flex-1 border-r overflow-y-auto p-6 bg-purple-50">
              <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-purple-50 py-2">{{ HIDDEN_FIELDS_CONFIG.company.title }}</h4>
              <div class="space-y-4">
                <div v-for="field in HIDDEN_FIELDS_CONFIG.company.fields" :key="field.key">
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

                  <!-- 布林值 -->
                  <label v-else-if="field.type === 'boolean'" class="inline-flex items-center space-x-2 mt-2">
                    <input type="checkbox" v-model="form[field.key]" class="rounded" />
                    <span class="text-sm">是</span>
                  </label>
                </div>
              </div>
            </div>

            <!-- 第5區塊：緊急聯絡人 -->
            <div class="flex-1 border-r overflow-y-auto p-6 bg-red-50">
              <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-red-50 py-2">{{ HIDDEN_FIELDS_CONFIG.emergency.title }}</h4>
              <div class="space-y-4">
                <div v-for="field in HIDDEN_FIELDS_CONFIG.emergency.fields" :key="field.key">
                  <label class="block text-sm font-semibold text-gray-900 mb-1">
                    {{ field.label }}
                    <span v-if="field.required" class="text-red-500">*</span>
                  </label>

                  <!-- 文字輸入 -->
                  <input
                    v-if="field.type === 'text'"
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
            <div class="flex-1 overflow-y-auto p-6 bg-gray-50">
              <h4 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gray-50 py-2">{{ HIDDEN_FIELDS_CONFIG.other.title }}</h4>
              <div class="space-y-4">
                <div v-for="field in HIDDEN_FIELDS_CONFIG.other.fields.filter(f => f.type !== 'custom')" :key="field.key">
                  <label class="block text-sm font-semibold text-gray-900 mb-1">
                    {{ field.label }}
                    <span v-if="field.required" class="text-red-500">*</span>
                  </label>

                  <!-- 文字輸入 -->
                  <input
                    v-if="field.type === 'text'"
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
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:focus:border-blue-500"
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
                <div class="border-t pt-4 flex justify-end space-x-3">
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
              <p class="text-gray-900">{{ getWebsiteInfo(selectedLead.payload?.['頁面_URL'] || selectedLead.source).name }}</p>
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
  PlusIcon
} from '@heroicons/vue/24/outline'

// 明確匯入組件
import StatsCard from '~/components/StatsCard.vue'
import DataTable from '~/components/DataTable.vue'
import { formatters } from '~/utils/tableColumns'
import { useMockDataStore } from '~/stores/mockData'
import { useCases } from '~/composables/useCases'

definePageMeta({ middleware: 'auth' })

// ===========================================
// 欄位配置區域 - 統一管理所有欄位排序與結構
// ===========================================

// 主要顯示欄位 (由左至右排序) - 根據內容長度優化寬度
const MAIN_TABLE_COLUMNS = [
  { key: 'case_status', title: '進線狀態', sortable: true, width: '90px' }, // 最多4個字 "核准撥款"
  { key: 'datetime', title: '時間', sortable: true, width: '140px' },
  { key: 'assignee', title: '承辦業務', sortable: true, width: '80px' }, // 業務名稱通常2-4字
  { key: 'channel', title: '來源管道', sortable: true, width: '80px' }, // "網站表單" 4字
  { key: 'customer_name', title: '姓名', sortable: true, width: '80px' }, // 中文姓名2-4字
  { key: 'line_info', title: 'LINE資訊', sortable: false, width: '160px' },
  { key: 'purpose', title: '諮詢項目', sortable: false, width: '100px' }, // "房屋貸款" 4字
  { key: 'website', title: '網站', sortable: false, width: '50px' }, // 最寬是 "G10" 3字元
  { key: 'contact_info', title: '聯絡資訊', sortable: false, width: '160px' },
  { key: 'actions', title: '操作', sortable: false, width: '160px' }
]

// 隱藏欄位結構 - 編輯時顯示的詳細資料 (這些應該是案件的，但這裡只顯示進線相關的)
const HIDDEN_FIELDS_CONFIG = {
  // 個人資料
  personal: {
    title: '個人資料',
    fields: [
      { key: 'birth_date', label: '出生年月日', type: 'date' },
      { key: 'id_number', label: '身份證字號', type: 'text' },
      { key: 'education', label: '最高學歷', type: 'select', options: ['國小', '國中', '高中職', '專科', '大學', '碩士', '博士'] }
    ]
  },
  // 聯絡資訊
  contact: {
    title: '聯絡資訊',
    fields: [
      { key: 'region', label: '所在地區', type: 'text' },
      { key: 'registered_address', label: '戶籍地址', type: 'text' },
      { key: 'home_phone', label: '室內電話', type: 'text' },
      { key: 'address_same', label: '通訊地址是否同戶籍地', type: 'boolean' },
      { key: 'mailing_address', label: '通訊地址', type: 'text' },
      { key: 'mobile_phone', label: '通訊電話', type: 'text' },
      { key: 'residence_duration', label: '現居地住多久', type: 'text' },
      { key: 'residence_owner', label: '居住地持有人', type: 'text' },
      { key: 'telecom_provider', label: '電信業者', type: 'select', options: ['中華電信', '台灣大哥大', '遠傳電信', '台灣之星', '亞太電信'] }
    ]
  },
  other: {
    title: '其他資訊',
    fields: [
      { key: 'case_number', label: '進線編號', type: 'text', readonly: true },
      { key: 'required_amount', label: '需求金額', type: 'number' },
      { key: 'custom_fields', label: '自定義欄位', type: 'custom' }
    ]
  },
  // 公司資料
  company: {
    title: '公司資料',
    fields: [
      { key: 'company_email', label: '電子郵件', type: 'email' },
      { key: 'company_name', label: '公司名稱', type: 'text' },
      { key: 'company_phone', label: '公司電話', type: 'text' },
      { key: 'company_address', label: '公司地址', type: 'text' },
      { key: 'job_title', label: '職稱', type: 'text' },
      { key: 'monthly_income', label: '月收入', type: 'number' },
      { key: 'new_labor_insurance', label: '有無新轉勞保', type: 'boolean' },
      { key: 'employment_duration', label: '目前公司在職多久', type: 'text' }
    ]
  },
  // 緊急聯絡人
  emergency: {
    title: '緊急聯絡人',
    fields: [
      { key: 'contact1_name', label: '聯絡人①姓名', type: 'text' },
      { key: 'contact1_relationship', label: '聯絡人①關係', type: 'text' },
      { key: 'contact1_phone', label: '聯絡人①電話', type: 'text' },
      { key: 'contact1_available_time', label: '方便聯絡時間', type: 'text' },
      { key: 'contact1_confidential', label: '是否保密', type: 'boolean' },
      { key: 'contact2_name', label: '聯絡人②姓名', type: 'text' },
      { key: 'contact2_relationship', label: '聯絡人②關係', type: 'text' },
      { key: 'contact2_phone', label: '聯絡人②電話', type: 'text' },
      { key: 'contact2_confidential', label: '是否保密', type: 'boolean' },
      { key: 'contact2_available_time', label: '方便聯絡時間', type: 'text' },
      { key: 'referrer', label: '介紹人', type: 'text' }
    ]
  }
}

const authStore = useAuthStore()
const { alert, success, error: showError, confirm } = useNotification()
const { list: listCases, updateOne: updateCase, removeOne: removeCase, convertToCase } = useCases()
const { getUsers } = useUsers()
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

// 模態窗口狀態
const editOpen = ref(false)
const viewOpen = ref(false)
const convertOpen = ref(false)
const assignOpen = ref(false)
const lineNameModalOpen = ref(false)
const editingId = ref(null)
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

// 選項配置
const CHANNEL_OPTIONS = [
  { value: 'wp_form', label: '網站表單' },
  { value: 'lineoa', label: '官方賴' },
  { value: 'email', label: 'Email' },
  { value: 'phone', label: '電話' }
]

// 案件狀態選項 (包含所有10種狀態及其對應路由)
const CASE_STATUS_NAVIGATION_OPTIONS = [
  { value: 'pending', label: '待處理', category: 'leads', route: '/cases' }, // 未指派 -> 待處理
  { value: 'valid_customer', label: '有效客', category: 'leads_management', route: '/cases/valid-customer' },
  { value: 'invalid_customer', label: '無效客', category: 'leads_management', route: '/cases/invalid-customer' },
  { value: 'customer_service', label: '客服', category: 'leads_management', route: '/cases/customer-service' },
  { value: 'blacklist', label: '黑名單', category: 'leads_management', route: '/cases/blacklist' },
  { value: 'approved_disbursed', label: '核准撥款', category: 'submissions', route: '/submissions/approved-disbursed' },
  { value: 'approved_undisbursed', label: '核准未撥', category: 'submissions', route: '/submissions/approved-pending' },
  { value: 'conditional_approval', label: '附條件', category: 'submissions', route: '/submissions/conditional' },
  { value: 'rejected', label: '婉拒', category: 'submissions', route: '/submissions/declined' },
  { value: 'tracking', label: '追蹤中', category: 'tracking', route: '/tracking/index' } // 追蹤管理 -> 追蹤中
]

const WEBSITE_OPTIONS = Array.from({ length: 10 }, (_, i) => `G${i + 1}`);

// 表單數據 - 包含所有欄位
const form = reactive({
  // 基本資料
  page_url: '',
  website_domain: '',
  channel: 'wp_form',
  status: 'pending',
  created_at: '',
  assigned_to: null,
  customer_name: '',
  email: null,
  line_id: '',
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

// 表格配置
const leadTableColumns = computed(() => MAIN_TABLE_COLUMNS)

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
      const mockDataStore = useMockDataStore()
      // 過濾出待處理狀態的案件
      leads.value = mockDataStore.leads.filter(lead => lead.case_status === 'pending')
      loading.value = false
      // 確保 badges 刷新
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

const onEdit = async (lead) => {
  editingId.value = lead.id

  const pageUrl = lead.payload?.['頁面_URL'] || lead.source || ''
  const websiteInfo = getWebsiteInfo(pageUrl)
  const payload = lead.payload || {}

  Object.assign(form, {
    // 基本資料
    page_url: pageUrl,
    website_domain: websiteInfo.website ? websiteInfo.domain : (pageUrl ? 'other' : ''),
    channel: lead.channel || 'wp_form',
    status: lead.status || 'pending',
    created_at: lead.created_at ? new Date(lead.created_at).toISOString().slice(0,16) : new Date().toISOString().slice(0,16),
    assigned_to: lead.assigned_to || null,
    customer_name: lead.customer_name || '',
    email: null,
    line_id: lead.line_id || payload['LINE_ID'] || '',
    loan_purpose: payload['貸款需求'] || '',
    ip_address: lead.ip_address || null,
    notes: lead.notes || payload['備註'] || '',

    // 個人資料
    birth_date: payload['出生年月日'] || '',
    id_number: payload['身份證字號'] || '',
    education: payload['最高學歷'] || '',

    // 聯絡資訊
    region: payload['房屋區域'] || payload['所在地區'] || '',
    registered_address: payload['戶籍地址'] || '',
    home_phone: payload['室內電話'] || '',
    address_same: payload['通訊地址是否同戶籍地'] || false,
    mailing_address: payload['通訊地址'] || payload['房屋地址'] || '',
    mobile_phone: payload['通訊電話'] || lead.phone || '',
    residence_duration: payload['現居地住多久'] || '',
    residence_owner: payload['居住地持有人'] || '',
    telecom_provider: payload['電信業者'] || '',

    // 其他資訊
    case_number: generateCaseNumber(lead),
    required_amount: payload['資金需求'] || null,

    // 公司資料
    company_email: payload['電子郵件'] || lead.email || '',
    company_name: payload['公司名稱'] || '',
    company_phone: payload['公司電話'] || '',
    company_address: payload['公司地址'] || '',
    job_title: payload['職稱'] || '',
    monthly_income: payload['月收入'] || null,
    new_labor_insurance: payload['有無新轉勞保'] || false,
    employment_duration: payload['目前公司在職多久'] || '',

    // 緊急聯絡人
    contact1_name: payload['聯絡人①姓名'] || '',
    contact1_relationship: payload['聯絡人①關係'] || '',
    contact1_phone: payload['聯絡人①電話'] || '',
    contact1_available_time: payload['方便聯絡時間'] || '',
    contact1_confidential: payload['是否保密'] || false,
    contact2_name: payload['聯絡人②姓名'] || '',
    contact2_relationship: payload['聯絡人②關係'] || '',
    contact2_phone: payload['聯絡人②電話'] || '',
    contact2_confidential: payload['聯絡人②是否保密'] || false,
    contact2_available_time: payload['聯絡人②方便聯絡時間'] || '',
    referrer: payload['介紹人'] || ''
  })

  // 載入自定義欄位
  await loadCaseFields()
  preloadCustomFieldsFromLead(lead)
  editOpen.value = true
}

const closeEdit = () => {
  editOpen.value = false
  editingId.value = null
}

const saveEdit = async () => {
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

    const payload = {
      channel: form.channel,
      status: form.status,
      email: form.email,
      line_id: form.line_id,
      ip_address: form.ip_address,
      assigned_to: form.assigned_to,
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
    console.error('Update lead error:', err)
  } finally {
    saving.value = false
  }
}

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
    const { error } = await updateCase(assignLead.value.id, {
      assigned_to: assignForm.assigned_to
    })

    if (!error) {
      assignOpen.value = false
      await loadLeads()
      const assignedUser = users.value.find(u => u.id === assignForm.assigned_to)
      success(`已成功指派給 ${assignedUser?.name || '未知業務'}`)
    } else {
      showError(error?.message || '指派失敗')
    }
  } catch (err) {
    showError('系統錯誤，請稍後再試')
    console.error('Assign lead error:', err)
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

// 狀態切換對應區塊路由映射
const getStatusRouteMapping = (status) => {
  const statusOption = CASE_STATUS_NAVIGATION_OPTIONS.find(opt => opt.value === status)
  return statusOption ? statusOption.route : '/' // Default to main cases page if status not found
}

// 更新進線狀態
const updateLeadStatus = async (item, newStatus) => {
  try {
    const config = useRuntimeConfig()

    // 使用 mock 模式，直接更新中央資料庫
    if (config.public.apiBaseUrl === '/mock-api' || true) { // 目前強制使用 mock 模式
      console.log('Using mock mode for updateLeadStatus', { itemId: item.id, newStatus })
      const mockDataStore = useMockDataStore()
      const updatedLead = mockDataStore.updateLeadCaseStatus(item.id, newStatus)
      console.log('Mock update result:', updatedLead)

      if (updatedLead) {
        // 從列表中移除該項目（因為狀態已改變）
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

// 工具函數
const extractDomain = (url) => {
  try { return new URL(url).hostname } catch { return url || '' }
}

// Point 51: Generate case number - CASE年份末兩碼+月日+三碼流水號
const generateCaseNumber = (item) => {
  const date = new Date(item.created_at)
  const year = date.getFullYear().toString().slice(-2) // 年份末兩碼
  const month = String(date.getMonth() + 1).padStart(2, '0') // 月份
  const day = String(date.getDate()).padStart(2, '0') // 日期
  const serial = String(item.id).padStart(3, '0') // 三碼流水號使用item.id

  return `CASE${year}${month}${day}${serial}`
}

// Point 50: Get website info from domain or URL - Enhanced matching against website management
const getWebsiteInfo = (url) => {
  if (!url) return { name: '-', domain: '', website: null }

  const domain = extractDomain(url)

  // Enhanced matching logic to find website from management system
  const website = websites.value.find(w => {
    // Exact domain match
    if (w.domain === domain) return true

    // Domain without www prefix match
    const cleanDomain = domain.replace(/^www\./, '')
    const cleanWebsiteDomain = w.domain.replace(/^www\./, '')
    if (cleanDomain === cleanWebsiteDomain) return true

    // Check if URL contains the website domain
    if (url.includes(w.domain)) return true

    // Check if domain contains the website domain (for subdomains)
    if (domain.includes(w.domain) || w.domain.includes(domain)) return true

    return false
  })

  if (website) {
    // Return website name from management system
    return {
      name: website.name, // This comes from 網站管理 "網站名稱"
      domain: website.domain,
      website: website
    }
  }

  // Fallback if no match found in website management
  return {
    name: domain || url,
    domain: domain || url,
    website: null
  }
}

// 角色標籤轉換
const getRoleLabel = (role) => {
  const roleLabels = {
    'admin': '管理員',
    'sales': '業務',
    'manager': '主管',
    'executive': '高層',
    'staff': '員工'
  }
  return roleLabels[role] || role
}

const formatDate = (d) => new Date(d).toLocaleDateString('zh-TW', { year: 'numeric', month: '2-digit', day: '2-digit' })
const formatTime = (d) => new Date(d).toLocaleTimeString('zh-TW', { hour: '2-digit', minute: '2-digit' })

const formatCustomFieldValue = (val, cf) => {
  if (cf.type === 'multiselect') return Array.isArray(val) ? val.join(', ') : (val || '-')
  if (cf.type === 'boolean') return val ? '是' : '否'
  return val ?? '-'
}

// 頁面載入
onMounted(async () => {
  await Promise.all([loadUsers(), loadLeads(), loadCaseFields(), loadWebsites(), refreshBadges()])
})

// 組件銷毀時清理
onUnmounted(() => {
  clearTimeout(searchTimer)
})

// 設定頁面標題
useHead({
  title: '網路進線管理'
})


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