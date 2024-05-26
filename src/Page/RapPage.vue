<template>
    <div  class="service__container-about all">
        <div class="services-about">
            <h1>{{ $t('rap clip') }}</h1>
            <div class="about__text">
    <span v-for="(part, index) in splitText('rap-about')" :key="index" :class="part.class">{{ part.text }}</span>
  </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'RapPage',
  inject: ['splitText'],
}
</script>

<style scoped>




</style>