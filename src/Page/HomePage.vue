<template>

  <head>
    <title>Stars Station Studio</title>
    <meta name="description"
      content="IMAGINE YOURSELF, EXPRESS YOUR ART IN VIDEO, SOCIAL NETWORK, MONTAGE VIDEO, RAP CLIP">
  </head>
  <div>
  <Slider />
  <AboutUs />
  </div>
</template>

<script>
import Slider from '../components/Slider.vue';
import AboutUs from '../components/AboutUs.vue';



export default {
  name: "HomePage",
  components: {
    Slider,
    AboutUs,
  },
};
</script>


<style scoped></style>