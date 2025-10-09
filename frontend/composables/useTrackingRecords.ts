/**
 * 追蹤記錄 API
 * 移除所有 mock 邏輯，直接使用真實 API
 */

export function useTrackingRecords() {
  const { get, post, put, del } = useApi()

  const list = async () => {
    const { data, error } = await get('/contact-schedules')
    if (error) {
      console.error('Failed to fetch tracking records:', error)
      return { items: [], success: false, error }
    }
    return { items: data?.data || [], success: true }
  }

  const create = async (record: any) => {
    const { data, error } = await post('/contact-schedules', record)
    if (error) {
      console.error('Failed to create tracking record:', error)
      return { error: true, message: error.message || 'Failed to create' }
    }
    return { error: false, message: 'Success', data: data?.data }
  }

  const update = async (id: string, record: any) => {
    const { data, error } = await put(`/contact-schedules/${id}`, record)
    if (error) {
      console.error('Failed to update tracking record:', error)
      return { error: true, message: error.message || 'Failed to update' }
    }
    return { error: false, message: 'Success', data: data?.data }
  }

  const remove = async (id: string) => {
    const { data, error } = await del(`/contact-schedules/${id}`)
    if (error) {
      console.error('Failed to delete tracking record:', error)
      return { error: true, message: error.message || 'Failed to delete' }
    }
    return { error: false, message: 'Success', data: data?.data }
  }

  return {
    list,
    create,
    update,
    remove,
  }
}
