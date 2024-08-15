<template>
  <div class="services-container">
    <div
      v-for="(service, index) in services"
      :key="index"
      :class="['service-wrapper', { 'service-wrapper-reverse': index % 2 !== 0 }]"
      :data-aos="index % 2 === 0 ? 'fade-right' : 'fade-left'"
    >
      <div
        :class="['service-item', { 'service-item-right': index % 2 !== 0 }]"
        :data-aos="index % 2 === 0 ? 'fade-left' : 'fade-right'"
      >
        <div class="service-title">{{ $t(service.title) }}</div>
        <img :src="service.image" alt="service image" :class="['service-image', { 'service-image-right': index % 2 !== 0 }]" />
      </div>
      <div
        class="service-description"
        :data-aos="index % 2 === 0 ? 'fade-left' : 'fade-right'"
      >
        <p>{{ $t(service.description) }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import AOS from 'aos';
import 'aos/dist/aos.css';

export default {
  name: 'ServicesComponent',
  mounted() {
    AOS.init();
  },
  data() {
    return {
      services: [
        { title: 'montage_about', image: require('@/assets/img/montage-video.webp'), description: 'montage_about' },
        { title: 'social_network', image: require('@/assets/img/social-network.webp'), description: 'network_about' },
        { title: 'advertising_video', image: require('@/assets/img/advertising-video.webp'), description: 'advertising_about' },
        { title: 'imagine_yourself', image: require('@/assets/img/imagine-yourself.webp'), description: 'yourself_about' },
        { title: 'rap_clip', image: require('@/assets/img/rap-clip.webp'), description: 'rap_about' },
      ],
    };
  },
};
</script>

<style scoped>
.services-container {
  display: flex;
  flex-direction: column;
  overflow:hidden;
  margin-top: 200px;
}

.service-wrapper {
  display: flex;
  margin-bottom: 130px;
  flex-direction: row;
}

.service-wrapper-reverse {
  flex-direction: row-reverse;
}

.service-item {
  width: 50%;
  display: flex;
  flex-direction: column;
}

.service-title {
  background-color: #222222;
  color: #ffffff;
  text-align: center;
  font-size: 40px;
  height: 100px;
  line-height: 100px;
}

.service-image {
  width: calc(100% - 30px);
  margin-top: 10px;
  position: relative;
  left: 30px;
}

.service-image-right {
  left: auto;
  right: 30px;
}

.service-description {
  width: 50%;
  margin-top: 20px;
  font-size: 20px;
  text-align: justify;
  padding: 0 30px 0 30px;
}
</style>
