import { useAuthStore } from '~/stores/auth'

export default defineNuxtPlugin(() => {
  // Initialize auth store on client side only
  const authStore = useAuthStore()

  // 僅初始化 store，不進行任何 API 調用
  // 實際的初始化會在 middleware 中進行，使用本地 token 判斷
  // 這樣可以避免在 plugin 階段調用後端 API 導致 503 錯誤
  console.log('Auth plugin - Auth store initialized')
  console.log('Auth plugin - 當前登入狀態:', authStore.isLoggedIn)
})