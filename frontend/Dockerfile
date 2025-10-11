FROM node:22-alpine

LABEL "language"="nodejs"
LABEL "framework"="nuxt.js"

# 生產模式環境變數
ENV NODE_ENV=production
ENV NUXT_HOST=0.0.0.0
ENV NUXT_PORT=8080
ENV NUXT_PUBLIC_API_BASE_URL=https://laravel-api.zeabur.app/api
ENV NITRO_PRESET=node-server

WORKDIR /src

# 複製前端檔案
COPY frontend/ /src

# 安裝依賴（使用 npm，因為有 package-lock.json）
RUN npm install

# 建置應用程式（使用 node-server preset）
RUN npm run build

EXPOSE 8080

# 啟動生產伺服器 - 使用標準 Node.js 輸出
CMD ["node", ".output/server/index.mjs"]
