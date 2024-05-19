<template>
    <div id="rap-clip" class="Services_container all">
      <div class="service_item">
        <h1  data-aos="zoom-out">{{ $t('rap clip') }}</h1>
        <router-link to="/montage"><button data-aos="fade-up" class="learn-more">{{ $t('learn more') }}</button></router-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'RapClip'
  }
  </script>
  
  <style scoped>

  #rap-clip {
    background-image:linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/rap_clip.png');
  }

  @media screen and (max-width: 769px) {
  #rap-clip{
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/rap-clip-mobile.png');
}
  }

  </style>