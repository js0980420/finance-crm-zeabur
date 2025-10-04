export default defineNuxtConfig({
  devtools: { enabled: false },
  // 開發模式使用 SSR 避免 503 錯誤，實際渲染邏輯在客戶端
  ssr: true,
  modules: [
    '@nuxt/ui',
    '@pinia/nuxt'
  ],
  ui: {
    global: true,
    colorMode: {
      preference: 'light'
    }
  },
  css: ['~/assets/css/main.css'],
  runtimeConfig: {
    public: {
      // Point 78: Use vite proxy in local development to avoid CORS issues
      // Local development (NODE_ENV=development): use proxy '/api'
      // Develop/Production environments: use direct API URL
      apiBaseUrl: process.env.NODE_ENV === 'development' ? '/api' : (process.env.NUXT_PUBLIC_API_BASE_URL || 'https://dev-finance.mercylife.cc/api')
    }
  },
  // Development configuration - 優化 Vite 效能
  vite: {
    server: {
      allowedHosts: ['finance.local', 'localhost'],
      hmr: {
        overlay: false,
        protocol: 'ws',
        host: 'localhost',
        port: 9122,
        clientPort: 9122
      },
      proxy: {
        '/api': {
          target: process.env.NODE_ENV === 'development' ? 'http://127.0.0.1:9222' : 'http://backend:8000',
          changeOrigin: true,
          secure: false,
          ws: true
        }
      }
    },
    build: {
      // 生產環境優化
      cssCodeSplit: true,
      chunkSizeWarningLimit: 1000,
      rollupOptions: {
        output: {
          manualChunks: {
            'vendor': ['vue', 'pinia'],
            'icons': ['@heroicons/vue/24/outline'],
            'ui': ['sweetalert2']
          }
        }
      }
    },
    optimizeDeps: {
      // 預構建依賴以加快首次載入
      include: [
        'vue',
        'pinia',
        '@heroicons/vue/24/outline',
        'sweetalert2'
      ],
      // 排除不需要預構建的項目
      exclude: ['@nuxt/devtools', '@nuxt/kit']
    },
    // 啟用快取並設定 ESBuild 優化
    cacheDir: 'node_modules/.vite',
    esbuild: {
      // 使用 esbuild 加速編譯
      target: 'esnext',
      keepNames: true
    }
  },
  // Nitro 配置 - SPA 模式簡化配置
  nitro: {
    // SPA 模式不需要實驗性功能
  },
})
