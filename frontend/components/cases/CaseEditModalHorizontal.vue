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
// 此檔案為新版橫向排列的編輯畫面
// 需要從 CaseEditModal.vue 複製完整的 script setup 內容
// 這裡僅為 template 示範
</script>
