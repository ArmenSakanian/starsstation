<template>
  <div class="home-page">
    <HeroVideo />
    <Service />
    <section id="section_1"><Video /></section>
    <Partner />
    <section id="feedback"><ContactPage /></section>
  </div>
</template>

<script>
import HeroVideo from '../components/HeroVideo.vue';
import Service from '../components/Service.vue';
import Video from '../components/Video.vue';
import Partner from '../components/Partner.vue';
import ContactPage from '../components/ContactPage.vue';

export default {
  name: 'HomePage',
  components: { HeroVideo, Service, Video, Partner, ContactPage }
};
</script>
