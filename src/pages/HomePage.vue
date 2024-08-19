<template>
<test />
<section class="section_1">
  <Video />
    <Service />
</section>
    <section class="section_2">
      <Partner />
      <ContactPage /> 
    </section>
</template>

<script>
import test from '../components/test.vue'
import Video from '../components/Video.vue'
import Service from '../components/Service.vue'
import Partner from '../components/Partner.vue'
import ContactPage from '../components/ContactPage.vue'





export default {
  name: "HomePage",
  components: {  
    test, 
    Video,
    Service,
    Partner,
    ContactPage,
  },
};
</script>


<style scoped>

.section_2 {
  background-color: #171a36;
}
</style>