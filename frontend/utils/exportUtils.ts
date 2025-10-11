/**
 * CSV 導出工具函數
 *
 * 提供將案件資料導出為 CSV 檔案的功能
 * 支援自定義欄位映射、檔案名稱、編碼等
 */

import {
  transformCasesData,
  defaultCaseExportMapping,
  basicCaseExportMapping,
  completeCaseExportMapping,
  type FieldMapping
} from '~/data/exportMappings';

/**
 * 將資料陣列轉換為 CSV 格式字串
 *
 * @param data 已轉換的資料陣列（鍵為 CSV 欄位名稱）
 * @returns CSV 格式字串
 */
function convertToCSV(data: Record<string, string>[]): string {
  if (data.length === 0) return '';

  // 取得欄位名稱（表頭）
  const headers = Object.keys(data[0]);

  // 建立 CSV 內容
  const csvRows: string[] = [];

  // 加入表頭
  csvRows.push(headers.map(header => escapeCSVValue(header)).join(','));

  // 加入資料列
  data.forEach(row => {
    const values = headers.map(header => {
      const value = row[header] || '';
      return escapeCSVValue(value);
    });
    csvRows.push(values.join(','));
  });

  return csvRows.join('\n');
}

/**
 * 跳脫 CSV 特殊字元
 *
 * @param value 原始值
 * @returns 跳脫後的值
 */
function escapeCSVValue(value: string): string {
  // 如果值包含逗號、雙引號、換行符，則用雙引號包圍
  if (value.includes(',') || value.includes('"') || value.includes('\n')) {
    // 將雙引號替換為兩個雙引號（CSV 規範）
    return `"${value.replace(/"/g, '""')}"`;
  }
  return value;
}

/**
 * 下載 CSV 檔案
 *
 * @param csvContent CSV 內容
 * @param filename 檔案名稱（不含副檔名）
 */
function downloadCSV(csvContent: string, filename: string): void {
  // 加入 UTF-8 BOM，確保 Excel 正確識別中文
  const BOM = '\uFEFF';
  const blob = new Blob([BOM + csvContent], { type: 'text/csv;charset=utf-8;' });

  // 建立下載連結
  const link = document.createElement('a');
  const url = URL.createObjectURL(blob);

  link.setAttribute('href', url);
  link.setAttribute('download', `${filename}.csv`);
  link.style.visibility = 'hidden';

  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);

  // 釋放 URL 物件
  URL.revokeObjectURL(url);
}

/**
 * 產生預設檔案名稱
 *
 * @param prefix 檔名前綴
 * @returns 檔案名稱（包含時間戳記）
 */
function generateFilename(prefix: string = '案件資料'): string {
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0');
  const day = String(now.getDate()).padStart(2, '0');
  const hour = String(now.getHours()).padStart(2, '0');
  const minute = String(now.getMinutes()).padStart(2, '0');
  const second = String(now.getSeconds()).padStart(2, '0');

  return `${prefix}_${year}${month}${day}_${hour}${minute}${second}`;
}

/**
 * 主要導出函數：導出案件資料為 CSV
 *
 * @param casesData 原始案件資料陣列
 * @param options 導出選項
 * @returns 是否成功導出
 */
export function exportCasesToCSV(
  casesData: Record<string, any>[],
  options: {
    filename?: string;
    mapping?: FieldMapping[];
    mode?: 'complete' | 'basic' | 'custom'; // 導出模式
  } = {}
): boolean {
  try {
    // 檢查資料是否為空
    if (!casesData || casesData.length === 0) {
      console.warn('沒有資料可以導出');
      return false;
    }

    // 決定使用哪個映射配置
    let mapping: FieldMapping[];
    if (options.mapping) {
      // 使用自定義映射
      mapping = options.mapping;
    } else if (options.mode === 'basic') {
      // 使用簡化版映射
      mapping = basicCaseExportMapping;
    } else {
      // 預設使用完整版映射
      mapping = completeCaseExportMapping;
    }

    // 轉換資料
    const transformedData = transformCasesData(casesData, mapping);

    // 轉換為 CSV 格式
    const csvContent = convertToCSV(transformedData);

    // 產生檔案名稱
    const filename = options.filename || generateFilename('案件資料');

    // 下載檔案
    downloadCSV(csvContent, filename);

    console.log(`成功導出 ${casesData.length} 筆案件資料`);
    return true;
  } catch (error) {
    console.error('導出 CSV 時發生錯誤:', error);
    return false;
  }
}

/**
 * 快速導出函數：使用預設設定導出完整案件資料
 *
 * @param casesData 原始案件資料陣列
 * @returns 是否成功導出
 */
export function quickExportCases(casesData: Record<string, any>[]): boolean {
  return exportCasesToCSV(casesData, {
    mode: 'complete',
    filename: generateFilename('完整案件資料'),
  });
}

/**
 * 導出基本資訊：僅包含基本欄位
 *
 * @param casesData 原始案件資料陣列
 * @returns 是否成功導出
 */
export function exportBasicCases(casesData: Record<string, any>[]): boolean {
  return exportCasesToCSV(casesData, {
    mode: 'basic',
    filename: generateFilename('案件基本資料'),
  });
}

/**
 * 批次導出：根據狀態分組導出
 *
 * @param casesData 原始案件資料陣列
 * @param groupByField 分組欄位（預設為 case_status）
 * @returns 是否成功導出所有分組
 */
export function exportCasesByGroup(
  casesData: Record<string, any>[],
  groupByField: string = 'case_status'
): boolean {
  try {
    // 根據指定欄位分組
    const grouped = casesData.reduce((acc, caseData) => {
      const groupKey = caseData[groupByField] || 'unknown';
      if (!acc[groupKey]) {
        acc[groupKey] = [];
      }
      acc[groupKey].push(caseData);
      return acc;
    }, {} as Record<string, Record<string, any>[]>);

    // 為每個分組導出 CSV
    let allSuccess = true;
    Object.entries(grouped).forEach(([groupKey, groupCases]) => {
      const success = exportCasesToCSV(groupCases, {
        filename: generateFilename(`案件資料_${groupKey}`),
        mode: 'complete',
      });
      if (!success) allSuccess = false;
    });

    return allSuccess;
  } catch (error) {
    console.error('批次導出時發生錯誤:', error);
    return false;
  }
}

/**
 * 預覽 CSV 內容（用於除錯）
 *
 * @param casesData 原始案件資料陣列
 * @param maxRows 最多預覽幾列
 * @returns CSV 內容（字串）
 */
export function previewCSV(
  casesData: Record<string, any>[],
  maxRows: number = 5
): string {
  const previewData = casesData.slice(0, maxRows);
  const transformedData = transformCasesData(previewData, completeCaseExportMapping);
  return convertToCSV(transformedData);
}