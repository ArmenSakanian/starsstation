<template>
  <div class="contact">
    <div class="contact__container">
      <div class="contact__container-item info">
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
        </div>
      </div>
      <div class="contact__container-item feedback">
        <form @submit.prevent="submitForm" method="POST" action="sendmail.php" enctype="multipart/form-data" ref="form">
          <h1>{{ $t('feedback') }}</h1>
          <div class="feedback_container">
            <div class="form-group-container">
              <div class="form-group">
                <label
                  :class="{ 'active': activeInputs.name || inputs.name, 'inactive': !activeInputs.name && !inputs.name }"
                  for="name">{{ $t('name') }}</label>
                <input @focus="handleFocus('name')" @blur="handleBlur('name')" type="text" id="name" name="name"
                  v-model="inputs.name" ref="name">
              </div>
              <div class="form-group">
                <label
                  :class="{ 'active': activeInputs.surname || inputs.surname, 'inactive': !activeInputs.surname && !inputs.surname }"
                  for="surname">{{ $t('surname') }}</label>
                <input @focus="handleFocus('surname')" @blur="handleBlur('surname')" type="text" id="surname"
                  name="surname" v-model="inputs.surname" ref="surname">
              </div>
            </div>
            <div class="form-group-container">
              <div class="form-group">
                <label
                  :class="{ 'active': activeInputs.email || inputs.email, 'inactive': !activeInputs.email && !inputs.email }"
                  for="email">{{ $t('email') }}</label>
                <input @focus="handleFocus('email')" @blur="handleBlur('email')" type="email" id="email" name="email"
                  v-model="inputs.email" ref="email">
              </div>
              <div class="form-group">
                <label
                  :class="{ 'active': activeInputs.tel || inputs.tel, 'inactive': !activeInputs.tel && !inputs.tel }"
                  for="tel">{{ $t('tel') }}</label>
                <input @focus="handleFocus('tel')" @blur="handleBlur('tel')" type="tel" id="tel" name="tel"
                  v-model="inputs.tel" ref="tel">
              </div>
            </div>
            <div class="form-group-container">
              <div class="form-group">
                <label
                  :class="{ 'active': activeInputs.message || inputs.message, 'inactive': !activeInputs.message && !inputs.message }"
                  for="message">{{ $t('message') }}</label>
                <textarea @focus="handleFocus('message')" @blur="handleBlur('message')" name="message" id="message"
                  rows="4" v-model="inputs.message" ref="message" @input="autoResize"></textarea>
                <div class="file-drop-area">
                  <input type="file" name="files[]" id="attachment"
                    accept=".png, .jpeg, .jpg, .svg, .pdf, .docx, .txt, .odt, .xlsx, .ods, .gif, .bmp, .tiff, .pptx, .odp"
                    multiple @change="updateFileList">
                  <label for="attachment" class="btn-upload"><img src="@/assets/icon/upload.svg" alt=""></label>
                </div>
              </div>
            </div>
            <div class="consent">
              <input type="checkbox" id="consent" v-model="consentGiven">
              <p>{{ $t('agreement') }}<router-link to="/Privacy">{{ $t('privacy_policy_title') }}</router-link></p>
            </div>
            <div class="consent">
              <input type="checkbox" id="subscribe" v-model="subscribe">
              <p>{{ $t('newsletter_text') }}</p>
            </div>
            <div class="form-controls">
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
      <div class="contact__container-item info">
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
      subscribe: false,
      errorMessage: '',
      allowedTypes: [
        'image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml',
        'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'text/plain', 'application/vnd.oasis.opendocument.text',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.oasis.opendocument.spreadsheet',
        'image/gif', 'image/bmp', 'image/tiff', 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/vnd.oasis.opendocument.presentation'
      ],
      maxSize: 10 * 1024 * 1024,
      currentUploadIndex: -1
    };
  },
  computed: {
    currentLanguage() {
      return this.$i18n.locale;
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
        this.fileList.push({ name: file.name, type: file.type, progress: 0, originalFile: file });
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
      }, 200);
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
        this.startUploadProgress(index);
      } else if (this.currentUploadIndex > index) {
        this.currentUploadIndex--;
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
        this.isSubmitting = true;
        const formData = new FormData();
        Object.keys(this.inputs).forEach(key => {
          formData.append(key, this.inputs[key]);
        });
        this.fileList.forEach(file => {
          formData.append('files[]', file.originalFile, file.name);
        });
        formData.append('csrf_token', this.csrfToken);
        formData.append('language', this.currentLanguage);
        formData.append('subscribe', this.subscribe);

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
              this.resetForm();
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
            this.isSubmitting = false;
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
      this.subscribe = false;
      this.errorMessage = '';
      this.$refs.form.reset();
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
      textarea.style.height = '150px';
      textarea.style.height = textarea.scrollHeight + 'px';
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
  padding: 30px 10px 30px 10px;
  display: flex;
  justify-content: center;
  flex-direction: column;
}

.contact__container {
  min-width: 1000px;
  margin: 0 auto;
  border-radius: 20px;
  box-shadow: 0px 0px 2px 0px #ffffff;
}


.feedback_container {
  padding: 30px 20px;
}

.contact__container-item h1 {
  text-align: center;
}

.contact-info {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
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
  background-color: transparent;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  z-index: 1;
  transition: 1s;
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

.form-group-container {
  display: flex;
  justify-content: space-around;
  align-items: center;
  gap: 40px;
  margin-bottom: 40px;
}

.form-group {
  width: 100%;
  position: relative;
}

.file-drop-area {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: absolute;
  bottom: 40px;
  right: 20px;
}

.file-drop-area label {
  display: flex;
  align-items: center;
}

.file-drop-area img {
  width: 30px;
  height: 30px;
  margin-top: 10px;
}


input[type="file"] {
  position: absolute;
  left: -9999px;
}

label {
  position: absolute;
  color: black;
  top: -25px;
  font-weight: bold;
  margin-left: 5px;
  transition: all 0.3s ease;
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
  padding-right: 30px;
}

label.active {
  top: -20px;
  color: var(--active-color);
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
    top: -25px;
    font-size: 20px;
  }
}

@keyframes sinkLabel {
  from {
    top: -25px;
    font-size: 20px;
  }

  to {
    top: 20px;
    font-size: 16px;
  }
}

.btn-upload {
  display: inline-block;
  padding: 20px 10px;
  color: var(--text-color);
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
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
  margin-top: 15px;
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
  margin: 20px auto;
}

.consent input[type="checkbox"] {
  position: absolute;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  width: 25px;
  height: 25px;
  border-radius: 4px;
  outline: none;
  cursor: pointer;  
}

.consent input[type="checkbox"]:checked {
  background-color: var(--active-color);
  border-color: var(--active-color);
}

.consent input[type="checkbox"]:checked::after {
  content: url('@/assets/icon/checkmark.svg');
  display: inline-block;
  width: 20px;  /* Задайте ширину изображения */
  height: 20px;  /* Задайте высоту изображения */
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}


.consent p {
  color: var(--text-color);
  margin-left: 30px;
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


@media screen and (max-width: 769px) {
  .contact__container {
    min-width: 300px;
  }
  .contact-info {
    flex-direction: column;
  }
  .form-group-container {
    flex-direction: column;
  }
}

@media (min-width: 769px) and (max-width: 1024px) {
  .contact__container[data-v-50e640b0] {
    min-width: 500px;
  }

  .form-group-container {
    flex-direction: column;
  }
}
</style>
