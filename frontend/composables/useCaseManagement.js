/**
 * 簡化的案件管理可組合函數
 * 只保留配置和輔助函數，表單欄位由 CustomerForm 元件處理
 */

// 導入配置選項
import {
  CASE_STATUS_OPTIONS,
  CHANNEL_OPTIONS,
  BUSINESS_LEVEL_OPTIONS,
  PURPOSE_OPTIONS,
  WEBSITE_OPTIONS
} from './useCaseConfig'

// 導入輔助函數
import {
  getDisplaySource,
  generateCaseNumber,
  getRoleLabel
} from './useCaseHelpers'

// 導入表格配置
import {
  getTableColumnsForPage
} from './useCaseTableColumns'

// 導入表單配置
import {
  getAddFormFields,
  getPageConfig,
  SALES_STAFF
} from './useCaseForm'

/**
 * 簡化的案件管理可組合函數
 * 提供配置選項、表格配置、表單配置和輔助函數
 */
export const useCaseManagement = () => {
  return {
    // --- 配置選項 ---
    CASE_STATUS_OPTIONS,
    CHANNEL_OPTIONS,
    BUSINESS_LEVEL_OPTIONS,
    PURPOSE_OPTIONS,
    WEBSITE_OPTIONS,

    // --- 表格配置 ---
    getTableColumnsForPage,

    // --- 表單配置 ---
    getAddFormFields,
    getPageConfig,
    SALES_STAFF,

    // --- 輔助函數 ---
    getDisplaySource,
    generateCaseNumber,
    getRoleLabel
  }
}
