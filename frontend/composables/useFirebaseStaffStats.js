import { ref, reactive } from 'vue'
// import { ref as dbRef, onValue, off } from 'firebase/database'

export const useFirebaseStaffStats = () => {
  // const { $firebaseDB } = useNuxtApp()
  const { canViewAllChats, getLocalUser } = useAuth()
  
  // 狀態管理
  const isConnected = ref(false)
  const staffStats = ref(null)
  const allStaffStats = ref(null)
  const listeners = reactive(new Map())
  
  // 錯誤處理
  const error = ref(null)
  const connectionStatus = ref('disconnected')

  /**
   * 初始化連接
   */
  const initialize = () => {
    console.warn('Firebase staff stats is disabled.')
    connectionStatus.value = 'error'
    isConnected.value = false
    return false
  }

  /**
   * 監聽個人員工統計（一般員工用）
   */
  const watchStaffStats = (staffId) => {
    console.warn(`Firebase staff stats monitoring for ${staffId} is disabled.`)
  }

  /**
   * 監聽所有員工統計總覽（admin/executive 用）
   */
  const watchAllStaffStats = () => {
    console.warn('Firebase all staff stats monitoring is disabled.')
  }

  /**
   * 開始監聽統計資料（根據權限自動選擇）
   */
  const startStatsMonitoring = () => {
    console.warn('Firebase stats monitoring is disabled.')
    return false
  }

  /**
   * 停止監聽特定統計
   */
  const stopStatsMonitoring = (key) => {
    console.warn(`Stopping Firebase stats monitoring for ${key} is disabled.`)
  }

  /**
   * 獲取特定員工的詳細統計（從全域統計中查找）
   */
  const getStaffDetailFromOverview = (staffId) => {
    console.warn('Firebase is disabled, cannot get staff details from overview.')
    return null
  }

  /**
   * 計算總未讀數量（根據當前用戶權限）
   */
  const getTotalUnreadCount = () => {
    return 0
  }

  /**
   * 獲取活躍對話數量
   */
  const getActiveConversationsCount = () => {
    return 0
  }

  /**
   * 錯誤處理
   */
  const handleFirebaseError = (firebaseError) => {
    console.warn('Firebase staff stats error handled, but Firebase is disabled:', firebaseError)
    error.value = firebaseError
    connectionStatus.value = 'error'
  }

  /**
   * 清理所有監聽器
   */
  const cleanup = () => {
    console.warn('Firebase stats cleanup is disabled.')
    listeners.clear()
    isConnected.value = false
    connectionStatus.value = 'disconnected'
    staffStats.value = null
    allStaffStats.value = null
  }

  return {
    // 狀態
    isConnected: readonly(isConnected),
    staffStats: readonly(staffStats),
    allStaffStats: readonly(allStaffStats),
    error: readonly(error),
    connectionStatus: readonly(connectionStatus),
    
    // 方法
    initialize,
    startStatsMonitoring,
    stopStatsMonitoring,
    watchStaffStats,
    watchAllStaffStats,
    getStaffDetailFromOverview,
    getTotalUnreadCount,
    getActiveConversationsCount,
    cleanup
  }
}