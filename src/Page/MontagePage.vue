<!-- AboutPage.vue -->
<template>
    <div  class="service__container-about all">
        <div class="services-about">
            <h1>{{ $t('montage video') }}</h1>
            <div class="about__text">
    <span v-for="(part, index) in splitText('montage-about')" :key="index" :class="part.class">{{ part.text }}</span>
  </div>
        </div>
    </div>
</template>

<script>
export default {
  name: 'MontagePage',
  methods: {
    splitText(key) {
      const text = this.$t(key);
      const parts = text.split(/(<highlight>.*?<\/highlight>)/g).filter(Boolean);
      return parts.map(part => {
        if (part.startsWith('<highlight>') && part.endsWith('</highlight>')) {
          return {
            text: part.replace('<highlight>', '').replace('</highlight>', ''),
            class: 'highlight'
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


.service__container-about {
    background-color: #222222;
    border-top: 1px solid #757575;
    border-bottom: 1px solid #757575;
    margin-top: 76px;
}

.services-about {
    padding: 150px 0 150px 0;
    text-align: center;
    color: white;
    width: 100%;
}

.about__text {
    color: #dddddd;
    padding-top: 20px;
    font-size: 28px;
    line-height: 2;
    width: 90%;
    margin: 0 auto;
    
}

@media screen and (max-width: 1024px) {
    .about__text {
        font-size: 16px;
    }
}

.highlight {
  font-weight: bold;
  color: rgb(255, 255, 255);
  text-shadow: 0px 0 20px #1cff00;
}

</style>