<template>
  <div id="montage-video" class="Services_container all">
    <div class="service_item">
      <h1 >{{ $t('montage video') }}</h1>
      <router-link  to="/Montage"><button  class="learn-more">{{ $t('learn more') }}</button></router-link>
      <div class="quotes">
          <span v-for="(part, index) in splitText('montage video-quotes')" :key="index" :class="part.class">{{ part.text }}</span>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MontageVideo',
  inject: ['splitText'],
}
</script>

<style scoped>


@media screen and (max-width: 1024px) {
  #montage-video {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/montage-video-mobile.webp');
}
  }

</style>