<template>
  <div class="space-y-6">
    <!-- 頁面標題 -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">{{ pageConfig.title }}</h1>
        <p class="text-gray-600 mt-2">{{ pageConfig.description }}</p>
      </div>
      <div class="flex items-center space-x-3">
      <button
        @click="sendTestOverdueNotification"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400"
      >
        測試逾期通知
      </button>
      <button
        @click="openAddModal"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
      >
        <PlusIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
        {{ pageConfig.addButtonText }}
      </button>
    </div>
    </div>

    <!-- 追蹤行事曆 -->
    <div class="mb-6">
      <TrackingCalendar :events="calendarEvents" @updateEvent="handleUpdateScheduleEvent" />
    </div>

    <!-- 進線列表 -->
    <DataTable
      :title="pageConfig.tableTitle"
      :columns="trackingTableColumns"
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
      @intake-item="openIntakeModal"
      @schedule-tracking="openScheduleModal"
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

        <select
          v-model="selectedStatus"
          class="px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option value="">全部狀態</option>
          <option v-for="option in trackingStatusOptions" :key="option.value" :value="option.value">
            {{ option.label }}
          </option>
        </select>
      </template>

      <!-- Action Buttons -->
      <template #actions>
        <!-- 可以在這裡添加相關操作按鈕 -->
      </template>
    </DataTable>

    <!-- Add Modal -->
    <div v-if="addModalOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 mt-0" @click.self="closeAddModal">
      <div class="bg-white rounded-lg p-6 w-full max-w-3xl mx-4 max-h-[90vh] overflow-y-auto">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ pageConfig.addModalTitle }}</h3>
        <form @submit.prevent="saveAddModal" class="grid grid-cols-1 md:grid-cols-2 gap-4">

          <!-- 案件狀態 (預設為tracking) -->
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">案件狀態</label>
            <select v-model="addForm.case_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-500" disabled>
              <option :value="pageConfig.defaultStatus">{{ CASE_STATUS_OPTIONS.find(opt => opt.value === pageConfig.defaultStatus)?.label }}</option>
            </select>
          </div>

          <!-- 業務等級 (追蹤頁面專有) -->
          <div v-if="pageConfig.showBusinessLevel">
            <label class="block text-sm font-semibold text-gray-900 mb-1">業務等級</label>
            <select v-model="addForm.business_level" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
              <option v-for="option in BUSINESS_LEVEL_OPTIONS" :key="option.value" :value="option.value">{{ option.label }}</option>
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
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed" :disabled="addModalSaving">
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

    <!-- 其他模態視窗 - 指派、LINE名稱編輯等 -->
    <!-- 這些保持與網路進線相同的邏輯 -->

    <!-- View Modal -->
    <div v-if="viewOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 mt-0" @click.self="closeView">
      <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-gray-900">案件詳情</h3>
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
              <p class="text-gray-900">{{ getDisplaySource(selectedLead) }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">來源管道</label>
              <p class="text-gray-900">{{ selectedLead.channel || '-' }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">時間</label>
              <p class="text-gray-900">{{ new Date(selectedLead.created_at).toLocaleString('zh-TW') }}</p>
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
            <div class="text-sm text-gray-900 font-semibold mb-2">案件資訊：</div>
            <div class="bg-gray-50 p-3 rounded-lg">
              <div class="text-sm text-gray-900"><span class="font-medium">案件編號：</span>{{ generateCaseNumber(assignLead) }}</div>
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
                <div class="text-xs text-gray-500">案件編號：{{ generateCaseNumber(lineNameLead) }}</div>
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

    <!-- Schedule Modal (臨時的模態視窗) -->
    <div v-if="scheduleModalOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 mt-0" @click.self="closeScheduleModal">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">安排追蹤行程 - 案件 #{{ schedulingCase?.id }}</h3>
        <form @submit.prevent="saveSchedule" class="space-y-4">
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">追蹤日期 <span class="text-red-500">*</span></label>
            <input type="date" v-model="scheduleForm.date" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">追蹤時間 <span class="text-red-500">*</span></label>
            <input type="time" v-model="scheduleForm.time" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-1">備註</label>
            <textarea v-model="scheduleForm.notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>
          <div class="flex justify-end space-x-3 pt-4">
            <button type="button" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50" @click="closeScheduleModal">取消</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">儲存排程</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, reactive } from 'vue'
import { PlusIcon } from '@heroicons/vue/24/outline'
import DataTable from '~/components/DataTable.vue'
import TrackingCalendar from '~/components/TrackingCalendar.vue'
import CaseEditModal from '~/components/cases/CaseEditModal.vue'
import { useCaseManagement } from '~/composables/useCaseManagement'
import { useMockDataStore } from '~/stores/mockData'
import { useUsers } from '~/composables/useUsers'
import { useCases } from '~/composables/useCases'
import { useNotification } from '~/composables/useNotification'
import { useSidebarBadges } from '~/composables/useSidebarBadges'

definePageMeta({ middleware: 'auth' })

// 使用統一的案件管理配置
const {
  CASE_STATUS_OPTIONS,
  CHANNEL_OPTIONS,
  WEBSITE_OPTIONS,
  BUSINESS_LEVEL_OPTIONS,
  PURPOSE_OPTIONS,
  ADD_LEAD_FORM_CONFIG,
  HIDDEN_FIELDS_CONFIG,
  EDIT_MODAL_SECTIONS,
  SALES_STAFF,
  getTableColumnsForPage,
  getPageConfig,
  addCase,
  generateCaseNumber,
  getDisplaySource,
  updateCaseStatus,
  updateBusinessLevel
} = useCaseManagement()

// 獲取追蹤頁面配置
const pageConfig = getPageConfig('tracking')

const mockDataStore = useMockDataStore()
const authStore = useAuthStore()
const { updateOne: updateCase } = useCases()
const { success, error: showError, confirm } = useNotification()
const { refreshBadges } = useSidebarBadges()

// 追蹤相關的狀態選項
const trackingStatusOptions = computed(() => CASE_STATUS_OPTIONS.filter(opt =>
  ['tracking', 'approved_disbursed', 'approved_undisbursed', 'conditional_approval'].includes(opt.value)
))

// 使用統一的表格欄位配置（專為追蹤頁面設計）
const trackingTableColumns = computed(() => getTableColumnsForPage('tracking'))

// 響應式數據 - 使用與網路進線相同的變數名稱
const loading = ref(false)
const loadError = ref(null)
const searchQuery = ref('')
const currentPage = ref(1)
const itemsPerPage = ref(10)
const selectedStatus = ref('')
const selectedAssignee = ref('all')
const leads = ref([]) // 改名為 leads 以保持一致性
const users = ref(SALES_STAFF) // 使用固定的業務人員列表

// 編輯相關
const editOpen = ref(false)
const editingCase = ref(null)
const viewOpen = ref(false)
const convertOpen = ref(false)
const assignOpen = ref(false)
const lineNameModalOpen = ref(false)
const selectedLead = ref(null)
const convertLead = ref(null)
const assignLead = ref(null)
const lineNameLead = ref(null)
const intakeLead = ref(null) // 新增用於進件模態的響應式變數
const saving = ref(false)

// 新增相關
const addModalOpen = ref(false)
const addModalSaving = ref(false)
const addForm = reactive({
  case_status: pageConfig.defaultStatus,
  business_level: 'A',
  created_at: new Date().toISOString().slice(0, 16),
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

const caseFields = ref([])

// 篩選後的進線列表
const filteredLeads = computed(() => {
  let filtered = leads.value

  // 搜尋過濾
  if (searchQuery.value && searchQuery.value.length >= 2) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(lead => {
      return (
        lead.customer_name?.toLowerCase().includes(query) ||
        lead.email?.toLowerCase().includes(query) ||
        lead.mobile_phone?.includes(query) ||
        lead.phone?.includes(query) ||
        lead.line_id?.toLowerCase().includes(query) ||
        lead.line_user_info?.display_name?.toLowerCase().includes(query)
      )
    })
  }

  // 根據選擇的狀態篩選
  if (selectedStatus.value) {
    filtered = filtered.filter(lead => lead.case_status === selectedStatus.value)
  }

  // 根據承辦業務篩選
  if (selectedAssignee.value && selectedAssignee.value !== 'all') {
    if (selectedAssignee.value === 'null') {
      filtered = filtered.filter(lead => !lead.assigned_to)
    } else {
      filtered = filtered.filter(lead => lead.assigned_to === selectedAssignee.value)
    }
  }

  return filtered
})

// 載入案件數據
const loadLeads = async () => {
  loading.value = true
  loadError.value = null
  try {
    const config = useRuntimeConfig()
    const isMockMode = config.public.apiBaseUrl === '/mock-api'

    if (isMockMode) {
      // 載入追蹤相關的案件
      const trackingCases = mockDataStore.cases.filter(case_ =>
        ['tracking', 'approved_disbursed', 'approved_undisbursed', 'conditional_approval', 'declined'].includes(case_.case_status) ||
        case_.assigned_to !== null // 有被指派的案件都可能需要追蹤
      )
      leads.value = trackingCases
      console.log('追蹤管理 (Mock) - 載入案件:', leads.value.length, '件')
    } else {
      // API 模式：從後端載入
      const { list: listCases } = useCases()
      const { items, success: ok, error } = await listCases({ case_status: 'tracking', per_page: 1000 }) // 獲取所有追蹤中的案件

      if (ok) {
        leads.value = items || []
        console.log('追蹤管理 (API) - 載入案件:', leads.value.length, '件')
      } else {
        showError(error?.message || '載入追蹤案件失敗')
      }
    }
  } catch (error) {
    console.error('載入追蹤案件失敗:', error)
    loadError.value = error.message || '載入失敗'
  } finally {
    loading.value = false
  }
}

// 載入用戶
// 載入用戶（已改用固定列表SALES_STAFF，不需要從後端載入）
// const loadUsers = async () => {
//   // 使用固定的 SALES_STAFF，不需要從後端載入
// }

// 搜尋處理
const handleSearch = (query) => {
  searchQuery.value = query
}

// 分頁處理
const handlePageChange = (page) => {
  currentPage.value = page
}

const handlePageSizeChange = (size) => {
  itemsPerPage.value = size
  currentPage.value = 1
}

// 編輯功能
const onEdit = (item) => {
  editingCase.value = { ...item }
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
      success('追蹤案件更新成功')
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

// 新增功能
const openAddModal = () => {
  // 重置表單為初始狀態
  Object.assign(addForm, {
    case_status: pageConfig.defaultStatus,
    business_level: 'A',
    created_at: new Date().toISOString().slice(0, 16),
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
  // 重置表單
  Object.assign(addForm, {
    case_status: pageConfig.defaultStatus,
    business_level: 'A',
    created_at: new Date().toISOString().slice(0, 16),
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
}

const saveAddModal = async () => {
  addModalSaving.value = true
  try {
    // 驗證必填欄位
    if (!addForm.customer_name?.trim()) {
      showError('客戶姓名為必填項目')
      return
    }
    if (!addForm.source_channel) {
      showError('來源管道為必填項目')
      return
    }

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
      case_status: pageConfig.defaultStatus, // 使用頁面配置的預設狀態
      business_level: addForm.business_level, // 追蹤管理頁面特有
      payload: {
        '頁面_URL': addForm.website_domain || '',
        '貸款需求': addForm.consultation_items || '',
        'LINE_ID': addForm.line_id || '',
        'LINE顯示名稱': addForm.line_name || ''
      }
    }

    const { success: ok, data: newCase } = await addCase(newCaseData)

    if (ok && newCase) {
      addModalOpen.value = false
      await loadLeads()
      await refreshBadges() // 更新側邊欄計數
      success(`新增追蹤案件 #${newCase.id} 成功！`)
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

// 其他操作 - 保持與網路進線相同的介面
const viewLead = (lead) => {
  selectedLead.value = lead
  viewOpen.value = true
}

const closeView = () => {
  viewOpen.value = false
  selectedLead.value = null
}

const openConvert = (lead) => {
  if (!lead.customer_id) {
    showError('此案件尚未綁定客戶，請先建立/綁定客戶後再送件')
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
    const { convertToCase } = useCases() // Assuming useCases has convertToCase
    const { error } = await convertToCase(convertLead.value.id, convertForm)
    if (!error) {
      convertOpen.value = false
      await loadLeads()
      success('案件轉換成功')
    } else {
      showError(error?.message || '轉換失敗')
    }
  } catch (err) {
    showError('系統錯誤，請稍後再試')
    console.error('Convert case error:', err)
  }
}

const onDelete = async (lead) => {
  const confirmed = await confirm(`確定刪除編號 ${lead.id} 的案件嗎？`)
  if (!confirmed) return

  try {
    const { removeOne } = useCases() // FIX: Changed from deleteOne to removeOne
    if (typeof removeOne !== 'function') {
      showError('刪除功能未正確配置 (removeOne is not a function)')
      console.error('useCases() did not return a removeOne function')
      return
    }
    const { error } = await removeOne(lead.id)
    if (!error) {
      await loadLeads()
      await refreshBadges() // 更新側邊欄計數
      success(`編號 ${lead.id} 的案件已刪除`)
    } else {
      showError(error?.message || '刪除失敗')
    }
  } catch (err) {
    showError('系統錯誤，請稍後再試')
    console.error('Delete case error:', err)
  }
}

const handleCellChange = async ({ item, columnKey, newValue, column }) => {
  console.log('handleCellChange called:', { columnKey, newValue, item })

  switch (columnKey) {
    case 'case_status':
      // 使用統一的 updateCaseStatus 函數
      await updateCaseStatus(item.id, newValue, false) // tracking 頁面不自動導航
      // 更新本地狀態
      const index = leads.value.findIndex(l => l.id === item.id)
      if (index !== -1) {
        leads.value[index].case_status = newValue
      }
      // 更新側邊欄計數
      await refreshBadges()
      break
    case 'business_level':
      await updateBusinessLevel(item.id, newValue)
      // 更新本地狀態
      const levelIndex = leads.value.findIndex(l => l.id === item.id)
      if (levelIndex !== -1) {
        leads.value[levelIndex].business_level = newValue
      }
      break
    case 'channel':
      // TODO: Implement update channel if needed
      console.warn('Channel update not yet implemented in tracking page')
      break
    case 'purpose':
      // TODO: Implement update purpose if needed
      console.warn('Purpose update not yet implemented in tracking page')
      break
    case 'website_name':
      // TODO: Implement update website if needed
      console.warn('Website update not yet implemented in tracking page')
      break
    default:
      console.warn('Unhandled column change:', columnKey, newValue)
  }
}

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
    const { updateOne } = useCases()
    const { error } = await updateOne(assignLead.value.id, {
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
  } finally {
    saving.value = false
  }
}

const openIntakeModal = (item) => {
  intakeLead.value = item
  confirm(`確定要將案件 #${item.id} 設定為「進件」嗎？這將通知行政端處理。`).then(confirmed => {
    if (confirmed) {
      // TODO: 這裡可以發送 API 請求通知後端行政端，或直接更新狀態
      success(`案件 #${item.id} 已設定為「進件」，並通知行政端。`)
      // 可以在這裡進一步處理，例如更新案件狀態為一個新的「待行政處理」狀態
      // 或者發送一個事件通知後端
    } else {
      showError(`案件 #${item.id} 的「進件」操作已取消。`)
    }
    intakeLead.value = null
  })
}

// 追蹤行事曆事件列表
const calendarEvents = ref([])

// FIX: Add missing state for schedule modal
const scheduleModalOpen = ref(false)
const schedulingCase = ref(null)
const scheduleForm = reactive({
  date: '',
  time: '',
  notes: ''
})

// 打開排程模態視窗
const openScheduleModal = (item) => {
  schedulingCase.value = item
  // 初始化排程表單
  Object.assign(scheduleForm, {
    date: new Date().toISOString().slice(0, 10), // 預設為今天
    time: '',
    notes: item.notes || '',
  })
  scheduleModalOpen.value = true
}

// 關閉排程模態視窗
const closeScheduleModal = () => {
  scheduleModalOpen.value = false
  schedulingCase.value = null
}

// 儲存排程
const saveSchedule = async () => {
  if (!scheduleForm.date || !scheduleForm.time) {
    showError('請選擇日期和時間')
    return
  }

  const scheduledDateTime = `${scheduleForm.date}T${scheduleForm.time}`

  // TODO: 呼叫後端 API 創建新的追蹤行程
  console.log('呼叫後端 API 創建行程:', { caseId: schedulingCase.value.id, scheduled_at: scheduledDateTime, notes: scheduleForm.notes })
  success(`案件 #${schedulingCase.value.id} 已安排追蹤至 ${scheduleForm.date} ${scheduleForm.time}`)

  // 暫時將排程數據添加到 TrackingCalendar 的 events 屬性中 (待後端集成後移除)
  calendarEvents.value.push({
    id: Date.now(), // 簡單的唯一ID
    title: `追蹤案件 #${schedulingCase.value.id}`,
    start: scheduledDateTime,
    end: scheduledDateTime, // 對於單一時間點的追蹤，start 和 end 可以相同
    extendedProps: {
      caseId: schedulingCase.value.id,
      notes: scheduleForm.notes,
      status: 'scheduled' // 新增的行程預設為已排程
    }
  })

  closeScheduleModal()
}

// 處理行事曆事件更新 (來自 TrackingCalendar 組件的 emit)
const handleUpdateScheduleEvent = async (updatedEvent) => {
  console.log('接收到行事曆事件更新:', updatedEvent)

  // TODO: 呼叫後端 API 更新追蹤行程的狀態和備註
  success(`行程 #${updatedEvent.id} 狀態已更新為 ${getStatusLabel(updatedEvent.extendedProps?.status)}`)

  // 更新本地 calendarEvents 數據
  const index = calendarEvents.value.findIndex(event => event.id === updatedEvent.id)
  if (index !== -1) {
    calendarEvents.value[index] = updatedEvent
  }
}

const getStatusLabel = (status) => {
  switch (status) {
    case 'contacted':
      return '已聯絡'
    case 'rescheduled':
      return '改期'
    case 'scheduled':
    default:
      return '已排程'
  }
}

// 頁面載入時執行
onMounted(() => {
  loadLeads() // 只載入案件，不需要載入用戶（已使用固定SALES_STAFF）
})

// 設定頁面標題
useHead({
  title: pageConfig.title
})
</script>