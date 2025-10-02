import { ref, computed, reactive } from 'vue'
import { useMockDataStore } from '~/stores/mockData'
import { useNotification } from '~/composables/useNotification'
import { useSidebarBadges } from '~/composables/useSidebarBadges'

/**
 * 統一的案件管理可組合函數
 * 處理所有案件的 CRUD 操作、狀態切換、路由導航等
 */
export const useCaseManagement = () => {
  const config = useRuntimeConfig()
  const { success, error: showError } = useNotification()
  const { refreshBadges } = useSidebarBadges()
  const mockDataStore = useMockDataStore()

  // --- State for Tracking Page (New) ---
  const state = reactive({
    cases: [], // All cases fetched
    paginatedCases: [], // Cases for current page
    currentPage: 1,
    itemsPerPage: 10,
    searchQuery: '',
    selectedStatus: '', // For filtering by status
    sortKey: 'application_date', // Default sort key
    sortOrder: 'desc', // Default sort order
    calendarEvents: [], // New: Events for the calendar
  });

  // --- Computed properties for Tracking Page (New) ---
  const filteredCases = computed(() => {
    let tempCases = state.cases;

    // Filter by search query
    if (state.searchQuery) {
      const query = state.searchQuery.toLowerCase();
      tempCases = tempCases.filter(caseItem =>
        caseItem.name.toLowerCase().includes(query) ||
        caseItem.id.toString().includes(query) ||
        caseItem.case_type.toLowerCase().includes(query)
      );
    }

    // Filter by status
    if (state.selectedStatus) {
      tempCases = tempCases.filter(caseItem => caseItem.status === state.selectedStatus);
    }
    return tempCases;
  });

  const sortedCases = computed(() => {
    const sortableCases = [...filteredCases.value]; // Use filtered cases
    if (state.sortKey) {
      sortableCases.sort((a, b) => {
        const aValue = a[state.sortKey];
        const bValue = b[state.sortKey];

        if (aValue < bValue) return state.sortOrder === 'asc' ? -1 : 1;
        if (aValue > bValue) return state.sortOrder === 'asc' ? 1 : -1;
        return 0;
      });
    }
    return sortableCases;
  });

  const totalPages = computed(() => {
    return Math.ceil(sortedCases.value.length / state.itemsPerPage);
  });

  // --- Methods for Tracking Page (New) ---
  const paginateCases = () => {
    const start = (state.currentPage - 1) * state.itemsPerPage;
    const end = start + state.itemsPerPage;
    state.paginatedCases = sortedCases.value.slice(start, end);
  };

  const fetchCases = async () => {
    // This should fetch cases relevant to tracking, e.g., 'tracking' status
    const fetched = await loadCasesByStatus('tracking'); // Assuming loadCasesByStatus can fetch 'tracking' cases
    state.cases = fetched.map(c => ({
      id: c.id,
      name: c.customer_name,
      case_type: c.payload?.['貸款需求'] || '未知', // Assuming case_type comes from payload
      application_date: new Date(c.created_at).toLocaleDateString('zh-TW'),
      status: c.case_status || '追蹤中', // Assuming status is case_status
      original_case: c // Keep original case data if needed for other operations
    }));
    state.currentPage = 1; // Reset to first page on new fetch
    paginateCases();
  };

  const setSort = (key) => {
    if (state.sortKey === key) {
      state.sortOrder = state.sortOrder === 'asc' ? 'desc' : 'asc';
    } else {
      state.sortKey = key;
      state.sortOrder = 'asc';
    }
    paginateCases(); // Re-paginate after sort
  };

  const goToPage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
      state.currentPage = page;
      paginateCases();
    }
  };

  const nextPage = () => {
    if (state.currentPage < totalPages.value) {
      state.currentPage++;
      paginateCases();
    }
  };

  const prevPage = () => {
    if (state.currentPage > 1) {
      state.currentPage--;
      paginateCases();
    }
  };

  const updateItemsPerPage = (newItemsPerPage) => {
    state.itemsPerPage = newItemsPerPage;
    state.currentPage = 1; // Reset to first page
    paginateCases();
  };

  // --- Calendar Events (New) ---
  const fetchCalendarEvents = async () => {
    // Mock data for calendar events
    // In a real app, this would be an API call
    const mockEvents = [
      { id: 1, title: '案件追蹤 - 王小明', date: '2025-09-10', description: '電話追蹤進度', caseId: 101 },
      { id: 2, title: '案件追蹤 - 陳大華', date: '2025-09-15', description: '安排面談', caseId: 102 },
      { id: 3, title: '案件追蹤 - 林美麗', date: '2025-09-20', description: '提交文件', caseId: 103 },
      { id: 4, title: '案件追蹤 - 張志明', date: '2025-10-05', description: '客戶回訪', caseId: 104 },
      { id: 5, title: '案件追蹤 - 李曉芬', date: '2025-10-12', description: '更新狀態', caseId: 105 },
    ];
    state.calendarEvents = mockEvents;
  };

  // 案件狀態到路由的映射
  const STATUS_ROUTE_MAP = {
    pending: '/cases',
    valid_customer: '/cases/valid-customer',
    invalid_customer: '/cases/invalid-customer',
    customer_service: '/cases/customer-service',
    blacklist: '/cases/blacklist',
    approved_disbursed: '/cases/approved-disbursed',
    approved_undisbursed: '/cases/approved-undisbursed',
    conditional_approval: '/cases/conditional-approval',
    declined: '/cases/rejected',
    tracking: '/cases/tracking'
  }

  // ⚠️ 狀態映射已移除
  // 後端 API 現在統一使用前端友善的狀態名稱（pending, valid_customer 等）
  // 資料庫內部的映射（unassigned ↔ pending）由後端 CaseMapper 和 CaseResource 處理
  // 前端不再需要知道資料庫的欄位名稱

  // 案件狀態選項 (按照業務流程順序排列)
  const CASE_STATUS_OPTIONS = [
    // 網路進線 (1種)
    { value: 'pending', label: '待處理', category: 'leads', backendValue: 'unassigned' },

    // 網路進線管理 (4種)
    { value: 'valid_customer', label: '有效客', category: 'leads_management', backendValue: 'valid_customer' },
    { value: 'invalid_customer', label: '無效客', category: 'leads_management', backendValue: 'invalid_customer' },
    { value: 'customer_service', label: '客服', category: 'leads_management', backendValue: 'customer_service' },
    { value: 'blacklist', label: '黑名單', category: 'leads_management', backendValue: 'blacklist' },

    // 送件管理 (4種)
    { value: 'approved_disbursed', label: '核准撥款', category: 'case_management' },
    { value: 'approved_undisbursed', label: '核准未撥', category: 'case_management' },
    { value: 'conditional_approval', label: '附條件', category: 'case_management' },
    { value: 'declined', label: '婉拒', category: 'case_management' },

    // 業務管理 (1種)
    { value: 'tracking', label: '追蹤中', category: 'sales_tracking' }
  ]

  // 來源管道選項
  const CHANNEL_OPTIONS = [
    { value: 'wp_form', label: '網站表單' },
    { value: 'lineoa', label: '官方LINE' },
    { value: 'email', label: 'email' },
    { value: 'phone', label: '專線' }
  ]

  // 業務等級選項
  const BUSINESS_LEVEL_OPTIONS = [
    { value: 'A', label: 'A級' },
    { value: 'B', label: 'B級' },
    { value: 'C', label: 'C級' }
  ]

  // 諮詢項目選項
  const PURPOSE_OPTIONS = [
    { value: '房屋貸款', label: '房屋貸款' },
    { value: '企業貸款', label: '企業貸款' },
    { value: '個人信貸', label: '個人信貸' },
    { value: '汽車貸款', label: '汽車貸款' },
    { value: '其他', label: '其他' }
  ]

  // 網路進線適用的案件狀態選項 (只包含網路進線相關的狀態)
  const CASE_STATUS_NAVIGATION_OPTIONS = CASE_STATUS_OPTIONS.filter(opt =>
    ['leads', 'leads_management'].includes(opt.category)
  ).map(opt => ({
    ...opt,
    route: {
      'pending': '/cases',
      'valid_customer': '/cases/valid-customer',
      'invalid_customer': '/cases/invalid-customer',
      'customer_service': '/cases/customer-service',
      'blacklist': '/cases/blacklist'
    }[opt.value] || '/cases'
  }))

  // 網站選項
  const WEBSITE_OPTIONS = Array.from({ length: 10 }, (_, i) => ({
    value: `G${i + 1}`,
    label: `G${i + 1}`
  }))

  /**
   * 載入指定狀態的案件
   */
  const loadCasesByStatus = async (status) => {
    console.log('=== loadCasesByStatus 開始 ===')
    console.log('查詢狀態:', status)
    console.log('🔍 實際 config.public.apiBaseUrl:', config.public.apiBaseUrl)
    console.log('🔍 比較結果:', config.public.apiBaseUrl === '/mock-api')
    console.log('💡 強制使用 Mock API 模式進行測試')

    // 臨時強制使用 Mock API 進行測試
    if (true) {
      console.log('使用 Mock API 模式查詢案件')
      console.log('mockDataStore.cases 總數:', mockDataStore.cases.length)
      console.log('所有案件:', mockDataStore.cases.map(c => ({ id: c.id, name: c.customer_name, status: c.case_status || c.status })))

      const filteredCases = mockDataStore.cases.filter(caseItem => {
        const caseStatus = caseItem.case_status || caseItem.status || 'pending'
        const matches = caseStatus === status
        console.log(`案件 ${caseItem.id} (${caseItem.customer_name}): status=${caseStatus}, matches=${matches}`)
        return matches
      })

      console.log(`過濾後的 ${status} 案件:`, filteredCases.map(c => ({ id: c.id, name: c.customer_name, status: c.case_status || c.status })))
      console.log('=== loadCasesByStatus 完成 (Mock) ===')
      return filteredCases
    }

    // API 模式邏輯
    console.log('使用真實 API 模式查詢案件')
    const { get } = useApi()
    const { data, error } = await get('/cases', { case_status: status, per_page: 1000 })
    if (error) {
      console.error('❌ 載入案件失敗:', error)
      return []
    }
    console.log('=== loadCasesByStatus 完成 (API) ===')
    return data.items || []
  }

  /**
   * 新增案件
   */
  const addCase = async (caseData) => {
    console.log('=== useCaseManagement addCase 開始 ===')
    console.log('接收到的 caseData:', caseData)
    console.log('使用真實 API 模式新增案件')

    // 直接使用標準 API 欄位名稱，完全匹配資料庫結構
    const apiPayload = {
      customer_name: caseData.customer_name,
      customer_phone: caseData.phone || caseData.mobile_phone || caseData.customer_phone,
      customer_email: caseData.email || caseData.customer_email,
      consultation_item: caseData.consultation_items || caseData.loan_purpose || caseData.consultation_item,  // 前端用 consultation_items，資料庫用 consultation_item
      demand_amount: caseData.demand_amount,
      channel: caseData.source_channel || caseData.channel,  // 前端用 source_channel，資料庫用 channel
      website_source: caseData.website_domain || caseData.website || caseData.website_source,  // 前端用 website_domain，資料庫用 website_source
      assigned_to: caseData.assigned_to,
      status: caseData.case_status || caseData.status || 'pending',
      line_id: caseData.line_id,
      line_display_name: caseData.line_name || caseData.line_user_info?.display_name,  // 前端用 line_name，資料庫用 line_display_name
      notes: caseData.notes
    }

    // 移除值為 null、undefined 或空字串的欄位
    // 避免傳送空字串給後端造成驗證錯誤
    Object.keys(apiPayload).forEach(key => {
      const value = apiPayload[key]
      if (value === null || value === undefined || value === '') {
        delete apiPayload[key]
      }
    })

    console.log('API payload (標準格式):', apiPayload)

    const { post } = useApi()
    const { data, error } = await post('/cases', apiPayload)
    if (error) {
      console.log('❌ API 新增案件失敗:', error)
      console.log('後端驗證錯誤詳情:', error.errors)
      console.log('錯誤訊息:', error.message)
      return { success: false, error }
    }
    await refreshBadges()
    console.log('✅ API 新增案件成功:', data)
    return { success: true, data }
  }

  /**
   * 更新案件狀態
   */
  const updateCaseStatus = async (caseId, newStatus, shouldNavigate = true) => {
    try {
      if (config.public.apiBaseUrl === '/mock-api') {
        const updatedCase = mockDataStore.updateCaseStatus(caseId, newStatus)
        if (updatedCase) {
          const statusLabel = CASE_STATUS_OPTIONS.find(opt => opt.value === newStatus)?.label
          success(`案件狀態已更新為：${statusLabel}`)

          await refreshBadges()

          // 導航到對應頁面
          if (shouldNavigate) {
            const targetRoute = STATUS_ROUTE_MAP[newStatus]
            if (targetRoute && targetRoute !== useRoute().path) {
              await navigateTo(targetRoute)
            }
          }

          return { success: true, data: updatedCase }
        } else {
          showError('更新案件狀態失敗')
          return { success: false, error: '案件不存在' }
        }
      }

      // API 模式邏輯
      const { patch } = useApi()
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
      if (config.public.apiBaseUrl === '/mock-api') {
        const updatedCase = mockDataStore.updateCaseBusinessLevel(caseId, newLevel)
        if (updatedCase) {
          success(`業務等級已更新為：${newLevel}級`)
          return { success: true, data: updatedCase }
        } else {
          showError('更新業務等級失敗')
          return { success: false, error: '案件不存在' }
        }
      }

      // API 模式邏輯
      const { patch } = useApi()
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
   * 刪除案件
   */
  const deleteCase = async (caseId) => {
    if (config.public.apiBaseUrl === '/mock-api') {
      // Mock 模式暫不支持刪除，因為可能影響其他功能測試
      showError('Mock 模式不支持刪除案件')
      return { success: false, error: 'Mock 模式不支持刪除' }
    }

    // API 模式邏輯
    const { delete: del } = useApi()
    const { data, error } = await del(`/cases/${caseId}`)

    if (error) {
      showError('刪除案件失敗')
      return { success: false, error }
    }

    success('案件已刪除')
    await refreshBadges()
    return { success: true, data }
  }

  /**
   * 頁面與案件狀態對應表
   */
  const PAGE_CASE_STATUS_MAP = {
    // 網路進線管理 (1種)
    '/cases': 'pending',

    // 網路進線分類管理 (4種)
    '/cases/valid-customer': 'valid_customer',
    '/cases/invalid-customer': 'invalid_customer',
    '/cases/customer-service': 'customer_service',
    '/cases/blacklist': 'blacklist',

    // 送件管理 (4種)
    '/cases/approved-disbursed': 'approved_disbursed',
    '/cases/approved-undisbursed': 'approved_undisbursed',
    '/cases/conditional-approval': 'conditional_approval',
    '/cases/rejected': 'declined',

    // 業務追蹤管理 (1種) - 唯一有業務等級的頁面
    '/cases/tracking': 'tracking'
  }

  /**
   * 根據來源管道產生案件資料
   */
  const generateCaseByChannel = (channel, baseData = {}) => {
    const timestamp = Date.now()

    // 所有案件共同的基本資料
    const commonData = {
      customer_name: baseData.customer_name || `客戶${timestamp}`,
      created_at: new Date().toISOString(),
      assigned_to: null,
      channel: channel,
      ...baseData
    }

    // 根據來源管道設置特定欄位
    switch (channel) {
      case 'wp_form':
        return {
          ...commonData,
          email: baseData.email || `mock${timestamp}@example.com`,
          phone: baseData.phone || `09${String(Math.floor(Math.random() * 100000000)).padStart(8, '0')}`,
          line_id: null,
          source: baseData.source || `https://g${Math.floor(Math.random() * 10) + 1}.example.com`,
          payload: {
            '頁面_URL': baseData.source || `https://g${Math.floor(Math.random() * 10) + 1}.example.com`,
            '需求金額': Math.floor(Math.random() * 1000000) + 100000,
            '房屋地址': `假地址${Math.floor(Math.random() * 999)}號`,
            ...baseData.payload
          }
        }

      case 'lineoa':
        return {
          ...commonData,
          line_id: baseData.line_id || `U${timestamp}abcdef`,
          line_user_info: {
            display_name: baseData.customer_name || `LINE用戶${timestamp}`,
            picture_url: '/images/line-avatar-default.png',
            editable_name: baseData.customer_name || `LINE用戶${timestamp}`,
            ...baseData.line_user_info
          },
          email: null,
          phone: null,
          source: 'line',
          payload: {
            '聯絡方式': 'LINE',
            '所在地區': `地區${Math.floor(Math.random() * 999)}`,
            '資金需求': Math.floor(Math.random() * 1000000) + 100000,
            '貸款需求': '房屋貸款',
            ...baseData.payload
          }
        }

      case 'email':
        return {
          ...commonData,
          email: baseData.email || `customer${timestamp}@example.com`,
          phone: baseData.phone || `09${String(Math.floor(Math.random() * 100000000)).padStart(8, '0')}`,
          line_id: null,
          source: 'email',
          payload: {
            '聯絡方式': 'Email',
            '所在地區': `地區${Math.floor(Math.random() * 999)}`,
            '資金需求': Math.floor(Math.random() * 1000000) + 100000,
            '貸款需求': '信用貸款',
            ...baseData.payload
          }
        }

      case 'phone':
        return {
          ...commonData,
          phone: baseData.phone || `09${String(Math.floor(Math.random() * 100000000)).padStart(8, '0')}`,
          email: null,
          line_id: null,
          source: 'phone',
          payload: {
            '聯絡方式': '電話',
            '所在地區': `地區${Math.floor(Math.random() * 999)}`,
            '資金需求': Math.floor(Math.random() * 1000000) + 100000,
            '貸款需求': '個人信貸',
            ...baseData.payload
          }
        }

      default:
        return {
          ...commonData,
          email: `mock${timestamp}@example.com`,
          phone: `09${String(Math.floor(Math.random() * 100000000)).padStart(8, '0')}`,
          source: 'unknown',
          payload: {}
        }
    }
  }

  /**
   * 根據當前頁面產生新案件
   */
  const generateCaseForCurrentPage = (channel = 'wp_form', additionalData = {}) => {
    const currentPath = useRoute().path
    const caseStatus = PAGE_CASE_STATUS_MAP[currentPath] || 'pending'

    // 產生基本案件資料
    const caseData = generateCaseByChannel(channel, additionalData)

    // 設定案件狀態
    caseData.case_status = caseStatus

    // 只有追蹤管理頁面才設定業務等級
    if (currentPath === '/cases/tracking') {
      caseData.business_level = additionalData.business_level || 'A'
    }

    return caseData
  }

  /**
   * 根據案件來源渠道取得顯示名稱（不依賴網站資料）
   */
  const getDisplaySource = (item) => {
    if (!item) return '-'

    switch (item.channel) {
      case 'wp_form':
        // 對於網站表單，只顯示簡化的來源資訊
        const url = item.payload?.['頁面_URL'] || item.source
        if (url) {
          try {
            const domain = new URL(url).hostname
            return domain
          } catch {
            return url
          }
        }
        return '網站表單'

      case 'lineoa':
        return '官方LINE'

      case 'email':
        return 'Email'

      case 'phone':
        return '電話'

      default:
        return item.channel || '-'
    }
  }

  /**
   * 生成案件編號 - CASE年份末兩碼+月日+三碼流水號
   */
  const generateCaseNumber = (item) => {
    const date = new Date(item.created_at)
    const year = date.getFullYear().toString().slice(-2) // 年份末兩碼
    const month = String(date.getMonth() + 1).padStart(2, '0') // 月份
    const day = String(date.getDate()).padStart(2, '0') // 日期
    const serial = String(item.id).padStart(3, '0') // 三碼流水號使用item.id

    return `CASE${year}${month}${day}${serial}`
  }

  /**
   * 角色標籤轉換
   */
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

  const getChannelStyling = (channel) => {
    const style = {
      wp: { label: '網站表單', class: 'bg-blue-100 text-blue-800' },
      lineoa: { label: '官方賴', class: 'bg-green-100 text-green-800' },
      email: { label: 'Email', class: 'bg-purple-100 text-purple-800' },
      phone: { label: '電話', class: 'bg-orange-100 text-orange-800' }
    };
    return style[channel] || { label: channel || '-', class: 'bg-gray-100 text-gray-800' };
  }

  const getStatusStyling = (status) => {
    const style = {
      unassigned: { label: '未指派', class: 'bg-gray-100 text-gray-800' },
      valid_customer: { label: '有效客', class: 'bg-green-100 text-green-800' },
      invalid_customer: { label: '無效客', class: 'bg-red-100 text-red-800' },
      customer_service: { label: '客服', class: 'bg-blue-100 text-blue-800' },
      blacklist: { label: '黑名單', class: 'bg-black text-white' },
      approved_disbursed: { label: '核准撥款', class: 'bg-emerald-100 text-emerald-800' },
      approved_undisbursed: { label: '核准未撥', class: 'bg-yellow-100 text-yellow-800' },
      conditional_approval: { label: '附條件', class: 'bg-orange-100 text-orange-800' },
      rejected: { label: '婉拒', class: 'bg-red-100 text-red-800' },
      tracking_management: { label: '追蹤管理', class: 'bg-purple-100 text-purple-800' }
    };
    return style[status] || { label: status || '-', class: 'bg-gray-100 text-gray-800' };
  }

  const durationOptions = ['未滿三個月', '三個月至一年', '一年至三年', '三年至五年', '五年以上'];
  const taiwanCities = ['臺北市', '新北市', '桃園市', '臺中市', '臺南市', '高雄市', '基隆市', '新竹市', '嘉義市', '宜蘭縣', '新竹縣', '苗栗縣', '彰化縣', '南投縣', '雲林縣', '嘉義縣', '屏東縣', '花蓮縣', '臺東縣', '澎湖縣'];

  const HIDDEN_FIELDS_CONFIG = {
    personal: {
      title: '個人資料',
      fields: [
        { key: 'birth_date', label: '出生年月日', type: 'date' },
        { key: 'id_number', label: '身份證字號', type: 'text' },
        { key: 'education', label: '最高學歷', type: 'select', options: ['國小', '國中', '高中職', '專科', '大學', '碩士', '博士'] }
      ]
    },
    contact: {
      title: '聯絡資訊',
      fields: [
        { key: 'region', label: '所在地區', type: 'select', options: taiwanCities },
        { key: 'registered_address', label: '戶籍地址', type: 'text' },
        { key: 'home_phone', label: '室內電話', type: 'text' },
        { key: 'address_same', label: '通訊地址是否同戶籍地', type: 'boolean' },
        { key: 'mailing_address', label: '通訊地址', type: 'text' },
        { key: 'mobile_phone', label: '通訊電話', type: 'text' },
        { key: 'residence_duration', label: '現居地住多久', type: 'select', options: durationOptions },
        { key: 'residence_owner', label: '居住地持有人', type: 'text' },
        { key: 'telecom_provider', label: '電信業者', type: 'select', options: ['中華電信', '台灣大哥大', '遠傳電信'] }
      ]
    },
    other: {
      title: '其他資訊',
      fields: [
        { key: 'case_number', label: '進線編號', type: 'text', readonly: true },
        { key: 'required_amount', label: '需求金額', type: 'select', options: ['50萬以下', '50-100萬', '100-200萬', '200-300萬', '300-500萬', '500-800萬', '800-1000萬', '1000萬以上'] },
        { key: 'custom_fields', label: '自定義欄位', type: 'custom' }
      ]
    },
    company: {
      title: '公司資料',
      fields: [
        { key: 'company_email', label: '電子郵件', type: 'email' },
        { key: 'company_name', label: '公司名稱', type: 'text' },
        { key: 'company_phone', label: '公司電話', type: 'text' },
        { key: 'company_address', label: '公司地址', type: 'text' },
        { key: 'job_title', label: '職稱', type: 'text' },
        { key: 'monthly_income', label: '月收入', type: 'number' },
        { key: 'new_labor_insurance', label: '有無薪轉勞保', type: 'boolean' },
        { key: 'employment_duration', label: '目前公司在職多久', type: 'select', options: durationOptions }
      ]
    },
    emergency: {
      title: '緊急聯絡人',
      fields: [
        { key: 'contact1_name', label: '聯絡人①姓名', type: 'text' },
        { key: 'contact1_relationship', label: '聯絡人①關係', type: 'text' },
        { key: 'contact1_phone', label: '聯絡人①電話', type: 'text' },
        { key: 'contact1_available_time', label: '方便聯絡時間', type: 'select', options: ['早上 (08:00-12:00)', '下午 (12:00-18:00)', '晚上 (18:00-22:00)', '隨時', '平日上班時間', '假日'] },
        { key: 'contact1_confidential', label: '是否保密', type: 'boolean' },
        { key: 'contact2_name', label: '聯絡人②姓名', type: 'text' },
        { key: 'contact2_relationship', label: '聯絡人②關係', type: 'text' },
        { key: 'contact2_phone', label: '聯絡人②電話', type: 'text' },
        { key: 'contact2_confidential', label: '是否保密', type: 'boolean' },
        { key: 'contact2_available_time', label: '方便聯絡時間', type: 'select', options: ['早上 (08:00-12:00)', '下午 (12:00-18:00)', '晚上 (18:00-22:00)', '隨時', '平日上班時間', '假日'] },
        { key: 'referrer', label: '介紹人', type: 'text' }
      ]
    }
  }

  /**
   * 統一的表格欄位配置
   */
  const UNIFIED_TABLE_COLUMNS = [
    // 1. 案件狀態
    {
      key: "case_status",
      title: "案件狀態",
      sortable: true,
      width: "100px",
      hidden: false,
      type: "select",
      options: CASE_STATUS_OPTIONS,
      formatter: (value) => {
        const option = CASE_STATUS_OPTIONS.find(opt => opt.value === value)
        return option ? option.label : value || '待處理'
      }
    },
    // 2. 業務等級
    {
      key: "business_level",
      title: "業務等級",
      sortable: true,
      width: "100px",
      hidden: true,
      trackingOnly: true,
      type: "select",
      options: BUSINESS_LEVEL_OPTIONS,
      formatter: (value) => {
        const option = BUSINESS_LEVEL_OPTIONS.find(opt => opt.value === value)
        return option ? option.label : value || 'A級'
      }
    },
    // 3. 案件編號
    {
      key: "case_number",
      title: "案件編號",
      sortable: true,
      width: "130px",
      hidden: true,
      formatter: (value, item) => {
        if (value) return value
        const date = new Date(item.created_at)
        const year = date.getFullYear().toString().slice(-2)
        const month = String(date.getMonth() + 1).padStart(2, '0')
        const day = String(date.getDate()).padStart(2, '0')
        const serial = String(item.id).padStart(3, '0')
        return `CASE${year}${month}${day}${serial}`
      }
    },
    // 4. 時間
    {
      key: "datetime",
      title: "時間",
      sortable: true,
      width: "110px",
      hidden: false,
      formatter: (value, item) => {
        const dateTime = value || item.created_at
        if (!dateTime) return '-'
        const date = new Date(dateTime)
        const dateStr = date.toLocaleDateString('zh-TW', { year: 'numeric', month: '2-digit', day: '2-digit' })
        const timeStr = date.toLocaleTimeString('zh-TW', { hour: '2-digit', minute: '2-digit' })
        return `<div>${dateStr}</div><div>${timeStr}</div>`
      }
    },
    // 5. 承辦業務
    {
      key: "assignee",
      title: "承辦業務",
      sortable: true,
      width: "100px",
      hidden: false,
      type: "user_select",
      formatter: (value, item) => {
        return item.assignee?.name || '未指派'
      }
    },
    // 6. 來源管道
    {
      key: "channel",
      title: "來源管道",
      sortable: true,
      width: "100px",
      hidden: false,
      type: "select",
      options: CHANNEL_OPTIONS,
      formatter: (value) => {
        const option = CHANNEL_OPTIONS.find(opt => opt.value === value)
        return option ? option.label : value || '-'
      }
    },
    // 7. 姓名
    {
      key: "customer_name",
      title: "姓名",
      sortable: true,
      width: "100px",
      hidden: false,
      type: "text",  // 支援內聯文字編輯
      placeholder: "請輸入姓名",
      formatter: (value) => value || '-'
    },
    // 8. LINE資訊
    {
      key: "line_info",
      title: "LINE資訊",
      sortable: false,
      width: "140px",
      hidden: false,
      type: "line_info",
      formatter: (value, item) => {
        const displayName = item.line_display_name || item.line_user_info?.display_name || item.payload?.['LINE顯示名稱'] || ''
        const lineId = item.line_id || item.payload?.['LINE_ID'] || ''

        // Debug: 顯示實際資料
        console.log('LINE formatter:', {
          displayName,
          lineId,
          line_display_name: item.line_display_name,
          line_user_info: item.line_user_info,
          line_id: item.line_id
        })

        if (!displayName && !lineId) return '待輸入'
        const display = displayName ? `<div>${displayName}</div>` : ''
        const id = lineId ? `<div>${lineId}</div>` : ''
        return display + id
      }
    },
    // 9. 諮詢項目
    {
      key: "loan_purpose",  // 使用後端 API 欄位名稱
      title: "諮詢項目",
      sortable: false,
      width: "100px",
      hidden: false,
      type: "select",
      options: PURPOSE_OPTIONS,
      formatter: (value, item) => {
        return item.payload?.['貸款需求'] || value || '-'
      }
    },
    // 10. 網站
    {
      key: "website",  // 使用後端 API 欄位名稱
      title: "網站",
      sortable: false,
      width: "80px",
      hidden: false,
      type: "select",
      options: WEBSITE_OPTIONS,
      formatter: (value, item) => {
        const url = item.payload?.['頁面_URL'] || item.source || ''
        if (!url) return '-'
        try {
          const domain = new URL(url).hostname
          const match = domain.match(/^g(\d+)\./i)
          return match ? `G${match[1]}` : domain
        } catch {
          return url
        }
      }
    },
    // 11. 聯絡資訊
    {
      key: "contact_info",
      title: "聯絡資訊",
      sortable: false,
      width: "140px",
      hidden: false,
      formatter: (value, item) => {
        const email = item.email || ''
        const phone = item.phone || ''  // 統一使用 phone，後端已將所有手機號碼映射到此欄位

        if (!email && !phone) return '待輸入'
        const emailLine = email ? `<div>${email}</div>` : ''
        const phoneLine = phone ? `<div>${phone}</div>` : ''
        return emailLine + phoneLine
      }
    },
    // 12. 地區/地址
    {
      key: "location",
      title: "地區/地址",
      sortable: false,
      width: "130px",
      hidden: true,
      formatter: (value, item) => {
        const region = item.payload?.['所在地區'] || ''
        const address = item.payload?.['房屋地址'] || ''
        if (!region && !address) return '-'
        const parts = []
        if (region) parts.push(region)
        if (address) parts.push(address)
        return parts.join(' ')
      }
    },
    // 13. 需求金額
    {
      key: "amount",
      title: "需求金額",
      sortable: false,
      width: "110px",
      hidden: true,
      formatter: (value, item) => {
        const amount = item.payload?.['需求金額'] || item.payload?.['資金需求'] || value
        if (!amount) return '-'
        const numAmount = parseFloat(amount)
        if (isNaN(numAmount)) return amount
        return `${numAmount.toLocaleString('zh-TW')} 萬元`
      }
    },
    // 14. 自定義欄位
    {
      key: "custom_fields",
      title: "自定義欄位",
      sortable: false,
      width: "120px",
      hidden: true,
      formatter: () => '-'
    },
    // 15. 操作按鈕
    {
      key: "actions",
      title: "操作",
      sortable: false,
      width: "120px",
      hidden: false,
      type: "actions",
      align: "left",
      formatter: () => ''
    }
  ]

  /**
   * 根據頁面類型取得欄位配置
   */
  const getTableColumnsForPage = (pageType = 'default') => {
  // Start with a full copy of all possible columns
  const allColumns = JSON.parse(JSON.stringify(UNIFIED_TABLE_COLUMNS));

  // Define which columns are visible for each page type
  let visibleKeys = [];

  switch (pageType) {
    case 'pending': // 網路進線 (待處理)
      visibleKeys = [
        'case_status',
        'datetime',
        'assignee',
        'channel',
        'customer_name',
        'line_info',
        'purpose',
        'website_name',
        'contact_info',
        'actions'
      ];
      break;

    case 'tracking': // 追蹤管理 - 11個欄位（唯一有11個的頁面）
      visibleKeys = [
        'case_status',       // 1. 案件狀態
        'business_level',    // 2. 業務等級 (追蹤管理特有)
        'datetime',          // 3. 進線時間
        'assignee',          // 4. 承辦業務
        'channel',           // 5. 來源管道
        'customer_name',     // 6. 客戶姓名
        'line_info',         // 7. LINE資訊
        'purpose',           // 8. 諮詢項目
        'website_name',      // 9. 網站
        'contact_info',      // 10. 聯絡方式
        'actions'            // 11. 操作
      ];
      break;

    case 'valid_customer': // 有效客戶
    case 'invalid_customer': // 無效客戶
    case 'customer_service': // 客服
    case 'blacklist': // 黑名單
      visibleKeys = [
        'case_status',
        'datetime',
        'assignee',
        'channel',
        'customer_name',
        'line_info',
        'purpose',
        'contact_info',
        'actions'
      ];
      break;

    case 'approved_disbursed': // 核准撥款
    case 'approved_undisbursed': // 核准未撥
    case 'conditional_approval': // 附條件核准
    case 'declined': // 婉拒
      visibleKeys = [
        'case_status',
        'case_number',
        'datetime',
        'assignee',
        'customer_name',
        'line_info',
        'purpose',
        'amount',
        'actions'
      ];
      break;

    default:
      // Default visible columns if pageType doesn't match
      visibleKeys = [
        'case_status',
        'datetime',
        'assignee',
        'customer_name',
        'actions'
      ];
      break;
  }

  // Filter columns based on visibility
  const filteredColumns = allColumns.filter(col => visibleKeys.includes(col.key));

  // For tracking page, make business_level visible
  if (pageType === 'tracking') {
    const businessLevelColumn = filteredColumns.find(col => col.key === 'business_level');
    if (businessLevelColumn) {
      businessLevelColumn.hidden = false;
    }
  }

  // Find the actions column to customize its buttons
  const actionsColumn = filteredColumns.find(col => col.key === 'actions');

  if (actionsColumn) {
    switch (pageType) {
      case 'tracking':
        // 追蹤管理頁面：編輯、轉換、安排追蹤、進件（特有）
        actionsColumn.allowedActions = ['edit', 'convert', 'schedule', 'submit_lead'];
        break;

      case 'pending':
      case 'valid_customer':
      case 'invalid_customer':
      case 'customer_service':
      case 'blacklist':
      case 'approved_disbursed':
      case 'approved_undisbursed':
      case 'conditional_approval':
      case 'declined':
        // 其他頁面：只有查看、編輯、轉換，沒有安排追蹤和進件
        actionsColumn.allowedActions = ['view', 'edit', 'convert'];
        break;

      default:
        // 預設操作
        actionsColumn.allowedActions = ['view', 'edit'];
        break;
    }
  }

  return filteredColumns;
};

  /**
   * 產生新的假案件 (用於測試) - 保持向後兼容
   */
  const generateMockCase = (status = 'pending', additionalData = {}) => {
    const timestamp = Date.now()
    return {
      customer_name: `假客戶${timestamp}`,
      email: `mock${timestamp}@example.com`,
      phone: `09${String(Math.floor(Math.random() * 100000000)).padStart(8, '0')}`,
      line_id: `mocklineid${timestamp}`,
      channel: 'wp_form',
      source: `http://mock-website-${timestamp}.com`,
      case_status: status,
      assigned_to: null,
      business_level: 'A',
      payload: {
        '頁面_URL': `http://mock-website-${timestamp}.com`,
        '需求金額': Math.floor(Math.random() * 1000000) + 100000,
        '房屋地址': `假地址${Math.floor(Math.random() * 999)}號`
      },
      ...additionalData
    }
  }

  /**
   * 完整的頁面配置 - 統一管理所有案件頁面的配置
   */
  const PAGE_CONFIGS = {
    // 網路進線 (待處理)
    pending: {
      title: '網路進線',
      description: '顯示來自 WP 表單的進件（可搜尋、編輯、刪除）',
      addButtonText: '新增進線',
      tableTitle: '網路進線列表',
      searchPlaceholder: '搜尋姓名/手機/Email/LINE/網站... (至少2個字符)',
      emptyText: '沒有網路進線案件',
      defaultStatus: 'pending',
      showBusinessLevel: false,
      showAssigneeFilter: true,
      allowedActions: ['view', 'edit', 'convert', 'delete', 'assign', 'line_edit'],
      editModalTitle: '編輯進線',
      addModalTitle: '新增進線'
    },

    // 有效客戶
    valid_customer: {
      title: '有效客戶',
      description: '已確認為有效的客戶案件',
      addButtonText: '新增有效客戶',
      tableTitle: '有效客戶列表',
      searchPlaceholder: '搜尋客戶資訊...',
      emptyText: '沒有有效客戶案件',
      defaultStatus: 'valid_customer',
      showBusinessLevel: false,
      showAssigneeFilter: true,
      allowedActions: ['view', 'edit', 'convert', 'delete'],
      editModalTitle: '編輯有效客戶',
      addModalTitle: '新增有效客戶'
    },

    // 無效客戶
    invalid_customer: {
      title: '無效客戶',
      description: '已確認為無效的客戶案件',
      addButtonText: '新增無效客戶',
      tableTitle: '無效客戶列表',
      searchPlaceholder: '搜尋客戶資訊...',
      emptyText: '沒有無效客戶案件',
      defaultStatus: 'invalid_customer',
      showBusinessLevel: false,
      showAssigneeFilter: true,
      allowedActions: ['view', 'edit', 'delete'],
      editModalTitle: '編輯無效客戶',
      addModalTitle: '新增無效客戶'
    },

    // 客服
    customer_service: {
      title: '客服案件',
      description: '需要客服處理的案件',
      addButtonText: '新增客服案件',
      tableTitle: '客服案件列表',
      searchPlaceholder: '搜尋客服案件...',
      emptyText: '沒有客服案件',
      defaultStatus: 'customer_service',
      showBusinessLevel: false,
      showAssigneeFilter: true,
      allowedActions: ['view', 'edit', 'convert', 'delete'],
      editModalTitle: '編輯客服案件',
      addModalTitle: '新增客服案件'
    },

    // 黑名單
    blacklist: {
      title: '黑名單',
      description: '列入黑名單的客戶',
      addButtonText: '新增黑名單',
      tableTitle: '黑名單列表',
      searchPlaceholder: '搜尋黑名單客戶...',
      emptyText: '沒有黑名單案件',
      defaultStatus: 'blacklist',
      showBusinessLevel: false,
      showAssigneeFilter: true,
      allowedActions: ['view', 'edit', 'delete'],
      editModalTitle: '編輯黑名單',
      addModalTitle: '新增黑名單'
    },

    // 核准撥款
    approved_disbursed: {
      title: '核准撥款',
      description: '已核准並完成撥款的案件',
      addButtonText: '新增核准撥款',
      tableTitle: '核准撥款列表',
      searchPlaceholder: '搜尋核准撥款案件...',
      emptyText: '沒有核准撥款案件',
      defaultStatus: 'approved_disbursed',
      showBusinessLevel: false,
      showAssigneeFilter: true,
      allowedActions: ['view', 'edit'],
      editModalTitle: '編輯核准撥款',
      addModalTitle: '新增核准撥款'
    },

    // 核准未撥
    approved_undisbursed: {
      title: '核准未撥',
      description: '已核准但尚未撥款的案件',
      addButtonText: '新增核准未撥',
      tableTitle: '核准未撥列表',
      searchPlaceholder: '搜尋核准未撥案件...',
      emptyText: '沒有核准未撥案件',
      defaultStatus: 'approved_undisbursed',
      showBusinessLevel: false,
      showAssigneeFilter: true,
      allowedActions: ['view', 'edit', 'convert'],
      editModalTitle: '編輯核准未撥',
      addModalTitle: '新增核准未撥'
    },

    // 附條件核准
    conditional_approval: {
      title: '附條件核准',
      description: '附帶條件的核准案件',
      addButtonText: '新增附條件核准',
      tableTitle: '附條件核准列表',
      searchPlaceholder: '搜尋附條件核准案件...',
      emptyText: '沒有附條件核准案件',
      defaultStatus: 'conditional_approval',
      showBusinessLevel: false,
      showAssigneeFilter: true,
      allowedActions: ['view', 'edit', 'convert'],
      editModalTitle: '編輯附條件核准',
      addModalTitle: '新增附條件核准'
    },

    // 婉拒
    declined: {
      title: '婉拒案件',
      description: '已婉拒的案件',
      addButtonText: '新增婉拒案件',
      tableTitle: '婉拒案件列表',
      searchPlaceholder: '搜尋婉拒案件...',
      emptyText: '沒有婉拒案件',
      defaultStatus: 'declined',
      showBusinessLevel: false,
      showAssigneeFilter: true,
      allowedActions: ['view', 'edit'],
      editModalTitle: '編輯婉拒案件',
      addModalTitle: '新增婉拒案件'
    },

    // 追蹤管理
    tracking: {
      title: '追蹤管理',
      description: '需要業務追蹤的案件',
      addButtonText: '新增追蹤案件',
      tableTitle: '追蹤管理列表',
      searchPlaceholder: '搜尋追蹤案件...',
      emptyText: '沒有追蹤案件',
      defaultStatus: 'tracking',
      showBusinessLevel: true,
      showAssigneeFilter: true,
      allowedActions: ['view', 'edit', 'convert', 'schedule'],
      editModalTitle: '編輯追蹤案件',
      addModalTitle: '新增追蹤案件'
    }
  }

  /**
   * 根據頁面類型獲取配置
   */
  const getPageConfig = (pageType) => {
    return PAGE_CONFIGS[pageType] || PAGE_CONFIGS.pending
  }

  /**
   * 編輯視窗的區塊配置
   */
  const EDIT_MODAL_SECTIONS = [
    {
      id: 'basic',
      title: '基本資訊',
      bgColor: 'bg-gray-50',
      fields: [
        { key: 'case_status', label: '進線狀態', type: 'select', options: 'CASE_STATUS_OPTIONS' },
        { key: 'business_level', label: '業務等級', type: 'select', options: 'BUSINESS_LEVEL_OPTIONS', trackingOnly: true },
        { key: 'created_at', label: '時間', type: 'datetime-local', readonly: true },
        { key: 'assigned_to', label: '承辦業務', type: 'user_select' },
        { key: 'channel', label: '來源管道', type: 'select', options: 'CHANNEL_OPTIONS' },
        { key: 'customer_name', label: '姓名', type: 'text' }
      ]
    },
    {
      id: 'contact',
      title: '聯絡資訊',
      bgColor: 'bg-white',
      fields: [
        { key: 'email', label: '電子郵件', type: 'email' },
        { key: 'mobile_phone', label: '手機號碼', type: 'tel' },
        { key: 'line_id', label: 'LINE ID', type: 'text' },
        { key: 'line_user_info.display_name', label: 'LINE名稱', type: 'text' }
      ]
    },
    {
      id: 'loan',
      title: '貸款資訊',
      bgColor: 'bg-gray-50',
      fields: [
        { key: 'loan_purpose', label: '貸款需求', type: 'select', options: 'PURPOSE_OPTIONS' },
        { key: 'payload.需求金額', label: '需求金額', type: 'text' },
        { key: 'payload.頁面_URL', label: '來源網站', type: 'text' }
      ]
    },
    {
      id: 'personal',
      title: '個人資料',
      bgColor: 'bg-white',
      hidden: true,
      fields: [] // 使用 HIDDEN_FIELDS_CONFIG.personal
    },
    {
      id: 'company',
      title: '公司資料',
      bgColor: 'bg-gray-50',
      hidden: true,
      fields: [] // 使用 HIDDEN_FIELDS_CONFIG.company
    },
    {
      id: 'actions',
      title: '操作',
      bgColor: 'bg-white',
      width: 'w-80',
      isActionSection: true
    }
  ]

  // 固定的業務人員列表
  const SALES_STAFF = [
    { id: 'zhang', name: '張業務' },
    { id: 'wang', name: '王業務' },
    { id: 'huang', name: '黃業務' }
  ]

  return {
    // 常數
    STATUS_ROUTE_MAP,
    CASE_STATUS_OPTIONS,
    CASE_STATUS_NAVIGATION_OPTIONS,
    PAGE_CASE_STATUS_MAP,
    UNIFIED_TABLE_COLUMNS,
    CHANNEL_OPTIONS,
    BUSINESS_LEVEL_OPTIONS,
    PURPOSE_OPTIONS,
    WEBSITE_OPTIONS,
    HIDDEN_FIELDS_CONFIG,
    SALES_STAFF,

    // 頁面配置
    PAGE_CONFIGS,
    EDIT_MODAL_SECTIONS,

    ADD_LEAD_FORM_CONFIG: [
      { key: 'assigned_to', label: '承辦業務', type: 'user_select' },
      { key: 'source_channel', label: '來源管道', type: 'select', options: CHANNEL_OPTIONS, required: true },
      { key: 'customer_name', label: '姓名', type: 'text', required: true },
      { key: 'line_name', label: 'LINE顯示名稱', type: 'text' },
      { key: 'line_id', label: 'LINE ID', type: 'text' },
      { key: 'consultation_items', label: '諮詢項目', type: 'select', options: PURPOSE_OPTIONS },
      { key: 'website_domain', label: '網站', type: 'website_select' },
      { key: 'email', label: '電子郵件', type: 'email' },
      { key: 'phone', label: '手機', type: 'tel' },
    ],

    // State for tracking page
    state, // Export the reactive state object

    // 方法
    loadCasesByStatus,
    addCase,
    updateCaseStatus,
    updateBusinessLevel,
    deleteCase,
    generateMockCase,
    generateCaseByCurrentPage: generateCaseForCurrentPage,
    getDisplaySource,
    generateCaseNumber,
    getRoleLabel,
    getTableColumnsForPage,
    getPageConfig,
    getChannelStyling,
    getStatusStyling,

    // Methods for tracking page
    fetchCases,
    setSort,
    goToPage,
    nextPage,
    prevPage,
    updateItemsPerPage,

    // Calendar methods
    fetchCalendarEvents, // Export the new calendar event fetcher
  }
}
