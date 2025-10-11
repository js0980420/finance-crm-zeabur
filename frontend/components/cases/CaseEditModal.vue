<template>
  <div v-if="isOpen" class="modal fade show" style="display: block; background-color: rgba(0,0,0,0.5);" @click.self="closeModal">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ isEdit ? '編輯案件' : '新增案件' }}</h5>
          <div class="ms-auto d-flex align-items-center">
            <button type="button" class="btn btn-secondary me-2" @click="triggerFileUpload">
              <ArrowUpTrayIcon class="hero-icon" /> 上傳圖片
            </button>
            <button type="button" class="btn btn-secondary me-2" @click="exportCSV">
              <ArrowDownTrayIcon class="hero-icon" /> 導出CSV
            </button>
            <button type="button" class="btn btn-light me-2" @click="closeModal" :disabled="saving">取消</button>
            <button type="button" class="btn btn-dark" @click="saveCase" :disabled="saving">
              {{ saving ? '儲存中...' : '儲存' }}
            </button>
          </div>
        </div>
        <div class="modal-body">
          <input type="file" ref="fileInput" @change="handleImageUpload" multiple accept="image/*" class="d-none">
          <form @submit.prevent="saveCase" id="applicationForm">
            <!-- 個人資料 -->
            <div class="card mb-3">
              <div class="card-header">個人資料</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-auto form-group-row">
                    <label for="name" class="form-label">姓名：</label>
                    <input type="text" id="name" class="form-control" v-model="form.name" required>
                  </div>
                  <div class="col-auto form-group-row">
                    <label for="dob" class="form-label">出生年月日：</label>
                    <input type="date" id="dob" class="form-control" v-model="form.birth_date">
                  </div>
                  <div class="col-auto form-group-row">
                    <label for="idNumber" class="form-label">身份證字號：</label>
                    <input type="text" id="idNumber" class="form-control" v-model="form.id_number" maxlength="10">
                  </div>
                  <div class="col-auto form-group-row">
                    <label for="education" class="form-label">最高學歷：</label>
                    <select id="education" class="form-select" v-model="form.education">
                      <option value="">請選擇</option>
                      <option value="國中">國中</option>
                      <option value="高中">高中</option>
                      <option value="專科">專科</option>
                      <option value="大學">大學</option>
                      <option value="碩士">碩士</option>
                      <option value="博士">博士</option>
                    </select>
                  </div>
                  <div class="col-auto form-group-row">
                    <label for="mobile" class="form-label">手機號碼：</label>
                    <input type="tel" id="mobile" class="form-control" v-model="form.phone" required>
                  </div>
                </div>
              </div>
            </div>

            <!-- 聯絡資訊 -->
            <div class="card mb-3">
              <div class="card-header">聯絡資訊</div>
              <div class="card-body">
                <div class="row">
                  <div class="col-auto form-group-row">
                    <label for="contactTime" class="form-label">可聯繫時間：</label>
                    <select id="contactTime" class="form-select" v-model="form.contact_time">
                      <option value="">請選擇</option>
                      <option value="早上">早上</option>
                      <option value="下午">下午</option>
                      <option value="晚上">晚上</option>
                      <option value="其他">其他</option>
                    </select>
                  </div>
                  <div class="col-auto form-group-row">
                    <label for="homePhone" class="form-label">室內電話：</label>
                    <input type="tel" id="homePhone" class="form-control" v-model="form.landline_phone">
                  </div>
                  <div class="col-auto form-group-row">
                    <label class="form-label">現居地住多久：</label>
                    <div class="input-group duration-group">
                      <input type="number" id="residenceDurationYears" class="form-control narrow-number-input" min="0" v-model="residenceDuration.years">
                      <span class="input-group-text">年</span>
                      <input type="number" id="residenceDurationMonths" class="form-control narrow-number-input" min="0" max="11" v-model="residenceDuration.months">
                      <span class="input-group-text">月</span>
                    </div>
                  </div>
                  <div class="col-auto form-group-row">
                    <label for="residenceOwner" class="form-label">居住地持有人：</label>
                    <select id="residenceOwner" class="form-select" v-model="form.residence_owner">
                        <option value="">請選擇</option>
                        <option value="本人">本人</option>
                        <option value="父母">父母</option>
                        <option value="配偶">配偶</option>
                        <option value="租屋">租屋</option>
                        <option value="其他">其他</option>
                    </select>
                  </div>
                  <div class="col-auto form-group-row">
                    <label for="telecom" class="form-label">電信業者：</label>
                    <select id="telecom" class="form-select" v-model="form.telecom_operator">
                      <option value="">請選擇</option>
                      <option value="中華電信">中華電信</option>
                      <option value="台灣大哥大">台灣大哥大</option>
                      <option value="遠傳電信">遠傳電信</option>
                      <option value="其他">其他</option>
                    </select>
                  </div>
                </div>
                <div class="manual-br"></div>
                <div class="row">
                  <div class="col-lg-8 form-group-row">
                    <label class="form-label">戶籍地址：</label>
                    <div class="input-group address-group">
                      <select class="form-select" v-model="form.city">
                        <option value="">請選擇縣市</option>
                        <option v-for="city in cities" :key="city" :value="city">{{ city }}</option>
                      </select>
                      <select class="form-select" v-model="form.district">
                        <option value="">請選擇區域</option>
                        <option v-for="district in homeDistricts" :key="district" :value="district">{{ district }}</option>
                      </select>
                      <input type="text" class="form-control" placeholder="街道巷弄號" v-model="form.street">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-8 form-group-row">
                    <label class="form-label">通訊地址：</label>
                    <div class="input-group address-group">
                      <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" id="sameAsResidential" v-model="form.comm_address_same_as_home" @change="syncHomeToComm" style="width: 20px; height: 20px; cursor: pointer;">
                        <label class="form-check-label ms-2" for="sameAsResidential" style="cursor: pointer;">同戶籍地</label>
                      </div>
                      <select class="form-select" v-model="commAddress.city" :disabled="form.comm_address_same_as_home">
                        <option value="">請選擇縣市</option>
                        <option v-for="city in cities" :key="city" :value="city">{{ city }}</option>
                      </select>
                      <select class="form-select" v-model="commAddress.district" :disabled="form.comm_address_same_as_home">
                        <option value="">請選擇區域</option>
                        <option v-for="district in commDistricts" :key="district" :value="district">{{ district }}</option>
                      </select>
                      <input type="text" class="form-control" placeholder="街道巷弄號" v-model="commAddress.street" :disabled="form.comm_address_same_as_home">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- 公司資料 -->
            <div class="card mb-3">
                <div class="card-header">公司資料</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto form-group-row"><label for="email" class="form-label">電子郵件：</label><input type="email" id="email" class="form-control" v-model="form.email"></div>
                        <div class="col-auto form-group-row"><label for="companyName" class="form-label">公司名稱：</label><input type="text" id="companyName" class="form-control" v-model="form.company_name"></div>
                        <div class="col-auto form-group-row"><label for="companyPhone" class="form-label">公司電話：</label><input type="tel" id="companyPhone" class="form-control" v-model="form.company_phone"></div>
                        <div class="col-auto form-group-row"><label for="jobTitle" class="form-label">職稱：</label><input type="text" id="jobTitle" class="form-control" v-model="form.job_title"></div>
                        <div class="col-auto form-group-row">
                          <label for="monthlyIncome" class="form-label">月收入(萬)：</label>
                          <input type="number" id="monthlyIncome" class="form-control narrow-number-input" min="0" v-model="monthlyIncomeInMyriad">
                        </div>
                        <div class="col-auto form-group-row">
                            <label class="form-label">目前公司在職多久：</label>
                             <div class="input-group duration-group">
                                <input type="number" id="timeAtCompanyYears" class="form-control narrow-number-input" min="0" v-model="companyTenure.years"><span class="input-group-text">年</span>
                                <input type="number" id="timeAtCompanyMonths" class="form-control narrow-number-input" min="0" max="11" v-model="companyTenure.months"><span class="input-group-text">月</span>
                            </div>
                        </div>
                        <div class="col-auto form-group-row">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="hasLaborInsurance" :checked="form.has_labor_insurance === 'yes' || form.has_labor_insurance === true" @change="form.has_labor_insurance = $event.target.checked ? 'yes' : 'no'" style="width: 20px; height: 20px; cursor: pointer;">
                              <label class="form-check-label" for="hasLaborInsurance" style="cursor: pointer; margin-left: 8px;">有無薪轉勞保</label>
                            </div>
                        </div>
                    </div>
                    <div class="manual-br"></div>
                    <div class="row">
                        <div class="col-lg-8 form-group-row">
                          <label class="form-label">公司地址：</label>
                          <div class="input-group address-group">
                              <select class="form-select" v-model="companyAddress.city">
                                <option value="">請選擇縣市</option>
                                <option v-for="city in cities" :key="city" :value="city">{{ city }}</option>
                              </select>
                              <select class="form-select" v-model="companyAddress.district">
                                <option value="">請選擇區域</option>
                                <option v-for="district in companyDistricts" :key="district" :value="district">{{ district }}</option>
                              </select>
                              <input type="text" id="companyAddressStreet" class="form-control" placeholder="街道巷弄號" v-model="companyAddress.street">
                          </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 緊急聯絡人 -->
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    緊急聯絡人
                    <button type="button" class="btn btn-secondary btn-sm" @click="showContact2 = true" v-if="!showContact2">新增聯絡人②</button>
                </div>
                <div class="card-body">
                    <!-- 聯絡人 1 -->
                    <div class="row">
                        <div class="col-auto form-group-row"><label class="form-label">聯絡人①姓名：</label><input type="text" class="form-control" v-model="form.emergency_contact_1_name"></div>
                        <div class="col-auto form-group-row"><label class="form-label">關係：</label>
                            <select class="form-select" v-model="form.emergency_contact_1_relationship">
                                <option value="">請選擇</option>
                                <option value="父母">父母</option>
                                <option value="兄弟姊妹">兄弟姊妹</option>
                                <option value="配偶">配偶</option>
                                <option value="子女">子女</option>
                                <option value="朋友">朋友</option>
                                <option value="其他">其他</option>
                            </select>
                        </div>
                        <div class="col-auto form-group-row"><label class="form-label">電話：</label><input type="tel" class="form-control" v-model="form.emergency_contact_1_phone"></div>
                        <div class="col-auto form-group-row">
                            <div class="form-check"><input class="form-check-input" type="checkbox" v-model="form.confidential_1"><label class="form-check-label">是否保密</label></div>
                        </div>
                    </div>
                    <div class="manual-br"></div>
                    <!-- 聯絡人 2 -->
                    <div class="row" v-if="showContact2">
                        <div class="col-auto form-group-row"><label class="form-label">聯絡人②姓名：</label><input type="text" class="form-control" v-model="form.emergency_contact_2_name"></div>
                        <div class="col-auto form-group-row"><label class="form-label">關係：</label>
                            <select class="form-select" v-model="form.emergency_contact_2_relationship">
                                <option value="">請選擇</option>
                                <option value="父母">父母</option>
                                <option value="兄弟姊妹">兄弟姊妹</option>
                                <option value="配偶">配偶</option>
                                <option value="子女">子女</option>
                                <option value="朋友">朋友</option>
                                <option value="其他">其他</option>
                            </select>
                        </div>
                        <div class="col-auto form-group-row"><label class="form-label">電話：</label><input type="tel" class="form-control" v-model="form.emergency_contact_2_phone"></div>
                        <div class="col-auto form-group-row">
                            <div class="form-check"><input class="form-check-input" type="checkbox" v-model="form.confidential_2"><label class="form-check-label">是否保密</label></div>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-auto form-group-row"><label for="referrer" class="form-label">介紹人：</label><input type="text" id="referrer" class="form-control" v-model="form.referrer"></div>
                    </div>
                </div>
            </div>
          <!-- 附件 -->
            <div class="card mb-3">
              <div class="card-header">附件</div>
              <div class="card-body">
                <div v-if="form.images?.length || stagedImages.length" class="d-flex flex-wrap gap-2">
                  <!-- Existing Images -->
                  <div v-for="(image, index) in form.images" :key="index" class="position-relative">
                    <img :src="image.url" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                  </div>
                  <!-- Staged Images -->
                  <div v-for="(image, index) in stagedImages" :key="index" class="position-relative">
                    <img :src="image.previewUrl" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                    <button @click="removeStagedImage(index)" class="btn btn-danger btn-sm position-absolute top-0 end-0 rounded-circle" style="width: 24px; height: 24px; line-height: 1;">X</button>
                  </div>
                </div>
                <div v-else class="text-muted">
                  暫無附件
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, computed, watch, onMounted, ref, nextTick } from 'vue'
import { useNotification } from '~/composables/useNotification'
import { useUsers } from '~/composables/useUsers'
import {
  CASE_STATUS_OPTIONS,
  BUSINESS_LEVEL_OPTIONS,
} from '~/composables/useCaseConfig'
import { addressData } from '~/data/addressData'
import { ArrowUpTrayIcon, ArrowDownTrayIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
  isOpen: { type: Boolean, default: false },
  case: { type: Object, default: null },
  pageType: { type: String, default: 'pending' }
})

const emit = defineEmits(['close', 'save'])

const { error: showError, success } = useNotification()
const saving = ref(false)
const availableUsers = ref([])
const showContact2 = ref(false)
const fileInput = ref(null)
const stagedImages = ref([]) // For new images to be uploaded

const form = reactive({
  id: null,
  case_status: 'pending',
  business_level: 'A',
  assigned_to: '',
  name: '',
  phone: '',
  email: '',
  notes: '',
  birth_date: '',
  id_number: '',
  education: '',

  contact_time: '',
  landline_phone: '',
  residence_duration: '',
  residence_owner: '',
  telecom_operator: '',
  city: '',
  district: '',
  street: '',
  comm_address_same_as_home: false,
  comm_address: '',
  company_name: '',
  company_phone: '',
  job_title: '',
  monthly_income: '',
  company_tenure: '',
  has_labor_insurance: 'no',
  company_address: '',
  emergency_contact_1_name: '',
  emergency_contact_1_relationship: '',
  emergency_contact_1_phone: '',
  confidential_1: false,
  emergency_contact_2_name: '',
  emergency_contact_2_relationship: '',
  emergency_contact_2_phone: '',
  confidential_2: false,
  referrer: '',
  demand_amount: '',
  images: [], // To hold existing images
});

// --- Address Data ---
const cities = Object.keys(addressData);

const commAddress = ref({ city: '', district: '', street: '' });
const companyAddress = ref({ city: '', district: '', street: '' });

const homeDistricts = computed(() => form.city ? addressData[form.city] : []);
const commDistricts = computed(() => commAddress.value.city ? addressData[commAddress.value.city] : []);
const companyDistricts = computed(() => companyAddress.value.city ? addressData[companyAddress.value.city] : []);

watch(commAddress, (newVal) => {
  form.comm_address = `${newVal.city || ''}${newVal.district || ''}${newVal.street || ''}`;
}, { deep: true });

watch(companyAddress, (newVal) => {
  form.company_address = `${newVal.city || ''}${newVal.district || ''}${newVal.street || ''}`;
}, { deep: true });

watch(() => commAddress.value.city, (newCity, oldCity) => {
  if (newCity !== oldCity) {
    commAddress.value.district = '';
  }
});

watch(() => companyAddress.value.city, (newCity, oldCity) => {
  if (newCity !== oldCity) {
    companyAddress.value.district = '';
  }
});

watch(() => form.city, (newCity, oldCity) => {
  if (newCity !== oldCity) {
    form.district = '';
  }
});

function parseAddress(addressString) {
    const address = addressString || '';
    const city = cities.find(c => address.startsWith(c));
    if (!city) return { city: '', district: '', street: address };
    const districts = addressData[city] || [];
    const district = districts.find(d => address.startsWith(`${city}${d}`));
    const street = district ? address.substring(city.length + district.length) : address.substring(city.length);
    return { city, district, street };
}


// --- Computed properties for complex fields ---

const monthlyIncomeInMyriad = computed({
  get: () => form.monthly_income ? parseFloat((form.monthly_income / 10000).toFixed(2)) : null,
  set: (val) => form.monthly_income = val ? val * 10000 : null
});

const demandAmountInMyriad = computed({
  get: () => form.demand_amount ? parseFloat((form.demand_amount / 10000).toFixed(2)) : null,
  set: (val) => form.demand_amount = val ? val * 10000 : null
});

const residenceDuration = computed({
  get() {
    const match = form.residence_duration?.match(/(\d+)年(\d+)月/) || [];
    return { years: match[1] || null, months: match[2] || null };
  },
  set(val) {
    form.residence_duration = `${val.years || 0}年${val.months || 0}月`;
  }
});

const companyTenure = computed({
  get() {
    const match = form.company_tenure?.match(/(\d+)年(\d+)月/) || [];
    return { years: match[1] || null, months: match[2] || null };
  },
  set(val) {
    form.company_tenure = `${val.years || 0}年${val.months || 0}月`;
  }
});

// --- Watchers ---

watch(() => props.case, (newCase) => {
  if (newCase) {
    const payload = newCase.payload || {};
    Object.assign(form, {
      id: newCase.id,
      case_status: newCase.case_status || 'pending',
      business_level: newCase.business_level || 'A',
      assigned_to: newCase.assigned_to || '',
      name: newCase.name || newCase.customer_name || '',
      phone: newCase.phone || '',
      email: newCase.email || '',
      notes: newCase.notes || '',
      // 優先從模型欄位讀取，fallback 到 payload
      birth_date: newCase.birth_date || payload.birth_date || '',
      id_number: newCase.id_number || payload.id_number || '',
      education: newCase.education || payload.education || '',
      contact_time: newCase.contact_time || payload.contact_time || '',
      landline_phone: newCase.landline_phone || payload.landline_phone || '',
      residence_duration: newCase.residence_duration || payload.residence_duration || '',
      residence_owner: newCase.residence_owner || payload.residence_owner || '',
      telecom_operator: newCase.telecom_operator || payload.telecom_operator || '',
      city: newCase.city || '',
      district: newCase.district || '',
      street: newCase.street || '',
      comm_address_same_as_home: newCase.comm_address_same_as_home ?? payload.comm_address_same_as_home ?? false,
      comm_address: newCase.comm_address || payload.comm_address || '',
      company_name: newCase.company_name || payload.company_name || '',
      company_phone: newCase.company_phone || payload.company_phone || '',
      job_title: newCase.job_title || payload.job_title || '',
      monthly_income: newCase.monthly_income || payload.monthly_income || '',
      company_tenure: newCase.company_tenure || payload.company_tenure || '',
      has_labor_insurance: (newCase.has_labor_insurance !== null && newCase.has_labor_insurance !== undefined)
        ? (newCase.has_labor_insurance ? 'yes' : 'no')
        : ((payload.has_labor_insurance !== null && payload.has_labor_insurance !== undefined)
          ? (payload.has_labor_insurance ? 'yes' : 'no')
          : 'no'),
      company_address: newCase.company_address || payload.company_address || '',
      emergency_contact_1_name: newCase.emergency_contact_1_name || payload.emergency_contact_1_name || '',
      emergency_contact_1_relationship: newCase.emergency_contact_1_relationship || payload.emergency_contact_1_relationship || '',
      emergency_contact_1_phone: newCase.emergency_contact_1_phone || payload.emergency_contact_1_phone || '',
      confidential_1: payload.confidential_1 || false,
      emergency_contact_2_name: payload.emergency_contact_2_name || '',
      emergency_contact_2_relationship: payload.emergency_contact_2_relationship || '',
      emergency_contact_2_phone: payload.emergency_contact_2_phone || '',
      confidential_2: payload.confidential_2 || false,
      referrer: newCase.referrer || payload.referrer || '',
      demand_amount: newCase.demand_amount || payload.demand_amount || '',
      images: newCase.images || [],
    });

    commAddress.value = parseAddress(form.comm_address);
    companyAddress.value = parseAddress(form.company_address);
    stagedImages.value = []; // Clear staged images when case changes

    showContact2.value = !!(form.emergency_contact_2_name || form.emergency_contact_2_phone);
  }
}, { immediate: true, deep: true });

watch(() => form.comm_address_same_as_home, (isSame) => {
  if (isSame) {
    commAddress.value.city = form.city;
    commAddress.value.district = form.district;
    commAddress.value.street = form.street;
  }
});

watch([() => form.city, () => form.district, () => form.street], ([newCity, newDistrict, newStreet]) => {
  if (form.comm_address_same_as_home) {
    commAddress.value.city = newCity;
    commAddress.value.district = newDistrict;
    commAddress.value.street = newStreet;
  }
});


// --- Methods ---

const syncHomeToComm = () => {
  if (form.comm_address_same_as_home) {
    // 強制同步所有地址資料
    commAddress.value.city = form.city;
    commAddress.value.district = form.district;
    commAddress.value.street = form.street;
  }
};

const isEdit = computed(() => !!props.case?.id);

const closeModal = () => {
  if (!saving.value) {
    emit('close');
  }
};

const triggerFileUpload = () => {
  fileInput.value.click();
};

const handleImageUpload = (event) => {
  const files = Array.from(event.target.files);
  files.forEach(file => {
    stagedImages.value.push({
      file: file,
      previewUrl: URL.createObjectURL(file)
    });
  });
};

const removeStagedImage = (index) => {
  stagedImages.value.splice(index, 1);
};

const exportCSV = () => {
  const data = form;
  let csvContent = "data:text/csv;charset=utf-8,\uFEFF"; // Add BOM for Chinese characters

  const fieldLabels = {
    id: '案件ID',
    case_status: '案件狀態',
    business_level: '業務等級',
    assigned_to: '承辦業務',
    name: '姓名',
    phone: '手機號碼',
    email: '電子郵件',
    notes: '備註',
    birth_date: '出生年月日',
    id_number: '身份證字號',
    education: '最高學歷',
    contact_time: '可聯繫時間',
    landline_phone: '室內電話',
    residence_duration: '現居地住多久',
    residence_owner: '居住地持有人',
    telecom_operator: '電信業者',
    home_address_city: '戶籍地址-縣市',
    home_address_district: '戶籍地址-區域',
    home_address_street: '戶籍地址-街道巷弄號',
    comm_address_same_as_home: '通訊地址同戶籍地',
    comm_address_city: '通訊地址-縣市',
    comm_address_district: '通訊地址-區域',
    comm_address_street: '通訊地址-街道巷弄號',
    company_name: '公司名稱',
    company_phone: '公司電話',
    job_title: '職稱',
    monthly_income: '月收入',
    company_tenure: '目前公司在職多久',
    has_labor_insurance: '有無薪轉勞保',
    company_address_city: '公司地址-縣市',
    company_address_district: '公司地址-區域',
    company_address_street: '公司地址-街道巷弄號',
    emergency_contact_1_name: '聯絡人①姓名',
    emergency_contact_1_relationship: '聯絡人①關係',
    emergency_contact_1_phone: '聯絡人①電話',
    confidential_1: '聯絡人①是否保密',
    emergency_contact_2_name: '聯絡人②姓名',
    emergency_contact_2_relationship: '聯絡人②關係',
    emergency_contact_2_phone: '聯絡人②電話',
    confidential_2: '聯絡人②是否保密',
    referrer: '介紹人',
    demand_amount: '資金需求',
  };

  // Determine the actual headers to use, including dynamic ones
  let actualHeaders = Object.keys(fieldLabels);

  // Add image URLs as headers if any
  if (data.images && data.images.length > 0) {
    for (let i = 0; i < data.images.length; i++) {
      actualHeaders.push(`image_url_${i + 1}`);
      fieldLabels[`image_url_${i + 1}`] = `圖片URL_${i + 1}`; // Add to labels
    }
  }

  // Generate CSV header row
  csvContent += actualHeaders.map(headerKey => `"${fieldLabels[headerKey] || headerKey}"`).join(',') + '\r\n';

  // Generate CSV data row
  const values = actualHeaders.map(headerKey => {
    if (headerKey.startsWith('home_address_')) {
      const part = headerKey.replace('home_address_', '');
      return `"${form[part] || ''}"`;
    }
    if (headerKey.startsWith('comm_address_')) {
      const part = headerKey.replace('comm_address_', '');
      return `"${commAddress.value[part] || ''}"`;
    }
    if (headerKey.startsWith('company_address_')) {
      const part = headerKey.replace('company_address_', '');
      return `"${companyAddress.value[part] || ''}"`;
    }
    if (headerKey.startsWith('image_url_')) {
      const index = parseInt(headerKey.replace('image_url_', '')) - 1;
      return `"${(data.images && data.images[index]?.url) || ''}"`;
    }
    // Handle specific field values
    if (headerKey === 'case_status') {
      const statusOption = CASE_STATUS_OPTIONS.find(opt => opt.value === data[headerKey]);
      return `"${statusOption ? statusOption.label : (data[headerKey] || '')}"`;
    }
    if (headerKey === 'has_labor_insurance') {
      return `"${data[headerKey] === 'yes' ? '有' : '無'}"`;
    }
    if (['comm_address_same_as_home', 'confidential_1', 'confidential_2'].includes(headerKey)) {
      return `"${data[headerKey] ? '是' : '否'}"`;
    }
    if (headerKey === 'residence_duration') {
      return `"${residenceDuration.value.years || 0}年${residenceDuration.value.months || 0}月"`;
    }
    if (headerKey === 'company_tenure') {
      return `"${companyTenure.value.years || 0}年${companyTenure.value.months || 0}月"`;
    }
    if (headerKey === 'monthly_income') {
      return `"${monthlyIncomeInMyriad.value !== null ? monthlyIncomeInMyriad.value + '萬' : ''}"`;
    }
    if (headerKey === 'demand_amount') {
      return `"${demandAmountInMyriad.value !== null ? demandAmountInMyriad.value + '萬' : ''}"`;
    }
    // Default for other fields
    return `"${data[headerKey] || ''}"`;
  }).join(',');
  csvContent += values + '\r\n';

  const encodedUri = encodeURI(csvContent);
  const link = document.createElement("a");
  link.setAttribute("href", encodedUri);
  link.setAttribute("download", `case_export_${data.id || 'new'}.csv`);
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);

  success('案件資料已導出為 CSV 檔案');
};

const saveCase = async () => {
  if (!form.name.trim() || !form.phone.trim()) {
    showError('姓名和手機號碼為必填項');
    return;
  }
  saving.value = true;

  // 所有欄位直接發送到後端，後端會保存到相應的資料表欄位
  const apiPayload = {
    id: form.id,
    case_status: form.case_status,
    assigned_to: form.assigned_to,
    name: form.name,
    phone: form.phone,
    email: form.email,
    notes: form.notes,
    business_level: form.business_level,

    // 個人資料
    birth_date: form.birth_date,
    id_number: form.id_number,
    education: form.education,

    // 聯絡資訊
    contact_time: form.contact_time,
    city: form.city,
    district: form.district,
    street: form.street,
    landline_phone: form.landline_phone,
    comm_address_same_as_home: form.comm_address_same_as_home,
    comm_address: form.comm_address,
    residence_duration: form.residence_duration,
    residence_owner: form.residence_owner,
    telecom_operator: form.telecom_operator,

    // 公司資料
    company_name: form.company_name,
    company_phone: form.company_phone,
    company_address: form.company_address,
    job_title: form.job_title,
    monthly_income: form.monthly_income,
    has_labor_insurance: form.has_labor_insurance === 'yes' || form.has_labor_insurance === '1' || form.has_labor_insurance === 1 || form.has_labor_insurance === true,
    company_tenure: form.company_tenure,

    // 貸款資訊
    demand_amount: form.demand_amount,

    // 緊急聯絡人
    emergency_contact_1_name: form.emergency_contact_1_name,
    emergency_contact_1_relationship: form.emergency_contact_1_relationship,
    emergency_contact_1_phone: form.emergency_contact_1_phone,
    confidential_1: form.confidential_1,
    emergency_contact_2_name: form.emergency_contact_2_name,
    emergency_contact_2_relationship: form.emergency_contact_2_relationship,
    emergency_contact_2_phone: form.emergency_contact_2_phone,
    confidential_2: form.confidential_2,

    // 其他
    referrer: form.referrer,

    // 如果有新圖片，標記需要使用 FormData
    hasImages: stagedImages.value.length > 0,
    imageFiles: stagedImages.value.map(img => img.file),
  };

  emit('save', apiPayload);

  // The parent component will set saving to false after the API call.
};

const showField = (fieldKey) => {
  if (fieldKey === 'business_level') {
    return props.pageType === 'tracking' || form.case_status === 'tracking';
  }
  return true;
};

// --- Lifecycle Hooks ---

const { getUsers } = useUsers();
onMounted(async () => {
  try {
    const { success, users } = await getUsers({ per_page: 250 });
    if (success) availableUsers.value = users;
  } catch (e) { console.error(e); }
});

watch(() => props.isOpen, (isOpen) => {
  if (!isOpen) {
    saving.value = false;
  }
});
</script>

<style scoped>
/* Using Bootstrap via CDN, so most styles are global. Add specific overrides here if needed */
.form-group-row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    margin-bottom: 0.5rem;
}
.form-group-row .form-label {
    margin-bottom: 0;
    margin-right: 0.5rem;
    white-space: nowrap;
}
.form-group-row .form-control, .form-group-row .form-select, .form-group-row .form-check, .form-group-row .input-group {
    flex: 1 1 auto;
    width: auto;
    min-width: 120px;
}
.address-group .form-select {
    min-width: 100px;
    flex-grow: 0.5;
}
.address-group .form-control {
     flex-grow: 2;
}
.duration-group .form-control {
    width: 80px;
    flex: 0 1 auto;
}
.duration-group .input-group-text {
    background: transparent;
    border: none;
    padding: 0 0.5rem;
}
.narrow-number-input {
    width: 80px !important;
    flex: 0 1 auto !important;
}
.manual-br {
    width: 100%;
    height: 15px;
}
.modal-fullscreen {
    width: 100vw;
    max-width: none;
    height: 100%;
    margin: 0;
}
.modal-body {
  overflow-y: auto;
}
.hero-icon {
  width: 1.25rem;
  height: 1.25rem;
  margin-right: 0.5rem;
  display: inline-block;
  vertical-align: middle;
}

.form-check-input[type="radio"]:checked {
  background-color: black !important;
  border-color: black !important;
  background-image: none !important; /* Remove default inner circle image */
}

.form-check-input[type="checkbox"]:checked {
  background-color: black !important;
  border-color: black !important;
  /* Bootstrap's default checkmark is usually white on a colored background */
}

.form-check-input[type="radio"]:checked {
  background-color: black;
  border-color: black;
  background-image: none; /* Remove default inner circle image */
}

.form-check-input[type="checkbox"]:checked {
  background-color: black;
  border-color: black;
  /* Bootstrap's default checkmark is usually white on a colored background */
}

.form-check-input[type="radio"]:checked {
  background-color: black;
  border-color: black;
  background-image: none; /* Remove default inner circle image */
}

.form-check-input[type="checkbox"]:checked {
  background-color: black;
  border-color: black;
  /* Bootstrap's default checkmark is usually white on a colored background */
}
</style>