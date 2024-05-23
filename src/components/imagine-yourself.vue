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
    name: 'ImagineYourself',
    mounted() {
    const scrollToId = this.$route.query.scrollToId;
    if (scrollToId) {
      this.$nextTick(() => {
        const element = document.getElementById(scrollToId);
        if (element) {
          const yOffset = -50;
          const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
          window.scrollTo({ top: y, behavior: 'smooth' });
        }
      });
    }
  }
  }
  </script>
  
  <style scoped>



  @media screen and (max-width: 1024px) {
    #imagine-yourself {
    background-image:linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Imaginez-vous-mobile.png');
  }
  }
  </style>
  