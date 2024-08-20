<template>
  <section class="about-section">
    <div class="about-content">
      <h1 class="about-title" v-html="formattedTitle"></h1>
      <p class="about-text" v-html="formattedText"></p>
    </div>
  </section>
</template>

<script>
import { formatText } from '@/utils/textFormatter';

export default {
  name: 'AboutSection',
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
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(135deg, #f0f0f0, #d9d9d9);
  padding: 60px 20px;
}

.about-content {
  background-color: white;
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
  max-width: 900px;
  text-align: center;
}

.about-title {
  font-size: 48px;
  font-weight: 700;
  margin-bottom: 30px;
  color: #333;
  position: relative;
  display: inline-block;
}

.about-title::after {
  content: '';
  position: absolute;
  width: 50px;
  height: 4px;
  background-color: #ff6b6b;
  left: 50%;
  transform: translateX(-50%);
  bottom: -10px;
}

.about-text {
  font-size: 24px;
  line-height: 1.8;
  color: #555;
  margin-top: 20px;
}


@media (max-width: 768px) {
  .about-title {
    font-size: 36px;
  }

  .about-text {
    font-size: 20px;
  }
}
</style>



