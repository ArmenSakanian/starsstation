<template>
  <div id="montage-video" class="Services_container all">
    <div class="service_item">
      <h1>{{ $t('montage video') }}</h1>
      <router-link to="/montage"><button class="learn-more">{{ $t('learn more') }}</button></router-link>
    </div>
    <span class="arrow"><svg width="45" height="26" viewBox="0 0 45 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.5 0.5L22.5 24.5L44.5 0.5" stroke="white" />
      </svg></span>
  </div>
</template>

<script>
export default {
  name: 'MontageVideo'
}
</script>

<style scoped>
#montage-video {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Montage-video.webp');
}

@media screen and (max-width: 769px) {
  #montage-video {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Montage-video-mobile.png');
}
  }

</style>