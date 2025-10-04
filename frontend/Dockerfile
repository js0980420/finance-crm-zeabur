# Nuxt 前端 - 開發模式配置
FROM node:20-alpine

WORKDIR /app

# 安裝編譯依賴
RUN apk add --no-cache python3 make g++

# 複製 package files
COPY package*.json ./

# 安裝依賴包（包含開發依賴）
RUN npm install

# 複製源碼
COPY . .

# 設定開發環境變數
ENV NODE_ENV=development
ENV NUXT_HOST=0.0.0.0
ENV NUXT_PORT=8080
ENV PORT=8080

# 暴露端口
EXPOSE 8080

# 使用開發模式啟動
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0", "--port", "8080"]
