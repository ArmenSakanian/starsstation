<template>
  <div class="service-content">
    <div data-aos="fade-right" class="title_section"><h1 class="title">{{ $t('service') }}</h1></div>
    <div class="services-container">
      <div class="services-row" v-for="(row, rowIndex) in serviceRows" :key="rowIndex">
        <div class="service" 
             v-for="(service, index) in row" 
             :key="index" 
             data-aos="fade-up">
          <img :src="service.icon" alt="Icon" class="service-icon" />
          <h1 class="service-title" v-html="formatText(service.title)"></h1>
          <p class="service-description" v-html="formatText(service.description)"></p>
        </div>
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
        { icon: yourself, title: 'imagine_yourself', description: 'imagine_yourself_quotes' },
        { icon: adversting, title: 'advertising_video', description: 'advertising_video_quotes' },
        { icon: network, title: 'social_network', description: 'social_network_quotes' },
        { icon: montage, title: 'montage_video', description: 'montage_video_quotes' },
        { icon: clip, title: 'rap_clip', description: 'rap_clip_quotes' },
        
      ],
    };
  },
  computed: {
    serviceRows() {
      const itemsPerRow = this.getItemsPerRow();
      const rows = [];
      for (let i = 0; i < this.services.length; i += itemsPerRow) {
        rows.push(this.services.slice(i, i + itemsPerRow));
      }
      return rows;
    }
  },
  methods: {
    formatText(key) {
      return formatText(this.$i18n, key);
    },
    getItemsPerRow() {
      const width = window.innerWidth;
      if (width > 1024) return 3;
      if (width > 769) return 2;
      return 1;
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
  display: flex;
  justify-content: center;
  margin-top: 40px;
  gap: 50px;
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
  transition: transform 0.3s ease;
}

.service:hover {
  transform: scale(1.1);
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

@media (max-width: 1024px) {
  .services-row {
    justify-content: space-between;
  }
}

@media (max-width: 769px) {
  .services-row {
    flex-direction: column;
    align-items: center;
  }
}
</style>
