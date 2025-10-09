import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', () => {
  // 用戶狀態
  const user = ref(null)
  const isLoggedIn = computed(() => !!user.value && !!user.value.token)
  const token = computed(() => user.value?.token || null)
  
  // 初始化狀態追蹤
  const _isInitializing = ref(false)
  const _isInitialized = ref(false)
  const _initPromise = ref(null)
  
  // 權限檢查
  const isExecutive = computed(() => user.value?.role === roles.EXECUTIVE)
  const isAdmin = computed(() => user.value?.role === roles.ADMIN)
  const isManager = computed(() => user.value?.role === roles.MANAGER)
  const isStaff = computed(() => user.value?.role === roles.STAFF)
  
  // 檢查特定權限
  const hasPermission = (permission) => {
    if (!user.value) return false
    
    // Admin 和 Executive 角色自動擁有所有權限
    if (user.value.role === 'admin' || user.value.role === 'executive') {
      return true
    }
    
    // 檢查是否有 all_access 權限（超級管理員）
    if (user.value.permissions?.includes('all_access')) {
      return true
    }
    
    // 檢查特定權限
    return user.value.permissions?.includes(permission)
  }
  
  // 權限角色定義（與後端保持一致）
  const roles = {
    ADMIN: 'admin', // 系統管理員
    EXECUTIVE: 'executive', // 經銷商/公司高層
    MANAGER: 'manager', // 行政人員/主管
    STAFF: 'staff' // 業務人員
  }

  // 移除模擬用戶數據，改為完全使用 API

  // 登入功能
  const login = async (credentials) => {
    try {
      const { post } = useApi()
      
      // 調試：檢查傳入的密碼
      console.log('Login credentials:', {
        username: credentials.username,
        password: credentials.password,
        passwordLength: credentials.password?.length,
        passwordType: typeof credentials.password
      })
      
      // 使用統一的 API composable
      const { data: response, error } = await post('/auth/login', {
        username: credentials.username,  // 後端期望 username 欄位
        password: credentials.password
      })
      
      if (error) {
        throw new Error(error.message || '登入失敗')
      }
      
      if (response.access_token && response.user) {
        // 調試：檢查後端回應格式
        console.log('Backend response:', {
          access_token: !!response.access_token,
          user: response.user,
          roles: response.user.roles,
          rolesType: typeof response.user.roles,
          rolesLength: response.user.roles?.length,
          firstRole: response.user.roles?.[0]
        })
        
        // 設定用戶資料，確保包含 token 和主要角色
        const userData = {
          ...response.user,
          token: response.access_token,  // 後端回傳 access_token
          role: Array.isArray(response.user.roles) 
            ? response.user.roles[0] 
            : (response.user.roles && response.user.roles[0]) || null  // 取得主要角色（第一個角色）
        }
        
        console.log('設定的用戶資料:', userData)
        user.value = userData
        
        // 強制觸發響應式更新
        await nextTick()
        
        // 檢查 user 是否正確設定
        console.log('設定後的 user.value:', user.value)
        console.log('設定後的 isLoggedIn:', isLoggedIn.value)
        
        // 儲存包含 JWT token 的用戶資料到 sessionStorage
        if (process.client) {
          sessionStorage.setItem('user-profile', JSON.stringify({
            id: userData.id,
            username: userData.username,
            email: userData.email,
            name: userData.name,
            roles: userData.roles,
            permissions: userData.permissions,
            is_admin: userData.is_admin,
            is_manager: userData.is_manager,
            token: userData.token  // 儲存 JWT token
          }))
        }
        console.log('登入成功，使用 JWT Token + SessionStorage')
        
        // 確保所有狀態更新完成
        await new Promise(resolve => setTimeout(resolve, 50))
        
        return { success: true, user: userData }
      } else {
        throw new Error('登入回應格式錯誤')
      }
    } catch (error) {
      console.error('Login failed:', error)
      throw new Error(error.message || '登入失敗，請檢查您的帳號密碼')
    }
  }

  // 註冊功能
  const register = async (userData) => {
    try {
      const { post } = useApi()
      
      const { data: response, error } = await post('/auth/register', userData)
      
      if (error) {
        throw new Error(error.message || '註冊失敗，請稍後再試')
      }
      
      return { success: true, message: response.message || '註冊成功，請使用您的帳號密碼登入' }
    } catch (error) {
      console.error('Registration failed:', error)
      throw new Error(error.message || '註冊失敗，請稍後再試')
    }
  }

  // 登出功能
  const logout = async () => {
    try {
      // 呼叫後端登出 API 清除 HTTP-Only Cookie
      const { post } = useApi()
      await post('/auth/logout')
    } catch (error) {
      console.error('Logout API error:', error)
    }
    
    user.value = null
    
    // 清除 sessionStorage 中的用戶資料
    if (process.client) {
      sessionStorage.removeItem('user-profile')
      // 不需要清除 localStorage，因為已經不使用了
      localStorage.removeItem('admin-template-user')
      localStorage.removeItem('auth-token')
    }
    
    console.log('已登出，清除會話資料')
    
    // 重定向到登入頁面
    if (process.client) {
      const router = useRouter();
      router.push('/auth/login');
    } else {
      navigateTo('/auth/login');
    }
  }

  // 設定用戶資料
  const setUser = (userData) => {
    user.value = userData
  }

  // 背景驗證 token 是否有效（不阻塞頁面載入）
  const verifyTokenInBackground = async () => {
    if (!process.client || !user.value?.token) {
      return
    }

    try {
      console.log('Background token verification starting...')
      const { get } = useApi()
      const { data: userData, error } = await get('/auth/me')

      if (!error && userData?.user) {
        // Token 有效，更新用戶資料（保留 token）
        user.value = {
          ...userData.user,
          token: user.value.token,
          role: Array.isArray(userData.user.roles)
            ? userData.user.roles[0]
            : (userData.user.roles && userData.user.roles[0]) || null
        }
        console.log('Background token verification succeeded')
      } else {
        // Token 無效，清除登入狀態
        console.log('Background token verification failed - token invalid')
        sessionStorage.removeItem('user-profile')
        user.value = null
        // 重定向到登入頁
        if (process.client) {
          const router = useRouter();
          router.push('/auth/login');
        } else {
          navigateTo('/auth/login');
        }
      }
    } catch (error) {
      console.warn('Background token verification error:', error)
      // 如果是網絡錯誤，保留登入狀態，不強制登出
      // 如果是 401 錯誤，useApi 會自動處理登出
    }
  }

  // 初始化用戶狀態 - 單例模式，防止多次並發初始化
  // 使用本地 token 判斷 + 背景驗證策略
  const initializeAuth = async (force = false) => {
    // 如果已經初始化完成且不是強制重新初始化，直接返回結果
    if (_isInitialized.value && !force) {
      console.log('Auth already initialized, skipping')
      return isLoggedIn.value
    }

    // 如果正在初始化中，返回現有的 Promise
    if (_isInitializing.value && _initPromise.value && !force) {
      console.log('Auth initialization in progress, waiting for existing promise')
      try {
        return await _initPromise.value
      } catch (error) {
        console.error('Failed to wait for existing initialization:', error)
        return false
      }
    }

    if (!process.client) {
      return false
    }

    // 開始初始化
    _isInitializing.value = true

    const initPromise = (async () => {
      try {
        console.log('Starting auth initialization (local token check + background verification)...')

        // 嘗試從 sessionStorage 恢復用戶資料
        const storedProfile = sessionStorage.getItem('user-profile')

        if (storedProfile) {
          try {
            const userProfile = JSON.parse(storedProfile)

            // 檢查是否有 JWT token - 只做本地判斷
            if (!userProfile.token) {
              console.log('No JWT token found in stored profile')
              sessionStorage.removeItem('user-profile')
              user.value = null
              return false
            }

            // 直接使用本地存儲的用戶資料，不阻塞頁面載入
            user.value = {
              ...userProfile,
              role: Array.isArray(userProfile.roles)
                ? userProfile.roles[0]
                : (userProfile.roles && userProfile.roles[0]) || null
            }
            console.log('已從本地恢復登入狀態:', userProfile.username)

            // 在背景非同步驗證 token（不阻塞頁面載入）
            setTimeout(() => {
              verifyTokenInBackground()
            }, 100)

            return true // 先放行，背景驗證

          } catch (error) {
            console.error('解析用戶資料失敗:', error)
            sessionStorage.removeItem('user-profile')
            user.value = null
            return false
          }
        } else {
          user.value = null
          return false
        }
      } catch (error) {
        console.error('初始化認證失敗:', error)
        user.value = null
        return false
      } finally {
        // 清除舊的 localStorage 資料（向後相容）
        if (localStorage.getItem('admin-template-user') || localStorage.getItem('auth-token')) {
          localStorage.removeItem('admin-template-user')
          localStorage.removeItem('auth-token')
          console.log('已清除舊的 localStorage 資料')
        }

        // 標記初始化完成
        _isInitializing.value = false
        _isInitialized.value = true
        _initPromise.value = null
        console.log('Auth initialization completed (local check done, background verification scheduled)')
      }
    })()

    // 保存 Promise 以供其他調用等待
    _initPromise.value = initPromise

    return await initPromise
  }
  
  // 等待初始化完成的輔助方法
  const waitForInitialization = async () => {
    if (_isInitialized.value) {
      return isLoggedIn.value
    }
    
    if (_isInitializing.value && _initPromise.value) {
      try {
        return await _initPromise.value
      } catch (error) {
        console.error('Failed to wait for initialization:', error)
        return false
      }
    }
    
    // 如果沒有進行初始化，啟動初始化
    return await initializeAuth()
  }

  // 所有用戶管理功能現在都透過 useUserManagement composable 處理

  return {
    // 狀態
    user: readonly(user),
    token,
    isLoggedIn,
    isAdmin,
    isExecutive,
    isManager,
    isStaff,
    roles,
    _isInitialized,
    _isInitializing,
    
    // 方法
    login,
    register,
    logout,
    setUser,
    initializeAuth,
    waitForInitialization,
    hasPermission
  }
})
