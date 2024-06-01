
<template>
  <footer>
    <div class="footer__container">
      <div class="footer__subscribe footer__item">
        <h1>{{ $t('subscribe_title') }} Stars Station Studio</h1>

          <div>
            <form @submit.prevent="subscribe">
              <div class="form-group">
                <input type="email" v-model="email" placeholder="Email">
                <button class="subscribe">{{ $t('send') }}</button>
              </div>
            </form>
          </div>

      </div>
      <div class="footer__links footer__item">
        <h1>{{ $t('link') }}</h1>
        <div class="links ">
          <nav>
            <ul>
              <li><router-link to="/">{{ $t('home') }}</router-link></li>
              <li><router-link to="/About">{{ $t('about') }}</router-link></li>
              <li><router-link to="/Contact">{{ $t('contact') }}</router-link></li>
              <li><router-link to="/Privacy">{{ $t('privacy_policy_title') }}</router-link></li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="footer__service footer__item">
        <h1>{{ $t('service') }}</h1>
        <div class="service">
          <nav>
            <ul>
              <li><router-link to="/Yourself">{{ $t('imagine yourself') }}</router-link></li>
              <li><router-link to="/Advertising">{{ $t('advertising video') }}</router-link></li>
              <li><router-link to="/Network">{{ $t('social network') }}</router-link></li>
              <li><router-link to="/Montage">{{ $t('montage video') }}</router-link></li>
              <li><router-link to="/Rap">{{ $t('rap clip') }}</router-link></li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="footer__social footer__item">
        <h1>{{ $t('social') }}</h1>
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
    <div class="copyright">
      <p>©2024 Stars Station Studio</p>
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




.subscribe {
  margin-top: 10px;
  padding: 10px 25px;
}
input {
  height: 50px;
  border: none;
  border-bottom: 2px solid var(--text-color);
  background-color: transparent;
  font-size: 16px;
  color: var(--text-color);
  width: 300px;
  outline: none;
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

.footer__item {
  margin-bottom: 15px;
  flex: 1;
  min-width: 200px;
  padding: 10px;
  box-sizing: border-box;
}

.footer__container {
  background-color: var(--bg-secondary-color);
  color: var(--text-color);
  padding: 20px 50px 0 50px;
  display: flex;
  flex-wrap: wrap;
}

.footer__container a {
  color: var(--text-color);
  text-decoration: none;
}


.footer__item > div {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 30px;
  text-align: center;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.footer__item h1 {
  text-align: center;
  font-size: 32px;
  margin-bottom: 10px;
}








.copyright {
  background-color: var(--bg-main-color);
  padding: 10px;
  text-align: center;
  color: var(--text-color);
  font-size: 14px;
}

@media screen and (max-width: 1024px) {
  .footer__container a {
    text-decoration: underline;
  }

  .footer__container {
    flex-wrap: wrap;
  }

  .footer__item {
    min-width: 100%; /* Элементы занимают всю ширину контейнера */
  }

  .footer__item div nav ul {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    flex-direction: row;
    padding: 0;
    margin: 0;
  }

  .footer__item div li {
    margin-right: 10px;
    margin-bottom: 10px;
  }
}
</style>