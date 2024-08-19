<template>
  <footer class="footer">
    <div class="footer-container">
      <!-- Логотип -->
      <div class="footer-logo">
        <img src="@/assets/logo/Logo-Full_white.svg" alt="Logo" class="logo" />
      </div>

      <!-- Меню -->
      <nav class="footer-menu">
        <ul class="menu-ul">
          <li><router-link to="/About">{{ $t('about') }}</router-link></li>
          <li><router-link to="/Services">{{ $t('service') }}</router-link></li>
          <li><router-link to="/Contact">{{ $t('contact') }}</router-link></li>
          <li><router-link to="/Contact">{{ $t('our_videos') }}</router-link></li>
        </ul>
      </nav>

      <!-- Социальные иконки -->
      <div class="social-icons">
        <img src="@/assets/icon/instagram.svg" alt="Instagram" class="icon" />
        <img src="@/assets/icon/facebook.svg" alt="Facebook" class="icon" />
        <img src="@/assets/icon/youtube.svg" alt="YouTube" class="icon" />
      </div>
    </div>

    <!-- Контактная информация -->
    <div class="footer-lower">
      <div class="contact-us">
        <h3 class="contact-title">{{ $t('contact') }}</h3>
        <p class="email">{{ $t('email') }}: suport@starsstation.ch</p>
        <p class="phone">{{ $t('tel') }}: 555-567-9012</p>
      </div>
      <form @submit.prevent="subscribe">
        <div class="subscribe-form">
        <div class="form-title">
          <h3 class="subscribe-title">Subscribe</h3>
          <p class="subscribe-description">Sign up for our newsletter to be the first to receive updates.</p>
        </div>
        <div class="form-group">
          <input type="email" v-model="email" placeholder="Email">
          <button class="subscribe">{{ $t('send') }}</button>
        </div>
      </div>
      </form>
      <!-- Форма подписки -->
    </div>

    <!-- Разделительная линия и текст -->
    <div class="footer-bottom">
      <hr class="divider" />
      <div class="footer-bottom-text">
        <p>© 2024 Stars Station Studio. All Rights Reserved.</p>
        <router-link to="/privacy-policy">Privacy Policy</router-link>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'AppFooter',
  data() {
    return {
      email: ''
    };
  },
  methods: {
    async subscribe() {
      try {
        const response = await axios.post('subscribe.php', new URLSearchParams({ email: this.email }));
        console.log(response.data); // Добавьте эту строку для отладки
        Swal.fire({
          icon: 'success',
          title: this.$t('success_title'),
          text: this.$t(response.data.message_id), // Используем message_id для перевода
          timer: 3000,
          showConfirmButton: true,
          timerProgressBar: true,
          confirmButtonText: 'OK'
        });
        this.email = '';  // Очистить поле ввода
      } catch (error) {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: this.$t('error_title'),
          text: this.$t('subscribe_error'),
          timer: 3000,
          showConfirmButton: true,
          timerProgressBar: true,
          confirmButtonText: 'OK'
        });
      }
    }
  }
}
</script>

<style scoped>
.footer {
  width: 100%;
  background-color: #191A23;

}

.footer-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 50px;
}

.footer-logo {
  margin-top: 50px;
  margin-left: 50px;
}

.footer-logo img {
  width: 180px;
  /* Устанавливаем ширину логотипа */
}

.footer-menu {
  display: flex;
  gap: 40px;
  margin-top: 50px;
}

.footer-menu ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
  justify-content: center;
}

.footer-menu ul li a {
  color: white;
  text-decoration: none;
  font-size: 20px;
}

.social-icons {
  display: flex;
  gap: 20px;
  margin-top: 50px;
  margin-right: 50px;
}

.icon {
  width: 30px;
  height: 30px;
  cursor: pointer;
}

.footer-lower {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 50px;
  gap: 50px;
}

.contact-us {
  color: white;
  margin-left: 50px;
  /* Добавляем отступ слева */
}

.contact-title {
  background-color: #FF9900;
  padding: 7px;
  color: black;
  font-size: 40px;
display: inline;
}

.contact-us p {
  font-size: 20px;
  margin: 30px 0 0 0;
  /* Добавляем отступ 30px между почтой и телефоном */
}

.subscribe-form {
  display: flex;
  align-items: center;
  background-color: #292A32;
  padding: 30px 40px;
  border-radius: 14px;
  flex-direction: column;
}

.form-title {
  display: flex;
  flex-direction: column;
}

.subscribe-title {
  color: white;
  font-size: 40px;
  margin: 0 0 10px 0;
  /* Отступ между заголовком и описанием */
}

.subscribe-description {
  color: white;
  font-size: 20px;
  margin: 0 0 30px 0;
}

.form-group {
  width: 100%;
    display: flex;
    gap: 20px;
}

.form-group input {
  width: 100%;
  height: 60px;
  border: 1px solid white;
  padding: 10px;
  color: white;
  background-color: transparent;
  border-radius: 14px;
  /* Скругляем углы input */
  margin-bottom: 30px;
  /* Отступ между input и кнопкой */
}

.subscribe {
  width: 70%;
  height: 60px;
  background-color: #FF9900;
  color: black;
  border: none;
  cursor: pointer;
  font-size: 18px;
  border-radius: 14px;
  /* Скругляем углы кнопки */
}

.footer-bottom {

  text-align: center;
  padding: 20px 0;
}

.divider {
  border: 0;
  height: 1px;
  background-color: white;
  width: 100%;
  margin-bottom: 20px;
}

.footer-bottom-text p {
  color: white;
  font-size: 16px;
  margin: 0;
}

.footer-bottom-text a {
  color: white;
  text-decoration: none;
  margin-left: 10px;
  font-size: 16px;
}

@media screen and (max-width: 1024px) {

  .form-group {
    flex-direction: column;
    align-items: center;
  }
  .footer-container {
    flex-direction: column;
  }

  .footer-lower {
    flex-direction: column;
  }

  .subscribe-form {
    width: 100%;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 55px 10px;
  }

  .form-group input {
    width: 90%;
  }

  .subscribe {
    width: 80%;
  }

  .footer-logo,
  .contact-us,
  .subscribe,
  .social-icons {
    margin: 0;
  }

  .contact-us {
    text-align: center;
  }

  .footer-menu ul {
    margin-bottom: 50px;
  }

}

@media screen and (max-width: 1024px) {

  .footer-menu ul li a,
  .subscribe-description,
  .contact-us p {
    font-size: 16px;
  }

  .contact-title,
  .subscribe-title {
    font-size: 25px;
  }
}
</style>
