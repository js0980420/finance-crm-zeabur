import { ref, computed, watch } from 'vue'

export const useRealtimeChat = () => {
  // Firebase即時聊天
  // const firebaseChat = useFirebaseChat()
  
  // 發送訊息仍需要通過API
  const { replyMessage } = useChat()
  
  // 狀態管理
  const conversations = ref([])
  const messages = ref({})
  const connectionStatus = ref('disconnected')
  const error = ref(null)
  
  // 監聽器管理
  // let watcherCleanupFns = []

  /**
   * 初始化即時聊天
   */
  const initialize = async () => {
    console.log('Firebase即時聊天系統已停用，使用API fallback模式...')
    connectionStatus.value = 'disconnected'
    error.value = 'Firebase已停用，即時聊天功能無法使用'
    return false // 返回 false 表示初始化失敗
  }

  /**
   * 清理舊的監聽器
   */
  // const cleanupWatchers = () => {
  //   watcherCleanupFns.forEach(cleanup => {
  //     try {
  //       cleanup()
  //     } catch (error) {
  //       console.warn('清理監聽器時出錯:', error)
  //     }
  //   })
  //   watcherCleanupFns = []
  // }
  
  /**
   * 開始Firebase監聽
   */
  const startFirebaseListeners = async () => {
    console.warn('Firebase監聽器已停用，無法啟動。')
  }

  /**
   * 載入特定用戶的訊息
   */
  const loadMessages = async (lineUserId) => {
    console.warn('Firebase已停用，無法載入訊息。')
    // 這裡可以考慮添加一個API fallback來獲取歷史消息，如果需要的話
  }

  /**
   * 發送訊息
   */
  const sendMessage = async (lineUserId, content) => {
    try {
      // 發送訊息通過API
      const response = await replyMessage(lineUserId, content)
      
      // 在Firebase停用模式下，訊息不會通過即時監聽自動更新
      // 可能需要手動更新 messages 狀態 (如果需要實時顯示發送的訊息)
      return response
    } catch (error) {
      console.error('發送訊息失敗:', error)
      throw error
    }
  }

  /**
   * 停止監聽特定用戶訊息
   */
  const unwatchMessages = (lineUserId) => {
    console.warn('Firebase已停用，無法停止監聽訊息。')
  }

  /**
   * 清理所有資源
   */
  const cleanup = () => {
    console.log('清理即時聊天資源...')
    
    // 清理監聽器
    // cleanupWatchers() 
    
    // 清理Firebase資源 (不再需要)
    // firebaseChat.cleanup() 
    
    // 重置狀態
    conversations.value = []
    messages.value = {}
    connectionStatus.value = 'disconnected'
    error.value = null
    
    console.log('即時聊天資源清理完成')
  }

  /**
   * 獲取連接狀態文字
   */
  const getConnectionStatusText = () => {
    return 'Firebase已停用'
  }

  return {
    // 狀態
    conversations: readonly(conversations),
    messages: readonly(messages),
    connectionStatus: readonly(connectionStatus),
    error: readonly(error),
    
    // 方法
    initialize,
    loadMessages,
    sendMessage,
    unwatchMessages,
    cleanup,
    getConnectionStatusText
  }
}