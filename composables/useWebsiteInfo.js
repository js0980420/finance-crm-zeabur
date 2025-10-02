import { computed } from 'vue'

// 工具函數：從 URL 中提取域名
const extractDomain = (url) => {
  try { return new URL(url).hostname } catch { return url || '' }
}

// 網站資訊處理 Composable
export function useWebsiteInfo(websitesRef) {
  // 根據域名或 URL 獲取網站資訊
  const getWebsiteInfo = (url) => {
    if (!url) return { name: '-', domain: '', website: null }

    const domain = extractDomain(url)

    // 增強匹配邏輯，從網站管理系統中查找網站
    const website = websitesRef.value.find(w => {
      // 精確域名匹配
      if (w.domain === domain) return true

      // 不帶 www 前綴的域名匹配
      const cleanDomain = domain.replace(/^www\./, '')
      const cleanWebsiteDomain = w.domain.replace(/^www\./, '')
      if (cleanDomain === cleanWebsiteDomain) return true

      // 檢查 URL 是否包含網站域名
      if (url.includes(w.domain)) return true

      // 檢查域名是否包含網站域名 (用於子域名)
      if (domain.includes(w.domain) || w.domain.includes(domain)) return true

      return false
    })

    if (website) {
      // 返回網站管理系統中的網站名稱
      return {
        name: website.name, // 這來自網站管理「網站名稱」
        domain: website.domain,
        website: website
      }
    }

    // 如果在網站管理中找不到匹配項，則回退
    return {
      name: domain || url,
      domain: domain || url,
      website: null
    }
  }

  // 獲取網站名稱的便捷函數
  const getWebsiteName = (item) => {
  try {
    if (!item) {
      console.warn('getWebsiteName received null or undefined item');
      return '未知網站 (無項目)';
    }
    const url = item.payload?.['頁面_URL'] || item.source;
    if (!url) {
      console.warn('getWebsiteName received item without valid URL:', item);
      return '未知網站 (無URL)';
    }
    const websiteInfo = getWebsiteInfo(url);
    if (!websiteInfo || !websiteInfo.name) {
      console.warn('getWebsiteInfo returned invalid data for URL:', url, websiteInfo);
      return '未知網站 (無名稱)';
    }
    return websiteInfo.name;
  } catch (e) {
    console.error('Error in getWebsiteName:', e, 'Item:', item);
    return '未知網站 (錯誤)';
  }
}

  return {
    getWebsiteInfo,
    getWebsiteName
  }
}
