<template>
  <div class="service__container-about all">
    <div class="services-about" data-aos="fade-up">
      <h1>{{ $t('imagine_yourself') }}<h1>{{ $t('imagine_yourself_2') }}</h1></h1>
      <div class="about__text">
        <span v-for="(part, index) in splitText('yourself_about')" :key="index" :class="part.class">{{ part.text }}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'YourselfPage',
  inject: ['splitText'],
}
</script>

<style scoped>




</style>