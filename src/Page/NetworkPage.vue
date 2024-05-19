<!-- AboutPage.vue -->
<template>
    <div  class="service__container-about all">
        <div class="services-about">
            <h1>{{ $t('social network') }}</h1>
            <div class="about__text">
    <span v-for="(part, index) in splitText('network-about')" :key="index" :class="part.class">{{ part.text }}</span>
  </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'NetworkPage',
  methods: {
    splitText(key) {
      const text = this.$t(key);
      const parts = text.split(/(<color-bold>.*?<\/color-bold>)/g).filter(Boolean);
      return parts.map(part => {
        if (part.startsWith('<color-bold>') && part.endsWith('</color-bold>')) {
          return {
            text: part.replace('<color-bold>', '').replace('</color-bold>', ''),
            class: 'color-bold'
          };
        } else {
          return {
            text: part,
            class: ''
          };
        }
      });
    },
  }
}
</script>

<style scoped>




</style>