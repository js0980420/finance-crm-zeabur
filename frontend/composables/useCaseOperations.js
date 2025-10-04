import { reactive, computed } from 'vue'
import { useApi } from './useApi'
import { useNotification } from '~/composables/useNotification'
import { useSidebarBadges } from '~/composables/useSidebarBadges'
import { CASE_STATUS_OPTIONS, STATUS_ROUTE_MAP } from './useCaseConfig'
import { PURPOSE_OPTIONS, WEBSITE_OPTIONS } from './useCaseConfig'

/**
 * 案件操作函數
 * 包含所有 CRUD 操作、狀態管理和分頁邏輯
 */
export const useCaseOperations = () => {
  const { success, error: showError } = useNotification()
  const { refreshBadges } = useSidebarBadges()
  const authStore = useAuthStore()
  const { get, post, put, patch, delete: remove } = useApi()

  // --- State for Tracking Page ---
  const state = reactive({
    cases: [], // All cases fetched
    paginatedCases: [], // Cases for current page
    currentPage: 1,
    itemsPerPage: 10,
    searchQuery: '',
    selectedStatus: '', // For filtering by status
    sortKey: 'application_date', // Default sort key
    sortOrder: 'desc', // Default sort order
    calendarEvents: [], // Events for the calendar
  })

  // --- Computed properties for Tracking Page ---
  const filteredCases = computed(() => {
    let tempCases = state.cases

    // Filter by search query
    if (state.searchQuery) {
      const query = state.searchQuery.toLowerCase()
      tempCases = tempCases.filter(caseItem =>
        caseItem.name.toLowerCase().includes(query) ||
        caseItem.id.toString().includes(query) ||
        caseItem.case_type.toLowerCase().includes(query)
      )
    }

    // Filter by status
    if (state.selectedStatus) {
      tempCases = tempCases.filter(caseItem => caseItem.case_status === state.selectedStatus)
    }
    return tempCases
  })

  const sortedCases = computed(() => {
    const sortableCases = [...filteredCases.value] // Use filtered cases
    if (state.sortKey) {
      sortableCases.sort((a, b) => {
        const aValue = a[state.sortKey]
        const bValue = b[state.sortKey]

        if (aValue < bValue) return state.sortOrder === 'asc' ? -1 : 1
        if (aValue > bValue) return state.sortOrder === 'asc' ? 1 : -1
        return 0
      })
    }
    return sortableCases
  })

  const totalPages = computed(() => {
    return Math.ceil(sortedCases.value.length / state.itemsPerPage)
  })

  // --- Methods for Tracking Page ---
  const paginateCases = () => {
    const start = (state.currentPage - 1) * state.itemsPerPage
    const end = start + state.itemsPerPage
    state.paginatedCases = sortedCases.value.slice(start, end)
  }

  const fetchCases = async () => {
    // This should fetch cases relevant to tracking, e.g., 'tracking' status
    const fetched = await loadCasesByStatus('tracking')
    state.cases = fetched.map(c => ({
      id: c.id,
      name: c.customer_name,
      case_type: c.payload?.['貸款需求'] || '未知',
      application_date: new Date(c.created_at).toLocaleDateString('zh-TW'),
      case_status: c.case_status || '追蹤中',
      original_case: c // Keep original case data if needed for other operations
    }))
    state.currentPage = 1 // Reset to first page on new fetch
    paginateCases()
  }

  const setSort = (key) => {
    if (state.sortKey === key) {
      state.sortOrder = state.sortOrder === 'asc' ? 'desc' : 'asc'
    } else {
      state.sortKey = key
      state.sortOrder = 'asc'
    }
    paginateCases() // Re-paginate after sort
  }

  const goToPage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
      state.currentPage = page
      paginateCases()
    }
  }

  const nextPage = () => {
    if (state.currentPage < totalPages.value) {
      state.currentPage++
      paginateCases()
    }
  }

  const prevPage = () => {
    if (state.currentPage > 1) {
      state.currentPage--
      paginateCases()
    }
  }

  const updateItemsPerPage = (newItemsPerPage) => {
    state.itemsPerPage = newItemsPerPage
    state.currentPage = 1 // Reset to first page
    paginateCases()
  }

  // --- Calendar Events ---
  const fetchCalendarEvents = async () => {
    // 從真實 API 載入行事曆事件
    const { get } = useApi()
    const { data, error } = await get('/contact-schedules/calendar')

    if (error) {
      console.error('Failed to fetch calendar events:', error)
      state.calendarEvents = []
      return
    }

    state.calendarEvents = data?.data || []
  }

  /**
   * 載入指定狀態的案件
   */
  const loadCasesByStatus = async (caseStatus, searchQuery = '', assignedTo = null) => {
    console.log('=== loadCasesByStatus 開始 ===')
    console.log('查詢狀態:', caseStatus)

    // API 模式邏輯
    console.log('使用真實 API 模式查詢案件')
    const { data, error } = await get('/cases', { case_status: caseStatus, per_page: 1000 })
    if (error) {
      console.error('載入案件失敗:', error)
      return []
    }
    const apiCases = data.data || []  // Laravel pagination 使用 data 陣列，不是 items

    // 計算並返回過濾後的案件
    console.log('API 模式載入的案件總數:', apiCases.length)
    console.log('所有案件 (API 模式): ', apiCases.map(c => ({ id: c.id, customer_name: c.customer_name, case_status: c.case_status })))

    const filteredCases = apiCases.filter(caseItem => {
      const matchesStatus = (!caseStatus || caseItem.case_status === caseStatus)
      const matchesSearch = !searchQuery ||
        caseItem.customer_name?.toLowerCase().includes(searchQuery.toLowerCase()) ||
        caseItem.email?.toLowerCase().includes(searchQuery.toLowerCase()) ||
        caseItem.mobile_phone?.includes(searchQuery) ||
        caseItem.line_id?.toLowerCase().includes(searchQuery.toLowerCase())
      const matchesAssignee = !assignedTo || assignedTo === 'all' || (assignedTo === 'null' ? !caseItem.assigned_to : caseItem.assigned_to === parseInt(assignedTo))
      return matchesStatus && matchesSearch && matchesAssignee
    })

    return filteredCases
  }

  /**
   * 新增案件
   */
  const addCase = async (caseData) => {
    console.log('=== useCaseOperations addCase 開始 ===')
    console.log('接收到的 caseData:', caseData)
    console.log('使用真實 API 模式新增案件')

    // 統一使用標準欄位名稱，完全匹配後端 API 和資料庫結構
    const apiPayload = {
      customer_name: caseData.customer_name,
      phone: caseData.phone,
      email: caseData.email,
      loan_purpose: caseData.loan_purpose,
      channel: caseData.channel,  // 必填欄位
      website: caseData.website,
      assigned_to: caseData.assigned_to,
      case_status: caseData.case_status || 'pending',
      line_id: caseData.line_id,
      line_display_name: caseData.line_display_name,
      business_level: caseData.business_level,
      notes: caseData.notes
    }

    // 移除值為 null, undefined 或空字串的欄位
    // 避免傳送空字串給後端造成驗證錯誤
    Object.keys(apiPayload).forEach(key => {
      const value = apiPayload[key]
      if (value === null || value === undefined || value === '') {
        delete apiPayload[key]
      }
    })

    console.log('API payload (標準格式):', apiPayload)

    const { data, error } = await post('/leads', apiPayload)
    if (error) {
      console.log('❌ API 新增進線失敗:', error)
      console.log('後端驗證錯誤詳情:', error.errors)
      console.log('錯誤訊息:', error.message)
      return { success: false, error }
    }
    await refreshBadges()
    console.log('✅ API 新增進線成功:', data)
    return { success: true, data }
  }

  /**
   * 更新案件狀態
   */
  const updateCaseStatus = async (caseId, newStatus, shouldNavigate = true) => {
    try {
      // API 模式邏輯
      const { data, error } = await patch(`/cases/${caseId}/status`, { case_status: newStatus })

      if (error) {
        showError('更新案件狀態失敗')
        return { success: false, error }
      }

      const statusLabel = CASE_STATUS_OPTIONS.find(opt => opt.value === newStatus)?.label
      success(`案件狀態已更新為：${statusLabel}`)

      await refreshBadges()

      if (shouldNavigate) {
        const targetRoute = STATUS_ROUTE_MAP[newStatus]
        if (targetRoute && targetRoute !== useRoute().path) {
          await navigateTo(targetRoute)
        }
      }

      return { success: true, data }
    } catch (error) {
      showError('更新狀態失敗，請稍後再試')
      console.error('Update case status error:', error)
      return { success: false, error }
    }
  }

  /**
   * 更新業務等級
   */
  const updateBusinessLevel = async (caseId, newLevel) => {
    try {
      // API 模式邏輯
      const { data, error } = await patch(`/cases/${caseId}/business-level`, { business_level: newLevel })

      if (error) {
        showError('更新業務等級失敗')
        return { success: false, error }
      }

      success(`業務等級已更新為：${newLevel}級`)
      return { success: true, data }
    } catch (error) {
      showError('更新業務等級失敗，請稍後再試')
      console.error('Update business level error:', error)
      return { success: false, error }
    }
  }

  /**
   * 更新諮詢項目
   */
  const updatePurpose = async (caseId, newPurpose) => {
    try {
      const { updateOne } = useCases()
      const { error } = await updateOne(caseId, { loan_purpose: newPurpose })

      if (error) {
        showError('更新諮詢項目失敗')
        return { success: false, error }
      }

      const purposeLabel = PURPOSE_OPTIONS.find(opt => opt.value === newPurpose)?.label || newPurpose
      success(`諮詢項目已更新為：${purposeLabel}`)
      return { success: true }
    } catch (error) {
      showError('更新諮詢項目失敗，請稍後再試')
      console.error('Update purpose error:', error)
      return { success: false, error }
    }
  }

  /**
   * 更新網站
   */
  const updateWebsite = async (item, newWebsite) => {
    try {
      const { updateOne } = useCases()

      // 更新 payload 中的網站資訊
      const updatedPayload = {
        ...(item.payload || {}),
        '頁面_URL': newWebsite
      }

      const { error } = await updateOne(item.id, {
        payload: updatedPayload,
        website: newWebsite
      })

      if (error) {
        showError('更新網站失敗')
        return { success: false, error }
      }

      const websiteLabel = WEBSITE_OPTIONS.find(opt => opt.value === newWebsite)?.label || newWebsite
      success(`網站已更新為：${websiteLabel}`)
      return { success: true }
    } catch (error) {
      showError('更新網站失敗，請稍後再試')
      console.error('Update website error:', error)
      return { success: false, error }
    }
  }

  /**
   * 刪除案件
   */
  const deleteCase = async (caseId) => {
    // API 模式邏輯
    const { data, error } = await remove(`/cases/${caseId}`)

    if (error) {
      showError('刪除案件失敗')
      return { success: false, error }
    }

    success('案件已刪除')
    await refreshBadges()
    return { success: true, data }
  }

  return {
    // State
    state,
    filteredCases,
    sortedCases,
    totalPages,

    // CRUD operations
    loadCasesByStatus,
    addCase,
    updateCaseStatus,
    updateBusinessLevel,
    updatePurpose,
    updateWebsite,
    deleteCase,

    // Pagination and sorting
    fetchCases,
    setSort,
    goToPage,
    nextPage,
    prevPage,
    updateItemsPerPage,
    paginateCases,

    // Calendar
    fetchCalendarEvents
  }
}
