<template>
  <div id="montage-video" class="service__container-about services_container">
    <div class="services-about" data-aos="fade-up">
      <h1>
        <template v-for="(part, index) in splitText('montage_video_quotes')" :key="index">
          <span v-if="part.class" :class="part.class">{{ part.text }}</span>
          <template v-else>{{ part.text }}</template>
        </template>
      </h1>
      <h1>
      </h1>
      <div class="about__text">
        <p>
          <template v-for="(part, index) in splitText('montage_about')" :key="index">
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
  name: 'MontagePage',
  inject: ['splitText'],
}
</script>

<style scoped></style>