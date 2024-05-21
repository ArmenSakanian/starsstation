<template>
    <div id="rap-clip" class="Services_container all">
      <div class="service_item">
        <h1  >{{ $t('rap clip') }}</h1>
        <router-link to="/Rap"><button  class="learn-more">{{ $t('learn more') }}</button></router-link>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'RapClip'
  }
  </script>
  
  <style scoped>



  @media screen and (max-width: 1024px) {
  #rap-clip{
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Rap-clip-mobile.png');
}
  }

  </style>