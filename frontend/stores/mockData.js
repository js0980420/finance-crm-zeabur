import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
// import { mockCases } from '~/data/mockCases'; // 註解或移除此行

export const useMockDataStore = defineStore('mockData', () => {
  // -- STATE --
  // const cases = ref(JSON.parse(JSON.stringify(mockCases.items))); // 註解或移除此行
  const cases = ref([]); // 初始化為空陣列

  // 追蹤記錄模擬數據 - 符合業主規範
  const trackingRecords = ref([]); // Initialize as empty

  // -- GETTERS (Computed) --
  const getCasesByStatus = (status) => {
    return computed(() => cases.value.filter(caseItem => caseItem.status === status));
  };

  const getCasesByCaseStatus = (caseStatus) => {
    return computed(() => cases.value.filter(caseItem => caseItem.case_status === caseStatus));
  };

  const statusCounts = computed(() => {
    return cases.value.reduce((acc, caseItem) => {
      // 按照案件規則，只使用 case_status 進行統計
      const status = caseItem.case_status || caseItem.status || 'pending'; // 預設為 pending
      acc[status] = (acc[status] || 0) + 1;
      return acc;
    }, {
      // 初始化所有狀態計數為0，確保側邊欄顯示完整
      pending: 0,
      valid_customer: 0,
      invalid_customer: 0,
      customer_service: 0,
      blacklist: 0,
      approved_disbursed: 0,
      approved_undisbursed: 0,
      conditional_approval: 0,
      declined: 0,
      tracking: 0,
      intake: 0,
      disbursed: 0,
      approved_pending: 0,
      conditional: 0,
    });
  });

  // -- ACTIONS --
  function addCase(newCaseData) {
    const newId = cases.value.length > 0 ? Math.max(...cases.value.map(c => c.id)) + 1 : 1;
    const caseItem = {
      id: newId,
      created_at: new Date().toISOString(),
      updated_at: new Date().toISOString(),
      ...newCaseData,
    };
    cases.value = [caseItem, ...cases.value];
    return caseItem;
  }

  function updateCase(id, updates) {
    const index = cases.value.findIndex(caseItem => caseItem.id === id);
    if (index !== -1) {
      // 只更新指定的欄位，而不是整個物件替換
      Object.assign(cases.value[index], { ...updates, updated_at: new Date().toISOString() });
      return cases.value[index];
    }
    return null;
  }

  function updateCaseStatus(id, newStatus) {
    return updateCase(id, { case_status: newStatus });
  }

  function updateCaseCaseStatus(id, newCaseStatus) {
    return updateCase(id, { case_status: newCaseStatus });
  }

  // 為了向後兼容，加入 addLead 別名
  function addLead(newLeadData) {
    return addCase(newLeadData);
  }

  // 為了向後兼容，加入 updateLeadCaseStatus 別名
  function updateLeadCaseStatus(id, newCaseStatus) {
    return updateCaseCaseStatus(id, newCaseStatus);
  }

  // 更新案件業務等級
  function updateCaseBusinessLevel(id, newBusinessLevel) {
    return updateCase(id, { business_level: newBusinessLevel });
  }

  // 追蹤記錄操作
  function addTrackingRecord(newRecordData) {
    const newId = trackingRecords.value.length > 0 ? Math.max(...trackingRecords.value.map(r => r.id)) + 1 : 1;
    const record = {
      id: newId,
      created_at: new Date().toISOString(),
      updated_at: new Date().toISOString(),
      ...newRecordData,
    };
    trackingRecords.value = [record, ...trackingRecords.value];
    return record;
  }

  function updateTrackingRecord(id, updates) {
    const index = trackingRecords.value.findIndex(record => record.id === id);
    if (index !== -1) {
      Object.assign(trackingRecords.value[index], { ...updates, updated_at: new Date().toISOString() });
      return trackingRecords.value[index];
    }
    return null;
  }

  function removeTrackingRecord(id) {
    const index = trackingRecords.value.findIndex(record => record.id === id);
    if (index !== -1) {
      const removed = trackingRecords.value.splice(index, 1);
      return removed[0];
    }
    return null;
  }

  function removeCase(id) {
    const index = cases.value.findIndex(caseItem => caseItem.id === id);
    if (index !== -1) {
      const removed = cases.value.splice(index, 1);
      return removed[0];
    }
    return null;
  }

  return {
    cases,
    leads: cases, // 為了向後兼容，加入 leads 別名指向 cases
    trackingRecords, // 加入 trackingRecords
    getCasesByStatus,
    getCasesByCaseStatus,
    statusCounts,
    addCase,
    addLead, // 加入 addLead 方法
    updateCase,
    updateCaseStatus,
    updateCaseCaseStatus,
    updateLeadCaseStatus, // 加入 updateLeadCaseStatus 方法
    updateCaseBusinessLevel, // 加入 updateCaseBusinessLevel 方法
    addTrackingRecord, // 追蹤記錄 CRUD
    updateTrackingRecord,
    removeTrackingRecord,
    removeCase, // 新增 removeCase 方法
  };
});
