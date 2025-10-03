export const useSidebarBadges = () => {
  const { get } = useApi()
  
  // Reactive state for badges (根據案件狀態動態計數)
  const badges = ref({
    // 網路進線
    pending: 0,

    // 網路進線管理
    valid_customer: 0,
    invalid_customer: 0,
    customer_service: 0,
    blacklist: 0,

    // 送件管理
    approved_disbursed: 0,
    approved_undisbursed: 0,
    conditional_approval: 0,
    declined: 0,

    // 追蹤管理
    tracking: 0,

    // 其他
    contact_reminders: 0
  })
  
  const loading = ref(false)
  
  // Get count for a specific status
  const getCount = async (status) => {
    try {
      const { data, error } = await get('/leads', {
        case_status: status,  // 使用 case_status 參數
        page: 1,
        per_page: 1
      })
      if (!error && data) {
        return data.total || 0
      }
      return 0
    } catch (err) {
      console.warn(`Failed to get ${status} count:`, err)
      return 0
    }
  }
  
  // Get pending count specifically (most important)
  const getPendingCount = async () => {
    const count = await getCount('pending')
    badges.value.pending = count
    return count
  }

  // Get contact reminders count (overdue + need reminder)
  const getContactRemindersCount = async () => {
    try {
      const [overdueRes, reminderRes] = await Promise.all([
        get('/contact-schedules/overdue/list'),
        get('/contact-schedules/reminders/list')
      ])

      let count = 0
      // Check for successful responses and handle 401 gracefully
      if (overdueRes && !overdueRes.error && overdueRes.data) {
        if (Array.isArray(overdueRes.data)) {
          count += overdueRes.data.length
        }
      }
      if (reminderRes && !reminderRes.error && reminderRes.data) {
        if (Array.isArray(reminderRes.data)) {
          count += reminderRes.data.length
        }
      }

      badges.value.contact_reminders = count
      return count
    } catch (err) {
      // Silently handle errors - these APIs require authentication
      // and may fail if user is not logged in
      badges.value.contact_reminders = 0
      return 0
    }
  }
  
  // Get all badge counts (根據所有案件狀態) - 優化為只在需要時載入
  const refreshAllBadges = async () => {
    if (loading.value) return

    loading.value = true
    try {
      // 只獲取最重要的幾個徽章，減少 API 請求
      const [
        pending,
        tracking,
        contactReminders
      ] = await Promise.all([
        getCount('pending'),
        getCount('tracking'),
        getContactRemindersCount()
      ])

      badges.value = {
        pending,
        valid_customer: 0,  // 延遲載入，需要時才獲取
        invalid_customer: 0,
        customer_service: 0,
        blacklist: 0,
        approved_disbursed: 0,
        approved_undisbursed: 0,
        conditional_approval: 0,
        declined: 0,
        tracking,
        contact_reminders: contactReminders
      }
    } catch (err) {
      console.error('Failed to refresh badges:', err)
    } finally {
      loading.value = false
    }
  }
  
  // Initialize badges on mount
  let pollInterval = null
  
  const startPolling = (intervalMs = 30000) => { // Poll every 30 seconds
    stopPolling()
    refreshAllBadges() // Initial load
    pollInterval = setInterval(refreshAllBadges, intervalMs)
  }
  
  const stopPolling = () => {
    if (pollInterval) {
      clearInterval(pollInterval)
      pollInterval = null
    }
  }
  
  // Manual refresh function
  const refreshBadges = async () => {
    await refreshAllBadges()
  }
  
  // Cleanup on unmount
  onUnmounted(() => {
    stopPolling()
  })
  
  return {
    badges: readonly(badges),
    loading: readonly(loading),
    refreshBadges,
    getPendingCount,
    startPolling,
    stopPolling
  }
}