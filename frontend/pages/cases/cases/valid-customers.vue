<template>
  <div class="space-y-6">
    <!-- 頁面標題 -->
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">有效客管理</h1>
        <p class="text-gray-600 mt-2">顯示所有狀態為「有效客」的案件</p>
      </div>
      <div class="flex items-center space-x-4">
        <button
          class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
          <DocumentTextIcon class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" />
          導出 CSV
        </button>
        <!-- 根據新的邏輯，有效客頁面不應該有直接新增的按鈕 -->
      </div>
    </div>

    <!-- 有效客列表 -->
    <DataTable
      title="有效客列表"
      :columns="validCustomerTableColumns"
      :data="filteredValidCustomers"
      :loading="loading"
      :error="loadError"
      :search-query="searchQuery"
      search-placeholder="搜尋姓名/手機/Email/LINE/網站... (至少2個字符)"
      :show-search-icon="false"
      :current-page="currentPage"
      :items-per-page="itemsPerPage"
      loading-text="載入中..."
      empty-text="沒有有效客案件"
      @search="handleSearch"
      @refresh="loadValidCustomers"
      @retry="loadValidCustomers"
      @page-change="handlePageChange"
      @page-size-change="handlePageSizeChange"
      @cell-change="handleCellChange"
      @edit-item="onEdit"
      @delete-item="onDelete"
      @convert-item="onConvert" <!-- 新增這一行 -->
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
      </template>

      <!-- Action Buttons -->
      <template #actions>
        <!-- 可以在這裡添加新增案件等按鈕 -->
      </template>
    </DataTable>

    <!-- Edit Modal -->
    <CaseEditModal
      :isOpen="editOpen"
      :case="editingCase"
      page-type="valid_customer"
      @close="closeEdit"
      @save="saveEdit"
    />

    <!-- Delete Modal (如果需要，可以從 index.vue 複製過來) -->
    <!-- 目前先不複製，因為 DataTable 已經有 @delete-item 事件 -->

  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import {
  DocumentTextIcon,
  PlusIcon, // 雖然移除了新增按鈕，但可能其他地方會用到，先保留
} from '@heroicons/vue/24/outline';

import DataTable from '~/components/DataTable.vue';
import CaseEditModal from '~/components/cases/CaseEditModal.vue';
import { useNotification } from '~/composables/useNotification';
import { useLeads } from '~/composables/useLeads'; // 假設 useLeads 也能處理 case
import { useUsers } from '~/composables/useUsers';
import { useCaseManagement } from '~/composables/useCaseManagement';
import { useAuthStore } from '~/stores/auth'; // 引入 authStore

// 使用統一的案件管理
const {
  getTableColumnsForPage,
  generateCaseNumber, // 可能會用到
} = useCaseManagement();

const authStore = useAuthStore();
const { success, error: showError, confirm } = useNotification();
const { list: listLeads, updateOne: updateLead, removeOne, convertToCase } = useLeads(); // 新增 convertToCase

// ... (其他函數)

const onConvert = async (customer) => {
  const confirmed = await confirm(`確定將有效客案件 ${customer.id} 建檔嗎？`);
  if (!confirmed) return;

  try {
    // convertToCase 函數需要一個 lead 物件和一個 payload
    // 這裡假設 customer 就是 lead，並且 payload 可以是空物件或包含額外資訊
    const { error } = await convertToCase(customer, {}); // 假設不需要額外的 payload

    if (!error) {
      await loadValidCustomers();
      success(`有效客案件 ${customer.id} 已成功建檔！`);
    } else {
      showError(error?.message || '建檔失敗');
    }
  } catch (err) {
    showError('系統錯誤，請稍後再試');
    console.error('Convert valid customer error:', err);
  }
};
const { getUsers } = useUsers();

// 搜尋和篩選
const searchQuery = ref('');
const selectedAssignee = ref('all');

// 載入狀態
const loading = ref(false);
const loadError = ref(null);

// 有效客數據
const validCustomers = ref([]);
const users = ref([]);

// 模態窗口狀態
const editOpen = ref(false);
const editingCase = ref(null);

// 表單提交狀態
const saving = ref(false);

// Pagination
const currentPage = ref(1);
const itemsPerPage = ref(5); // Default to 5 items per page as requested

const totalPages = computed(() => Math.ceil(filteredValidCustomers.value.length / itemsPerPage.value));

// 表格配置
const validCustomerTableColumns = computed(() => getTableColumnsForPage('valid_customer'));

// 過濾數據
const filteredValidCustomers = computed(() => {
  let filtered = validCustomers.value;

  // 搜尋過濾
  if (searchQuery.value && searchQuery.value.length >= 2) {
    const query = searchQuery.value.toLowerCase();
    filtered = filtered.filter(customer => {
      return (
        customer.customer_name?.toLowerCase().includes(query) ||
        customer.phone?.toLowerCase().includes(query) ||
        customer.email?.toLowerCase().includes(query) ||
        customer.payload?.line_id?.toLowerCase().includes(query) || // 假設 line_id 在 payload 中
        customer.assignee?.name?.toLowerCase().includes(query)
      );
    });
  }

  // 承辦業務過濾
  if (selectedAssignee.value && selectedAssignee.value !== 'all') {
    if (selectedAssignee.value === 'null') {
      filtered = filtered.filter(customer => !customer.assigned_to);
    } else {
      filtered = filtered.filter(customer => customer.assigned_to === parseInt(selectedAssignee.value));
    }
  }

  return filtered;
});

// 載入數據
const loadValidCustomers = async () => {
  loading.value = true;
  loadError.value = null;

  try {
    const { items, success: ok } = await listLeads({
      case_status: 'valid_customer', // 只獲取狀態為 'valid_customer' 的案件
      per_page: 1000 // 獲取所有有效客，客戶端分頁
    });

    if (ok) {
      validCustomers.value = items || [];
    }
  } catch (err) {
    loadError.value = '載入有效客數據失敗';
    console.error('Load valid customers error:', err);
  } finally {
    loading.value = false;
  }
};

const loadUsers = async () => {
  try {
    const { success: ok, users: list } = await getUsers({ per_page: 250 });
    if (ok && Array.isArray(list)) users.value = list;
  } catch (e) {
    console.warn('Load users failed:', e);
  }
};

// DataTable event handlers
const handleSearch = (query) => {
  searchQuery.value = query;
  currentPage.value = 1; // Reset to first page when searching
};

const handlePageChange = (page) => {
  currentPage.value = page;
};

const handlePageSizeChange = (size) => {
  itemsPerPage.value = size;
  currentPage.value = 1; // Reset to first page
};

// 搜尋防抖
let searchTimer;
watch([searchQuery, selectedAssignee], () => {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => {
    currentPage.value = 1;
  }, 300);
});

// 模態窗口控制
const onEdit = (customer) => {
  editingCase.value = { ...customer };
  editOpen.value = true;
};

const closeEdit = () => {
  editOpen.value = false;
  editingCase.value = null;
};

const saveEdit = async (apiPayload) => {
  saving.value = true;
  try {
    console.log('🟡 valid-customers.vue - saveEdit - 收到的 apiPayload:', apiPayload);

    const { error, data } = await updateLead(apiPayload.id, apiPayload); // 假設 updateLead 也能處理 case

    console.log('🟡 valid-customers.vue - saveEdit - API 回應:', { error, data });

    if (!error) {
      editOpen.value = false;
      editingCase.value = null;
      await loadValidCustomers();
      success('有效客案件更新成功');
    } else {
      showError(error?.message || '更新失敗');
    }
  } catch (err) {
    showError('系統錯誤，請稍後再試');
    console.error('Update valid customer error:', err);
  }
};

const onDelete = async (customer) => {
  const confirmed = await confirm(`確定刪除編號 ${customer.id} 的有效客案件嗎？`);
  if (!confirmed) return;

  try {
    const { error } = await removeOne(customer.id); // 假設 removeOne 也能處理 case
    if (!error) {
      await loadValidCustomers();
      success(`編號 ${customer.id} 的有效客案件已刪除`);
    } else {
      showError(error?.message || '刪除失敗');
    }
  } catch (err) {
    showError('系統錯誤，請稍後再試');
    console.error('Delete valid customer error:', err);
  }
};

// 統一的欄位變更處理器 (如果 DataTable 支援直接修改狀態，這裡可能需要調整)
const handleCellChange = async ({ item, columnKey, newValue, column }) => {
  console.log('handleCellChange called:', { columnKey, newValue, item });

  // 這裡可以根據需要處理特定欄位的變更，例如指派業務、修改狀態等
  // 由於有效客頁面主要顯示已是有效客的案件，狀態變更可能較少
  // 如果需要，可以參考 index.vue 中的 updateLeadStatus 邏輯
  switch (columnKey) {
    case 'assigned_to':
      // 假設這裡需要更新指派業務
      try {
        const assignedUser = users.value.find(u => u.id === newValue);
        const { error } = await updateLead(item.id, {
          assigned_to: newValue,
          assignee: assignedUser ? {
            id: assignedUser.id,
            name: assignedUser.name,
            email: assignedUser.email
          } : null
        });
        if (!error) {
          success(`已成功指派給 ${assignedUser?.name || '未知業務'}`);
          // 更新本地數據
          const index = validCustomers.value.findIndex(c => c.id === item.id);
          if (index !== -1) {
            validCustomers.value[index].assigned_to = newValue;
            validCustomers.value[index].assignee = assignedUser;
          }
        } else {
          showError(error?.message || '指派失敗');
        }
      } catch (err) {
        showError('系統錯誤，請稍後再試');
        console.error('Assign lead error:', err);
      }
      break;
    default:
      console.warn('Unhandled column change:', columnKey, newValue);
  }
};


// 頁面載入
onMounted(async () => {
  await Promise.all([loadUsers(), loadValidCustomers()]);
});

// 組件銷毀時清理
onUnmounted(() => {
  clearTimeout(searchTimer);
});

// 設定頁面標題
useHead({
  title: '有效客管理'
});
</script>

<style scoped>
/* Ensure tooltips appear above everything */
.group:hover .group-hover\:block {
  z-index: 50;
}
</style>