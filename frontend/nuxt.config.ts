export default defineNuxtConfig({
  devtools: { enabled: false },
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
      // 開發環境使用 proxy，生產環境使用完整 URL
      apiBaseUrl: process.env.NODE_ENV === 'development' 
        ? '/api' 
        : process.env.NUXT_PUBLIC_API_BASE_URL
    }
  },
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
      // 開發環境中的 proxy 配置
      ...(process.env.NODE_ENV === 'development' && {
        proxy: {
          '/api': {
            // Zeabur 開發環境中使用您的 Laravel API
            target: process.env.VITE_BACKEND_URL,
            changeOrigin: true,
            secure: true,
            ws: true,
            // 重寫路徑：將 /api 加入到目標 URL
            rewrite: (path) => path.replace(/^\/api/, '/api')
          }
        }
      })
    },
    build: {
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
      include: [
        'vue',
        'pinia',
        '@heroicons/vue/24/outline',
        'sweetalert2'
      ],
      exclude: ['@nuxt/devtools', '@nuxt/kit']
    },
    cacheDir: 'node_modules/.vite',
    esbuild: {
      target: 'esnext',
      keepNames: true
    }
  },
  nitro: {
    // Nitro 配置
  },
})
