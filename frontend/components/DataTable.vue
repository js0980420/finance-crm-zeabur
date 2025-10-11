<template>
  <div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <!-- Title Section -->
    <div class="p-6 border-b border-gray-200">
      <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ title }}</h2>
      
      <!-- Search and Actions Section -->
      <div class="flex items-center justify-between">
        <!-- Left Side - Search -->
        <div class="flex items-center space-x-4">
          <div class="relative">
            <input
              :value="searchQuery"
              @input="$emit('search', $event.target.value)"
              type="text"
              :placeholder="searchPlaceholder"
              :class="showSearchIcon ? 'pl-10 pr-4 py-2' : 'pl-4 pr-4 py-2'"
              class="border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 min-w-64"
            />
            <MagnifyingGlassIcon v-if="showSearchIcon" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" />
          </div>
          
          <!-- Additional Filters Slot -->
          <slot name="filters"></slot>
        </div>
        
        <!-- Right Side - Action Buttons -->
        <div class="flex items-center space-x-3">
          <!-- Additional Action Buttons Slot -->
          <slot name="actions"></slot>
          
          <!-- Refresh Button - Always at the rightmost position -->
          <button
            @click="$emit('refresh')"
            :disabled="loading"
            class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 transition-colors duration-200 disabled:opacity-50"
          >
            <ArrowPathIcon class="w-4 h-4 mr-2" :class="{ 'animate-spin': loading }" />
            重新整理
          </button>
        </div>
      </div>
    </div>

    <!-- Table Content -->
    <div class="overflow-x-auto">
      <!-- Loading State -->
      <div v-if="loading" class="p-8 text-center">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">{{ loadingText }}</p>
      </div>
      
      <!-- Error State -->
      <div v-else-if="error" class="p-8 text-center">
        <p class="text-red-600">{{ error }}</p>
        <button 
          @click="$emit('retry')"
          class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
        >
          重試
        </button>
      </div>
      
      <!-- Empty State -->
      <div v-else-if="!data || data.length === 0" class="p-8 text-center">
        <div class="w-12 h-12 mx-auto mb-4 text-gray-400">
          <slot name="empty-icon">
            <TableCellsIcon class="w-full h-full" />
          </slot>
        </div>
        <p class="text-gray-500">{{ emptyText }}</p>
      </div>
      
      <!-- Data Table -->
      <table v-else class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-gray-50">
          <tr>
            <th 
              v-for="column in columns" 
              :key="column.key"
              :class="[
                'px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider',
                column.headerClass
              ]"
              :style="column.width ? { width: column.width } : {}"
            >
              <div class="flex items-center space-x-1">
                <span>{{ column.title }}</span>
                <button
                  v-if="column.sortable"
                  @click="handleSort(column.key)"
                  class="hover:text-gray-700"
                >
                  <ChevronUpDownIcon class="w-4 h-4" />
                </button>
              </div>
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr 
            v-for="(item, index) in paginatedData" 
            :key="getRowKey(item, index)"
            :class="[
              'hover:bg-blue-50 transition-colors',
              rowClass
            ]"
          >
            <td
              v-for="column in columns"
              :key="column.key"
              :class="[
                'px-6 py-4 whitespace-nowrap text-base',
                column.cellClass
              ]"
            >
              <slot
                :name="`cell-${column.key}`"
                :item="item"
                :value="getNestedValue(item, column.key)"
                :index="index"
              >
                <!-- Actions column with dynamic buttons (網路進線格式：帶圖標和 tooltip) -->
                <div v-if="column.type === 'actions' && column.allowedActions" class="flex items-center space-x-2">
                  <!-- 安排追蹤 -->
                  <button
                    v-if="column.allowedActions.includes('schedule')"
                    @click="$emit('schedule-tracking', item)"
                    class="group relative inline-flex items-center justify-center p-2 text-purple-600 hover:text-white hover:bg-purple-600 rounded-lg transition-all duration-200"
                    title="安排追蹤"
                  >
                    <CalendarIcon class="w-4 h-4" />
                    <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
                      安排追蹤
                    </div>
                  </button>

                  <!-- 進件 -->
                  <button
                    v-if="column.allowedActions.includes('intake')"
                    @click="$emit('intake-item', item)"
                    class="group relative inline-flex items-center justify-center p-2 text-green-600 hover:text-white hover:bg-green-600 rounded-lg transition-all duration-200"
                    title="進件"
                  >
                    <ArrowUpTrayIcon class="w-4 h-4" />
                    <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
                      進件
                    </div>
                  </button>

                  <!-- 查看 -->
                  <button
                    v-if="column.allowedActions.includes('view')"
                    @click="$emit('view-item', item)"
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
                    v-if="column.allowedActions.includes('edit')"
                    @click="$emit('edit-item', item)"
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
                    v-if="column.allowedActions.includes('delete')"
                    @click="$emit('delete-item', item)"
                    class="group relative inline-flex items-center justify-center p-2 text-red-600 hover:text-white hover:bg-red-600 rounded-lg transition-all duration-200"
                    title="刪除"
                  >
                    <TrashIcon class="w-4 h-4" />
                    <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
                      刪除
                    </div>
                  </button>

                  <!-- 建檔 (Convert) -->
                  <button
                    v-if="column.allowedActions.includes('convert')"
                    @click="$emit('convert-item', item)"
                    class="group relative inline-flex items-center justify-center p-2 text-blue-600 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200"
                    title="建檔"
                  >
                    <ArrowRightIcon class="w-4 h-4" />
                    <div class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 text-xs text-white bg-gray-900 rounded whitespace-nowrap z-10">
                      建檔
                    </div>
                  </button>
                </div>
                <!-- Select dropdown for columns with type="select" -->
                <select
                  v-else-if="column.type === 'select' && column.options"
                  :value="getNestedValue(item, column.key) || ''"
                  @change="$emit('cell-change', { item, columnKey: column.key, newValue: $event.target.value, column })"
                  class="w-full px-2 py-1 text-sm border border-gray-300 rounded bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                  <option value="">請選擇</option>
                  <option
                    v-for="option in column.options"
                    :key="option.value"
                    :value="option.value"
                  >
                    {{ option.label }}
                  </option>
                </select>
                <!-- Default text display -->
                <div v-else :class="[column.textClass, 'flex flex-col']" v-html="formatCellValue(item, column)"></div>
              </slot>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <!-- Pagination -->
    <div v-if="showPagination && totalPages > 1" class="px-6 py-6 border-t border-gray-200 bg-gray-50 rounded-b-xl">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <p class="text-sm text-gray-700">
            顯示第 <span class="font-medium">{{ startIndex }}</span> 
            到 <span class="font-medium">{{ endIndex }}</span> 
            筆，共 <span class="font-medium">{{ totalItems }}</span> 筆記錄
          </p>
          
          <!-- Items per page selector -->
          <div class="flex items-center space-x-2">
            <label class="text-sm text-gray-700">每頁顯示：</label>
            <select
              :value="itemsPerPage"
              @change="$emit('page-size-change', parseInt($event.target.value))"
              class="text-sm border border-gray-300 rounded-md bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
              <option :value="5">5 筆</option>
              <option :value="10">10 筆</option>
              <option :value="20">20 筆</option>
              <option :value="50">50 筆</option>
              <option :value="100">100 筆</option>
            </select>
          </div>
        </div>
        
        <div class="flex items-center space-x-2">
          <button
            @click="$emit('page-change', currentPage - 1)"
            :disabled="currentPage === 1"
            class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-blue-50 focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            上一頁
          </button>
          
          <div class="flex space-x-1">
            <button
              v-for="page in visiblePages"
              :key="page"
              @click="typeof page === 'number' ? $emit('page-change', page) : null"
              :class="[
                'px-3 py-1 border text-sm rounded-md',
                page === currentPage
                  ? 'bg-blue-600 text-white border-blue-600'
                  : 'bg-white text-gray-700 border-gray-300 hover:bg-blue-50 focus:ring-2 focus:ring-blue-500',
                typeof page !== 'number' ? 'cursor-default' : 'cursor-pointer'
              ]"
              :disabled="typeof page !== 'number'"
            >
              {{ page }}
            </button>
          </div>
          
          <button
            @click="$emit('page-change', currentPage + 1)"
            :disabled="currentPage === totalPages"
            class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-blue-50 focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            下一頁
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  MagnifyingGlassIcon,
  ArrowPathIcon,
  ChevronUpDownIcon,
  TableCellsIcon,
  EyeIcon,
  PencilIcon,
  TrashIcon,
  CalendarIcon,
  ArrowUpTrayIcon,
  ArrowRightIcon // <-- 新增 ArrowRightIcon
} from '@heroicons/vue/24/outline'

const props = defineProps({
  // Table configuration
  title: {
    type: String,
    required: true
  },
  columns: {
    type: Array,
    required: true
  },
  data: {
    type: Array,
    default: () => []
  },
  rowKey: {
    type: [String, Function],
    default: 'id'
  },
  
  // Search
  searchQuery: {
    type: String,
    default: ''
  },
  searchPlaceholder: {
    type: String,
    default: '搜尋...'
  },
  showSearchIcon: {
    type: Boolean,
    default: true
  },
  
  // State
  loading: {
    type: Boolean,
    default: false
  },
  error: {
    type: String,
    default: ''
  },
  
  // Pagination
  showPagination: {
    type: Boolean,
    default: true
  },
  currentPage: {
    type: Number,
    default: 1
  },
  itemsPerPage: {
    type: Number,
    default: 10
  },
  
  // Text customization
  loadingText: {
    type: String,
    default: '載入中...'
  },
  emptyText: {
    type: String,
    default: '沒有資料'
  },
  
  // Style customization
  rowClass: {
    type: String,
    default: ''
  }
})

const emit = defineEmits([
  'search',
  'refresh',
  'retry',
  'sort',
  'page-change',
  'page-size-change',
  'cell-change',
  'assign-user',
  'edit-line-name',
  'view-item',
  'edit-item',
  'convert-item',
  'delete-item'
])

// Computed properties
const totalItems = computed(() => props.data.length)
const totalPages = computed(() => Math.ceil(totalItems.value / props.itemsPerPage))
const startIndex = computed(() => (props.currentPage - 1) * props.itemsPerPage + 1)
const endIndex = computed(() => Math.min(props.currentPage * props.itemsPerPage, totalItems.value))

const paginatedData = computed(() => {
  if (!props.showPagination) return props.data
  
  const start = (props.currentPage - 1) * props.itemsPerPage
  const end = start + props.itemsPerPage
  return props.data.slice(start, end)
})

const visiblePages = computed(() => {
  const pages = []
  const maxVisible = 5
  
  if (totalPages.value <= maxVisible) {
    for (let i = 1; i <= totalPages.value; i++) {
      pages.push(i)
    }
  } else {
    if (props.currentPage <= 3) {
      for (let i = 1; i <= 4; i++) {
        pages.push(i)
      }
      pages.push('...')
      pages.push(totalPages.value)
    } else if (props.currentPage >= totalPages.value - 2) {
      pages.push(1)
      pages.push('...')
      for (let i = totalPages.value - 3; i <= totalPages.value; i++) {
        pages.push(i)
      }
    } else {
      pages.push(1)
      pages.push('...')
      for (let i = props.currentPage - 1; i <= props.currentPage + 1; i++) {
        pages.push(i)
      }
      pages.push('...')
      pages.push(totalPages.value)
    }
  }
  
  return pages
})

// Methods
const getRowKey = (item, index) => {
  if (typeof props.rowKey === 'function') {
    return props.rowKey(item, index)
  }
  return item[props.rowKey] || index
}

const getNestedValue = (obj, path) => {
  return path.split('.').reduce((current, key) => current?.[key], obj)
}

const formatCellValue = (item, column) => {
  const value = getNestedValue(item, column.key)
  // console.log(`formatCellValue 被呼叫 - column: ${column.key}, value:`, value, 'hasFormatter:', !!column.formatter) // 暫時註釋掉 console.log

  if (column.formatter && typeof column.formatter === 'function') {
    const result = column.formatter(value, item)
    // console.log(`  → formatter 返回:`, result) // 暫時註釋掉 console.log
    return result
  }

  // 如果沒有 formatter，並且值是字符串，則進行 HTML 實體編碼，避免 HTML 註釋被錯誤解析
  if (typeof value === 'string') {
    return value.replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
  }
  
  // console.log(`  → 沒有 formatter,直接返回 value`) // 暫時註釋掉 console.log
  return value
}

const handleSort = (key) => {
  emit('sort', key)
}
</script>
