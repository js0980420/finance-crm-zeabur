export default defineNuxtConfig({
  devtools: { enabled: true },
  ssr: false, // 開發環境關閉 SSR 加快載入速度
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
  // Development server configuration removed - using package.json port setting (9122)
  // Development configuration
  vite: {
    server: {
      allowedHosts: ['finance.local', 'localhost'],
      hmr: {
        overlay: false, // 關閉錯誤覆蓋層，加快開發體驗
        protocol: 'ws',
        host: 'localhost',
        port: 9122,
        clientPort: 9122
      },
      // Point 78: Vite proxy configuration for local development CORS solution
      // This proxy forwards '/api/*' requests to backend server at localhost:9221
      // Only active in development mode (NODE_ENV=development)
      // Develop/Production environments bypass this proxy and use direct API calls
      proxy: {
        '/api': {
          target: process.env.NODE_ENV === 'development' ? 'http://127.0.0.1:9222' : 'http://backend:8000',
          changeOrigin: true,
          secure: false,
          ws: true, // Support WebSocket
          configure: (proxy, options) => {
            // 移除日誌以加快速度
            // proxy.on('proxyReq', (proxyReq, req, res) => {
            //   console.log(`[Vite Proxy] ${req.method} ${req.url} -> ${options.target}${req.url}`)
            // })
          }
        }
      }
    },
    build: {
      rollupOptions: {
        external: (id) => {
          return false
        }
      }
    },
    optimizeDeps: {
      include: ['@heroicons/vue', 'sweetalert2', 'pinia'],
      exclude: []
    },
    // 啟用快取加快重新啟動
    cacheDir: 'node_modules/.vite'
  },
  // Enable hot module replacement in development
  nitro: {
    experimental: {
      wasm: true
    }
  },
})
