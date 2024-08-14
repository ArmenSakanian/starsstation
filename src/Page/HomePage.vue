<template>

  <head>
    <title>Stars Station Studio</title>
    <meta name="description"
      content="IMAGINE YOURSELF, EXPRESS YOUR ART IN VIDEO, SOCIAL NETWORK, MONTAGE VIDEO, RAP CLIP">
  </head> 

  <Service />
    <ContactPage /> 
</template>

<script>

import Service from '../components/Service.vue'
import ContactPage from '../components/ContactPage.vue'




export default {
  name: "HomePage",
  components: {   
    Service,
    ContactPage,
  },
};
</script>


<style scoped></style>