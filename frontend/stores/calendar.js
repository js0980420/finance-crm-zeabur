import { defineStore } from 'pinia'

export const useCalendarStore = defineStore('calendar', {
  state: () => ({
    events: [],
    overdueNotificationSent: new Set(), // 記錄已發送逾期通知的事件ID
  }),
  getters: {
    overdueEvents: (state) => {
      const now = new Date()
      return state.events.filter(event => {
        const eventTime = new Date(event.dateTime)
        return eventTime < now && event.status !== 'contacted'
      })
    },
    newOverdueEvents: (state) => {
      const now = new Date()
      const overdueEvents = state.events.filter(event => {
        const eventTime = new Date(event.dateTime)
        return eventTime < now && event.status !== 'contacted'
      })
      return overdueEvents.filter(event =>
        !state.overdueNotificationSent.has(event.id)
      )
    }
  },
  actions: {
    addEvent(event) {
      this.events.push(event)
      this.checkOverdueEvents() // 添加事件後檢查逾期
    },
    updateEvent(updatedEvent) {
      const index = this.events.findIndex(event => event.id === updatedEvent.id)
      if (index !== -1) {
        this.events[index] = updatedEvent
        this.checkOverdueEvents() // 更新事件後檢查逾期
      }
    },
    removeEvent(eventId) {
      this.events = this.events.filter(event => event.id !== eventId)
      this.overdueNotificationSent.delete(eventId) // 移除已發送通知記錄
    },
    checkOverdueEvents(notificationsStore) {
      if (!notificationsStore) {
        console.warn('Notifications store not provided')
        return
      }

      try {
        this.newOverdueEvents.forEach(event => {
          // 發送逾期通知
          notificationsStore.addNotification({
            type: 'overdue',
            title: '追蹤逾期提醒',
            message: `客戶 ${event.case.customer_name} 的追蹤已逾期，請盡快聯繫`,
            priority: 'high',
            icon: 'ExclamationTriangleIcon',
            autoRemove: false, // 重要通知不自動移除
            eventId: event.id,
            caseId: event.case.id
          })

          // 記錄已發送通知
          this.overdueNotificationSent.add(event.id)
        })
      } catch (error) {
        console.error('Error checking overdue events:', error)
      }
    },
    // 手動觸發逾期檢查（用於測試）
    triggerOverdueCheck(notificationsStore) {
      this.checkOverdueEvents(notificationsStore)
    },
    // 清除已發送通知記錄（用於測試）
    clearNotificationHistory() {
      this.overdueNotificationSent.clear()
    }
  },
})
