import {
  CASE_STATUS_OPTIONS,
  BUSINESS_LEVEL_OPTIONS,
  CHANNEL_OPTIONS,
  PURPOSE_OPTIONS,
  HIDDEN_FIELDS_CONFIG
} from './useCaseConfig'

/**
 * 表單配置
 * 包含新增表單、編輯表單的欄位配置
 */

/**
 * 編輯視窗的區塊配置
 */
export const EDIT_MODAL_SECTIONS = [
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

/**
 * 統一的新增表單欄位配置函數
 * 欄位名稱與資料庫 customer_leads 表完全對應
 * 順序：案件狀態(自動) → [業務等級(僅追蹤)] → 承辦業務 → 姓名 → 來源管道 → LINE資訊 → 諮詢項目 → 網站 → 聯絡資訊
 * @param {string} pageType - 頁面類型 (pending, tracking, etc.)
 * @returns {Array} - 表單欄位配置
 */
export const getAddFormFields = (pageType = 'pending') => {
  const baseFields = [
    { key: 'assigned_to', label: '承辦業務', type: 'user_select', required: false, dbColumn: 'assigned_to' },
    { key: 'channel', label: '來源管道', type: 'select', options: CHANNEL_OPTIONS, required: true, dbColumn: 'channel' },
    { key: 'customer_name', label: '姓名', type: 'text', required: false, dbColumn: 'customer_name' },
    { key: 'line_display_name', label: 'LINE顯示名稱', type: 'text', required: false, dbColumn: 'line_display_name' },
    { key: 'line_id', label: 'LINE ID', type: 'text', required: false, dbColumn: 'line_id' },
    { key: 'loan_purpose', label: '諮詢項目', type: 'select', options: PURPOSE_OPTIONS, required: false, dbColumn: 'loan_purpose' },
    { key: 'website', label: '網站', type: 'website_select', required: false, dbColumn: 'website' },
    { key: 'email', label: '電子郵件', type: 'email', required: false, dbColumn: 'email' },
    { key: 'phone', label: '手機', type: 'tel', required: false, dbColumn: 'phone' },
  ]

  // 追蹤管理頁面額外增加業務等級欄位（在承辦業務之前，也就是索引0的位置）
  if (pageType === 'tracking') {
    baseFields.unshift({
      key: 'business_level',
      label: '業務等級',
      type: 'select',
      options: BUSINESS_LEVEL_OPTIONS,
      required: false,
      dbColumn: 'business_level'
    })
  }

  return baseFields
}

/**
 * 完整的頁面配置 - 統一管理所有案件頁面的配置
 */
export const PAGE_CONFIGS = {
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
export const getPageConfig = (pageType) => {
  return PAGE_CONFIGS[pageType] || PAGE_CONFIGS.pending
}

// 固定的業務人員列表
export const SALES_STAFF = [
  { id: 'zhang', name: '張業務' },
  { id: 'wang', name: '王業務' },
  { id: 'huang', name: '黃業務' }
]
