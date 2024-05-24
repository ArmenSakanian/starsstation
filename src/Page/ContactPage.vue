<template>
  <div class="contact">
    <div class="contact__container">
      <div class="contact__container-item info">
        <h1>{{ $t('contact') }}</h1>
        <div class="contact-info">
          <div class="contact-group">
            <button class="contact-button">
              <span class="icon"><img src="@/assets/telephone.svg" alt=""></span>
              <a href="tel:++41779441743">+41 77 944 17 43</a>
            </button>
          </div>
          <div class="contact-group">
            <button class="contact-button">
              <span class="icon"><img src="@/assets/email.svg" alt=""></span>
              <a href="mailto:support@starsstation.ch">support@starsstation.ch</a>
            </button>
          </div>
          <div class="contact-group logo">
            <img src="@/assets/logo/Logo-text_white.svg" alt="Logo">
          </div>
          <div class="social">
            <li><a href="https://www.instagram.com/starsstationstudio?igsh=cDdmczIxc2ljMzJq"><font-awesome-icon
                  :icon="['fab', 'instagram']" class="custom-icon instagram-icon" /></a></li>
            <li><a href="#"><font-awesome-icon :icon="['fab', 'facebook']" class="custom-icon facebook-icon" /></a></li>
            <li><a href="https://wa.me/41779441743"><font-awesome-icon :icon="['fab', 'whatsapp']"
                  class="custom-icon whatsapp-icon" /></a></li>
            <li><a href="https://www.youtube.com/@StarsStationStudio"><font-awesome-icon :icon="['fab', 'youtube']"
                  class="custom-icon youtube-icon" /></a></li>
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
              <label :class="{ 'active': activeInputs.message, 'inactive': !activeInputs.message }" for="message">
                {{ $t('message') }}
              </label>
              <textarea @focus="handleFocus('message')" @blur="handleBlur('message')" name="message" id="message"
                rows="4" v-model="inputs.message" ref="message" @input="autoResize"></textarea>
            </div>
            <div class="form-controls">
              <div class="form-group file inline">
                <div class="file-drop-area" @dragover.prevent @drop.prevent="handleDrop">
                  <input type="file" name="files[]" id="attachment" accept=".png, .jpeg, .jpg, .svg, .pdf, .docx, .txt, .odt, .xlsx, .ods, .gif, .bmp, .tiff, .pptx, .odp" multiple @change="updateFileList">
                  <label for="attachment" class="btn-upload">{{ $t('attach') }}</label>
                </div>
              </div>
              <input type="hidden" v-model="csrfToken" name="csrf_token">
              <div class="form-group form-button inline">
                <button class="send" type="submit" :disabled="isSubmitting">
  <span>{{ isSubmitting ? $t('sending') : $t('send') }}</span>
  <span v-if="isSubmitting" class="loader"></span>
</button>
              </div>
            </div>
            <div class="file-name">
              <span v-if="fileList.length > 0">
                {{ displayedFileList }}
                <a href="#" @click.prevent="toggleFileList" v-if="fileList.length > 3">
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
import axios from 'axios';
import Swal from 'sweetalert2';

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
      isSubmitting: false // Новая переменная состояния для загрузки
    };
  },
  computed: {
    displayedFileList() {
      if (this.showFullFileList) {
        return this.fileList.map(file => file.name).join(', ');
      }
      if (this.fileList.length > 3) {
        return `${this.fileList.slice(0, 3).map(file => file.name).join(', ')} ${this.$t('and')} ${this.fileList.length - 3} ${this.$t('more')}`;
      }
      return this.fileList.map(file => file.name).join(', ');
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
      this.fileList = Array.from(event.target.files); // Сохраняем файлы
      this.showFullFileList = false;  // Скрыть полный список при выборе новых файлов
    },
    handleDrop(event) {
      const droppedFiles = event.dataTransfer.files;
      this.fileList = Array.from(droppedFiles);
      this.showFullFileList = false; // Скрыть полный список при выборе новых файлов
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
      if (this.validateInputs()) {
        this.isSubmitting = true; // Показать индикатор загрузки
        const formData = new FormData();
        Object.keys(this.inputs).forEach(key => {
          formData.append(key, this.inputs[key]);
        });
        this.fileList.forEach(file => {
          formData.append('files[]', file); // Добавляем файлы в FormData
        });
        formData.append('csrf_token', this.csrfToken);

        axios.post('sendmail.php', formData)
          .then(() => {
            Swal.fire({
              icon: 'success',
              title: this.$t('success_message'),
              timer: 3000,
              showConfirmButton: false
            });
            this.resetForm(); // Очистить поля формы
          })
          .catch(error => {
            Swal.fire({
              icon: 'error',
              title: this.$t('error_message'),
              text: error.message,
              timer: 3000,
              showConfirmButton: false
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
          showConfirmButton: false
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
  padding-top: 150px;
  display: flex;
  justify-content: center;
}

.contact__container-item {
  width: 100%;
  margin: 0 auto;
  overflow: hidden;
}



.feedback_container {
  padding: 20px 100px;
}

.contact__container-item h1 {
  text-align: center;
}

.contact-info {
  padding-top: 100px;
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
  margin-left: 10px;
  font-size: 20px;
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

.logo {
  position: relative;
}

.logo img {
  width: 200px;
}

.icon svg {
  width: 25px;
  height: 25px;
}

.social a {
  color: var(--text-color);
}

.social {
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

.line {
  display: flex;
  justify-content: space-between;
}

.feedback_container>.form-group,
.file label {
  position: relative;
  margin-bottom: 50px;
}

label {
  position: absolute;
  color: var(--text-color);
  top: 20px;
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
  border-bottom: 2px solid var(--text-color);
  background-color: transparent;
  font-size: 16px;
  color: var(--text-color);
  width: 100%;
  outline: none;
}

input[type="text"],
input[type="email"],
input[type="tel"],
textarea {
  padding-top: 20px;
}

label.active {
  top: -15px;
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
    top: -15px;
    font-size: 12px;
  }
}

@keyframes sinkLabel {
  from {
    top: -15px;
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
  padding: 20px 50px;
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



.file-name span {
  color: var(--text-color);
  position: relative;
  display: flex;
  flex-direction: column;
}

.file-name span a {
  color: var(--text-color);
  font-style: italic;
  font-weight: bold;
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

input:-webkit-autofill,
textarea:-webkit-autofill,
select:-webkit-autofill {
  -webkit-box-shadow: 0 0 0px 1000px var(--bg-main-color) inset !important;
  box-shadow: 0 0 0px 1000px var(--bg-main-color) inset !important;
  -webkit-text-fill-color: #fff !important;
  color: #fff !important;
}

input:-moz-autofill,
textarea:-moz-autofill,
select:-moz-autofill {
  box-shadow: 0 0 0px 1000px var((--bg-main-color)) inset !important;
  -moz-text-fill-color: var(--text-color) !important;
  color: var(--text-color) !important;
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
