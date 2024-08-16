<template>
<test />
<Video />
  <Service />
    <ContactPage /> 
</template>

<script>
import test from '../components/test.vue'
import Video from '../components/Video.vue'
import Service from '../components/Service.vue'
import ContactPage from '../components/ContactPage.vue'




export default {
  name: "HomePage",
  components: {  
    test, 
    Video,
    Service,
    ContactPage,
  },
};
</script>


<style scoped></style>