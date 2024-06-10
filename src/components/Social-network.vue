<template>
  <div id="social-network" class="Services_container">
    <div class="service_item" data-aos="fade-up">
      <h1>{{ $t('social_network') }}</h1>
      <router-link to="/Network"><button class="learn-more" aria-label="Learn more about Social Network">{{
        $t('learn_more') }}</button></router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SocialNetwork',
  inject: ['splitText'],
}
</script>

<style scoped>
@media screen and (max-width: 1024px) {
  #social-network {
    background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/social-network-mobile.webp');
  }
}
</style>