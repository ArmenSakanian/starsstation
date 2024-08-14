<template>
  <div class="service_container">
    <div class="title_section">
      <h1>{{ $t('service') }}</h1>
    </div>
    <div class="rows-container">
      <div v-for="(row, rowIndex) in serviceRows" :key="rowIndex" class="services-row">
        <div v-for="(service, index) in row" :key="index" class="service-card"
          :style="{ backgroundImage: `url(${service.image})` }">
          <div class="service-content">
            <h3>{{ $t(service.name) }}</h3>
          </div>
          <button class="learn-more">{{ $t('learn_more') }} <i class="fa-solid fa-arrow-right"></i></button>
        </div>
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
      itemsPerRow: 3,
    };
  },
  computed: {
    serviceRows() {
      // Разделяем услуги на ряды в зависимости от количества элементов в ряду
      const rows = [];
      for (let i = 0; i < this.services.length; i += this.itemsPerRow) {
        rows.push(this.services.slice(i, i + this.itemsPerRow));
      }
      return rows;
    },
  },
  mounted() {
    // При монтировании компонента проверяем ширину экрана
    this.checkScreenWidth();
    // Добавляем слушатель события для изменения ширины экрана
    window.addEventListener('resize', this.checkScreenWidth);
  },
  methods: {
    checkScreenWidth() {
      // Если ширина экрана меньше 769px, устанавливаем по 1 элементу в ряду
      if (window.innerWidth < 769) {
        this.itemsPerRow = 1;
      }
      // Если ширина экрана меньше 1150px, но больше или равна 769px, устанавливаем по 2 элемента в ряду
      else if (window.innerWidth < 1150) {
        this.itemsPerRow = 2;
      }
      // В остальных случаях устанавливаем по 3 элемента в ряду
      else {
        this.itemsPerRow = 3;
      }
    },
  },
  beforeDestroy() {
    // Удаляем слушатель события при уничтожении компонента
    window.removeEventListener('resize', this.checkScreenWidth);
  },
};
</script>

<style scoped>
.rows-container {
  display: flex;
  flex-direction: column;
  gap: 50px;
  margin-top: 50px;
  /* Отступы между рядами */
}

.services-row {
  display: flex;
  justify-content: center;
  /* Центрирование элементов в ряду */
  gap: 50px;
  /* Отступы между карточками */
  margin: 0 auto;
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


@media screen and (max-width: 769px) {
  .service-card {
    width: 80%;
  }

  .services-row {
    margin: 0;
  }


}
</style>
