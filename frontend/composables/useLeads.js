export const useLeads = () => {
  const { get, put, del, post, patch } = useApi()

  const list = async (params = {}) => {
    const { data, error } = await get('/leads', params)
    if (error) return { success: false, error }
    return {
      success: true,
      items: data.data || [],
      meta: {
        total: data.total || 0,
        perPage: data.per_page || params.per_page || 15,
        currentPage: data.current_page || params.page || 1,
        lastPage: data.last_page || 1
      }
    }
  }

  const getOne = async (id) => {
    return await get(`/leads/${id}`)
  }

  const updateOne = async (id, payload) => {
    return await put(`/leads/${id}`, payload)
  }

  /**
   * 更新進線狀態
   * @param {number} id - 進線 ID
   * @param {string} status - 新狀態 (pending, tracking, intake, etc.)
   * @returns {Promise} - API 回應
   */
  const updateStatus = async (id, status) => {
    const { data, error } = await patch(`/leads/${id}/case-status`, { case_status: status })
    if (error) return { success: false, error }
    return { success: true, data }
  }

  const convertToCase = async (lead, payload) => {
    // 若 lead 有綁定 customer，直接送件
    if (!lead.customer_id) throw new Error('Lead 尚未綁定客戶，請先綁定或建立客戶')

    // 1) 建立案件
    const result = await post(`/customers/${lead.customer_id}/cases`, payload)

    // 2) 成功後，更新 lead 狀態為 submitted（已送件）
    if (!result.error) {
      await put(`/leads/${lead.id}`, { status: 'submitted' })
    }

    return result
  }

  const listSubmittable = async (params = {}) => {
    const { data, error } = await get('/leads/submittable', params)
    if (error) return { success: false, error }
    return {
      success: true,
      items: data.data || [],
      meta: {
        total: data.total || 0,
        perPage: data.per_page || params.per_page || 15,
        currentPage: data.current_page || params.page || 1,
        lastPage: data.last_page || 1
      }
    }
  }

  const removeOne = async (id) => {
    return await del(`/leads/${id}`)
  }

  const create = async (payload) => {
    const { data, error } = await post('/leads', payload)
    if (error) return { success: false, error }
    return { success: true, data }
  }

  return {
    list,
    listSubmittable,
    getOne,
    updateOne,
    updateStatus,
    removeOne,
    convertToCase,
    create
  }
}
