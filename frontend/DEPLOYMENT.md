# 部署配置說明

## 環境變數配置

### 本地開發環境

在本地開發時，使用 `.env` 檔案：

```env
# API 配置
NUXT_PUBLIC_API_BASE_URL=/api
VITE_BACKEND_URL=http://127.0.0.1:9222
```

**說明**：
- `NUXT_PUBLIC_API_BASE_URL=/api`：前端使用 `/api` 路徑
- `VITE_BACKEND_URL=http://127.0.0.1:9222`：Vite 代理會將 `/api` 請求轉發到本地後端

### Zeabur 部署環境

在 Zeabur 服務設定中加入以下環境變數：

#### 方案 1：使用後端的公開 URL（推薦）

```env
NUXT_PUBLIC_API_BASE_URL=https://your-backend-service.zeabur.app/api
```

**優點**：簡單直接，前端直接請求後端公開 URL
**缺點**：需要處理 CORS

#### 方案 2：使用 Vite 代理 + 內部服務名稱

```env
NUXT_PUBLIC_API_BASE_URL=/api
VITE_BACKEND_URL=http://backend:8000
```

**優點**：
- 使用 Zeabur 內部網路，速度更快
- 不需要處理 CORS
- 前後端在同一個專案內可使用服務名稱 `backend`

**注意**：前後端必須在同一個 Zeabur 專案中

## Zeabur 設定步驟

1. **進入 Zeabur 專案控制台**
2. **選擇前端服務**
3. **點擊「Environment Variables」（環境變數）**
4. **根據上述方案加入環境變數**

### 範例：使用方案 2（推薦）

| Key | Value |
|-----|-------|
| `NUXT_PUBLIC_API_BASE_URL` | `/api` |
| `VITE_BACKEND_URL` | `http://backend:8000` |

**注意**：`backend` 是您在 Zeabur 中後端服務的名稱，請根據實際情況調整。

## 驗證配置

部署後，打開瀏覽器開發者工具（F12），檢查 Network 標籤：

- ✅ **正確**：API 請求成功，狀態碼 200
- ❌ **錯誤**：
  - `ECONNREFUSED`：Vite 代理無法連接到後端（檢查 `VITE_BACKEND_URL`）
  - `CORS error`：直接請求後端但未設定 CORS（使用方案 2）
  - `404 Not Found`：API URL 設定錯誤（檢查 `NUXT_PUBLIC_API_BASE_URL`）

## 常見問題

### Q: 為什麼本地開發正常，Zeabur 部署失敗？

A: 因為本地和 Zeabur 的後端地址不同。本地是 `127.0.0.1:9222`，Zeabur 是內部服務名稱或公開 URL。

### Q: 如何知道後端服務的內部名稱？

A: 在 Zeabur 專案中，服務的內部名稱就是您建立服務時設定的名稱（通常是 `backend`、`api` 等）。

### Q: 前後端不在同一個 Zeabur 專案怎麼辦？

A: 使用方案 1，直接設定後端的公開 URL，並在後端設定 CORS 允許前端域名。
