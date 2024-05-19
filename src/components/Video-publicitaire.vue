<template>
    <div id="video-publicitaire" class="Services_container all">
      <div class="service_item">
        <h1 data-aos="zoom-out">{{ $t('express your') }}<br>{{ $t('art in video') }}</h1>
        <router-link to="/network"><button data-aos="fade-up" class="learn-more">{{ $t('learn more') }}</button></router-link>
      </div>
      
    </div>
  </template>
  
  <script>
  export default {
    name: 'VideoPublicitaire'
  }
  </script>
  
  <style scoped>

  #video-publicitaire {
    background-image:linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Video-publicitaire.webp');
  }

  @media screen and (max-width: 769px) {
  #video-publicitaire {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Video-publicitaire-mobile.png');
}
  }
  </style>
  