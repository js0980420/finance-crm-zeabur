/**
 * 案件配置選項
 * 包含所有狀態、管道、選項的配置
 */

// 狀態與路由映射
export const STATUS_ROUTE_MAP = {
  pending: '/cases',
  valid_customer: '/cases/valid-customers',
  invalid_customer: '/cases/invalid-customers',
  customer_service: '/cases/customer-services',
  blacklist: '/cases/blacklists',
  approved_disbursed: '/cases/approved-disbursed',
  approved_undisbursed: '/cases/approved-undisbursed',
  conditional_approval: '/cases/conditional-approval',
  declined: '/cases/rejected',
  tracking: '/cases/tracking'
}

// 頁面與案件狀態對應表
export const PAGE_CASE_STATUS_MAP = {
  '/cases': 'pending',
  '/cases/valid-customer': 'valid_customer',
  '/cases/invalid-customer': 'invalid_customer',
  '/cases/customer-service': 'customer_service',
  '/cases/blacklist': 'blacklist',
  '/cases/approved-disbursed': 'approved_disbursed',
  '/cases/approved-undisbursed': 'approved_undisbursed',
  '/cases/conditional-approval': 'conditional_approval',
  '/cases/rejected': 'declined',
  '/cases/tracking': 'tracking'
}

// 案件狀態選項 (按照業務流程順序排列)
export const CASE_STATUS_OPTIONS = [
  { value: 'pending', label: '待處理', category: 'leads', backendValue: 'unassigned' },
  { value: 'valid_customer', label: '有效客', category: 'leads_management', backendValue: 'valid_customer' },
  { value: 'invalid_customer', label: '無效客', category: 'leads_management', backendValue: 'invalid_customer' },
  { value: 'customer_service', label: '客服', category: 'leads_management', backendValue: 'customer_service' },
  { value: 'blacklist', label: '黑名單', category: 'leads_management', backendValue: 'blacklist' },
  { value: 'approved_disbursed', label: '核准撥款', category: 'case_management' },
  { value: 'approved_undisbursed', label: '核准未撥', category: 'case_management' },
  { value: 'conditional_approval', label: '附條件', category: 'case_management' },
  { value: 'declined', label: '婉拒', category: 'case_management' },
  { value: 'tracking', label: '追蹤中', category: 'sales_tracking' }
]

// 來源管道選項
export const CHANNEL_OPTIONS = [
  { value: 'wp_form', label: '網站表單' },
  { value: 'lineoa', label: '官方LINE' },
  { value: 'email', label: 'email' },
  { value: 'phone', label: '專線' }
]

// 業務等級選項
export const BUSINESS_LEVEL_OPTIONS = [
  { value: 'A', label: 'A級' },
  { value: 'B', label: 'B級' },
  { value: 'C', label: 'C級' }
]

// 諮詢項目選項
export const PURPOSE_OPTIONS = [
  { value: '房屋貸款', label: '房屋貸款' },
  { value: '企業貸款', label: '企業貸款' },
  { value: '個人信貸', label: '個人信貸' },
  { value: '汽車貸款', label: '汽車貸款' },
  { value: '其他', label: '其他' }
]

// 網站選項
export const WEBSITE_OPTIONS = Array.from({ length: 10 }, (_, i) => ({
  value: `G${i + 1}`,
  label: `G${i + 1}`
}))

// 可聯繫時間選項
export const CONTACT_TIME_OPTIONS = [
  { value: '早上', label: '早上' },
  { value: '下午', label: '下午' },
  { value: '晚上', label: '晚上' },
  { value: '其他', label: '其他' }
]

// 網路進線適用的案件狀態選項
export const CASE_STATUS_NAVIGATION_OPTIONS = CASE_STATUS_OPTIONS.filter(opt =>
  ['leads', 'leads_management'].includes(opt.category)
).map(opt => ({
  ...opt,
  route: STATUS_ROUTE_MAP[opt.value] || '/cases'
}))

// 樣式函數
export const getChannelStyling = (channel) => {
  const style = {
    wp_form: { label: '網站表單', class: 'bg-blue-100 text-blue-800' },
    lineoa: { label: '官方賴', class: 'bg-green-100 text-green-800' },
    email: { label: 'Email', class: 'bg-purple-100 text-purple-800' },
    phone: { label: '電話', class: 'bg-orange-100 text-orange-800' }
  }
  return style[channel] || { label: channel || '-', class: 'bg-gray-100 text-gray-800' }
}

export const getStatusStyling = (caseStatus) => {
  const style = {
    pending: { label: '待處理', class: 'bg-red-100 text-red-800' },
    valid_customer: { label: '有效客', class: 'bg-blue-100 text-blue-800' },
    invalid_customer: { label: '無效客', class: 'bg-gray-100 text-gray-800' },
    customer_service: { label: '客服', class: 'bg-purple-100 text-purple-800' },
    blacklist: { label: '黑名單', class: 'bg-black text-white' },
    approved_disbursed: { label: '核准撥款', class: 'bg-green-100 text-green-800' },
    approved_undisbursed: { label: '核准未撥', class: 'bg-yellow-100 text-yellow-800' },
    conditional_approval: { label: '附條件', class: 'bg-teal-100 text-teal-800' },
    declined: { label: '婉拒', class: 'bg-orange-100 text-orange-800' },
    tracking: { label: '追蹤中', class: 'bg-green-100 text-green-800' }
  }
  return style[caseStatus] || { label: caseStatus || '-', class: 'bg-gray-100 text-gray-800' }
}

// 隱藏欄位配置
const durationOptions = ['未滿三個月', '三個月至一年', '一年至三年', '三年至五年', '五年以上']
const taiwanCities = ['臺北市', '新北市', '桃園市', '臺中市', '臺南市', '高雄市', '基隆市', '新竹市', '嘉義市', '宜蘭縣', '新竹縣', '苗栗縣', '彰化縣', '南投縣', '雲林縣', '嘉義縣', '屏東縣', '花蓮縣', '臺東縣', '澎湖縣']

export const HIDDEN_FIELDS_CONFIG = {
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
