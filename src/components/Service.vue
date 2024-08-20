<template>
  <div class="services-container">
    <h1 class="services-header title">{{ $t('service') }}</h1>
    <div  id="service" class="services-row first-row">
      <div class="service" data-aos="fade-right"
           v-for="(service, index) in services.slice(0, 3)" 
           :key="index" 
           :class="{ 'full-span': index === 2 }">
        <img :src="service.icon" alt="Icon" class="service-icon" />
        <h3 class="service-title" v-html="formatText(service.title)"></h3>
        <p class="service-description" v-html="formatText(service.description)"></p>
      </div>
    </div>
    <div  class="services-row second-row">
      <div class="service" data-aos="fade-left" v-for="(service, index) in services.slice(3)" :key="index">
        <img :src="service.icon" alt="Icon" class="service-icon" />
        <h3 class="service-title" v-html="formatText(service.title)"></h3>
        <p class="service-description" v-html="formatText(service.description)"></p>
      </div>
    </div>
  </div>
</template>

<script>
import montage from '@/assets/icon/montage.png';
import network from '@/assets/icon/network.png';
import adversting from '@/assets/icon/adversting.png';
import yourself from '@/assets/icon/yourself.png';
import clip from '@/assets/icon/clip.png';
import { formatText } from '@/utils/textFormatter';

export default {
  name: 'Service',
  data() {
    return {
      services: [
        { 
          icon: yourself, 
          title: 'imagine_yourself', 
          description: 'imagine_yourself_quotes' 
        },
        { 
          icon: adversting, 
          title: 'advertising_video', 
          description: 'advertising_video_quotes' 
        },
        { 
          icon: network, 
          title: 'social_network', 
          description: 'social_network_quotes' 
        },
        { 
          icon: montage, 
          title: 'montage_video', 
          description: 'montage_video_quotes' 
        },
        { 
          icon: clip, 
          title: 'rap_clip', 
          description: 'rap_clip_quotes' 
        },
      ],
    };
  },
  methods: {
    formatText(key) {
      return formatText(this.$i18n, key);
    }
  }
};
</script>

<style scoped>
.services-container {
  max-width: 1220px;
  margin: 0 auto;
  padding: 20px;
}


.services-row {
  display: grid;
  grid-row-gap: 16px;
  grid-column-gap: 50px;
}

.first-row {
  grid-template-rows: auto;
  grid-template-columns: 1fr 1fr 1fr;
  margin-top: 40px;
}

.second-row {
  grid-template-rows: auto;
  grid-template-columns: 1fr 1fr;
  margin-top: 50px;
  margin-bottom: 50px;
}

.service {
  background-color: white;
  width: 100%;
  height: 290px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  transition: transform 0.3s ease; /* Плавный переход трансформации */
}

.service:hover {
  transform: scale(1.1); /* Увеличение размера на 5% при наведении */
}

.service-icon {
  width: 62px;
  height: 62px;
  margin-bottom: 15px;
}

.service-title {
  font-size: 24px;
  margin-bottom: 10px;
}

.service-description {
  font-size: 16px;
  text-align: center;
}

.color-bold {
  font-weight: bold;
  color: red; /* Замените на нужный цвет */
}

@media (max-width: 1024px) {
  .first-row {
    grid-template-columns: 1fr 1fr;
  }

  .first-row .service.full-span {
    grid-area: span 1 / span 2 / span 1 / span 2;
  }
}

@media (max-width: 769px) {
  .first-row, .second-row {
    grid-template-columns: 1fr;
  }

  .first-row .service.full-span {
    grid-area: auto;
  }
}
</style>
