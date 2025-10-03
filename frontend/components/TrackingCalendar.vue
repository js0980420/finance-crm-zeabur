<template>
  <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-semibold text-gray-900">追蹤行事曆</h2>
      <div class="flex space-x-2">
        <button @click="prevMonth" class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300">
          上個月
        </button>
        <span class="text-lg font-medium">{{ currentYear }} 年 {{ currentMonth + 1 }} 月</span>
        <button @click="nextMonth" class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300">
          下個月
        </button>
      </div>
    </div>
    <div class="grid grid-cols-7 gap-1 text-center font-medium text-gray-700">
      <div v-for="dayName in dayNames" :key="dayName" class="py-2">
        {{ dayName }}
      </div>
    </div>
    <div class="grid grid-cols-7 gap-1 border-t border-gray-200 mt-2">
      <div 
        v-for="day in calendarDays"
        :key="day.date"
        class="p-2 h-24 relative border-b border-gray-200"
        :class="{
          'bg-gray-50 text-gray-400': !day.isCurrentMonth,
          'bg-white': day.isCurrentMonth,
          'border-blue-500 border-2': day.isToday,
        }"
      >
        <div 
          class="text-sm font-medium"
          :class="{ 
            'text-blue-600': day.isToday && day.isCurrentMonth,
            'text-gray-900': !day.isToday && day.isCurrentMonth,
          }"
        >
          {{ day.dayOfMonth }}
        </div>
        <div v-if="day.events.length > 0" class="mt-1 space-y-1 overflow-y-auto max-h-14">
          <div 
            v-for="event in day.events"
            :key="event.id"
            class="text-xs font-medium px-1.5 py-0.5 rounded-md cursor-pointer hover:bg-opacity-80"
            :class="getEventClass(event)"
            @click="viewEvent(event)"
          >
            {{ event.title }}
          </div>
        </div>
      </div>
    </div>

    <!-- Event Detail Modal -->
    <div v-if="isModalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <h3 class="text-lg font-semibold mb-4">事件詳情</h3>
        <div v-if="selectedEvent" class="space-y-2">
          <p><strong>標題:</strong> {{ selectedEvent.title }}</p>
          <p><strong>日期:</strong> {{ formatDate(selectedEvent.start) }}</p>
          <p v-if="!isEditing"><strong>狀態:</strong> {{ getStatusLabel(selectedEvent.extendedProps?.status) }}</p>
          <div v-else>
            <label class="block text-sm font-semibold text-gray-900 mb-1">狀態 <span class="text-red-500">*</span></label>
            <select v-model="editingEvent.extendedProps.status" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
              <option v-for="option in SCHEDULE_STATUS_OPTIONS" :key="option.value" :value="option.value">{{ option.label }}</option>
            </select>
          </div>
          <p><strong>案件ID:</strong> {{ selectedEvent.extendedProps?.caseId }}</p>
          <p v-if="!isEditing && selectedEvent.extendedProps?.notes"><strong>備註:</strong> {{ selectedEvent.extendedProps.notes }}</p>
          <div v-else-if="isEditing">
            <label class="block text-sm font-semibold text-gray-900 mb-1">備註</label>
            <textarea v-model="editingEvent.extendedProps.notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>
        </div>
        <div class="mt-6 flex justify-end space-x-2">
          <button v-if="!isEditing" @click="startEditing" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">編輯</button>
          <button v-if="isEditing" @click="cancelEditing" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">取消編輯</button>
          <button v-if="isEditing" @click="saveEvent" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">儲存</button>
          <button @click="closeModal" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">關閉</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, reactive } from 'vue'

const props = defineProps({
  events: {
    type: Array,
    default: () => []
  }
})

const emit = defineEmits(['updateEvent'])

const today = new Date()
const currentMonth = ref(today.getMonth())
const currentYear = ref(today.getFullYear())

const dayNames = ['日', '一', '二', '三', '四', '五', '六']

const daysInMonth = (year, month) => new Date(year, month + 1, 0).getDate()
const firstDayOfMonth = (year, month) => new Date(year, month, 1).getDay()

const SCHEDULE_STATUS_OPTIONS = [
  { label: '待聯絡', value: 'scheduled' },
  { label: '已聯絡', value: 'contacted' },
  { label: '改期', value: 'rescheduled' }
]

const getEventClass = (event) => {
  const status = event.extendedProps?.status || 'scheduled'
  switch (status) {
    case 'contacted':
      return 'bg-green-100 text-green-800'
    case 'rescheduled':
      return 'bg-yellow-100 text-yellow-800'
    case 'scheduled':
    default:
      return 'bg-blue-100 text-blue-800'
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
      return '待聯絡'
  }
}

const calendarDays = computed(() => {
  const numDays = daysInMonth(currentYear.value, currentMonth.value)
  const firstDay = firstDayOfMonth(currentYear.value, currentMonth.value)
  const days = []

  // Add leading empty days from previous month
  const prevMonthDays = daysInMonth(currentYear.value, currentMonth.value - 1)
  for (let i = firstDay - 1; i >= 0; i--) {
    days.push({
      date: new Date(currentYear.value, currentMonth.value - 1, prevMonthDays - i),
      dayOfMonth: prevMonthDays - i,
      isCurrentMonth: false,
      isToday: false,
      events: []
    })
  }

  // Add days of the current month
  for (let i = 1; i <= numDays; i++) {
    const date = new Date(currentYear.value, currentMonth.value, i)
    const isToday = date.toDateString() === today.toDateString()
    days.push({
      date: date,
      dayOfMonth: i,
      isCurrentMonth: true,
      isToday: isToday,
      events: props.events.filter(event => {
        const eventDate = new Date(event.start); // 使用 event.start
        return eventDate.getFullYear() === currentYear.value &&
               eventDate.getMonth() === currentMonth.value &&
               eventDate.getDate() === i;
      })
    })
  }

  // Add trailing empty days from next month
  const remainingDays = 42 - days.length // Show 6 weeks total
  for (let i = 1; i <= remainingDays; i++) {
    days.push({
      date: new Date(currentYear.value, currentMonth.value + 1, i),
      dayOfMonth: i,
      isCurrentMonth: false,
      isToday: false,
      events: []
    })
  }
  return days
})

const prevMonth = () => {
  if (currentMonth.value === 0) {
    currentMonth.value = 11
    currentYear.value--
  } else {
    currentMonth.value--
  }
}

const nextMonth = () => {
  if (currentMonth.value === 11) {
    currentMonth.value = 0
    currentYear.value++
  } else {
    currentMonth.value++
  }
}

const isModalOpen = ref(false)
const isEditing = ref(false)
const selectedEvent = ref(null)
const editingEvent = ref(null)

const viewEvent = (event) => {
  selectedEvent.value = {
    ...event,
    date: event.start, // 將 date 屬性設置為 event.start，方便 formatDate 處理
    description: event.extendedProps?.notes || '無',
    caseId: event.extendedProps?.caseId || '無'
  }
  editingEvent.value = JSON.parse(JSON.stringify(selectedEvent.value)) // 複製一份用於編輯
  isEditing.value = false // 預設為非編輯模式
  isModalOpen.value = true
}

const startEditing = () => {
  isEditing.value = true
}

const cancelEditing = () => {
  editingEvent.value = JSON.parse(JSON.stringify(selectedEvent.value)) // 取消編輯時重置
  isEditing.value = false
}

const saveEvent = async () => {
  const previousStatus = selectedEvent.value.extendedProps?.status
  const newStatus = editingEvent.value.extendedProps?.status

  emit('updateEvent', editingEvent.value) // 發送更新事件給父組件
  selectedEvent.value = editingEvent.value // 更新顯示的事件
  isEditing.value = false

  // 如果狀態從其他狀態改為「已聯絡」，提示並跳轉到追蹤紀錄頁面
  if (previousStatus !== 'contacted' && newStatus === 'contacted') {
    closeModal()

    // 使用 Nuxt 的 notification 和 router
    const { success } = useNotification()
    const router = useRouter()

    success('行程已標記為已聯絡，請填寫追蹤紀錄')

    // 延遲一下讓通知顯示，然後跳轉並帶上案件ID和客戶名稱參數
    setTimeout(() => {
      router.push({
        path: '/cases/tracking/tracking-records',
        query: {
          caseId: editingEvent.value.extendedProps?.caseId,
          autoCreate: 'true'
        }
      })
    }, 1000)
  }
}

const closeModal = () => {
  isModalOpen.value = false
  selectedEvent.value = null
  editingEvent.value = null
  isEditing.value = false
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('zh-TW', { year: 'numeric', month: 'long', day: 'numeric' })
}
</script>

<style scoped>
/* 可以添加一些自定義樣式 */
</style>
