import { useAuthStore } from '~/stores/auth'

export default defineNuxtRouteMiddleware(async (to, from) => {
  const authStore = useAuthStore()

  // 如果是登入頁面，直接允許通過，不執行任何檢查
  if (to.path === '/auth/login' || to.path === '/auth/register') {
    return
  }

  console.log('Auth middleware - 來源頁面:', from?.path, '目標頁面:', to.path)
  console.log('Auth middleware - 當前登入狀態:', authStore.isLoggedIn)

  // 如果已經登入，直接允許通過（避免重複驗證）
  if (authStore.isLoggedIn) {
    console.log('用戶已登入，直接通過')
    return
  }

  // 等待初始化完成 - 使用本地 token 判斷，速度更快
  if (process.client) {
    try {
      // 快速初始化，不需要等待 DOM
      const authSuccess = await authStore.waitForInitialization()

      console.log('Auth middleware - 初始化結果:', authSuccess)
      console.log('Auth middleware - 初始化後登入狀態:', authStore.isLoggedIn)

      // 初始化後立即檢查登入狀態，不需要額外等待
      if (!authStore.isLoggedIn) {
        console.log('用戶未登入，重定向到登入頁')
        // 保存原始目標路徑，避免循環重定向
        const redirectPath = to.path !== '/' && to.path !== '/auth/login' ? to.path : undefined
        return navigateTo(redirectPath ? `/auth/login?redirect=${encodeURIComponent(redirectPath)}` : '/auth/login')
      }

      console.log('用戶已登入，允許通過')

    } catch (error) {
      console.error('Auth middleware - 初始化失敗:', error)
      // 保存原始目標路徑
      const redirectPath = to.path !== '/' && to.path !== '/auth/login' ? to.path : undefined
      return navigateTo(redirectPath ? `/auth/login?redirect=${encodeURIComponent(redirectPath)}` : '/auth/login')
    }
  } else {
    // Server side: 如果沒有登入狀態就重定向
    if (!authStore.isLoggedIn) {
      // 保存原始目標路徑
      const redirectPath = to.path !== '/' ? to.path : undefined
      return navigateTo(redirectPath ? `/auth/login?redirect=${encodeURIComponent(redirectPath)}` : '/auth/login')
    }
  }
})