<template>
    <div id="imagine-yourself" class="Services_container all">
      <div  class="service_item">
        <h1 data-aos="zoom-out">{{ $t('imagine yourself') }}</h1>
        <router-link  to="/network"><button data-aos="fade-up" class="learn-more">{{ $t('learn more') }}</button></router-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ImaginezVous'
  }
  </script>
  
  <style scoped>

  #imagine-yourself {
    background-image:linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Imaginez-vous.webp');
  }

  @media screen and (max-width: 769px) {
    #imagine-yourself {
    background-image:linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Imaginez-vous-mobile.png');
  }
  }
  </style>
  