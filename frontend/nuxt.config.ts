export default defineNuxtConfig({
  app: {
    head: {
      link: [
        { rel: 'stylesheet', href: 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' }
      ]
    }
  },
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
      // Use environment variable to determine API base URL
      // Local: set NUXT_PUBLIC_API_BASE_URL='/api' to use proxy
      // Zeabur: set NUXT_PUBLIC_API_BASE_URL to backend service URL
      apiBaseUrl: process.env.NUXT_PUBLIC_API_BASE_URL || '/api'
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
          // Use VITE_BACKEND_URL environment variable or default to local backend
          target: process.env.VITE_BACKEND_URL || 'http://127.0.0.1:9222',
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
