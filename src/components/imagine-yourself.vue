<template>
  <div id="imagine-yourself" class="Services_container">
    <div class="service_item">
      <h1>{{ $t('imagine_yourself') }}<h1>{{ $t('imagine_yourself_2') }}</h1></h1>
      <router-link to="/Yourself">
        <button class="learn-more" aria-label="Learn more about imagining yourself">{{ $t('learn_more') }}</button>
      </router-link>
    </div>
  </div>
</template>
  
  <script>
  export default {
    name: 'ImagineYourself',
    inject: ['splitText'],
  }
  </script>
  
  <style scoped>



  @media screen and (max-width: 1024px) {
    #imagine-yourself {
    background-image:linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/imagine-yourself-mobile.webp');
  }
  }
  </style>
  