<template>
  <div id="advertising-video" class="service__container-about services_container">
    <div class="services-about" data-aos="fade-up">
      <h1>
        <template v-for="(part, index) in splitText('advertising_video_quotes')" :key="index">
          <span v-if="part.class" :class="part.class">{{ part.text }}</span>
          <template v-else>{{ part.text }}</template>
        </template>
      </h1>
      <div class="about__text">
        <p>
          <template v-for="(part, index) in splitText('advertising_about')" :key="index">
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
  name: 'AdvertisingPage',
  inject: ['splitText'],
}
</script>

<style scoped></style>