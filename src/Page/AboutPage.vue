<template>

  <head>
    <title>About Us</title>
    <meta name="description"
      content="Transformez vos idées en vidéos captivantes. Spécialistes des courts métrages et des vidéos créatives, nous proposons des solutions adaptées à votre budget. Que ce soit pour des publicités à l'image de votre entreprise, des clips musicaux ou la gestion de vos réseaux sociaux, nous nous adaptons à vos besoins. Contactez-nous dès aujourd'hui pour donner vie à votre vision!">
  </head>
  <div class="service__container-about">
    <div class="services-about" data-aos="fade-up">
      <h1>
        <template v-for="(part, index) in splitText('about')" :key="index">
          <span v-if="part.class" :class="part.class">{{ part.text }}</span>
          <template v-else>{{ part.text }}</template>
        </template>
      </h1>
      <div class="about__text">
        <p>
          <template v-for="(part, index) in splitText('about_about')" :key="index">
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
  name: 'AboutPage',
  inject: ['splitText'],
}
</script>

<style scoped></style>