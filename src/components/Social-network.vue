<template>
    <div id="social-network" class="Services_container  all">
      <div class="service_item">
        <h1 >{{ $t('social network') }}</h1>
        <router-link to="/Network"><button class="learn-more">{{ $t('learn more') }}</button></router-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'SocialNetwork',
    inject: ['splitText'],
  }
  </script>
  
  <style scoped>



  @media screen and (max-width: 1024px) {
  #social-network {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/social-network-mobile.webp');
}
  }

  </style>
  