<template>
  <section class="about-section">
    <div class="content-wrapper">
      <div class="text-container">
        <div class="line text-line"></div>
        <div class="text-content">
          <h1 class="about-title" v-html="formattedTitle"></h1>
          <p class="about-text" v-html="formattedText"></p>
        </div>
      </div>
      <div class="contact-container">
        <div class="contact-content">
          <p class="contact-item"><strong>{{ $t('tel') }}:</strong> <a :href="`tel:${contacts.phone}`">{{ contacts.phone }}</a></p>
          <p class="contact-item"><strong>{{ $t('email') }}:</strong> <a :href="`mailto:${contacts.email}`"> {{ contacts.email }}</a></p>
          <div class="social-icons">
            <a v-if="contacts.socials.facebook.url" :href="contacts.socials.facebook.url" target="_blank">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a :href="contacts.socials.instagram.url" target="_blank">
              <i class="fab fa-instagram"></i>
            </a>
            <a :href="contacts.socials.youtube.url" target="_blank">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>
        <div class="line contact-line"></div>
      </div>
    </div>
    <div class="image-container">
      <img src="@/assets/img/about.webp" alt="About Image" class="about-image">
    </div>
  </section>
</template>

<script>
import { formatText } from '@/utils/textFormatter';
import contacts from "@/contacts.json";
export default {

  name: 'AboutSection',
  data() {
    return {
      contacts,
    };
  },
  computed: {
    formattedTitle() {
      return formatText(this.$i18n, 'about');
    },
    formattedText() {
      return formatText(this.$i18n, 'about_about');
    },
  },
};
</script>

<style scoped>
.about-section {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  align-items: flex-start;
  min-height: 100vh;
  background-color: #000;
  color: #fff;
  padding: 90px 40px;
  position: relative;
}

.content-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  margin-bottom: 40px;
  position: relative;
}

.text-container {
  display: flex;
  align-items: center;
  position: relative;
}

.line {
  width: 4px;
  background-color: #ffffff;
  /* Линия белого цвета */
  height: 100%;
  position: absolute;
}

.text-line {
  left: -20px;
}

.contact-line {
  right: -20px;
}

.text-content {
  max-width: 600px;
  padding-left: 24px;
}

.contact-container {
  display: flex;
  align-items: center;
  position: relative;
  text-align: right;
}

.contact-content {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  margin-right: 24px;
}





.image-container {
  width: 100%;
  text-align: center;
  margin-top: 20px;
}

.about-image {
  max-width: 80%;
  /* Изображение занимает до 80% ширины контейнера */
  height: auto;
  border-radius: 20px;
}

.about-title {
  font-size: 48px;
  /* Размер заголовка */
  font-weight: 700;
  margin-bottom: 20px;
}

.about-text {
  font-size: 20px;
  /* Размер текста */
  line-height: 2;
}

@media (max-width: 1024px) {
  .about-section {
    padding: 60px 20px;
  }
  .about-title {
    font: 32px;
  }
  .about-text {
    font-size: 18px;
  }
  .content-wrapper {
    flex-direction: column;
  }

  .text-content,
  .contact-content {
    text-align: center;
  }

  .text-container {
    margin-bottom: 20px;
  }

  .line {
    margin-bottom: 10px;
  }

  .text-line {
    left: 0;
  }

  .contact-line {
    right: 0;
  }

  .contact-container {
    flex-direction: column;
    align-items: flex-start;
    text-align: left;
  }


  .image-container {
    margin-top: 20px;
  }

  .about-image {
    max-width: 100%;
    /* Изображение занимает до 100% ширины контейнера */
    height: auto;
  }
}
</style>
