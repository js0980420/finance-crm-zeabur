<template>
  <div class="space-y-6">
    <!-- 頁面標題 -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">追蹤紀錄</h1>
        <p class="text-gray-600 mt-2">顯示所有客戶追蹤紀錄與業務管理記錄</p>
      </div>
    </div>

    <!-- 追蹤紀錄列表 -->
    <DataTable
      title="追蹤紀錄列表"
      :columns="trackingRecordTableColumns"
      :data="filteredTrackingRecords"
      :loading="loading"
      :error="loadError"
      :search-query="searchQuery"
      search-placeholder="搜尋客戶姓名/記錄人員/對話紀錄..."
      :show-search-icon="false"
      :current-page="currentPage"
      :items-per-page="itemsPerPage"
      loading-text="載入中..."
      empty-text="沒有追蹤記錄"
      @search="handleSearch"
      @refresh="loadTrackingRecords"
      @retry="loadTrackingRecords"
      @page-change="handlePageChange"
      @page-size-change="handlePageSizeChange"
    >
      <template #filters>
        <select
          v-if="authStore.hasPermission && authStore.hasPermission('customer_management')"
          v-model="selectedAssignee"
          class="px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option value="all">全部記錄人員</option>
          <option v-for="u in users" :key="u.id" :value="u.id">{{ u.name }}</option>
        </select>
      </template>

      <template #actions>
        <button
          @click="openAddModal"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
          <PlusIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
          新增追蹤紀錄
        </button>
      </template>

      <!-- 客戶姓名 -->
      <template #cell-customer_name="{ item }">
        <div class="text-sm font-medium text-gray-900">
          {{ item.customer_name || '-' }}
        </div>
      </template>

      <!-- 記錄人員 -->
      <template #cell-tracking_person="{ item }">
        <div class="text-sm font-medium text-gray-900">
          {{ item.tracking_person_name || '-' }}
        </div>
      </template>

      <!-- 聯繫時間 -->
      <template #cell-contact_time="{ item }">
        <div class="text-sm text-gray-900">{{ formatDate(item.contact_time) }}</div>
        <div class="text-xs text-gray-500">{{ formatTime(item.contact_time) }}</div>
      </template>

      <!-- 服務階段 -->
      <template #cell-service_stage="{ item }">
        <span class="text-sm text-gray-900">
          {{ item.service_stage || '-' }}
        </span>
      </template>

      <!-- 商機單 -->
      <template #cell-opportunity_order="{ item }">
        <span class="text-sm text-gray-900">
          {{ item.opportunity_order || '-' }}
        </span>
      </template>

      <!-- 維護進度 -->
      <template #cell-maintenance_progress="{ item }">
        <span class="text-sm text-gray-900 truncate max-w-[200px]">
          {{ item.maintenance_progress || '-' }}
        </span>
      </template>

      <!-- 商機狀態 -->
      <template #cell-opportunity_status="{ item }">
        <span class="text-sm text-gray-900">
          {{ item.opportunity_status || '-' }}
        </span>
      </template>

      <!-- 聯絡方式 -->
      <template #cell-contact_method="{ item }">
        <span class="text-sm text-gray-900">
          {{ item.contact_method || '-' }}
        </span>
      </template>

      <!-- 對話紀錄 -->
      <template #cell-conversation_record="{ item }">
        <span class="text-sm text-gray-900 truncate max-w-[200px]">
          {{ item.conversation_record || '-' }}
        </span>
      </template>

      <!-- Actions Cell -->
      <template #cell-actions="{ item }">
        <div class="flex items-center space-x-2 justify-end">
          <!-- 查看 -->
          <button
            @click="viewRecord(item)"
            class="group relative inline-flex items-center justify-center p-2 text-blue-600 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200"
            title="查看詳情"
          >
            <EyeIcon class="w-4 h-4" />
            <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
              查看詳情
            </div>
          </button>

          <!-- 編輯 -->
          <button
            @click="onEditRecord(item)"
            class="group relative inline-flex items-center justify-center p-2 text-gray-600 hover:text-white hover:bg-gray-600 rounded-lg transition-all duration-200"
            title="編輯"
          >
            <PencilIcon class="w-4 h-4" />
            <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
              編輯
            </div>
          </button>

          <!-- 刪除 -->
          <button
            @click="onDeleteRecord(item)"
            class="group relative inline-flex items-center justify-center p-2 text-red-600 hover:text-white hover:bg-red-600 rounded-lg transition-all duration-200"
            title="刪除"
          >
            <TrashIcon class="w-4 h-4" />
            <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
              刪除
            </div>
          </button>
        </div>
      </template>
    </DataTable>

    <!-- Add/Edit Modal -->
    <div v-if="editModalOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 mt-0" @click.self="closeEditModal">
      <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ editingRecordId ? '編輯追蹤紀錄' : '新增追蹤紀錄' }}</h3>
        <form @submit.prevent="saveTrackingRecord" class="space-y-4">
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">客戶姓名 <span class="text-red-500">*</span></label>
            <input v-model="form.customer_name" type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">記錄人員 <span class="text-red-500">*</span></label>
            <select v-model="form.tracking_person_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="">請選擇</option>
              <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">聯繫時間 <span class="text-red-500">*</span></label>
            <input v-model="form.contact_time" type="datetime-local" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">服務階段 <span class="text-red-500">*</span></label>
            <input v-model="form.service_stage" type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">商機單</label>
            <input v-model="form.opportunity_order" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">維護進度</label>
            <textarea v-model="form.maintenance_progress" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">商機狀態 <span class="text-red-500">*</span></label>
            <input v-model="form.opportunity_status" type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">聯絡方式 <span class="text-red-500">*</span></label>
            <select v-model="form.contact_method" required class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option value="">請選擇</option>
              <option value="電話">電話</option>
              <option value="LINE">LINE</option>
              <option value="面談">面談</option>
              <option value="郵件">郵件</option>
              <option value="系統紀錄">系統紀錄</option>
              <option value="其他">其他</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">對話紀錄</label>
            <textarea v-model="form.conversation_record" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>

          <div class="flex justify-end space-x-3 pt-4">
            <button type="button" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50" @click="closeEditModal">取消</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed" :disabled="saving">
              {{ saving ? '儲存中...' : '儲存' }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- View Modal -->
    <div v-if="viewModalOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 mt-0" @click.self="closeViewModal">
      <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-gray-900">追蹤紀錄詳情</h3>
          <button @click="closeViewModal" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>

        <div v-if="selectedRecord" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">客戶姓名</label>
            <p class="text-gray-900">{{ selectedRecord.customer_name || '-' }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">記錄人員</label>
            <p class="text-gray-900">{{ selectedRecord.tracking_person_name || '-' }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">聯繫時間</label>
            <p class="text-gray-900">{{ formatDate(selectedRecord.contact_time) }} {{ formatTime(selectedRecord.contact_time) }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">服務階段</label>
            <p class="text-gray-900">{{ selectedRecord.service_stage || '-' }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">商機單</label>
            <p class="text-gray-900">{{ selectedRecord.opportunity_order || '-' }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">維護進度</label>
            <p class="text-gray-900 whitespace-pre-wrap">{{ selectedRecord.maintenance_progress || '-' }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">商機狀態</label>
            <p class="text-gray-900">{{ selectedRecord.opportunity_status || '-' }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">聯絡方式</label>
            <p class="text-gray-900">{{ selectedRecord.contact_method || '-' }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">對話紀錄</label>
            <p class="text-gray-900 whitespace-pre-wrap">{{ selectedRecord.conversation_record || '-' }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  EyeIcon,
  PencilIcon,
  TrashIcon,
  PlusIcon
} from '@heroicons/vue/24/outline'
import DataTable from '~/components/DataTable.vue'

definePageMeta({ middleware: 'auth' })

import { useTrackingRecords } from '~/composables/useTrackingRecords';

const authStore = useAuthStore()
const { alert, success, error: showError, confirm } = useNotification()

// 假設存在一個 useTrackingRecords composable
// 如果不存在，則需要創建它，並實現相應的 API 互動邏輯
const { list: listTrackingRecords, create: createTrackingRecord, update: updateTrackingRecord, remove: removeTrackingRecord } = useTrackingRecords() // 尚未實現
const { getUsers } = useUsers()

// 搜尋和篩選
const searchQuery = ref('')
const selectedAssignee = ref('all')

// 載入狀態
const loading = ref(false)
const loadError = ref(null)

// 追蹤紀錄數據
const trackingRecords = ref([])
const users = ref([])

// 模態窗口狀態
const editModalOpen = ref(false)
const viewModalOpen = ref(false)
const editingRecordId = ref(null)
const selectedRecord = ref(null)

// 表單提交狀態
const saving = ref(false)

// Pagination
const currentPage = ref(1)
const itemsPerPage = ref(10)

const totalPages = computed(() => Math.ceil(filteredTrackingRecords.value.length / itemsPerPage.value))

// 表單數據
const form = reactive({
  customer_name: '',
  tracking_person_id: null,
  contact_time: '',
  service_stage: '',
  opportunity_order: '',
  maintenance_progress: '',
  opportunity_status: '',
  contact_method: '',
  conversation_record: '',
})

// 表格配置
const trackingRecordTableColumns = computed(() => [
  { key: 'customer_name', title: '客戶姓名', sortable: true, width: '120px' },
  { key: 'tracking_person', title: '記錄人員', sortable: true, width: '100px' },
  { key: 'contact_time', title: '聯繫時間', sortable: true, width: '160px' },
  { key: 'service_stage', title: '服務階段', sortable: true, width: '120px' },
  { key: 'opportunity_order', title: '商機單', sortable: false, width: '120px' },
  { key: 'maintenance_progress', title: '維護進度', sortable: false, width: '200px' },
  { key: 'opportunity_status', title: '商機狀態', sortable: true, width: '120px' },
  { key: 'contact_method', title: '聯絡方式', sortable: true, width: '100px' },
  { key: 'conversation_record', title: '對話紀錄', sortable: false, width: '250px' },
  { key: 'actions', title: '操作', sortable: false, width: '160px' }
])

// 過濾數據
const filteredTrackingRecords = computed(() => {
  let filtered = trackingRecords.value

  // 搜尋過濾
  if (searchQuery.value && searchQuery.value.length >= 2) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(record => {
      return (
        record.customer_name?.toLowerCase().includes(query) ||
        record.tracking_person_name?.toLowerCase().includes(query) ||
        record.conversation_record?.toLowerCase().includes(query)
      )
    })
  }

  // 記錄人員過濾
  if (selectedAssignee.value && selectedAssignee.value !== 'all') {
    filtered = filtered.filter(record => record.tracking_person_id === parseInt(selectedAssignee.value))
  }

  return filtered
})

// 載入數據
const loadTrackingRecords = async () => {
  loading.value = true
  loadError.value = null

  try {
    const config = useRuntimeConfig()
    if (config.public.apiBaseUrl === '/mock-api') {
      const mockDataStore = useMockDataStore()
      trackingRecords.value = mockDataStore.trackingRecords.map(record => ({
        ...record,
        tracking_person_name: users.value.find(u => u.id === record.tracking_person_id)?.name || '未知'
      }))
      loading.value = false
      return
    }

    const result = await listTrackingRecords()
    if (result.success && Array.isArray(result.items)) {
      trackingRecords.value = result.items.map(record => ({
        ...record,
        tracking_person_name: users.value.find(u => u.id === record.tracking_person_id)?.name || '未知'
      }))
    }
  } catch (err) {
    loadError.value = '載入追蹤記錄失敗'
    console.error('Load tracking records error:', err)
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

// DataTable 事件處理
const handleSearch = (query) => {
  searchQuery.value = query
  currentPage.value = 1
}

const handlePageChange = (page) => {
  currentPage.value = page
}

const handlePageSizeChange = (size) => {
  itemsPerPage.value = size
  currentPage.value = 1
}

// 模態窗口控制
const openAddModal = () => {
  editingRecordId.value = null
  Object.assign(form, {
    customer_name: '',
    tracking_person_id: authStore.user?.id || null, // 預設為當前用戶
    contact_time: new Date().toISOString().slice(0, 16),
    service_stage: '',
    opportunity_order: '',
    maintenance_progress: '',
    opportunity_status: '',
    contact_method: '',
    conversation_record: '',
  })
  editModalOpen.value = true
}

const onEditRecord = (record) => {
  editingRecordId.value = record.id
  Object.assign(form, {
    customer_name: record.customer_name,
    tracking_person_id: record.tracking_person_id,
    contact_time: record.contact_time ? new Date(record.contact_time).toISOString().slice(0, 16) : '',
    service_stage: record.service_stage,
    opportunity_order: record.opportunity_order,
    maintenance_progress: record.maintenance_progress,
    opportunity_status: record.opportunity_status,
    contact_method: record.contact_method,
    conversation_record: record.conversation_record,
  })
  editModalOpen.value = true
}

const closeEditModal = () => {
  editModalOpen.value = false
  editingRecordId.value = null
}

const saveTrackingRecord = async () => {
  saving.value = true
  try {
    let result
    if (editingRecordId.value) {
      result = await updateTrackingRecord(editingRecordId.value, form)
    } else {
      result = await createTrackingRecord(form)
    }

    if (!result.error) {
      editModalOpen.value = false
      await loadTrackingRecords()
      success(editingRecordId.value ? '追蹤記錄更新成功' : '追蹤記錄新增成功')
    } else {
      showError(result.error?.message || '操作失敗')
    }
  } catch (err) {
    showError('系統錯誤，請稍後再試')
    console.error('Save tracking record error:', err)
  } finally {
    saving.value = false
  }
}

const onDeleteRecord = async (record) => {
  const confirmed = await confirm(`確定刪除客戶 ${record.customer_name} 的追蹤記錄嗎？`)
  if (!confirmed) return

  try {
    const { error } = await removeTrackingRecord(record.id)
    if (!error) {
      await loadTrackingRecords()
      success(`客戶 ${record.customer_name} 的追蹤記錄已刪除`)
    } else {
      showError(error?.message || '刪除失敗')
    }
  } catch (err) {
    showError('系統錯誤，請稍後再試')
    console.error('Delete tracking record error:', err)
  }
}

const viewRecord = (record) => {
  selectedRecord.value = record
  viewModalOpen.value = true
}

const closeViewModal = () => {
  viewModalOpen.value = false
  selectedRecord.value = null
}

// 工具函數
const formatDate = (d) => new Date(d).toLocaleDateString('zh-TW', { year: 'numeric', month: '2-digit', day: '2-digit' })
const formatTime = (d) => new Date(d).toLocaleTimeString('zh-TW', { hour: '2-digit', minute: '2-digit' })

// 頁面載入
onMounted(async () => {
  await Promise.all([loadUsers(), loadTrackingRecords()])

  // 檢查是否從行事曆跳轉過來並需要自動新增
  const route = useRoute()
  if (route.query.autoCreate === 'true' && route.query.caseId) {
    // 從案件ID獲取客戶姓名
    const caseId = parseInt(route.query.caseId)
    await fetchCaseAndOpenModal(caseId)
  }
})

// 根據案件ID獲取案件並打開新增模態框
const fetchCaseAndOpenModal = async (caseId) => {
  try {
    const { get } = useApi()
    const { data, error } = await get(`/cases/${caseId}`)

    if (!error && data) {
      // 打開新增模態框並填入客戶姓名
      editingRecordId.value = null
      Object.assign(form, {
        customer_name: data.customer_name || '', // 自動填入客戶姓名
        tracking_person_id: authStore.user?.id || null,
        contact_time: new Date().toISOString().slice(0, 16),
        service_stage: '',
        opportunity_order: '',
        maintenance_progress: '',
        opportunity_status: '',
        contact_method: '',
        conversation_record: ''
      })
      addModalOpen.value = true
    }
  } catch (error) {
    console.error('獲取案件失敗:', error)
  }
}

// 設定頁面標題
useHead({
  title: '追蹤紀錄 - 貸款案件管理系統'
})
</script>

<style scoped>
/* 可以添加 scoped 樣式 */
</style>