<template>
  <div id="advertising-video" class="services_container">
    <div class="service_item" data-aos="fade-up">
      <h1>{{ $t('advertising_video') }}</h1>
      <router-link to="/Advertising"><button class="learn-more" aria-label="Learn more about Advertising video">{{
        $t('learn_more') }}</button></router-link>
      <div class="quotes">
        <p>
          <template v-for="(part, index) in splitText('advertising_video_quotes')" :key="index">
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
  name: 'AdvertisingVideo',
  inject: ['splitText'],
}
</script>

