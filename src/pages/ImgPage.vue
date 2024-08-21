<template>
  <div class="service-container">
    <div class="service-content">
      <div class="service-item">
        <div data-aos="fade-right" class="service-image">
          <img src="@/assets/img/advertising-video.webp" alt="Advertising Video" class="service-img" />
        </div>
        <div data-aos="fade-left" class="service-text">
          <h1 class="service-heading" v-html="combinedText"></h1>
        </div>
      </div>
      <div class="service-item service-item-reverse">
        <div data-aos="fade-left" class="service-image">
          <img src="@/assets/img/imagine-yourself.webp" alt="Imagine Yourself" class="service-img" />
        </div>
        <div data-aos="fade-right" class="service-text">
          <p class="service-paragraph" v-html="formatText('imagine_yourself_quotes')"></p>
        </div>
      </div>
    </div>
    <div  class="service-description">
      <p data-aos="fade-up" class="service-description-text" v-html="formatText('yourself_about')"></p>
    </div>
  </div>
</template>

<script>
import { formatText } from '@/utils/textFormatter';

export default {
  name: "ServiceComponent",
  computed: {
    combinedText() {
      // Объединяем тексты из двух разных ID
      return `${this.formatText('imagine_yourself')} ${this.formatText('imagine_yourself_2')}`;
    },
  },
  methods: {
    formatText(key) {
      return formatText(this.$i18n, key);
    },
  },
};
</script>

<style scoped>
.service-container {
  padding-top: 100px; /* Отступ сверху 100px */
  overflow: hidden;
}

.service-content {
  display: flex;
  flex-direction: column; /* Элементы располагаются вертикально */
  width: 100%;
}

.service-item {
  display: flex;
  justify-content: center; /* Выравнивание по центру */
  align-items: center;
  width: 100%; /* Каждый элемент занимает 100% ширины */
  margin-bottom: 20px; /* Отступ между элементами */
}

.service-item-reverse {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: row-reverse; /* Текст и изображение меняются местами */
  width: 100%;
}

.service-image, .service-text {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
}

.service-img {
  max-width: 100%;
  height: auto; /* Адаптивные изображения */
}

.service-paragraph {
  margin: 0;
  text-align: center;
  font-size: 20px; /* Размер шрифта 20px */
  text-transform: uppercase;
}

.service-heading {
  margin: 0;
  text-align: center;
  font-size: 48px; /* Размер шрифта 48px */
  text-transform: uppercase;
}

.service-description {
  margin: 50px 0;
}

.service-description-text {
  max-width: 1220px; /* Максимальная ширина текста 1220px */
  margin: 0 auto; /* Центрирование текста */
  font-size: 20px; /* Размер шрифта 20px */
  line-height: 3; /* Межстрочный интервал 3 */
  text-align: center; /* Выравнивание текста по центру */
}

@media (max-width: 1024px) {
  .service-item {
    flex-direction: column; /* Вертикальное расположение элементов */
  }

  .service-heading {
    font-size: 32px; /* Размер шрифта 32px */
    margin: 30px 0; /* Отступ 30px сверху и снизу */
  }

  .service-paragraph {
    font-size: 18px; /* Размер шрифта 18px */
    margin: 30px 0; /* Отступ 30px сверху и снизу */
  }
}
</style>
