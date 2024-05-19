<template>
    <div>
      <ImaginezVous/>
      <VideoPublicitaire/>
      <ReseauSocial/>
      <MontageVideo/>
      <RapClip/>
    </div>
  </template>
  
  <script>
import MontageVideo from '../components/Montage-video.vue';
import ReseauSocial from '../components/Reseau-social.vue';
import VideoPublicitaire from '../components/Video-publicitaire.vue';
import ImaginezVous from '../components/Imaginez-vous.vue';
import RapClip from '../components/Rap-clip.vue'


  export default {
  name: "HomePage",
  components: {
    ImaginezVous,
    VideoPublicitaire,
    ReseauSocial,
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

  