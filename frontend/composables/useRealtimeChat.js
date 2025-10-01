/*
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
  let watcherCleanupFns = []

  /**
   * 初始化即時聊天
   */
  const initialize = async () => {
    console.log('即時聊天系統初始化 (Firebase已停用)...')
    connectionStatus.value = 'disconnected'
    error.value = 'Firebase功能已暫時禁用'
  }

  /**
   * 清理舊的監聽器
   */
  const cleanupWatchers = () => {
    watcherCleanupFns.forEach(cleanup => {
      try {
        cleanup()
      } catch (error) {
        console.warn('清理監聽器時出錯:', error)
      }
    })
    watcherCleanupFns = []
  }

  /**
   * 開始Firebase監聽
   */
  const startFirebaseListeners = async () => {
    try {
      // 先清理舊的監聽器
      cleanupWatchers()
      
      const { canViewAllChats, getLocalUser } = useAuth()
      const user = getLocalUser()
      
      // Admin/executive 用戶可以看所有對話，其他用戶只能看分配給自己的
      const staffId = canViewAllChats() ? null : user?.id
      
      // 監聽對話列表
      // firebaseChat.watchConversations(staffId)
      
      // 監聽Firebase狀態變化 - 設置新的監聽器並保存清理函數
      const conversationsWatcherStop = watch(firebaseChat.conversations, (newConversations) => {
        console.log('Firebase conversations 更新:', newConversations.length)
        conversations.value = [...newConversations]
      }, { deep: true, immediate: true })
      watcherCleanupFns.push(conversationsWatcherStop)
      
      const messagesWatcherStop = watch(firebaseChat.messages, (newMessages) => {
        console.log('Firebase messages 更新:', Object.keys(newMessages).length, '個對話')
        messages.value = { ...newMessages }
      }, { deep: true, immediate: true })
      watcherCleanupFns.push(messagesWatcherStop)
      
      const statusWatcherStop = watch(firebaseChat.connectionStatus, (status) => {
        console.log('Firebase 連接狀態變化:', status)
        connectionStatus.value = status
        
        // Firebase連接失敗時顯示錯誤
        if (status === 'error') {
          console.error('Firebase連接失敗，聊天室功能異常')
          error.value = 'Firebase連接異常，請重新整理頁面或聯繫系統管理員'
        } else if (status === 'connected') {
          error.value = null
        }
      }, { immediate: true })
      watcherCleanupFns.push(statusWatcherStop)
      
    } catch (error) {
      console.error('Firebase監聽器啟動失敗:', error)
      connectionStatus.value = 'error'
      error.value = 'Firebase監聽器初始化失敗'
    }
  }


  /**
   * 載入特定用戶的訊息
   */
  const loadMessages = async (lineUserId) => {
    // 使用Firebase監聽
    // firebaseChat.watchMessages(lineUserId)
  }

  /**
   * 發送訊息
   */
  const sendMessage = async (lineUserId, content) => {
    try {
      // 發送訊息通過API，Firebase會自動同步更新
      const response = await replyMessage(lineUserId, content)
      
      // Firebase模式下，訊息會通過即時監聽自動更新
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
    // firebaseChat.unwatchMessages(lineUserId)
  }

  /**
   * 清理所有資源
   */
  const cleanup = () => {
    console.log('清理Firebase即時聊天資源...')
    
    // 清理監聽器
    cleanupWatchers()
    
    // 清理Firebase資源
    // firebaseChat.cleanup()
    
    // 重置狀態
    conversations.value = []
    messages.value = {}
    connectionStatus.value = 'disconnected'
    error.value = null
    
    console.log('Firebase即時聊天資源清理完成')
  }

  /**
   * 獲取連接狀態文字
   */
  const getConnectionStatusText = () => {
    switch (connectionStatus.value) {
      case 'connected': return '已連接'
      case 'connecting': return '連接中...'
      case 'error': return '連接異常'
      default: return '未連接'
    }
  }

  return {
    // 狀態
    conversations: readonly(conversations),
    messages: readonly(messages),
    connectionStatus: readonly(connectionStatus),
    error: readonly(error),
    
    // 方法
    initialize: () => console.warn('即時聊天功能已禁用'), // 禁用初始化
    loadMessages: () => console.warn('載入訊息功能已禁用'), // 禁用載入訊息
    sendMessage,
    unwatchMessages: () => console.warn('停止監聽訊息功能已禁用'), // 禁用停止監聽訊息
    cleanup: () => console.warn('即時聊天清理功能已禁用'), // 禁用清理
    getConnectionStatusText: () => '功能已禁用' // 禁用狀態文字
  }
}
*/