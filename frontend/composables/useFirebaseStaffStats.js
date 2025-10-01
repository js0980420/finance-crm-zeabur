/*
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
    console.warn('Firebase staff stats功能已禁用')
    connectionStatus.value = 'disabled'
    return false
  }

  // const watchStaffStats = (staffId) => {
  //   if (!isConnected.value || !staffId) return
  // 
  //   try {
  //     const statsRef = dbRef($firebaseDB, `staff_unread_stats/${staffId}`)
  // 
  //     const listener = onValue(statsRef, (snapshot) => {
  //       if (snapshot.exists()) {
  //         const data = snapshot.val()
  //         staffStats.value = {
  //           staffId: data.staffId,
  //           totalUnread: data.totalUnread || 0,
  //           activeConversations: data.activeConversations || 0,
  //           conversationDetails: data.conversationDetails || [],
  //           lastUpdated: data.updated ? new Date(data.updated) : new Date(),
  //           generatedAt: data.generatedAt || new Date().toISOString()
  //         }
  //         console.log(`Staff stats updated for ${staffId}:`, staffStats.value)
  //       } else {
  //         staffStats.value = null
  //         console.log(`No staff stats found for ${staffId}`)
  //       }
  //     }, (error) => {
  //       console.error(`Firebase Realtime Database staff stats listener error for ${staffId}:`, error)
  //       handleFirebaseError(error)
  //     })
  // 
  //     // 儲存監聽器引用
  //     listeners.set(`staff_stats_${staffId}`, { ref: statsRef, listener })
  //     
  //   } catch (error) {
  //     console.error(`Failed to setup Realtime Database staff stats listener for ${staffId}:`, error)
  //     handleFirebaseError(error)
  //   }
  // }

  /**
   * 監聽所有員工統計總覽（admin/executive 用）
   */
  // const watchAllStaffStats = () => {
  //   if (!isConnected.value || !canViewAllChats()) return
  // 
  //   try {
  //     const overviewRef = dbRef($firebaseDB, 'admin_staff_overview/all_staff_stats')
  // 
  //     const listener = onValue(overviewRef, (snapshot) => {
  //       if (snapshot.exists()) {
  //         const data = snapshot.val()
  //         allStaffStats.value = {
  //           totalStaff: data.totalStaff || 0,
  //           totalUnreadMessages: data.totalUnreadMessages || 0,
  //           totalActiveConversations: data.totalActiveConversations || 0,
  //           staffDetails: data.staffDetails || [],
  //           lastUpdated: data.lastUpdated ? new Date(data.lastUpdated) : new Date(),
  //           generatedAt: data.generatedAt || new Date().toISOString()
  //         }
  //         console.log('All staff stats updated:', allStaffStats.value)
  //       } else {
  //         allStaffStats.value = null
  //         console.log(`No admin staff overview found`)
  //       }
  //     }, (error) => {
  //       console.error('Firebase Realtime Database all staff stats listener error:', error)
  //       handleFirebaseError(error)
  //     })
  // 
  //     // 儲存監聽器引用
  //     listeners.set('all_staff_stats', { ref: overviewRef, listener })
  //     
  //   } catch (error) {
  //     console.error('Failed to setup Realtime Database all staff stats listener:', error)
  //     handleFirebaseError(error)
  //   }
  // }

  /**
   * 開始監聽統計資料（根據權限自動選擇）
   */
  const startStatsMonitoring = () => {
    console.warn('Firebase staff stats監聽功能已禁用')
    return false
  }

  /**
   * 停止監聽特定統計
   */
  const stopStatsMonitoring = (key) => {
    console.warn(`Firebase staff stats停止監聽功能已禁用: ${key}`)
  }

  /**
   * 獲取特定員工的詳細統計（從全域統計中查找）
   */
  const getStaffDetailFromOverview = (staffId) => {
    console.warn('Firebase staff stats獲取員工詳細統計功能已禁用')
    return null
  }

  /**
   * 計算總未讀數量（根據當前用戶權限）
   */
  const getTotalUnreadCount = () => {
    console.warn('Firebase staff stats獲取總未讀數量功能已禁用')
    return 0
  }

  /**
   * 獲取活躍對話數量
   */
  const getActiveConversationsCount = () => {
    console.warn('Firebase staff stats獲取活躍對話數量功能已禁用')
    return 0
  }

  /**
   * 錯誤處理
   */
  // const handleFirebaseError = (firebaseError) => {
  //   error.value = firebaseError
  //   connectionStatus.value = 'error'
  //   console.warn('Firebase staff stats error, may need fallback')
  // }

  /**
   * 清理所有監聽器
   */
  const cleanup = () => {
    console.warn('Firebase staff stats清理功能已禁用')
    listeners.clear()
    isConnected.value = false
    connectionStatus.value = 'disabled'
    staffStats.value = null
    allStaffStats.value = null
  }

  return {
    // 狀態
    isConnected: readonly(ref(false)),
    staffStats: readonly(ref(null)),
    allStaffStats: readonly(ref(null)),
    error: readonly(ref('Firebase功能已禁用')),
    connectionStatus: readonly(ref('disabled')),
    
    // 方法
    initialize: () => false,
    startStatsMonitoring: () => false,
    stopStatsMonitoring: () => {},
    watchStaffStats: () => {},
    watchAllStaffStats: () => {},
    getStaffDetailFromOverview: () => null,
    getTotalUnreadCount: () => 0,
    getActiveConversationsCount: () => 0,
    cleanup: () => {},
  }
}
*/