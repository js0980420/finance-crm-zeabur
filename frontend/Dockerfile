FROM node:22-alpine

LABEL "language"="nodejs"
LABEL "framework"="nuxt.js"

# 生產模式環境變數
ENV NODE_ENV=production
ENV NUXT_HOST=0.0.0.0
ENV NUXT_PORT=8080
ENV NUXT_PUBLIC_API_BASE_URL=https://laravel-api.zeabur.app/api

WORKDIR /src

# 安裝 pnpm
RUN npm install -g pnpm@9

# 複製前端檔案
COPY frontend/ /src

# 只安裝生產依賴
RUN pnpm install --prod --frozen-lockfile

# 建置應用程式
RUN pnpm build

# 移除開發依賴和不必要檔案以減少映像檔大小
RUN pnpm prune --prod && \
    rm -rf .nuxt/cache && \
    rm -rf node_modules/.cache

EXPOSE 8080

# 啟動生產伺服器
CMD ["node", ".output/server/index.mjs"]
