import {
  CASE_STATUS_OPTIONS,
  BUSINESS_LEVEL_OPTIONS,
  CHANNEL_OPTIONS,
  PURPOSE_OPTIONS,
  WEBSITE_OPTIONS
} from './useCaseConfig'

/**
 * 表格欄位配置
 * 包含統一的表格欄位定義和根據頁面類型獲取欄位配置的函數
 */

/**
 * 統一的表格欄位配置
 */
export const UNIFIED_TABLE_COLUMNS = [
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
      console.log('時間 formatter:', { value, created_at: item.created_at, dateTime })
      if (!dateTime) return '-'
      const date = new Date(dateTime)
      const dateStr = date.toLocaleDateString('zh-TW', { year: 'numeric', month: '2-digit', day: '2-digit' })
      const timeStr = date.toLocaleTimeString('zh-TW', { hour: '2-digit', minute: '2-digit' })
      const result = `<div>${dateStr}</div><div>${timeStr}</div>`
      console.log('時間 formatter 結果:', result)
      return result
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
      const result = item.assignee?.name || '未指派'
      console.log('承辦業務 formatter:', { value, assignee: item.assignee, result })
      return result
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
export const getTableColumnsForPage = (pageType = 'default') => {
  // Start with a full copy of all possible columns
  // 使用 map 建立淺拷貝，保留 formatter 函數
  const allColumns = UNIFIED_TABLE_COLUMNS.map(col => ({ ...col }));

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
        'loan_purpose', // Changed from 'purpose'
        'website',      // Changed from 'website_name'
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
        'loan_purpose',      // 8. 諮詢項目 (修正為 loan_purpose)
        'website',           // 9. 網站 (修正為 website)
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
        'loan_purpose',
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
        'loan_purpose',
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
        // 追蹤管理頁面：安排追蹤、進件、編輯、刪除（共4個按鈕）
        actionsColumn.allowedActions = ['schedule', 'intake', 'edit', 'delete'];
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
        // 其他頁面：只有編輯、刪除
        actionsColumn.allowedActions = ['edit', 'delete'];
        break;

      default:
        // 預設操作
        actionsColumn.allowedActions = ['view', 'edit'];
        break;
    }
  }

  return filteredColumns;
}
