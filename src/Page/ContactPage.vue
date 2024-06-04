<template>
  <div class="contact">
    <div class="contact__container">
      <div class="contact__container-item info">
        <h1>{{ $t('contact') }}</h1>
        <div class="contact-info">
          <div class="contact-group">
            <button class="contact-button" aria-label="Call us at +41 77 944 17 43">
              <a href="tel:++41779441743"><i class="fa-solid fa-phone"></i>+41 77 944 17 43</a>
            </button>
          </div>
          <div class="contact-group">
            <button class="contact-button" aria-label="Email us at support@starsstation.ch">
              <a href="mailto:support@starsstation.ch"><i class="fa-solid fa-envelope"></i>support@starsstation.ch</a>
            </button>
          </div>
          <div class="contact-group logo">
            <router-link to="/"><img src="@/assets/logo/Logo-text_white.svg" alt="Logo"></router-link>
          </div>
          <div class="social">
            <nav>
              <ul>
                <li>
                  <a href="https://www.instagram.com/starsstationstudio?igsh=cDdmczIxc2ljMzJq" aria-label="Instagram">
                    <i class="fab fa-instagram custom-icon instagram-icon"></i>
                  </a>
                </li>
                <li>
                  <a href="#" aria-label="Facebook">
                    <i class="fab fa-facebook custom-icon facebook-icon"></i>
                  </a>
                </li>
                <li>
                  <a href="https://wa.me/41779441743" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp custom-icon whatsapp-icon"></i>
                  </a>
                </li>
                <li>
                  <a href="https://www.youtube.com/@StarsStationStudio" aria-label="YouTube">
                    <i class="fab fa-youtube custom-icon youtube-icon"></i>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <div class="contact__container-item feedback">
        <form @submit.prevent="submitForm" method="POST" action="sendmail.php" enctype="multipart/form-data" ref="form">
          <h1>{{ $t('feedback') }}</h1>
          <div class="feedback_container">
            <div class="form-group">
              <label :class="{ 'active': activeInputs.name, 'inactive': !activeInputs.name }" for="name">{{ $t('name')
                }}</label>
              <input @focus="handleFocus('name')" @blur="handleBlur('name')" type="text" id="name" name="name"
                v-model="inputs.name" ref="name">
            </div>
            <div class="form-group">
              <label :class="{ 'active': activeInputs.surname, 'inactive': !activeInputs.surname }" for="surname">{{
                $t('surname') }}</label>
              <input @focus="handleFocus('surname')" @blur="handleBlur('surname')" type="text" id="surname"
                name="surname" v-model="inputs.surname" ref="surname">
            </div>
            <div class="form-group">
              <label :class="{ 'active': activeInputs.email, 'inactive': !activeInputs.email }" for="email">{{
                $t('email') }}</label>
              <input @focus="handleFocus('email')" @blur="handleBlur('email')" type="email" id="email" name="email"
                v-model="inputs.email" ref="email">
            </div>
            <div class="form-group">
              <label :class="{ 'active': activeInputs.tel, 'inactive': !activeInputs.tel }" for="tel">{{ $t('tel')
                }}</label>
              <input @focus="handleFocus('tel')" @blur="handleBlur('tel')" type="tel" id="tel" name="tel"
                v-model="inputs.tel" ref="tel">
            </div>
            <div class="form-group">
              <label :class="{ 'active': activeInputs.message, 'inactive': !activeInputs.message }" for="message">{{
                $t('message') }}</label>
              <textarea @focus="handleFocus('message')" @blur="handleBlur('message')" name="message" id="message"
                rows="4" v-model="inputs.message" ref="message" @input="autoResize"></textarea>
            </div>
            <div class="consent">
              <input type="checkbox" id="consent" v-model="consentGiven">
              <p>{{ $t('agreement') }}<router-link to="/Privacy">{{ $t('privacy_policy_title') }}</router-link></p>
            </div>
            <div class="consent">
              <input type="checkbox" id="subscribe" v-model="subscribe">
              <p>{{ $t('subscribe') }}</p>
            </div>
            <div class="form-controls">
              <div class="form-group file inline">
                <div class="file-drop-area" @dragover.prevent @drop="handleDrop">
                  <input type="file" name="files[]" id="attachment"
                    accept=".png, .jpeg, .jpg, .svg, .pdf, .docx, .txt, .odt, .xlsx, .ods, .gif, .bmp, .tiff, .pptx, .odp"
                    multiple @change="updateFileList">
                  <label for="attachment" class="btn-upload">{{ $t('attach') }}  <img src="@/assets/icon/upload.svg" alt=""></label>
                </div>
              </div>
              <input type="hidden" v-model="csrfToken" name="csrf_token">
              <input type="hidden" name="language" :value="currentLanguage">
              <input type="hidden" name="subscribe" :value="subscribe">
              <div class="form-group form-button inline">
                <button class="send" type="submit" :disabled="isSubmitting" aria-label="Send message">
                  <span>{{ isSubmitting ? $t('sending') : $t('send') }}</span>
                  <span v-if="isSubmitting" class="loader" aria-label="Loading..."></span>
                </button>
              </div>
            </div>
            <div class="file-list">
              <ul v-if="fileList.length > 0">
                <li v-for="(file, index) in displayedFileList" :key="index" class="file-item">
                  <img :src="getFileIcon(file)" alt="file icon" class="file-icon" />
                  <span class="file-name">{{ file.name }}</span>
                  <button @click.prevent="removeFile(index)" class="remove-file" aria-label="Remove file"><i
                      class="fa-solid fa-x"></i></button>
                  <div class="upload-progress">
                    <div class="upload-progress-bar" :style="{ width: file.progress + '%' }"></div>
                  </div>
                </li>
              </ul>
              <span v-if="fileList.length > 3">
                <a href="#" @click.prevent="toggleFileList">
                  {{ showFullFileList ? $t('hide') : `${$t('and')} ${fileList.length - 3} ${$t('more')}` }}
                </a>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ContactPage',
  data() {
    return {
      inputs: {
        name: '',
        surname: '',
        email: '',
        tel: '',
        message: ''
      },
      activeInputs: {
        name: false,
        surname: false,
        email: false,
        tel: false,
        message: false
      },
      fileList: [],
      showFullFileList: false,
      csrfToken: '',
      isSubmitting: false,
      consentGiven: false,
      subscribe: false, // Новый чекбокс для подписки
      errorMessage: '', // Поле для сообщения об ошибке
      allowedTypes: [
        'image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml',
        'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'text/plain', 'application/vnd.oasis.opendocument.text',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.oasis.opendocument.spreadsheet',
        'image/gif', 'image/bmp', 'image/tiff', 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/vnd.oasis.opendocument.presentation'
      ],
      maxSize: 10 * 1024 * 1024, // 10 MB
      currentUploadIndex: -1
    };
  },
  computed: {
    currentLanguage() {
      return this.$i18n.locale; // Получаем текущий язык из i18n
    },
    displayedFileList() {
      if (this.showFullFileList) {
        return this.fileList;
      }
      return this.fileList.slice(0, 3);
    }
  },
  created() {
    this.getCsrfToken();
  },
  methods: {
    handleFocus(input) {
      this.activeInputs[input] = true;
    },
    handleBlur(input) {
      if (!this.inputs[input]) {
        this.activeInputs[input] = false;
      }
    },
    updateFileList(event) {
      const newFiles = Array.from(event.target.files);
      this.processFiles(newFiles);
    },
    handleDrop(event) {
      event.preventDefault();
      const droppedFiles = Array.from(event.dataTransfer.files);
      this.processFiles(droppedFiles);
    },
    processFiles(files) {
      files.forEach(file => {
        if (this.fileList.some(existingFile => existingFile.name === file.name)) {
          this.showError(`${file.name} ${this.$t('is_already_selected')}`);
          return;
        }
        if (!this.allowedTypes.includes(file.type)) {
          this.showError(`${file.name} ${this.$t('is_not_a_supported_file_type')}`);
          return;
        }
        if (file.size > this.maxSize) {
          this.showError(`${file.name} ${this.$t('is_too_large')}. ${this.$t('maximum_size_is')} 10 MB.`);
          return;
        }
        this.fileList.push({ name: file.name, type: file.type, progress: 0, originalFile: file }); // Добавляем файл с начальным прогрессом 0
      });

      this.showFullFileList = false;
      if (this.currentUploadIndex === -1) {
        this.startUploadProgress(0);
      }
    },
    startUploadProgress(index) {
      if (index >= this.fileList.length) {
        this.currentUploadIndex = -1;
        return;
      }
      this.currentUploadIndex = index;
      const file = this.fileList[index];
      const interval = setInterval(() => {
        if (file.progress < 100) {
          file.progress += 10;
        } else {
          clearInterval(interval);
          this.startUploadProgress(index + 1);
        }
      }, 200); // 200 ms для каждого шага прогресса (всего 2 секунды)
    },
    getFileIcon(file) {
      if (!file || !file.type) {
        return require('@/assets/icon/default-icon.svg'); 
      }

      const fileType = file.type;
      if (fileType.includes('png')) {
        return require('@/assets/icon/image-icon.svg');
      } else if (fileType.includes('pdf')) {
        return require('@/assets/icon/pdf-icon.svg');
      } else if (fileType.includes('wordprocessingml.document')) {
        return require('@/assets/icon/docx-icon.svg');
      } else if (fileType.includes('text')) {
        return require('@/assets/icon/text-icon.svg');
      } else if (fileType.includes('spreadsheetml.sheet')) {
        return require('@/assets/icon/xlsx-icon.svg');
      } else if (fileType.includes('presentationml.presentation')) {
        return require('@/assets/icon/pptx-icon.svg');
      } else {
        return require('@/assets/icon/default-icon.svg'); 
      }
    },
    removeFile(index) {
      this.fileList.splice(index, 1);
      if (this.currentUploadIndex === index) {
        this.startUploadProgress(index); // Перезапуск прогресса при удалении файла
      } else if (this.currentUploadIndex > index) {
        this.currentUploadIndex--; // Корректировка индекса при удалении файла до текущего загружаемого
      }
    },
    toggleFileList() {
      this.showFullFileList = !this.showFullFileList;
    },
    getCsrfToken() {
      axios.get('get_csrf_token.php')
        .then(response => {
          this.csrfToken = response.data.token;
        })
        .catch(error => {
          console.error('Error getting CSRF token:', error);
        });
    },
    submitForm() {
      if (!this.consentGiven) {
        Swal.fire({
          icon: 'warning',
          title: this.$t('required_consent'),
          text: this.$t('you_must_agree_to_the_processing_of_personal_data'),
          timer: 3000,
            showConfirmButton: true,
  timerProgressBar: true,
  confirmButtonText: 'OK'
        });
        return;
      }

      if (this.validateInputs()) {
        this.isSubmitting = true; // Показать индикатор загрузки
        const formData = new FormData();
        Object.keys(this.inputs).forEach(key => {
          formData.append(key, this.inputs[key]);
        });
        this.fileList.forEach(file => {
          formData.append('files[]', file.originalFile, file.name); // Используем оригинальный файл
        });
        formData.append('csrf_token', this.csrfToken);
        formData.append('language', this.currentLanguage); // Добавляем текущий язык
        formData.append('subscribe', this.subscribe); // Добавляем статус подписки

        axios.post('sendmail.php', formData)
          .then(response => {
            const data = response.data;
            if (data.status === 'error') {
              this.errorMessage = data.message;
            } else {
              Swal.fire({
                icon: 'success',
                title: this.$t('success_message'),
                timer: 3000,
                  showConfirmButton: true,
  timerProgressBar: true,
  confirmButtonText: 'OK'
              });
              this.resetForm(); // Очистить поля формы
            }
          })
          .catch(error => {
            this.errorMessage = error.message;
            Swal.fire({
              icon: 'error',
              title: this.$t('error_message'),
              text: error.message,
              timer: 3000,
                showConfirmButton: true,
  timerProgressBar: true,
  confirmButtonText: 'OK'
            });
          })
          .finally(() => {
            this.isSubmitting = false; // Скрыть индикатор загрузки
          });
      } else {
        Swal.fire({
          icon: 'warning',
          title: this.$t('fill_all_fields'),
          timer: 3000,
            showConfirmButton: true,
  timerProgressBar: true,
  confirmButtonText: 'OK'
        });
      }
    },
    resetForm() {
      this.inputs = {
        name: '',
        surname: '',
        email: '',
        tel: '',
        message: ''
      };
      this.fileList = [];
      this.showFullFileList = false;
      this.consentGiven = false;
      this.subscribe = false; // Сброс подписки
      this.errorMessage = ''; // Очистить сообщение об ошибке
      this.$refs.form.reset(); // Сбросить форму
    },
    validateInputs() {
      for (const key in this.inputs) {
        if (this.inputs[key].trim() === '') {
          return false;
        }
      }
      return true;
    },
    autoResize() {
      const textarea = this.$refs.message;
      textarea.style.height = '50px'; // Устанавливаем высоту по умолчанию
      textarea.style.height = textarea.scrollHeight + 'px'; // Устанавливаем новую высоту на основе содержимого
    },
    showError(message) {
      Swal.fire({
        icon: 'warning',
        title: this.$t('file_upload_error'),
        text: message,
        timer: 3000,
          showConfirmButton: true,
  timerProgressBar: true,
  confirmButtonText: 'OK'
      });
    }
  },
  mounted() {
    this.autoResize();
  },
  watch: {
    'inputs.message': function () {
      this.autoResize();
    }
  }
};
</script>

<style scoped>
h1 {
  color: var(--text-color);
  font-size: 48px;
}

.contact {
  color: white;
  background-color: var(--bg-main-color);
  background-size: cover;
  background-attachment: fixed;
  background-position: center;
}

.contact__container {
  padding-top: 50px;
  display: flex;
  justify-content: center;
}

.contact__container-item {
  width: 100%;
  margin: 0 auto;
  overflow: hidden;
}

.feedback_container {
  padding: 50px 100px;
}

.contact__container-item h1 {
  text-align: center;
}

.contact-info {
  padding-top: 50px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.contact-group {
  margin-bottom: 30px;
  display: flex;
  align-items: center;
}

.contact-group a {
  text-decoration: underline;
  color: var(--text-color);
  font-size: 20px;
  transition: opacity 0.5s ease;
}

.contact-group a i {
  margin-right: 10px;
}

.contact-button {
  display: inline-flex;
  align-items: center;
  padding: 20px 30px;
  color: #fff;
  background: radial-gradient(circle, var(--bg-secondary-color), var(--bg-main-color));
  border: none;
  border-radius: 10px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  z-index: 1;
  transition: 1s;
}

.contact-button::before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: radial-gradient(circle, var(--bg-secondary-color), var(--bg-secondary-color));
  z-index: -1;
  opacity: 0;
  transition: opacity 0.5s ease;
}

.contact-button:hover::before {
  opacity: 1;
}

.contact-button:hover {
  transform: scale(1.2);
}

.contact-button a:hover {
  color: var(--active-color);
}

.logo {
  position: relative;
}

.logo img {
  width: 200px;
  transition: 1s;
}

.logo img:hover {
  transform: scale(1.2)
}

.icon svg {
  width: 25px;
  height: 25px;
}

.social a {
  color: var(--text-color);
}

.social nav ul {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.social li {
  padding: 20px;
}

form {
  position: relative;
  margin: 0 auto;
}

line {
  display: flex;
  justify-content: space-between;
}

.feedback_container>.form-group,
.file label {
  position: relative;
  margin-bottom: 50px;
}

.file label {
  display: flex;
    flex-direction: column;
    align-items: center;
}

.file label img {
  width: 50px;
    margin-top: 10px;
    animation: upload 2s ease-in-out infinite;
}

@keyframes upload {
  0% {
    opacity: 1;
  }
  50% {
    opacity: .5;
  }

  100% {
    opacity: 1;
  }
}

label {
  position: absolute;
  color: black;
  top: 20px;
  font-weight: bold;
  margin-left: 5px;
}

input {
  height: 50px;
}

textarea {
  resize: none;
}

input,
textarea {
  border: none;
  border-radius: 5px;
  background-color: white;
  font-size: 16px;
  color: #000000;
  width: 100%;
  padding-left: 10px;
  outline: none;
}

input[type="text"],
input[type="email"],
input[type="tel"],
textarea {
  padding-top: 20px;
}

label.active {
  top: -20px;
  font-size: 12px;
  color: var(--text-secondary-color);
  animation: floatLabel 0.3s ease forwards;
}

label.inactive {
  animation: sinkLabel 0.3s ease forwards;
}

@keyframes floatLabel {
  from {
    top: 20px;
    font-size: 16px;
  }

  to {
    top: -20px;
    font-size: 12px;
  }
}

@keyframes sinkLabel {
  from {
    top: -20px;
    font-size: 12px;
  }

  to {
    top: 20px;
    font-size: 16px;
  }
}

input[type="file"] {
  position: absolute;
  left: -9999px;
}

.btn-upload {
  display: inline-block;
  padding: 20px 10px;
  color: var(--text-color);
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
  border: 2px dashed var(--br-color);
  transition: .5s ease;
}

.btn-upload:hover {
  background-color: var(--active-color);
  border: 2px dashed var(--active-color);
  color: var(--bg-main-color);
}

.form-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
}

.file-item {
  display: flex;
  align-items: center;
  position: relative;
  padding: 10px;
  margin-bottom: 10px;
  background-color: white;
  border-radius: 14px 15px 0 0;
}

.file-icon {
  width: 30px;
  height: 30px;
  margin-right: 10px;
}

.file-name {
  flex-grow: 1;
  color: black;
}

.file-list span a {
  text-decoration: underline;
  color: var(--text-color);
}

.remove-file {
  background: none;
  border: none;
  color: var(--active-color);
  cursor: pointer;
  margin-left: 10px;
}

.upload-progress {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background-color: #f0f0f0;
}

.upload-progress-bar {
  height: 100%;
  background-color: rgba(0, 216, 47, 0.781);
  transition: width .5s;
}

.consent {
  display: flex;
  align-items: center;
  margin: 20px auto
}

.consent input[type="checkbox"] {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  width: 20px;
  height: 20px;
  border: 2px solid var(--br-color);
  border-radius: 4px;
  outline: none;
  cursor: pointer;
  position: relative;
  margin-right: 10px;
}

.consent input[type="checkbox"]:checked {
  background-color: var(--active-color);
  border-color: var(--active-color);
}

.consent input[type="checkbox"]:checked::after {
  content: '✔';
  color: var(--text-color);
  font-size: 16px;
  position: absolute;
  top: -5px;
  left: 2px;
}

.consent p {
  color: var(--text-color);
  margin: 0;
}

.consent a {
  color: var(--text-color);
  margin-left: 10px;
}

.form-button button {
  padding: 10px 20px;
}

.loader {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 3px solid var(--br-color);
  border-radius: 50%;
  border-top-color: var(--active-color);
  animation: spin 1s ease-in-out infinite;
  margin-left: 8px;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

@media screen and (max-width: 1024px) {
  .contact__container {
    flex-direction: column;
  }
}

@media screen and (max-width: 769px) {
  .feedback_container {
    padding: 20px 20px;
  }
}
</style>