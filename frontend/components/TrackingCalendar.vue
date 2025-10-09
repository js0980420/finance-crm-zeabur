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
        <h3 class="text-lg font-semibold mb-4">追蹤事件詳情</h3>
        <div v-if="selectedEvent" class="space-y-3">
          <p><strong>案件:</strong> {{ selectedEvent.title }}</p>
          <p><strong>排程日期:</strong> {{ formatDate(selectedEvent.start) }}</p>
          <p>
            <strong>狀態:</strong>
            <span
              class="inline-block px-2 py-1 rounded text-sm font-medium ml-2"
              :class="{
                'bg-blue-100 text-blue-800': selectedEvent.extendedProps?.status === 'scheduled' || !selectedEvent.extendedProps?.status,
                'bg-green-100 text-green-800': selectedEvent.extendedProps?.status === 'contacted',
                'bg-yellow-100 text-yellow-800': selectedEvent.extendedProps?.status === 'rescheduled'
              }"
            >
              {{ getStatusLabel(selectedEvent.extendedProps?.status) }}
            </span>
          </p>
          <p v-if="selectedEvent.extendedProps?.notes"><strong>備註:</strong> {{ selectedEvent.extendedProps.notes }}</p>

          <!-- 改期日期選擇器(只在點擊改期按鈕後顯示) -->
          <div v-if="isRescheduling" class="border-t pt-3 mt-3">
            <label class="block text-sm font-semibold text-gray-900 mb-2">選擇新的追蹤日期</label>
            <input
              type="date"
              v-model="newScheduleDate"
              :min="getTodayDateString()"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            />
          </div>
        </div>
        <div class="mt-6 flex justify-end space-x-2">
          <!-- 只有待聯絡狀態才顯示已聯絡和改期按鈕 -->
          <template v-if="selectedEvent?.extendedProps?.status === 'scheduled' || !selectedEvent?.extendedProps?.status">
            <button
              v-if="!isRescheduling"
              @click="markAsContacted"
              class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"
            >
              已聯絡
            </button>
            <button
              v-if="!isRescheduling"
              @click="startRescheduling"
              class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700"
            >
              改期
            </button>
            <button
              v-if="isRescheduling"
              @click="confirmReschedule"
              class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
            >
              確認改期
            </button>
            <button
              v-if="isRescheduling"
              @click="cancelRescheduling"
              class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400"
            >
              取消
            </button>
          </template>
          <button
            v-if="!isRescheduling"
            @click="closeModal"
            class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300"
          >
            關閉
          </button>
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
const isRescheduling = ref(false)
const selectedEvent = ref(null)
const newScheduleDate = ref('')

const viewEvent = (event) => {
  selectedEvent.value = {
    ...event,
    date: event.start,
    description: event.extendedProps?.notes || '無',
    caseId: event.extendedProps?.caseId || '無'
  }
  isRescheduling.value = false
  newScheduleDate.value = ''
  isModalOpen.value = true
}

const markAsContacted = async () => {
  const updatedEvent = {
    ...selectedEvent.value,
    extendedProps: {
      ...selectedEvent.value.extendedProps,
      status: 'contacted',
      contacted_at: new Date().toISOString()
    }
  }

  emit('updateEvent', updatedEvent)
  selectedEvent.value = updatedEvent
  closeModal()

  const { success } = useNotification()
  const router = useRouter()

  success('行程已標記為已聯絡，請填寫追蹤紀錄')

  setTimeout(() => {
    router.push({
      path: '/cases/tracking/tracking-records',
      query: {
        caseId: selectedEvent.value.extendedProps?.caseId,
        autoCreate: 'true'
      }
    })
  }, 1000)
}

const startRescheduling = () => {
  isRescheduling.value = true
  newScheduleDate.value = ''
}

const cancelRescheduling = () => {
  isRescheduling.value = false
  newScheduleDate.value = ''
}

const confirmReschedule = () => {
  if (!newScheduleDate.value) {
    const { error } = useNotification()
    error('請選擇新的追蹤日期')
    return
  }

  const updatedEvent = {
    ...selectedEvent.value,
    extendedProps: {
      ...selectedEvent.value.extendedProps,
      status: 'rescheduled',
      rescheduled_to: newScheduleDate.value
    }
  }

  emit('updateEvent', updatedEvent)

  // 建立新的追蹤排程
  const newEvent = {
    start: newScheduleDate.value,
    title: selectedEvent.value.title,
    extendedProps: {
      ...selectedEvent.value.extendedProps,
      status: 'scheduled',
      rescheduled_from_id: selectedEvent.value.id
    }
  }

  emit('createEvent', newEvent)

  const { success } = useNotification()
  success('追蹤已改期')
  closeModal()
}

const getTodayDateString = () => {
  const today = new Date()
  const year = today.getFullYear()
  const month = String(today.getMonth() + 1).padStart(2, '0')
  const day = String(today.getDate()).padStart(2, '0')
  return `${year}-${month}-${day}`
}

const closeModal = () => {
  isModalOpen.value = false
  selectedEvent.value = null
  isRescheduling.value = false
  newScheduleDate.value = ''
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('zh-TW', { year: 'numeric', month: 'long', day: 'numeric' })
}
</script>

<style scoped>
/* 可以添加一些自定義樣式 */
</style>
