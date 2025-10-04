<template>
  <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- 背景遮罩 -->
    <div class="fixed inset-0 bg-black bg-opacity-50" @click="closeModal"></div>

    <!-- 全螢幕彈窗 -->
    <div class="relative w-full h-full max-w-none max-h-none bg-white overflow-hidden flex flex-col">
      <!-- 標題列 -->
      <div class="sticky top-0 z-10 bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center shadow-sm">
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
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50"
          >
            {{ saving ? '儲存中...' : '儲存' }}
          </button>
        </div>
      </div>

      <!-- 6大區塊水平布局 -->
      <form @submit.prevent="saveCase" class="flex-grow overflow-hidden">
        <div class="h-full flex overflow-x-auto">
          <!-- 區塊 1: 基本資訊 (與主表格相同欄位) -->
          <div class="flex-shrink-0 w-80 border-r border-gray-200 overflow-y-auto bg-gray-50">
            <div class="p-6">
              <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-300 sticky top-0 bg-gray-50">
                基本資訊
              </h3>
              <div class="space-y-4">
                <!-- 1. 案件狀態 (與表格 type: select 一致) -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">案件狀態</label>
                  <select
                    v-model="form.case_status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option v-for="option in CASE_STATUS_OPTIONS" :key="option.value" :value="option.value">
                      {{ option.label }}
                    </option>
                  </select>
                </div>

                <!-- 2. 業務等級 (追蹤管理特有，type: select) -->
                <div v-if="showField('business_level')">
                  <label class="block text-sm font-medium text-gray-700 mb-1">業務等級</label>
                  <select
                    v-model="form.business_level"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option v-for="option in BUSINESS_LEVEL_OPTIONS" :key="option.value" :value="option.value">
                      {{ option.label }}
                    </option>
                  </select>
                </div>

                <!-- 3. 時間 (與表格格式一致) -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">建立時間</label>
                  <input
                    :value="formatDateTime(form.created_at)"
                    type="text"
                    readonly
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600"
                  />
                </div>

                <!-- 5. 承辦業務 (type: user_select) -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">承辦業務</label>
                  <select
                    v-model="form.assigned_to"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="">未指派</option>
                    <option v-for="user in availableUsers" :key="user.id" :value="user.id">
                      {{ user.name }}
                    </option>
                  </select>
                </div>

                <!-- 6. 來源管道 (type: select) -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">來源管道</label>
                  <select
                    v-model="form.channel"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="">請選擇</option>
                    <option v-for="option in CHANNEL_OPTIONS" :key="option.value" :value="option.value">
                      {{ option.label }}
                    </option>
                  </select>
                </div>

                <!-- 7. 姓名 (type: text) -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">姓名 *</label>
                  <input
                    v-model="form.customer_name"
                    type="text"
                    required
                    placeholder="請輸入姓名"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>

                <!-- 8. LINE資訊 (包含顯示名稱和ID) -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">LINE顯示名稱</label>
                  <input
                    v-model="form.line_display_name"
                    type="text"
                    placeholder="請輸入LINE顯示名稱"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">LINE ID</label>
                  <input
                    v-model="form.line_id"
                    type="text"
                    placeholder="請輸入LINE ID"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>

                <!-- 9. 諮詢項目 (type: select) -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">諮詢項目</label>
                  <select
                    v-model="form.loan_purpose"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="">請選擇</option>
                    <option v-for="option in PURPOSE_OPTIONS" :key="option.value" :value="option.value">
                      {{ option.label }}
                    </option>
                  </select>
                </div>

                <!-- 10. 網站 (type: select) -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">網站</label>
                  <select
                    v-model="form.website"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="">請選擇</option>
                    <option v-for="option in WEBSITE_OPTIONS" :key="option.value" :value="option.value">
                      {{ option.label }}
                    </option>
                  </select>
                </div>

                <!-- 11. 聯絡資訊 (Email + Phone) -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                  <input
                    v-model="form.email"
                    type="email"
                    placeholder="請輸入Email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">手機號碼 *</label>
                  <input
                    v-model="form.phone"
                    type="text"
                    required
                    placeholder="請輸入手機號碼"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
              </div>
            </div>
          </div>

          <!-- 區塊 2: 個人資料 -->
          <div class="flex-shrink-0 w-80 border-r border-gray-200 overflow-y-auto bg-white">
            <div class="p-6">
              <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-300 sticky top-0 bg-white">
                個人資料
              </h3>
              <div class="space-y-4">
                <!-- 案件編號 (只在編輯視窗顯示) -->
                <div v-if="isEdit">
                  <label class="block text-sm font-medium text-gray-700 mb-1">案件編號</label>
                  <input
                    :value="formatCaseNumber()"
                    type="text"
                    readonly
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">出生年月日</label>
                  <input
                    v-model="form.birth_date"
                    type="date"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">身份證字號</label>
                  <input
                    v-model="form.id_number"
                    type="text"
                    maxlength="10"
                    placeholder="請輸入身份證字號"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">最高學歷</label>
                  <select
                    v-model="form.education"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
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
          </div>

          <!-- 區塊 3: 聯絡資訊 -->
          <div class="flex-shrink-0 w-80 border-r border-gray-200 overflow-y-auto bg-gray-50">
            <div class="p-6">
              <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-300 sticky top-0 bg-gray-50">
                聯絡資訊
              </h3>
              <div class="space-y-4">
                <!-- 地區 -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">地區</label>
                  <input
                    v-model="form.customer_region"
                    type="text"
                    placeholder="請輸入地區"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">戶籍地址</label>
                  <textarea
                    v-model="form.home_address"
                    rows="2"
                    placeholder="請輸入戶籍地址"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">室內電話</label>
                  <input
                    v-model="form.landline_phone"
                    type="text"
                    placeholder="請輸入室內電話"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div class="flex items-center">
                  <input
                    v-model="form.comm_address_same_as_home"
                    @change="handleCommAddressChange"
                    type="checkbox"
                    id="comm_address_same"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                  />
                  <label for="comm_address_same" class="ml-2 block text-sm text-gray-700">
                    通訊地址同戶籍地
                  </label>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">通訊地址</label>
                  <textarea
                    v-model="form.comm_address"
                    :readonly="form.comm_address_same_as_home"
                    rows="2"
                    placeholder="請輸入通訊地址"
                    :class="[
                      'w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500',
                      form.comm_address_same_as_home ? 'bg-gray-100' : 'bg-white'
                    ]"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">通訊電話</label>
                  <input
                    v-model="form.comm_phone"
                    type="text"
                    placeholder="請輸入通訊電話"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">現居地住多久</label>
                  <input
                    v-model="form.residence_duration"
                    type="text"
                    placeholder="例：2年3個月"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">居住地持有人</label>
                  <select
                    v-model="form.residence_owner"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="">請選擇</option>
                    <option value="本人">本人</option>
                    <option value="父母">父母</option>
                    <option value="配偶">配偶</option>
                    <option value="租屋">租屋</option>
                    <option value="其他">其他</option>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">電信業者</label>
                  <select
                    v-model="form.telecom_operator"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  >
                    <option value="">請選擇</option>
                    <option value="中華電信">中華電信</option>
                    <option value="台灣大哥大">台灣大哥大</option>
                    <option value="遠傳電信">遠傳電信</option>
                    <option value="亞太電信">亞太電信</option>
                    <option value="台灣之星">台灣之星</option>
                    <option value="其他">其他</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- 區塊 4: 公司資料 -->
          <div class="flex-shrink-0 w-80 border-r border-gray-200 overflow-y-auto bg-white">
            <div class="p-6">
              <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-300 sticky top-0 bg-white">
                公司資料
              </h3>
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">公司名稱</label>
                  <input
                    v-model="form.company_name"
                    type="text"
                    placeholder="請輸入公司名稱"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">公司電話</label>
                  <input
                    v-model="form.company_phone"
                    type="text"
                    placeholder="請輸入公司電話"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">職稱</label>
                  <input
                    v-model="form.job_title"
                    type="text"
                    placeholder="請輸入職稱"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">公司地址</label>
                  <textarea
                    v-model="form.company_address"
                    rows="2"
                    placeholder="請輸入公司地址"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">月收入 (元)</label>
                  <input
                    v-model="form.monthly_income"
                    type="number"
                    step="1"
                    placeholder="0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div class="flex items-center">
                  <input
                    v-model="form.has_labor_insurance"
                    type="checkbox"
                    id="has_labor"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                  />
                  <label for="has_labor" class="ml-2 block text-sm text-gray-700">
                    有無薪轉勞保
                  </label>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">目前公司在職多久</label>
                  <input
                    v-model="form.company_tenure"
                    type="text"
                    placeholder="例：1年6個月"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
              </div>
            </div>
          </div>

          <!-- 區塊 5: 貸款資訊 -->
          <div class="flex-shrink-0 w-80 border-r border-gray-200 overflow-y-auto bg-gray-50">
            <div class="p-6">
              <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-300 sticky top-0 bg-gray-50">
                貸款資訊
              </h3>
              <div class="space-y-4">
                <!-- 需求金額 -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">需求金額 (萬元)</label>
                  <input
                    v-model="form.demand_amount"
                    type="number"
                    step="0.01"
                    placeholder="0.00"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">貸款金額 (萬元)</label>
                  <input
                    v-model="form.loan_amount"
                    type="number"
                    step="0.01"
                    placeholder="0.00"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">貸款類型</label>
                  <input
                    v-model="form.loan_type"
                    type="text"
                    placeholder="請輸入貸款類型"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">貸款期數 (月)</label>
                  <input
                    v-model="form.loan_term"
                    type="number"
                    placeholder="0"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">利率 (%)</label>
                  <input
                    v-model="form.interest_rate"
                    type="number"
                    step="0.01"
                    placeholder="0.00"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">備註</label>
                  <textarea
                    v-model="form.notes"
                    rows="4"
                    placeholder="請輸入備註"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
              </div>
            </div>
          </div>

          <!-- 區塊 6: 緊急聯絡人 -->
          <div class="flex-shrink-0 w-80 overflow-y-auto bg-white">
            <div class="p-6">
              <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-300 sticky top-0 bg-white">
                緊急聯絡人
              </h3>
              <div class="space-y-6">
                <!-- 聯絡人① -->
                <div>
                  <h4 class="text-md font-medium text-gray-800 mb-3">聯絡人①</h4>
                  <div class="space-y-3">
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">姓名</label>
                      <input
                        v-model="form.emergency_contact_1_name"
                        type="text"
                        placeholder="請輸入姓名"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">關係</label>
                      <select
                        v-model="form.emergency_contact_1_relationship"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      >
                        <option value="">請選擇</option>
                        <option value="父親">父親</option>
                        <option value="母親">母親</option>
                        <option value="配偶">配偶</option>
                        <option value="子女">子女</option>
                        <option value="兄弟姊妹">兄弟姊妹</option>
                        <option value="朋友">朋友</option>
                        <option value="同事">同事</option>
                        <option value="其他">其他</option>
                      </select>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">電話</label>
                      <input
                        v-model="form.emergency_contact_1_phone"
                        type="text"
                        placeholder="請輸入電話"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">方便聯絡時間</label>
                      <input
                        v-model="form.contact_time_1"
                        type="text"
                        placeholder="例：平日上午"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      />
                    </div>
                    <div class="flex items-center">
                      <input
                        v-model="form.confidential_1"
                        type="checkbox"
                        id="conf1"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                      />
                      <label for="conf1" class="ml-2 block text-sm text-gray-700">
                        保密聯絡
                      </label>
                    </div>
                  </div>
                </div>

                <!-- 聯絡人② -->
                <div>
                  <h4 class="text-md font-medium text-gray-800 mb-3">聯絡人②</h4>
                  <div class="space-y-3">
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">姓名</label>
                      <input
                        v-model="form.emergency_contact_2_name"
                        type="text"
                        placeholder="請輸入姓名"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">關係</label>
                      <select
                        v-model="form.emergency_contact_2_relationship"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      >
                        <option value="">請選擇</option>
                        <option value="父親">父親</option>
                        <option value="母親">母親</option>
                        <option value="配偶">配偶</option>
                        <option value="子女">子女</option>
                        <option value="兄弟姊妹">兄弟姊妹</option>
                        <option value="朋友">朋友</option>
                        <option value="同事">同事</option>
                        <option value="其他">其他</option>
                      </select>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">電話</label>
                      <input
                        v-model="form.emergency_contact_2_phone"
                        type="text"
                        placeholder="請輸入電話"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      />
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">方便聯絡時間</label>
                      <input
                        v-model="form.contact_time_2"
                        type="text"
                        placeholder="例：假日下午"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      />
                    </div>
                    <div class="flex items-center">
                      <input
                        v-model="form.confidential_2"
                        type="checkbox"
                        id="conf2"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                      />
                      <label for="conf2" class="ml-2 block text-sm text-gray-700">
                        保密聯絡
                      </label>
                    </div>
                  </div>
                </div>

                <!-- 介紹人 -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">介紹人</label>
                  <input
                    v-model="form.referrer"
                    type="text"
                    placeholder="請輸入介紹人"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>
              </div>
            </div>
          </div>
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

  // 提取 payload 中的資料
  const payload = apiData.payload || {}

  return {
    // 直接欄位
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

    // 從 payload 提取的欄位
    case_number: payload.case_number || '',
    birth_date: payload.birth_date || '',
    id_number: payload.id_number || '',
    education: payload.education || '',
    customer_region: payload.customer_region || '',
    home_address: payload.home_address || '',
    landline_phone: payload.landline_phone || '',
    comm_address_same_as_home: payload.comm_address_same_as_home || false,
    comm_address: payload.comm_address || '',
    comm_phone: payload.comm_phone || '',
    residence_duration: payload.residence_duration || '',
    residence_owner: payload.residence_owner || '',
    telecom_operator: payload.telecom_operator || '',
    company_name: payload.company_name || '',
    company_phone: payload.company_phone || '',
    company_address: payload.company_address || '',
    job_title: payload.job_title || '',
    monthly_income: payload.monthly_income || '',
    has_labor_insurance: payload.has_labor_insurance || false,
    company_tenure: payload.company_tenure || '',
    demand_amount: payload.demand_amount || '',
    loan_amount: payload.loan_amount || '',
    loan_type: payload.loan_type || '',
    loan_term: payload.loan_term || '',
    interest_rate: payload.interest_rate || '',
    emergency_contact_1_name: payload.emergency_contact_1_name || '',
    emergency_contact_1_relationship: payload.emergency_contact_1_relationship || '',
    emergency_contact_1_phone: payload.emergency_contact_1_phone || '',
    contact_time_1: payload.contact_time_1 || '',
    confidential_1: payload.confidential_1 || false,
    emergency_contact_2_name: payload.emergency_contact_2_name || '',
    emergency_contact_2_relationship: payload.emergency_contact_2_relationship || '',
    emergency_contact_2_phone: payload.emergency_contact_2_phone || '',
    contact_time_2: payload.contact_time_2 || '',
    confidential_2: payload.confidential_2 || false,
    referrer: payload.referrer || ''
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
  // 直接儲存在資料庫欄位的欄位
  const directFields = {
    id: form.id,
    customer_id: form.customer_id,
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
    created_at: form.created_at
  }

  console.log('🔵 CaseEditModal - transformFormToApiPayload - 直接欄位:', directFields)

  // 需要儲存在 payload JSON 欄位的額外欄位
  const payloadFields = {
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

  const result = {
    ...directFields,
    payload: payloadFields
  }

  console.log('🟢 CaseEditModal - transformFormToApiPayload - 最終 API Payload:', result)
  return result
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
