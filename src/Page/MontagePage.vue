<!-- AboutPage.vue -->
<template>
    <div  class="service__container-about all">
        <div class="services-about">
            <h1><span v-for="(part, index) in splitText('montage video-quotes')" :key="index" :class="part.class">{{ part.text }}</span>
            </h1>
            <div class="about__text">
    <span v-for="(part, index) in splitText('montage-about')" :key="index" :class="part.class">{{ part.text }}</span>
  </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'MontagePage',
  inject: ['splitText'],
}
</script>

<style scoped>
</style>