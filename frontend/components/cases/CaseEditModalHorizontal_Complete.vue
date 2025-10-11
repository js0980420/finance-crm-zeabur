<template>
  <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- 背景遮罩 -->
    <div class="fixed inset-0 bg-black bg-opacity-50" @click="closeModal"></div>

    <!-- 彈窗容器 -->
    <div class="relative w-[95vw] h-[90vh] bg-white rounded-lg shadow-2xl overflow-hidden flex flex-col">
      <!-- 標題列 -->
      <div class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-900">
          {{ isEdit ? '編輯案件' : '新增案件' }}
        </h2>
        <div class="flex space-x-3">
          <button
            type="button"
            @click="closeModal"
            class="px-4 py-2 text-gray-600 hover:text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-50"
          >
            取消
          </button>
          <button
            type="button"
            @click="saveCase"
            :disabled="saving"
            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:opacity-50 font-medium"
          >
            {{ saving ? '儲存中...' : '儲存' }}
          </button>
        </div>
      </div>

      <!-- 表單內容 -->
      <form @submit.prevent="saveCase" class="flex-grow overflow-y-auto p-6">
        <!-- 區塊 1: 基本資訊 -->
        <div class="mb-6 p-5 border border-gray-300 rounded-lg bg-white">
          <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">基本資訊</h3>

          <!-- 第一行：案件狀態 + 業務等級 + 建立時間 + 承辦業務 -->
          <div class="grid grid-cols-4 gap-4 mb-3">
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">案件狀態</label>
              <select v-model="form.case_status" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option v-for="option in CASE_STATUS_OPTIONS" :key="option.value" :value="option.value">
                  {{ option.label }}
                </option>
              </select>
            </div>
            <div class="flex items-center" v-if="showField('business_level')">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">業務等級</label>
              <select v-model="form.business_level" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option v-for="option in BUSINESS_LEVEL_OPTIONS" :key="option.value" :value="option.value">
                  {{ option.label }}
                </option>
              </select>
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">建立時間</label>
              <input :value="formatDateTime(form.created_at)" type="text" readonly
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm bg-gray-100 text-gray-600" />
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">承辦業務</label>
              <select v-model="form.assigned_to" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option value="">未指派</option>
                <option v-for="user in availableUsers" :key="user.id" :value="user.id">{{ user.name }}</option>
              </select>
            </div>
          </div>

          <!-- 第二行：來源管道 + 姓名 + LINE顯示名稱 + LINE ID -->
          <div class="grid grid-cols-4 gap-4 mb-3">
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">來源管道</label>
              <select v-model="form.channel" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option value="">請選擇</option>
                <option v-for="option in CHANNEL_OPTIONS" :key="option.value" :value="option.value">
                  {{ option.label }}
                </option>
              </select>
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">姓名<span class="text-red-500">*</span></label>
              <input v-model="form.customer_name" type="text" required placeholder="請輸入姓名"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-28 text-sm font-medium text-gray-700 shrink-0">LINE顯示名稱</label>
              <input v-model="form.line_display_name" type="text" placeholder="請輸入LINE顯示名稱"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-20 text-sm font-medium text-gray-700 shrink-0">LINE ID</label>
              <input v-model="form.line_id" type="text" placeholder="請輸入LINE ID"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
          </div>

          <!-- 第三行：諮詢項目 + 網站 + Email + 手機號碼 -->
          <div class="grid grid-cols-4 gap-4">
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">諮詢項目</label>
              <select v-model="form.loan_purpose" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option value="">請選擇</option>
                <option v-for="option in PURPOSE_OPTIONS" :key="option.value" :value="option.value">
                  {{ option.label }}
                </option>
              </select>
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">網站</label>
              <select v-model="form.website" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option value="">請選擇</option>
                <option v-for="option in WEBSITE_OPTIONS" :key="option.value" :value="option.value">
                  {{ option.label }}
                </option>
              </select>
            </div>
            <div class="flex items-center">
              <label class="w-20 text-sm font-medium text-gray-700 shrink-0">Email</label>
              <input v-model="form.email" type="email" placeholder="請輸入Email"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">手機號碼<span class="text-red-500">*</span></label>
              <input v-model="form.phone" type="text" required placeholder="請輸入手機號碼"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
          </div>
        </div>

        <!-- 區塊 2: 個人資料 -->
        <div class="mb-6 p-5 border border-gray-300 rounded-lg bg-gray-50">
          <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">個人資料</h3>

          <!-- 第一行：案件編號 + 出生年月日 + 身份證字號 + 最高學歷 -->
          <div class="grid grid-cols-4 gap-4">
            <div class="flex items-center" v-if="isEdit">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">案件編號</label>
              <input :value="formatCaseNumber()" type="text" readonly
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm bg-gray-100 text-gray-600" />
            </div>
            <div class="flex items-center">
              <label class="w-28 text-sm font-medium text-gray-700 shrink-0">出生年月日</label>
              <input v-model="form.birth_date" type="date"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-28 text-sm font-medium text-gray-700 shrink-0">身份證字號</label>
              <input v-model="form.id_number" type="text" maxlength="10" placeholder="請輸入身份證字號"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">最高學歷</label>
              <select v-model="form.education" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option value="">請選擇</option>
                <option value="國中">國中</option>
                <option value="高中職">高中職</option>
                <option value="專科">專科</option>
                <option value="大學">大學</option>
                <option value="碩士">碩士</option>
                <option value="博士">博士</option>
              </select>
            </div>
          </div>
        </div>

        <!-- 區塊 3: 聯絡資訊 -->
        <div class="mb-6 p-5 border border-gray-300 rounded-lg bg-white">
          <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">聯絡資訊</h3>

          <!-- 第一行：地區 + 戶籍地址 (address 占2格) -->
          <div class="grid grid-cols-4 gap-4 mb-3">
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">地區</label>
              <input v-model="form.customer_region" type="text" placeholder="請輸入地區"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="col-span-3 flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">戶籍地址</label>
              <input v-model="form.home_address" type="text" placeholder="請輸入戶籍地址"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
          </div>

          <!-- 第二行：室內電話 + 通訊地址同戶籍地 + 通訊地址 (占2格) -->
          <div class="grid grid-cols-4 gap-4 mb-3">
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">室內電話</label>
              <input v-model="form.landline_phone" type="text" placeholder="請輸入室內電話"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <input v-model="form.comm_address_same_as_home" @change="handleCommAddressChange" type="checkbox"
                id="comm_address_same" class="h-4 w-4 text-blue-600 border-gray-300 rounded" />
              <label for="comm_address_same" class="ml-2 text-sm font-medium text-gray-700">通訊地址同戶籍地</label>
            </div>
            <div class="col-span-2 flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">通訊地址</label>
              <input v-model="form.comm_address" :readonly="form.comm_address_same_as_home" type="text"
                placeholder="請輸入通訊地址" :class="[
                  'flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm',
                  form.comm_address_same_as_home ? 'bg-gray-100' : ''
                ]" />
            </div>
          </div>

          <!-- 第三行：通訊電話 + 現居地住多久 + 居住地持有人 + 電信業者 -->
          <div class="grid grid-cols-4 gap-4">
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">通訊電話</label>
              <input v-model="form.comm_phone" type="text" placeholder="請輸入通訊電話"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-28 text-sm font-medium text-gray-700 shrink-0">現居地住多久</label>
              <input v-model="form.residence_duration" type="text" placeholder="例：2年3個月"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-28 text-sm font-medium text-gray-700 shrink-0">居住地持有人</label>
              <select v-model="form.residence_owner" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option value="">請選擇</option>
                <option value="本人">本人</option>
                <option value="父母">父母</option>
                <option value="租屋">租屋</option>
                <option value="其他">其他</option>
              </select>
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">電信業者</label>
              <select v-model="form.telecom_operator" class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <option value="">請選擇</option>
                <option value="中華電信">中華電信</option>
                <option value="台灣大哥大">台灣大哥大</option>
                <option value="遠傳電信">遠傳電信</option>
                <option value="台灣之星">台灣之星</option>
                <option value="亞太電信">亞太電信</option>
              </select>
            </div>
          </div>
        </div>

        <!-- 區塊 4: 公司資料 -->
        <div class="mb-6 p-5 border border-gray-300 rounded-lg bg-gray-50">
          <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">公司資料</h3>

          <!-- 第一行：公司名稱 + 公司電話 + 公司地址 (占2格) -->
          <div class="grid grid-cols-4 gap-4 mb-3">
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">公司名稱</label>
              <input v-model="form.company_name" type="text" placeholder="請輸入公司名稱"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">公司電話</label>
              <input v-model="form.company_phone" type="text" placeholder="請輸入公司電話"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="col-span-2 flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">公司地址</label>
              <input v-model="form.company_address" type="text" placeholder="請輸入公司地址"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
          </div>

          <!-- 第二行：職稱 + 月收入 + 有無薪轉勞保 + 目前公司在職多久 -->
          <div class="grid grid-cols-4 gap-4">
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">職稱</label>
              <input v-model="form.job_title" type="text" placeholder="請輸入職稱"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-20 text-sm font-medium text-gray-700 shrink-0">月收入</label>
              <input v-model="form.monthly_income" type="number" step="0.01" placeholder="請輸入月收入"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <input v-model="form.has_labor_insurance" type="checkbox" id="has_labor_insurance"
                class="h-4 w-4 text-blue-600 border-gray-300 rounded" />
              <label for="has_labor_insurance" class="ml-2 text-sm font-medium text-gray-700">有無薪轉勞保</label>
            </div>
            <div class="flex items-center">
              <label class="w-36 text-sm font-medium text-gray-700 shrink-0">目前公司在職多久</label>
              <input v-model="form.company_tenure" type="text" placeholder="例：3年2個月"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
          </div>
        </div>

        <!-- 區塊 5: 貸款資訊 -->
        <div class="mb-6 p-5 border border-gray-300 rounded-lg bg-white">
          <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">貸款資訊</h3>

          <!-- 第一行：需求金額 + 貸款金額 + 貸款類型 + 貸款期數 -->
          <div class="grid grid-cols-4 gap-4 mb-3">
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">需求金額</label>
              <input v-model="form.demand_amount" type="number" step="0.01" placeholder="請輸入需求金額"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">貸款金額</label>
              <input v-model="form.loan_amount" type="number" step="0.01" placeholder="請輸入貸款金額"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">貸款類型</label>
              <input v-model="form.loan_type" type="text" placeholder="請輸入貸款類型"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">貸款期數</label>
              <input v-model="form.loan_term" type="number" placeholder="請輸入期數"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
          </div>

          <!-- 第二行：利率 -->
          <div class="grid grid-cols-4 gap-4">
            <div class="flex items-center">
              <label class="w-24 text-sm font-medium text-gray-700 shrink-0">利率(%)</label>
              <input v-model="form.interest_rate" type="number" step="0.01" placeholder="請輸入利率"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
            </div>
          </div>
        </div>

        <!-- 區塊 6: 緊急聯絡人 -->
        <div class="mb-6 p-5 border border-gray-300 rounded-lg bg-gray-50">
          <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">緊急聯絡人</h3>

          <!-- 聯絡人① -->
          <div class="mb-4">
            <h4 class="text-sm font-semibold text-gray-700 mb-2">聯絡人①</h4>
            <div class="grid grid-cols-4 gap-4 mb-2">
              <div class="flex items-center">
                <label class="w-20 text-sm font-medium text-gray-700 shrink-0">姓名</label>
                <input v-model="form.emergency_contact_1_name" type="text" placeholder="請輸入姓名"
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
              </div>
              <div class="flex items-center">
                <label class="w-20 text-sm font-medium text-gray-700 shrink-0">關係</label>
                <input v-model="form.emergency_contact_1_relationship" type="text" placeholder="請輸入關係"
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
              </div>
              <div class="flex items-center">
                <label class="w-20 text-sm font-medium text-gray-700 shrink-0">電話</label>
                <input v-model="form.emergency_contact_1_phone" type="text" placeholder="請輸入電話"
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
              </div>
              <div class="flex items-center">
                <label class="w-32 text-sm font-medium text-gray-700 shrink-0">方便聯絡時間</label>
                <input v-model="form.contact_time_1" type="text" placeholder="例：上午9:00-12:00"
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
              </div>
            </div>
            <div class="flex items-center">
              <input v-model="form.confidential_1" type="checkbox" id="confidential_1"
                class="h-4 w-4 text-blue-600 border-gray-300 rounded" />
              <label for="confidential_1" class="ml-2 text-sm text-gray-700">保密聯絡</label>
            </div>
          </div>

          <!-- 聯絡人② -->
          <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-2">聯絡人②</h4>
            <div class="grid grid-cols-4 gap-4 mb-2">
              <div class="flex items-center">
                <label class="w-20 text-sm font-medium text-gray-700 shrink-0">姓名</label>
                <input v-model="form.emergency_contact_2_name" type="text" placeholder="請輸入姓名"
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
              </div>
              <div class="flex items-center">
                <label class="w-20 text-sm font-medium text-gray-700 shrink-0">關係</label>
                <input v-model="form.emergency_contact_2_relationship" type="text" placeholder="請輸入關係"
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
              </div>
              <div class="flex items-center">
                <label class="w-20 text-sm font-medium text-gray-700 shrink-0">電話</label>
                <input v-model="form.emergency_contact_2_phone" type="text" placeholder="請輸入電話"
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
              </div>
              <div class="flex items-center">
                <label class="w-32 text-sm font-medium text-gray-700 shrink-0">方便聯絡時間</label>
                <input v-model="form.contact_time_2" type="text" placeholder="例：下午2:00-6:00"
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
              </div>
            </div>
            <div class="flex items-center">
              <input v-model="form.confidential_2" type="checkbox" id="confidential_2"
                class="h-4 w-4 text-blue-600 border-gray-300 rounded" />
              <label for="confidential_2" class="ml-2 text-sm text-gray-700">保密聯絡</label>
            </div>
          </div>

          <!-- 介紹人 -->
          <div class="mt-4">
            <div class="grid grid-cols-4 gap-4">
              <div class="flex items-center">
                <label class="w-20 text-sm font-medium text-gray-700 shrink-0">介紹人</label>
                <input v-model="form.referrer" type="text" placeholder="請輸入介紹人"
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
              </div>
            </div>
          </div>
        </div>

        <!-- 備註 -->
        <div class="mb-6 p-5 border border-gray-300 rounded-lg bg-white">
          <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">備註</h3>
          <textarea v-model="form.notes" rows="4" placeholder="請輸入備註"
            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm"></textarea>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive, computed, watch, onMounted, onUnmounted } from 'vue'
import { useCaseManagement } from '~/composables/useCaseManagement'
import { useNotification } from '~/composables/useNotification'
import { useUsers } from '~/composables/useUsers'
import {
  CASE_STATUS_OPTIONS,
  BUSINESS_LEVEL_OPTIONS,
  CHANNEL_OPTIONS,
  PURPOSE_OPTIONS,
  WEBSITE_OPTIONS
} from '~/composables/useCaseConfig'

const props = defineProps({
  isOpen: { type: Boolean, default: false },
  case: { type: Object, default: null },
  pageType: { type: String, default: 'pending' } // 用於判斷顯示哪些欄位
})

const emit = defineEmits(['close', 'save'])

const { error: showError } = useNotification()

// 儲存狀態
const saving = ref(false)

// 可用用戶列表
const availableUsers = ref([])

// 表單資料
const form = reactive({
  id: null,
  case_status: 'pending',
  business_level: 'A',
  created_at: null,
  assigned_to: '',
  channel: '',
  customer_name: '',
  line_display_name: '',
  line_id: '',
  loan_purpose: '',
  website: '',
  email: '',
  phone: '',
  case_number: '',
  birth_date: '',
  id_number: '',
  education: '',
  customer_region: '',
  home_address: '',
  landline_phone: '',
  comm_address_same_as_home: false,
  comm_address: '',
  comm_phone: '',
  residence_duration: '',
  residence_owner: '',
  telecom_operator: '',
  company_name: '',
  company_phone: '',
  company_address: '',
  job_title: '',
  monthly_income: '',
  has_labor_insurance: false,
  company_tenure: '',
  demand_amount: '',
  loan_amount: '',
  loan_type: '',
  loan_term: '',
  interest_rate: '',
  notes: '',
  emergency_contact_1_name: '',
  emergency_contact_1_relationship: '',
  emergency_contact_1_phone: '',
  contact_time_1: '',
  confidential_1: false,
  emergency_contact_2_name: '',
  emergency_contact_2_relationship: '',
  emergency_contact_2_phone: '',
  contact_time_2: '',
  confidential_2: false,
  referrer: ''
})

// 判斷欄位是否顯示（根據頁面類型）
const showField = (fieldKey) => {
  // 業務等級只在追蹤管理頁面顯示
  if (fieldKey === 'business_level') {
    return props.pageType === 'tracking' || form.case_status === 'tracking'
  }
  // 案件編號在特定狀態下顯示
  if (fieldKey === 'case_number') {
    return ['approved_disbursed', 'approved_undisbursed', 'conditional_approval', 'declined'].includes(props.pageType)
  }
  // 地區/地址在特定頁面隱藏
  if (fieldKey === 'location') {
    return !['pending', 'valid_customer', 'invalid_customer', 'customer_service', 'blacklist', 'tracking'].includes(props.pageType)
  }
  // 需求金額在特定頁面顯示
  if (fieldKey === 'amount') {
    return ['approved_disbursed', 'approved_undisbursed', 'conditional_approval', 'declined'].includes(props.pageType)
  }
  return true
}

// 是否為編輯模式
const isEdit = computed(() => !!props.case?.id)

// 從 API 資料轉換為表單格式
const transformApiPayloadToForm = (apiData) => {
  if (!apiData) return null

  return {
    // 基本資訊（直接欄位）
    id: apiData.id || null,
    case_status: apiData.case_status || apiData.status || 'pending',
    business_level: apiData.business_level || 'A',
    created_at: apiData.created_at || new Date().toISOString(),
    assigned_to: apiData.assigned_to || '',
    channel: apiData.channel || '',
    customer_name: apiData.customer_name || '',
    line_display_name: apiData.line_display_name || '',
    line_id: apiData.line_id || '',
    loan_purpose: apiData.loan_purpose || '',
    website: apiData.website || '',
    email: apiData.email || '',
    phone: apiData.phone || '',
    notes: apiData.notes || '',

    // 個人資料（直接欄位）
    case_number: apiData.case_number || '',
    birth_date: apiData.birth_date || '',
    id_number: apiData.id_number || '',
    education: apiData.education || '',

    // 聯絡資訊（直接欄位）
    customer_region: apiData.customer_region || '',
    home_address: apiData.home_address || '',
    landline_phone: apiData.landline_phone || '',
    comm_address_same_as_home: apiData.comm_address_same_as_home || false,
    comm_address: apiData.comm_address || '',
    comm_phone: apiData.comm_phone || '',
    residence_duration: apiData.residence_duration || '',
    residence_owner: apiData.residence_owner || '',
    telecom_operator: apiData.telecom_operator || '',

    // 公司資料（直接欄位）
    company_name: apiData.company_name || '',
    company_phone: apiData.company_phone || '',
    company_address: apiData.company_address || '',
    job_title: apiData.job_title || '',
    monthly_income: apiData.monthly_income || '',
    has_labor_insurance: apiData.has_labor_insurance || false,
    company_tenure: apiData.company_tenure || '',

    // 貸款資訊（直接欄位）
    demand_amount: apiData.demand_amount || '',
    loan_amount: apiData.loan_amount || '',
    loan_type: apiData.loan_type || '',
    loan_term: apiData.loan_term || '',
    interest_rate: apiData.interest_rate || '',

    // 緊急聯絡人（直接欄位）
    emergency_contact_1_name: apiData.emergency_contact_1_name || '',
    emergency_contact_1_relationship: apiData.emergency_contact_1_relationship || '',
    emergency_contact_1_phone: apiData.emergency_contact_1_phone || '',
    contact_time_1: apiData.contact_time_1 || '',
    confidential_1: apiData.confidential_1 || false,
    emergency_contact_2_name: apiData.emergency_contact_2_name || '',
    emergency_contact_2_relationship: apiData.emergency_contact_2_relationship || '',
    emergency_contact_2_phone: apiData.emergency_contact_2_phone || '',
    contact_time_2: apiData.contact_time_2 || '',
    confidential_2: apiData.confidential_2 || false,
    referrer: apiData.referrer || ''
  }
}

// 監聽案件資料變更
watch(() => props.case, (newCase) => {
  if (newCase) {
    const transformedData = transformApiPayloadToForm(newCase)
    Object.assign(form, transformedData)
  } else {
    form.created_at = new Date().toISOString()
  }
}, { immediate: true })

// 關閉彈窗
const closeModal = () => {
  if (!saving.value) {
    emit('close')
  }
}

// 處理通訊地址同步
const handleCommAddressChange = () => {
  if (form.comm_address_same_as_home) {
    form.comm_address = form.home_address
  }
}

// 監聽戶籍地址變更
watch(() => form.home_address, (newAddress) => {
  if (form.comm_address_same_as_home) {
    form.comm_address = newAddress
  }
})

// 將表單資料轉換為 API 格式
const transformFormToApiPayload = () => {
  // 所有欄位都是直接欄位，不再使用 payload 包裝
  const apiPayload = {
    // ID
    id: form.id,
    customer_id: form.customer_id,

    // 基本資訊
    case_status: form.case_status,
    assigned_to: form.assigned_to,
    channel: form.channel,
    source: form.source,
    website: form.website,
    customer_name: form.customer_name,
    phone: form.phone,
    email: form.email,
    line_id: form.line_id,
    line_display_name: form.line_display_name,
    loan_purpose: form.loan_purpose,
    business_level: form.business_level,
    notes: form.notes,
    created_at: form.created_at,

    // 個人資料
    birth_date: form.birth_date,
    id_number: form.id_number,
    education: form.education,
    case_number: form.case_number,

    // 聯絡資訊
    customer_region: form.customer_region,
    home_address: form.home_address,
    landline_phone: form.landline_phone,
    comm_address_same_as_home: form.comm_address_same_as_home,
    comm_address: form.comm_address,
    comm_phone: form.comm_phone,
    residence_duration: form.residence_duration,
    residence_owner: form.residence_owner,
    telecom_operator: form.telecom_operator,

    // 公司資料
    company_name: form.company_name,
    company_phone: form.company_phone,
    company_address: form.company_address,
    job_title: form.job_title,
    monthly_income: form.monthly_income,
    has_labor_insurance: form.has_labor_insurance,
    company_tenure: form.company_tenure,

    // 貸款資訊
    demand_amount: form.demand_amount,
    loan_amount: form.loan_amount,
    loan_type: form.loan_type,
    loan_term: form.loan_term,
    interest_rate: form.interest_rate,

    // 緊急聯絡人
    emergency_contact_1_name: form.emergency_contact_1_name,
    emergency_contact_1_relationship: form.emergency_contact_1_relationship,
    emergency_contact_1_phone: form.emergency_contact_1_phone,
    contact_time_1: form.contact_time_1,
    confidential_1: form.confidential_1,
    emergency_contact_2_name: form.emergency_contact_2_name,
    emergency_contact_2_relationship: form.emergency_contact_2_relationship,
    emergency_contact_2_phone: form.emergency_contact_2_phone,
    contact_time_2: form.contact_time_2,
    confidential_2: form.confidential_2,
    referrer: form.referrer
  }

  console.log('🟢 CaseEditModal - transformFormToApiPayload - 所有欄位直接送出:', apiPayload)
  return apiPayload
}

// 儲存案件
const saveCase = async () => {
  // 基本驗證
  if (!form.customer_name.trim()) {
    showError('請輸入客戶姓名')
    return
  }
  if (!form.phone.trim()) {
    showError('請輸入手機號碼')
    return
  }

  // 如果通訊地址同戶籍地，確保複製
  if (form.comm_address_same_as_home) {
    form.comm_address = form.home_address
  }

  saving.value = true
  try {
    // 將表單資料轉換為 API 格式後再傳送
    const apiPayload = transformFormToApiPayload()
    emit('save', apiPayload)
  } finally {
    // 不在這裡設置 saving.value = false，讓父組件控制
  }
}

// 格式化案件編號
const formatCaseNumber = () => {
  if (form.case_number) return form.case_number
  if (!form.created_at || !form.id) return ''

  const date = new Date(form.created_at)
  const year = date.getFullYear().toString().slice(-2)
  const month = String(date.getMonth() + 1).padStart(2, '0')
  const day = String(date.getDate()).padStart(2, '0')
  const serial = String(form.id).padStart(3, '0')
  return `CASE${year}${month}${day}${serial}`
}

// 格式化日期時間（與表格一致）
const formatDateTime = (dateTime) => {
  if (!dateTime) return ''
  const date = new Date(dateTime)
  const dateStr = date.toLocaleDateString('zh-TW', { year: 'numeric', month: '2-digit', day: '2-digit' })
  const timeStr = date.toLocaleTimeString('zh-TW', { hour: '2-digit', minute: '2-digit' })
  return `${dateStr} ${timeStr}`
}

// 載入可用用戶列表
const { getUsers } = useUsers()
const loadUsers = async () => {
  try {
    const { success, users, error } = await getUsers({ per_page: 250 })
    if (success && Array.isArray(users)) {
      availableUsers.value = users
    }
  } catch (error) {
    console.error('載入用戶列表失敗:', error)
  }
}

// 監聽按鍵事件
const handleKeydown = (event) => {
  if (event.key === 'Escape' && props.isOpen && !saving.value) {
    closeModal()
  }
}

onMounted(() => {
  loadUsers()
  document.addEventListener('keydown', handleKeydown)
})

onUnmounted(() => {
  document.removeEventListener('keydown', handleKeydown)
})

// 當儲存完成後，父組件會關閉彈窗，此時重置 saving 狀態
watch(() => props.isOpen, (isOpen) => {
  if (!isOpen) {
    saving.value = false
  }
})
</script>

<style scoped>
/* 確保全螢幕樣式 */
.fixed.inset-0 {
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}

/* 滾動條美化 */
.overflow-y-auto::-webkit-scrollbar {
  width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
  background: #f1f1f1;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}

.overflow-x-auto::-webkit-scrollbar {
  height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
  background: #f1f1f1;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}
</style>
