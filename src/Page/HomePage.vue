<template>
  <head>
  <title>Stars Station Studio</title>
  <meta name="description" content="IMAGINE YOURSELF, EXPRESS YOUR ART IN VIDEO, SOCIAL NETWORK, MONTAGE VIDEO, RAP CLIP">
</head>
    <div class="arrow_container">
      <span class="arrow"><svg width="35" height="21" viewBox="0 0 45 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.5 0.5L22.5 24.5L44.5 0.5" stroke="white" />
      </svg>
    </span>
    </div>
    <div>
      <ImagineYourself/>
      <AdvertisingVideo/>
      <SocialNetwork/>
      <MontageVideo/>
      <RapClip/>
    </div>
  </template>
  
  <script>
import MontageVideo from '../components/Montage-video.vue';
import SocialNetwork from '../components/Social-network.vue';
import AdvertisingVideo from '../components/Advertising-video.vue';
import ImagineYourself from '../components/imagine-yourself.vue';
import RapClip from '../components/Rap-clip.vue'


  export default {
  name: "HomePage",
  components: {
    ImagineYourself,
    AdvertisingVideo,
    SocialNetwork,
    MontageVideo,
    RapClip
    },
  mounted() {
    this.scrollToElementFromQuery();
  },
  methods: {
    scrollToElementFromQuery() {
      const scrollToId = this.$route.query.scrollToId;
      if (scrollToId) {
        this.$nextTick(() => {
          const element = document.getElementById(scrollToId);
          if (element) {
            const yOffset = -50; 
            const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
            window.scrollTo({ top: y, behavior: 'smooth' });
          } else {
            console.warn("Element not found:", scrollToId);
          }
        });
      }
    }
  }
};
  </script>


<style scoped>

</style>

  