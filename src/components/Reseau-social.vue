<template>
    <div id="reseau-social" class="Services_container  all">
      <div class="service_item">
        <h1 data-aos="zoom-out">{{ $t('social network') }}</h1>
        <router-link to="/network"><button data-aos="fade-up" class="learn-more">{{ $t('learn more') }}</button></router-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ReseauSocial'
  }
  </script>
  
  <style scoped>

  #reseau-social {
    background-image:linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Reseau-social.webp');
  }

  @media screen and (max-width: 769px) {
  #reseau-social {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Reseau-social-mobile.png');
}
  }

  </style>
  