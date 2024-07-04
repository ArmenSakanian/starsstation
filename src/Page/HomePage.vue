<template>

  <head>
    <title>Stars Station Studio</title>
    <meta name="description"
      content="IMAGINE YOURSELF, EXPRESS YOUR ART IN VIDEO, SOCIAL NETWORK, MONTAGE VIDEO, RAP CLIP">
  </head>
  <div>
  <Slider />
  <AboutUs />
  <Subscribe />
  </div>
</template>

<script>
import Slider from '../components/Slider.vue';
import AboutUs from '../components/AboutUs.vue';
import Subscribe from '../components/Subscribe.vue'



export default {
  name: "HomePage",
  components: {
    Slider,
    AboutUs,
    Subscribe,
  },
};
</script>


<style scoped></style>