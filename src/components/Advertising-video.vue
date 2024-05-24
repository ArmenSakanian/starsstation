<template>
    <div id="advertising-video" class="Services_container all">
      <div class="service_item">
        <h1 >{{ $t('advertising video') }}</h1>
        <router-link to="/Advertising"><button  class="learn-more">{{ $t('learn more') }}</button></router-link>
        <div class="quotes">
          <span v-for="(part, index) in splitText('advertising video-quotes')" :key="index" :class="part.class">{{ part.text }}</span>
        </div>
        
      </div>
      
    </div>
  </template>
  
  <script>
  export default {
    name: 'AdvertisingVideo',
    inject: ['splitText'],
  }
  </script>
  
  <style scoped>



  @media screen and (max-width: 1024px) {
  #advertising-video {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/advertising-video-mobile.webp');
}
  }
  </style>
  