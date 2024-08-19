<template>
  <div data-aos="fade-up" class="partner-container">
    <div class="partner-background">
      <h1 data-aos="fade-right" class="partner-title">Партнер</h1>
      <h2 data-aos="fade-left" class="partner-subtitle">Ваш надежный партнер</h2>
      <button  class="partner-button button">Связаться</button>
    </div>
  </div>
</template>
<script>
export default {
  name: 'PartnerComponent',
};
</script>

<style scoped>
.partner-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  background-color: transparent;
  height: 100vh;
  position: relative;
}

.partner-background {
  width: 100%;
  height: 100%;
  background-image: url('@/assets/icon/partner.png');
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.partner-title {
  font-size: 48px;
  color: white;
  margin: 10px 0;
  z-index: 2;
}

.partner-subtitle {
  font-size: 20px;
  color: white;
  margin-bottom: 30px;
  z-index: 2;
}
</style>