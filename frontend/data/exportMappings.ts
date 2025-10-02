/**
 * CSV 導出欄位映射配置檔
 *
 * 此檔案定義了從內部案件資料結構到 CSV 導出格式的欄位映射
 * 包含基本資訊、個人資料、聯絡資訊、公司資料、緊急聯絡人等所有欄位
 *
 * 資料來源：
 * - 基本欄位: useCaseManagement.js 的 ADD_LEAD_FORM_CONFIG
 * - 隱藏欄位: useCaseManagement.js 的 HIDDEN_FIELDS_CONFIG
 *
 * 待業主提供正式格式後，請修改此檔案中的映射配置
 */

export interface FieldMapping {
  // CSV 中的欄位名稱（中文）
  csvField: string;
  // 內部資料的欄位名稱（英文）
  internalField: string;
  // 欄位分組（用於組織大量欄位）
  group?: string;
  // 可選的轉換函式
  transform?: (value: any, record: any) => string;
}

// 案件狀態對應表（中文）
const caseStatusMap: Record<string, string> = {
  pending: '待處理',
  valid_customer: '有效客',
  invalid_customer: '無效客',
  customer_service: '客服',
  blacklist: '黑名單',
  approved_disbursed: '核准撥款',
  approved_undisbursed: '核准未撥',
  conditional_approval: '附條件',
  declined: '婉拒',
  tracking: '追蹤中',
};

// 來源管道對應表（中文）
const channelMap: Record<string, string> = {
  wp_form: '網站表單',
  lineoa: '官方LINE',
  email: 'Email',
  phone: '專線',
};

// 業務等級對應表（中文）
const businessLevelMap: Record<string, string> = {
  A: 'A級',
  B: 'B級',
  C: 'C級',
};

// 學歷對應表
const educationMap: Record<string, string> = {
  '國小': '國小',
  '國中': '國中',
  '高中職': '高中職',
  '專科': '專科',
  '大學': '大學',
  '碩士': '碩士',
  '博士': '博士',
};

/**
 * 完整的欄位映射配置（包含所有隱藏欄位）
 *
 * 欄位順序：
 * 1. 基本資訊區塊（9個欄位）
 * 2. 個人資料區塊（3個欄位）
 * 3. 聯絡資訊區塊（9個欄位）
 * 4. 公司資料區塊（8個欄位）
 * 5. 緊急聯絡人區塊（11個欄位）
 * 6. 其他資訊區塊（2個欄位）
 * 7. 系統欄位（2個欄位）
 *
 * 共計：44個欄位
 */
export const completeCaseExportMapping: FieldMapping[] = [
  // ==================== 基本資訊區塊 ====================
  {
    csvField: '案件編號',
    internalField: 'id',
    group: '基本資訊',
  },
  {
    csvField: '進線編號',
    internalField: 'case_number',
    group: '基本資訊',
  },
  {
    csvField: '案件狀態',
    internalField: 'case_status',
    group: '基本資訊',
    transform: (value) => caseStatusMap[value] || value || '未設定',
  },
  {
    csvField: '業務等級',
    internalField: 'business_level',
    group: '基本資訊',
    transform: (value) => businessLevelMap[value] || value || '未分級',
  },
  {
    csvField: '客戶姓名',
    internalField: 'customer_name',
    group: '基本資訊',
  },
  {
    csvField: '承辦業務',
    internalField: 'assigned_to',
    group: '基本資訊',
    transform: (value, record) => {
      if (record.assignee?.name) return record.assignee.name;
      return value ? `業務${value}` : '未指派';
    },
  },
  {
    csvField: '來源管道',
    internalField: 'source_channel',
    group: '基本資訊',
    transform: (value) => channelMap[value] || value || '未設定',
  },
  {
    csvField: '諮詢項目',
    internalField: 'consultation_items',
    group: '基本資訊',
  },
  {
    csvField: '網站',
    internalField: 'website_domain',
    group: '基本資訊',
  },

  // ==================== 個人資料區塊 ====================
  {
    csvField: '出生年月日',
    internalField: 'birth_date',
    group: '個人資料',
    transform: (value) => {
      if (!value) return '';
      const date = new Date(value);
      return date.toLocaleDateString('zh-TW', { year: 'numeric', month: '2-digit', day: '2-digit' });
    },
  },
  {
    csvField: '身份證字號',
    internalField: 'id_number',
    group: '個人資料',
  },
  {
    csvField: '最高學歷',
    internalField: 'education',
    group: '個人資料',
    transform: (value) => educationMap[value] || value || '',
  },

  // ==================== 聯絡資訊區塊 ====================
  {
    csvField: '手機號碼',
    internalField: 'mobile_phone',
    group: '聯絡資訊',
  },
  {
    csvField: 'Email',
    internalField: 'email',
    group: '聯絡資訊',
  },
  {
    csvField: 'LINE顯示名稱',
    internalField: 'line_name',
    group: '聯絡資訊',
    transform: (value, record) => {
      return value || record.line_user_info?.display_name || '';
    },
  },
  {
    csvField: 'LINE ID',
    internalField: 'line_id',
    group: '聯絡資訊',
  },
  {
    csvField: '所在地區',
    internalField: 'region',
    group: '聯絡資訊',
  },
  {
    csvField: '戶籍地址',
    internalField: 'registered_address',
    group: '聯絡資訊',
  },
  {
    csvField: '室內電話',
    internalField: 'home_phone',
    group: '聯絡資訊',
  },
  {
    csvField: '通訊地址同戶籍地',
    internalField: 'address_same',
    group: '聯絡資訊',
    transform: (value) => value ? '是' : '否',
  },
  {
    csvField: '通訊地址',
    internalField: 'mailing_address',
    group: '聯絡資訊',
  },
  {
    csvField: '現居地住多久',
    internalField: 'residence_duration',
    group: '聯絡資訊',
  },
  {
    csvField: '居住地持有人',
    internalField: 'residence_owner',
    group: '聯絡資訊',
  },
  {
    csvField: '電信業者',
    internalField: 'telecom_provider',
    group: '聯絡資訊',
  },

  // ==================== 公司資料區塊 ====================
  {
    csvField: '公司名稱',
    internalField: 'company_name',
    group: '公司資料',
  },
  {
    csvField: '公司電話',
    internalField: 'company_phone',
    group: '公司資料',
  },
  {
    csvField: '公司地址',
    internalField: 'company_address',
    group: '公司資料',
  },
  {
    csvField: '公司Email',
    internalField: 'company_email',
    group: '公司資料',
  },
  {
    csvField: '職稱',
    internalField: 'job_title',
    group: '公司資料',
  },
  {
    csvField: '月收入',
    internalField: 'monthly_income',
    group: '公司資料',
    transform: (value) => value ? String(value) : '',
  },
  {
    csvField: '有無薪轉勞保',
    internalField: 'new_labor_insurance',
    group: '公司資料',
    transform: (value) => value ? '有' : '無',
  },
  {
    csvField: '目前公司在職多久',
    internalField: 'employment_duration',
    group: '公司資料',
  },

  // ==================== 緊急聯絡人區塊 ====================
  {
    csvField: '聯絡人①姓名',
    internalField: 'contact1_name',
    group: '緊急聯絡人',
  },
  {
    csvField: '聯絡人①關係',
    internalField: 'contact1_relationship',
    group: '緊急聯絡人',
  },
  {
    csvField: '聯絡人①電話',
    internalField: 'contact1_phone',
    group: '緊急聯絡人',
  },
  {
    csvField: '聯絡人①方便聯絡時間',
    internalField: 'contact1_available_time',
    group: '緊急聯絡人',
  },
  {
    csvField: '聯絡人①是否保密',
    internalField: 'contact1_confidential',
    group: '緊急聯絡人',
    transform: (value) => value ? '是' : '否',
  },
  {
    csvField: '聯絡人②姓名',
    internalField: 'contact2_name',
    group: '緊急聯絡人',
  },
  {
    csvField: '聯絡人②關係',
    internalField: 'contact2_relationship',
    group: '緊急聯絡人',
  },
  {
    csvField: '聯絡人②電話',
    internalField: 'contact2_phone',
    group: '緊急聯絡人',
  },
  {
    csvField: '聯絡人②方便聯絡時間',
    internalField: 'contact2_available_time',
    group: '緊急聯絡人',
  },
  {
    csvField: '聯絡人②是否保密',
    internalField: 'contact2_confidential',
    group: '緊急聯絡人',
    transform: (value) => value ? '是' : '否',
  },
  {
    csvField: '介紹人',
    internalField: 'referrer',
    group: '緊急聯絡人',
  },

  // ==================== 其他資訊區塊 ====================
  {
    csvField: '需求金額',
    internalField: 'required_amount',
    group: '其他資訊',
  },

  // ==================== 系統欄位 ====================
  {
    csvField: '建立日期',
    internalField: 'created_at',
    group: '系統欄位',
    transform: (value) => {
      if (!value) return '';
      const date = new Date(value);
      return date.toLocaleString('zh-TW', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false,
      });
    },
  },
  {
    csvField: '最後更新',
    internalField: 'updated_at',
    group: '系統欄位',
    transform: (value) => {
      if (!value) return '';
      const date = new Date(value);
      return date.toLocaleString('zh-TW', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false,
      });
    },
  },
];

/**
 * 簡化版映射配置（僅包含基本欄位）
 * 適用於快速導出或業主只需要基本資訊的情況
 */
export const basicCaseExportMapping: FieldMapping[] = completeCaseExportMapping.filter(
  field => field.group === '基本資訊' || field.group === '系統欄位'
);

/**
 * 根據映射配置轉換單筆案件資料
 *
 * @param caseData 原始案件資料
 * @param mapping 欄位映射配置
 * @returns 轉換後的資料物件（鍵為 CSV 欄位名稱）
 */
export function transformCaseData(
  caseData: Record<string, any>,
  mapping: FieldMapping[] = completeCaseExportMapping
): Record<string, string> {
  const result: Record<string, string> = {};

  mapping.forEach(({ csvField, internalField, transform }) => {
    const value = caseData[internalField];
    result[csvField] = transform
      ? transform(value, caseData)
      : (value !== null && value !== undefined ? String(value) : '');
  });

  return result;
}

/**
 * 批量轉換案件資料
 *
 * @param casesData 原始案件資料陣列
 * @param mapping 欄位映射配置
 * @returns 轉換後的資料陣列
 */
export function transformCasesData(
  casesData: Record<string, any>[],
  mapping: FieldMapping[] = completeCaseExportMapping
): Record<string, string>[] {
  return casesData.map(caseData => transformCaseData(caseData, mapping));
}

/**
 * 預設導出映射（使用完整版）
 */
export const defaultCaseExportMapping = completeCaseExportMapping;