<template>
  <div class="service__container-about all">
    <div class="services-about" data-aos="fade-up">
      <h1>{{ $t('social_network') }}</h1>
      <div class="about__text">
        <span v-for="(part, index) in splitText('network_about')" :key="index" :class="part.class">{{ part.text }}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NetworkPage',
  inject: ['splitText'],
}
</script>

<style scoped>




</style>