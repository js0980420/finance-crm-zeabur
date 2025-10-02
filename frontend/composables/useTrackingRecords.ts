
import { ref } from 'vue';
import { useMockDataStore } from '~/stores/mockData';

export function useTrackingRecords() {
  const list = () => {
    console.log('Listing tracking records from mock store');
    const config = useRuntimeConfig();

    if (config.public.apiBaseUrl === '/mock-api') {
      const mockDataStore = useMockDataStore();
      return Promise.resolve({
        items: mockDataStore.trackingRecords,
        success: true
      });
    }

    // API 模式的邏輯 (暫時返回空陣列)
    return Promise.resolve({
      items: [],
      success: true
    });
  };

  const create = (record: any) => {
    console.log('Creating tracking record:', record);
    const config = useRuntimeConfig();

    if (config.public.apiBaseUrl === '/mock-api') {
      const mockDataStore = useMockDataStore();
      const newRecord = mockDataStore.addTrackingRecord(record);
      return { error: false, message: 'Success', data: newRecord };
    }

    // API 模式的邏輯
    return { error: false, message: 'Success' };
  };

  const update = (id: string, record: any) => {
    console.log(`Updating tracking record ${id}:`, record);
    const config = useRuntimeConfig();

    if (config.public.apiBaseUrl === '/mock-api') {
      const mockDataStore = useMockDataStore();
      const updatedRecord = mockDataStore.updateTrackingRecord(parseInt(id), record);
      return { error: !updatedRecord, message: updatedRecord ? 'Success' : 'Not found', data: updatedRecord };
    }

    // API 模式的邏輯
    return { error: false, message: 'Success' };
  };

  const remove = (id: string) => {
    console.log(`Removing tracking record ${id}`);
    const config = useRuntimeConfig();

    if (config.public.apiBaseUrl === '/mock-api') {
      const mockDataStore = useMockDataStore();
      const removedRecord = mockDataStore.removeTrackingRecord(parseInt(id));
      return { error: !removedRecord, message: removedRecord ? 'Success' : 'Not found', data: removedRecord };
    }

    // API 模式的邏輯
    return { error: false, message: 'Success' };
  };

  return {
    list,
    create,
    update,
    remove,
  };
}
