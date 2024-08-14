<template>
      <div class="title_section">
      <h1>{{ $t('service') }}</h1>
    </div>
  <div class="rows-container">
    <div v-for="(row, rowIndex) in serviceRows" :key="rowIndex" class="services-row">
      <div v-for="(service, index) in row" :key="index" class="service-card" :style="{ backgroundImage: `url(${service.image})` }">
        <div class="service-content">
          <h3>{{ $t(service.name) }}</h3>
        </div>
        <button class="learn-more">{{ $t('learn_more') }} <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Service',
  data() {
    return {
      services: [
        {
          name: 'advertising_video',
          image: require('@/assets/img/advertising-video.webp'),
        },
        {
          name: 'montage_video',
          image: require('@/assets/img/montage-video.webp'),
        },
        {
          name: 'imagine_yourself',
          image: require('@/assets/img/imagine-yourself.webp'),
        },
        {
          name: 'rap_clip',
          image: require('@/assets/img/rap-clip.webp'),
        },
        {
          name: 'social_network',
          image: require('@/assets/img/social-network.webp'),
        },
      ],
    };
  },
  computed: {
    serviceRows() {
      // Разделяем услуги на ряды по 3 элемента в каждом
      const rows = [];
      for (let i = 0; i < this.services.length; i += 3) {
        rows.push(this.services.slice(i, i + 3));
      }
      return rows;
    },
  },
};
</script>

<style scoped>
.rows-container {
  display: flex;
  flex-direction: column;
  gap: 50px; /* Отступы между рядами */
}

.services-row {
  display: flex;
  justify-content: center; /* Центрирование элементов в ряду */
  gap: 50px; /* Отступы между карточками */
  margin: 0 auto; /* Центрирование ряда */
}

.service-card {
  width: 330px;
  height: 430px;
  background-size: cover;
  background-position: center;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
  color: white;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.service-content {
  padding: 10px 0px;
    text-align: center;
    background-color: white;
    color: black;
    border-radius: 5px;
}

.service-card h3 {
  margin: 0;
  font-size: 24px;
}



.learn-more {
    margin: 0 auto;
    padding: 10px 20px;
    width: 150px;
    border: none;
    border-radius: 5px;
    background: #222222;
    background-size: 200% 100%;
    background-position: 100% 0;
    color: rgb(255, 255, 255);
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: .3s ease;
    text-align: center;
}

.learn-more i {
  margin-left: 10px;
    color: #ff9900;
    font-size: 20px;
}
</style>
