<!-- AboutPage.vue -->
<template>
  <head>
  <title> About Us</title>
  <meta name="description" content="Transformez vos idées en vidéos captivantes. Spécialistes des courts métrages et des vidéos créatives, nous proposons des solutions adaptées à votre budget. Que ce soit pour des publicités à l'image de votre entreprise, des clips musicaux ou la gestion de vos réseaux sociaux, nous nous adaptons à vos besoins. Contactez-nous dès aujourd'hui pour donner vie à votre vision!">
</head>
  <div  class="service__container-about all">
      <div class="services-about">
          <h1>{{ $t('about') }}</h1>
          <div class="about__text">
  <span v-for="(part, index) in splitText('about-about')" :key="index" :class="part.class">{{ part.text }}</span>
</div>
      </div>
  </div>
</template>

<script>
export default {
name: 'AboutPage',
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