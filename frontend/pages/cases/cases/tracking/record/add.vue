<template>
  <div class="space-y-6">
    <!-- 頁面標題 -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">新增追蹤紀錄</h1>
        <p class="text-gray-600 mt-2">記錄客戶追蹤歷程與業務互動詳情</p>
      </div>
      <button
        @click="$router.go(-1)"
        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
      >
        <ArrowLeftIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
        返回
      </button>
    </div>

    <!-- 表單區域 -->
    <div class="bg-white shadow rounded-lg">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">追蹤紀錄資訊</h3>
        <p class="mt-1 text-sm text-gray-500">請填寫完整的客戶追蹤紀錄資料</p>
      </div>

      <form @submit.prevent="saveRecord" class="p-6 space-y-6">
        <!-- 基本資訊區塊 -->
        <div class="bg-blue-50 p-4 rounded-lg">
          <h4 class="text-md font-semibold text-gray-800 mb-4">基本資訊</h4>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- 記錄人員 -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                記錄人員 <span class="text-red-500">*</span>
              </label>
              <select
                v-model="form.tracking_person_id"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="">請選擇記錄人員</option>
                <option v-for="user in users" :key="user.id" :value="user.id">
                  {{ user.name }}
                </option>
              </select>
            </div>

            <!-- 聯繫時間 -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                聯繫時間 <span class="text-red-500">*</span>
              </label>
              <input
                v-model="form.contact_time"
                type="datetime-local"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              />
            </div>

            <!-- 聯絡方式 -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                聯絡方式 <span class="text-red-500">*</span>
              </label>
              <select
                v-model="form.contact_method"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="">請選擇聯絡方式</option>
                <option value="電話">電話</option>
                <option value="LINE">LINE</option>
                <option value="面談">面談</option>
                <option value="郵件">郵件</option>
                <option value="系統紀錄">系統紀錄</option>
                <option value="其他">其他</option>
              </select>
            </div>
          </div>
        </div>

        <!-- 案件資訊區塊 -->
        <div class="bg-green-50 p-4 rounded-lg">
          <h4 class="text-md font-semibold text-gray-800 mb-4">案件資訊</h4>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- 服務階段 -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                服務階段 <span class="text-red-500">*</span>
              </label>
              <select
                v-model="form.service_stage"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="">請選擇服務階段</option>
                <option value="初次接觸">初次接觸</option>
                <option value="需求確認">需求確認</option>
                <option value="資料收集">資料收集</option>
                <option value="方案評估">方案評估</option>
                <option value="申請提交">申請提交</option>
                <option value="審核追蹤">審核追蹤</option>
                <option value="結果確認">結果確認</option>
                <option value="後續服務">後續服務</option>
              </select>
            </div>

            <!-- 商機單 -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                商機單
              </label>
              <input
                v-model="form.opportunity_order"
                type="text"
                placeholder="請輸入商機單號"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              />
            </div>

            <!-- 商機狀態 -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                商機狀態 <span class="text-red-500">*</span>
              </label>
              <select
                v-model="form.opportunity_status"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="">請選擇商機狀態</option>
                <option value="有興趣">有興趣</option>
                <option value="需考慮">需考慮</option>
                <option value="暫無需求">暫無需求</option>
                <option value="拒絕">拒絕</option>
                <option value="轉介">轉介</option>
              </select>
            </div>
          </div>
        </div>

        <!-- 追蹤詳情區塊 -->
        <div class="bg-yellow-50 p-4 rounded-lg">
          <h4 class="text-md font-semibold text-gray-800 mb-4">追蹤詳情</h4>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- 聯繫時長 -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                聯繫時長（分鐘）
              </label>
              <input
                v-model.number="form.contact_duration"
                type="number"
                min="0"
                placeholder="請輸入聯繫時長"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              />
            </div>

            <!-- 優先級別 -->
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                優先級別
              </label>
              <select
                v-model="form.priority"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="中">中</option>
                <option value="高">高</option>
                <option value="低">低</option>
              </select>
            </div>

            <!-- 下次追蹤日期 -->
            <div class="md:col-span-2">
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                下次追蹤日期
              </label>
              <input
                v-model="form.follow_up_date"
                type="date"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              />
            </div>
          </div>
        </div>

        <!-- 維護進度 -->
        <div class="bg-purple-50 p-4 rounded-lg">
          <h4 class="text-md font-semibold text-gray-800 mb-4">維護進度</h4>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">
              維護進度 <span class="text-red-500">*</span>
            </label>
            <textarea
              v-model="form.maintenance_progress"
              required
              rows="3"
              placeholder="請詳細描述當前的維護進度和處理情況..."
              class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            ></textarea>
          </div>
        </div>

        <!-- 對話紀錄 -->
        <div class="bg-red-50 p-4 rounded-lg">
          <h4 class="text-md font-semibold text-gray-800 mb-4">對話紀錄</h4>
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                對話紀錄 <span class="text-red-500">*</span>
              </label>
              <textarea
                v-model="form.conversation_record"
                required
                rows="4"
                placeholder="請記錄與客戶的詳細對話內容..."
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              ></textarea>
            </div>

            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                客戶回應
              </label>
              <textarea
                v-model="form.customer_response"
                rows="3"
                placeholder="請記錄客戶的具體回應和反饋..."
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              ></textarea>
            </div>

            <div>
              <label class="block text-sm font-semibold text-gray-900 mb-1">
                詳細備註
              </label>
              <textarea
                v-model="form.notes"
                rows="2"
                placeholder="其他需要記錄的重要資訊..."
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              ></textarea>
            </div>
          </div>
        </div>

        <!-- 表單提交按鈕 -->
        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
          <button
            type="button"
            @click="$router.go(-1)"
            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            取消
          </button>
          <button
            type="submit"
            :disabled="saving"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {{ saving ? '儲存中...' : '儲存追蹤紀錄' }}
          </button>
        </div>
      </form>
    </div>

    <!-- 成功提示彈窗 -->
    <div v-if="showSuccessModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" @click.self="closeSuccessModal">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex items-center mb-4">
          <CheckCircleIcon class="h-6 w-6 text-green-600 mr-3" />
          <h3 class="text-lg font-semibold text-gray-900">追蹤紀錄新增成功</h3>
        </div>
        <p class="text-gray-600 mb-6">追蹤紀錄已成功儲存到系統中</p>
        <div class="flex justify-end space-x-3">
          <button
            @click="closeSuccessModal"
            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
          >
            返回列表
          </button>
          <button
            @click="createAnother"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
          >
            新增另一筆
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ArrowLeftIcon, CheckCircleIcon } from '@heroicons/vue/24/outline'

definePageMeta({ middleware: 'auth' })

const authStore = useAuthStore()
const { success, error: showError } = useNotification()
const { getUsers } = useUsers()
const { post: apiPost } = useApi()

// 載入狀態
const saving = ref(false)
const showSuccessModal = ref(false)

// 使用者列表
const users = ref([])

// 表單數據 - 基於追蹤紀錄規則的核心欄位
const form = reactive({
  // 必填欄位
  tracking_person_id: null,        // 記錄人員
  contact_time: '',                // 聯繫時間
  service_stage: '',              // 服務階段
  opportunity_order: '',          // 商機單
  maintenance_progress: '',       // 維護進度
  opportunity_status: '',         // 商機狀態
  contact_method: '',             // 聯絡方式
  conversation_record: '',        // 對話紀錄

  // 選填欄位
  contact_duration: null,         // 聯繫時長
  customer_response: '',          // 客戶回應
  notes: '',                     // 詳細備註
  priority: '中',                // 優先級別
  follow_up_date: ''             // 下次追蹤日期
})

// 載入使用者列表
const loadUsers = async () => {
  try {
    const { success: ok, users: list } = await getUsers({ per_page: 250 })
    if (ok && Array.isArray(list)) {
      users.value = list
    }
  } catch (e) {
    console.warn('Load users failed:', e)
  }
}

// 儲存追蹤紀錄
const saveRecord = async () => {
  saving.value = true

  try {
    // 驗證必填欄位
    if (!form.tracking_person_id || !form.contact_time || !form.service_stage ||
        !form.opportunity_status || !form.contact_method || !form.maintenance_progress ||
        !form.conversation_record) {
      showError('請填寫所有必填欄位')
      return
    }

    // 準備提交數據
    const payload = {
      tracking_person_id: form.tracking_person_id,
      contact_time: form.contact_time,
      service_stage: form.service_stage,
      opportunity_order: form.opportunity_order || null,
      maintenance_progress: form.maintenance_progress,
      opportunity_status: form.opportunity_status,
      contact_method: form.contact_method,
      conversation_record: form.conversation_record,
      contact_duration: form.contact_duration || null,
      customer_response: form.customer_response || null,
      notes: form.notes || null,
      priority: form.priority || '中',
      follow_up_date: form.follow_up_date || null
    }

    // API 呼叫（這裡需要根據實際後端 API 調整）
    const { data, error } = await apiPost('/tracking-records', payload)

    if (error) {
      showError(error.message || '儲存失敗，請稍後再試')
      return
    }

    // 顯示成功訊息
    showSuccessModal.value = true

  } catch (err) {
    showError('系統錯誤，請稍後再試')
    console.error('Save tracking record error:', err)
  } finally {
    saving.value = false
  }
}

// 關閉成功彈窗並返回列表
const closeSuccessModal = () => {
  showSuccessModal.value = false
  navigateTo('/sales/tracking-records')
}

// 新增另一筆紀錄
const createAnother = () => {
  showSuccessModal.value = false

  // 重置表單，保留記錄人員資訊
  const currentUser = form.tracking_person_id
  Object.assign(form, {
    tracking_person_id: currentUser,
    contact_time: '',
    service_stage: '',
    opportunity_order: '',
    maintenance_progress: '',
    opportunity_status: '',
    contact_method: '',
    conversation_record: '',
    contact_duration: null,
    customer_response: '',
    notes: '',
    priority: '中',
    follow_up_date: ''
  })
}

// 頁面載入時初始化數據
onMounted(async () => {
  await loadUsers()

  // 設定預設聯繫時間為當前時間
  const now = new Date()
  const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000)
    .toISOString()
    .slice(0, 16)
  form.contact_time = localDateTime

  // 如果已登入，預設選擇當前使用者為記錄人員
  if (authStore.user?.id) {
    form.tracking_person_id = authStore.user.id
  }
})

// 設定頁面標題
useHead({
  title: '新增追蹤紀錄 - 貸款案件管理系統'
})
</script>