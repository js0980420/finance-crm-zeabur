/**
 * 案件配置常數
 * 包含案件狀態、來源管道、業務等級等配置選項
 */

// 案件狀態選項
export const CASE_STATUS_OPTIONS = [
  { value: 'pending', label: '待處理' },
  { value: 'valid_customer', label: '有效客戶' },
  { value: 'invalid_customer', label: '無效客戶' },
  { value: 'customer_service', label: '客服' },
  { value: 'blacklist', label: '黑名單' },
  { value: 'approved_disbursed', label: '核准撥款' },
  { value: 'approved_undisbursed', label: '核准未撥' },
  { value: 'conditional_approval', label: '附條件核准' },
  { value: 'declined', label: '婉拒' },
  { value: 'tracking', label: '追蹤管理' }
]

// 來源管道選項
export const CHANNEL_OPTIONS = [
  { value: 'wp_form', label: '網站表單' },
  { value: 'lineoa', label: '官方LINE' },
  { value: 'email', label: 'Email' },
  { value: 'phone', label: '電話' },
  { value: 'other', label: '其他' }
]

// 業務等級選項
export const BUSINESS_LEVEL_OPTIONS = [
  { value: 'A', label: 'A級' },
  { value: 'B', label: 'B級' },
  { value: 'C', label: 'C級' },
  { value: 'D', label: 'D級' }
]

// 貸款需求選項
export const PURPOSE_OPTIONS = [
  { value: 'mortgage', label: '房屋貸款' },
  { value: 'personal', label: '個人信貸' },
  { value: 'car', label: '汽車貸款' },
  { value: 'business', label: '企業貸款' },
  { value: 'other', label: '其他' }
]

// 網站來源選項
export const WEBSITE_OPTIONS = [
  { value: 'g1', label: 'G1網站' },
  { value: 'g2', label: 'G2網站' },
  { value: 'g3', label: 'G3網站' },
  { value: 'g4', label: 'G4網站' },
  { value: 'g5', label: 'G5網站' },
  { value: 'g6', label: 'G6網站' },
  { value: 'g7', label: 'G7網站' },
  { value: 'g8', label: 'G8網站' },
  { value: 'g9', label: 'G9網站' },
  { value: 'g10', label: 'G10網站' }
]

// 頁面路徑對應案件狀態
export const PAGE_CASE_STATUS_MAP = {
  '/cases/pending': 'pending',
  '/cases/valid-customer': 'valid_customer',
  '/cases/invalid-customer': 'invalid_customer',
  '/cases/customer-service': 'customer_service',
  '/cases/blacklist': 'blacklist',
  '/cases/approved-disbursed': 'approved_disbursed',
  '/cases/approved-undisbursed': 'approved_undisbursed',
  '/cases/conditional-approval': 'conditional_approval',
  '/cases/declined': 'declined',
  '/cases/tracking': 'tracking'
}

// 隱藏欄位配置
export const HIDDEN_FIELDS_CONFIG = {
  personal: [
    { key: 'birth_date', label: '出生日期', type: 'date' },
    { key: 'id_number', label: '身分證字號', type: 'text' },
    { key: 'education', label: '教育程度', type: 'text' },
    { key: 'marital_status', label: '婚姻狀況', type: 'text' }
  ],
  company: [
    { key: 'company_name', label: '公司名稱', type: 'text' },
    { key: 'job_title', label: '職稱', type: 'text' },
    { key: 'monthly_income', label: '月收入', type: 'number' },
    { key: 'company_phone', label: '公司電話', type: 'tel' }
  ]
}
