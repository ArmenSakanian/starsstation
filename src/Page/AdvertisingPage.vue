
<template>
    <div  class="service__container-about all">
        <div class="services-about">
            <h1>{{ $t('advertising video-quotes') }}</h1>
            <div class="about__text">
    <span v-for="(part, index) in splitText('advertising-about')" :key="index" :class="part.class">{{ part.text }}</span>
  </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'AdvertisingPage',
  inject: ['splitText'],
}
</script>

<style scoped>




</style>