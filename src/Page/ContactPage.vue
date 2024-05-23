<template>
    <head>
  <title>Contact</title>
  <meta name="description" content="+79995470177 sakanyan2004@gmail.com">
</head>
  <div class="contact">
    <div class="contact__container">
      <div class="contact__container-item info">
        <h1>{{ $t('contact') }}</h1>
        <div class="contact-info">
          <div class="contact-group">
            <button class="contact-button">
              <span class="icon"><img src="@/assets/telephone.svg" alt=""></span>
              <a href="tel:+79995470177">+7 999 547 01 77</a>
            </button>
          </div>
          <div class="contact-group">
            <button class="contact-button">
              <span class="icon"><img src="@/assets/email.svg" alt=""></span>
              <a href="mailto:sakanyan2004@gmail.com">sakanyan2004@gmail.com</a>
            </button>
          </div>
          <div class="contact-group logo">
            <img src="@/assets/logo/Logo-text_white.svg" alt="Logo">
          </div>
          <div class="social">
            <li><a href="https://www.youtube.com/"><i class="fa-brands fa-instagram"></i></a> </li>
            <li><a href="https://www.youtube.com/"><i class="fa-brands fa-facebook"></i></a> </li>
            <li><a href="https://www.youtube.com/"><i class="fa-brands fa-youtube"></i></a> </li>
            <li><a href="https://www.youtube.com/"><i class="fa-brands fa-whatsapp"></i></a> </li>
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
                rows="4" v-model="inputs.message" ref="message"></textarea>
            </div>
            <div class="form-controls">
              <div class="form-group file inline">
                <input type="file" name="files[]" id="attachment" accept=".png, .jpeg, .jpg, .svg, .pdf, .docx" multiple
                  @change="updateFileList">
                <label for="attachment" class="btn-upload">{{ $t('attach') }}</label>
                <span v-if="fileList.length > 0">
                  {{ displayedFileList }}
                  <a href="#" @click.prevent="toggleFileList" v-if="fileList.length > 3">
                    {{ showFullFileList ? $t('hide') : `${$t('and')} ${fileList.length - 3} ${$t('more')}` }}
                  </a>
                </span>
              </div>
              <input type="hidden" v-model="csrfToken" name="csrf_token">
              <div class="form-group form-button inline">
                <button class="send" type="submit">{{ $t('send') }}</button>
              </div>
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
      csrfToken: ''
    };
  },
  computed: {
    displayedFileList() {
      if (this.showFullFileList) {
        return this.fileList.map(file => file.name).join(', ');
      }
      if (this.fileList.length > 3) {
        return `${this.fileList.slice(0, 3).map(file => file.name).join(', ')}`;
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
          })
          .catch(error => {
            Swal.fire({
              icon: 'error',
              title: this.$t('error_message'),
              text: error.message,
              timer: 3000,
              showConfirmButton: false
            });
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
    validateInputs() {
      for (const key in this.inputs) {
        if (this.inputs[key].trim() === '') {
          return false;
        }
      }
      return true;
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

.form-group, .file label {
  position: relative;
  margin-bottom: 50px;
}

label {
  position: absolute;
  color: var(--text-color);
  top: 20px;
}

input,
textarea {
  border: none;
  border-bottom: 2px solid var(--text-color);
  background-color: transparent;
  font-size: 16px;
  color: var(--text-color);
  width: 100%;
  height: 50px;
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
  padding: 8px 16px;
  background-color: var(--active-color);
  color: var(--text-color);
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.btn-upload:hover {
  background-color: var(--active-dark-color);
}


.form-controls {
  display: flex;
  justify-content: space-between;
}



.file span {
  color: var(--text-color);
    position: relative;
    display: flex;
    flex-direction: column;
}

.file span a {
  color: var(--text-color);
  font-style: italic;
  font-weight: bold;
}


.form-button button {
  padding: 10px 20px;
  position: relative;
  top: 20px;
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
