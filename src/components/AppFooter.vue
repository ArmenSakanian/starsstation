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
          <li><router-link to="/About">About Us</router-link></li>
          <li><router-link to="/Services">Services</router-link></li>
          <li><router-link to="/Contact">Contact</router-link></li>
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
        <h3 class="contact-title">Contact Us</h3>
        <p class="email">Email: suport@starsstation.ch</p>
        <p class="phone">Phone: 555-567-9012</p>
      </div>
      
      <!-- Форма подписки -->
      <div class="subscribe-form">
        <div class="form-title">
          <h3 class="subscribe-title">Subscribe</h3>
          <p class="subscribe-description">Sign up for our newsletter to be the first to receive updates.</p>
        </div>
        <input type="email" placeholder="Enter your email" class="email-input" />
        <button class="subscribe-button">Subscribe</button>
      </div>
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
  name: 'AppFooter'
}
</script>

<style scoped>
.footer {
  width: 100%;
  background-color: #191A23;
  padding: 50px 0;
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
  width: 180px; /* Устанавливаем ширину логотипа */
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
  gap: 40px;
}

.footer-menu ul li a {
  color: white;
  text-decoration: none;
  font-size: 18px;
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
  padding: 60px 50px;
}

.contact-us {
  color: white;
  margin-left: 50px; /* Добавляем отступ слева */
}

.contact-title {
  background-color: #FF9900; /* Применяем фон только к заголовку */
  padding: 7px;
  color: black;
  font-size: 20px;
  margin: 0 0 50px 0; /* Добавляем отступ снизу в 50px */
}

.contact-us p {
  font-size: 18px;
  margin: 0 0 30px 0; /* Добавляем отступ 30px между почтой и телефоном */
}

.subscribe-form {
  display: flex;
  align-items: flex-start;
  background-color: #292A32;
  padding: 55px 40px; /* Padding сверху и снизу 55px, слева и справа 40px */
  border-radius: 14px; /* Скругляем углы контейнера */
}

.form-title {
  display: flex;
  flex-direction: column;
}

.subscribe-title {
  color: white;
  font-size: 28px;
  margin: 0 0 10px 0; /* Отступ между заголовком и описанием */
}

.subscribe-description {
  color: white;
  font-size: 16px;
  margin: 0 0 30px 0; 
  width: 380px;
}

.email-input {
  width: 280px;
  height: 70px;
  border: 1px solid white;
  padding: 10px;
  color: white;
  background-color: transparent;
  border-radius: 14px; /* Скругляем углы input */
  margin-bottom: 30px; /* Отступ между input и кнопкой */
}

.subscribe-button {
  width: 250px;
  height: 70px;
  background-color: #FF9900;
  margin-left: 50px;
  color: black;
  border: none;
  cursor: pointer;
  font-size: 18px;
  border-radius: 14px; /* Скругляем углы кнопки */
}

.footer-bottom {
  margin-top: 50px;
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
  .footer-container{
    flex-direction: column;
  }
  .footer-lower {
    flex-direction: column;
  }
  .subscribe-form {
    flex-direction: column;
    align-items: center;
  }
  .footer-logo, .contact-us, .subscribe-button, .social-icons {
    margin: 0;
  }

  .contact-us {
    text-align: center;
  }

  .footer-menu ul {
    margin-bottom: 50px;
  }

}

</style>
