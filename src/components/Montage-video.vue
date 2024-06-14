<template>
  <div id="montage-video" class="services_container">
    <div class="service_item" data-aos="fade-up">
      <h1 >{{ $t('montage_video') }}</h1>
      <router-link  to="/Montage"><button  class="learn-more" aria-label="Learn more about Montage Video">{{ $t('learn more') }}</button></router-link>
      <div class="quotes">
        <p>
          <template v-for="(part, index) in splitText('montage_video_quotes')" :key="index">
            <span v-if="part.class" :class="part.class">{{ part.text }}</span>
            <template v-else>{{ part.text }}</template>
          </template>
        </p>
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

