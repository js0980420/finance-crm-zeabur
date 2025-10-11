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

  const assignLead = async (id, payload) => {
    const { data, error } = await put(`/leads/${id}`, { assigned_to: payload.assigned_to })
    if (error) return { success: false, error }
    return { success: true, lead: data.lead }
  }

  // Helper: get latest lead for a customer (by created_at desc)
  const getLatestForCustomer = async (customerId) => {
    const { success, items } = await list({ customer_id: customerId, per_page: 1 })
    return success && items.length > 0 ? items[0] : null
  }

  // Get status summary
  const getStatusSummary = async () => {
    const { data, error } = await get('/leads/status-summary')
    if (error) return { success: false, error }
    return { success: true, summary: data }
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
    deleteOne: removeOne, // Alias for consistency
    assignLead,
    getLatestForCustomer,
    getStatusSummary,
    create,
    createOne: create // Alias for consistency
  }
}
