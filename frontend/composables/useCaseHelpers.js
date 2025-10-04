import { PAGE_CASE_STATUS_MAP } from './useCaseConfig'

/**
 * 案件輔助函數
 * 包含各種工具函數：顯示來源、生成案件編號、角色標籤等
 */

/**
 * 根據案件來源渠道取得顯示名稱（不依賴網站資料）
 */
export const getDisplaySource = (item) => {
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
export const generateCaseNumber = (item) => {
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
export const getRoleLabel = (role) => {
  const roleLabels = {
    'admin': '管理員',
    'sales': '業務',
    'manager': '主管',
    'executive': '高層',
    'staff': '員工'
  }
  return roleLabels[role] || role
}

/**
 * 根據來源管道產生案件資料
 */
export const generateCaseByChannel = (channel, baseData = {}) => {
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
export const generateCaseForCurrentPage = (channel = 'wp_form', additionalData = {}) => {
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
