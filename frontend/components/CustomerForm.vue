<template>
  <div class="p-4">
    <form @submit.prevent="onSubmit" class="space-y-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- 動態欄位渲染 -->
        <div v-for="field in fields" :key="field.key" :class="{ 'md:col-span-2': field.type === 'textarea' }">
          <label class="block text-sm font-medium mb-1">
            {{ field.label }}
            <span v-if="field.required" class="text-red-500">*</span>
          </label>

          <!-- User Select -->
          <select
            v-if="field.type === 'user_select'"
            v-model="form[field.key]"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          >
            <option value="">未指派</option>
            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
          </select>

          <!-- Website Select -->
          <select
            v-else-if="field.type === 'website_select'"
            v-model="form[field.key]"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          >
            <option value="">請選擇網站</option>
            <option v-for="option in websiteOptions" :key="option.value" :value="option.value">
              {{ option.label }}
            </option>
          </select>

          <!-- Generic Select -->
          <select
            v-else-if="field.type === 'select'"
            v-model="form[field.key]"
            :required="field.required"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          >
            <option value="">請選擇</option>
            <option v-for="option in field.options" :key="option.value" :value="option.value">
              {{ option.label }}
            </option>
          </select>

          <!-- Textarea -->
          <textarea
            v-else-if="field.type === 'textarea'"
            v-model="form[field.key]"
            rows="3"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            :placeholder="field.placeholder"
          ></textarea>

          <!-- Other Inputs -->
          <input
            v-else
            v-model="form[field.key]"
            :type="field.type"
            :required="field.required"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          />
        </div>
      </div>
      <div class="flex justify-end space-x-3">
        <button type="button" class="px-4 py-2 rounded border " @click="$emit('cancel')">取消</button>
        <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white">儲存</button>
      </div>
    </form>
  </div>
</template>

<script setup>
const props = defineProps({
  modelValue: { type: Object, default: () => ({}) },
  fields: { type: Array, default: () => [] },
  users: { type: Array, default: () => [] },
  websiteOptions: { type: Array, default: () => [] }
})
const emit = defineEmits(['save','cancel'])

// 動態建立表單資料
const form = reactive({})

// 初始化表單資料（根據 fields 配置）
const initializeForm = () => {
  props.fields.forEach(field => {
    form[field.key] = props.modelValue[field.key] ?? ''
  })
}

// 監聽 modelValue 變化
watch(() => props.modelValue, (newVal) => {
  if (newVal) {
    props.fields.forEach(field => {
      form[field.key] = newVal[field.key] ?? ''
    })
  }
}, { immediate: true })

// 監聽 fields 變化
watch(() => props.fields, () => {
  initializeForm()
}, { immediate: true })

const onSubmit = () => {
  emit('save', { ...form })
}
</script>
