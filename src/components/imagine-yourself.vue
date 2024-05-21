<template>
    <div id="imagine-yourself" class="Services_container all">
      <div  class="service_item">
        <h1>{{ $t('imagine yourself') }}</h1>
        <router-link  to="/Yourself"><button class="learn-more">{{ $t('learn more') }}</button></router-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ImagineYourself'
  }
  </script>
  
  <style scoped>



  @media screen and (max-width: 1024px) {
    #imagine-yourself {
    background-image:linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Imaginez-vous-mobile.png');
  }
  }
  </style>
  