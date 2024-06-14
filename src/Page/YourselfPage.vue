<template>
  <div id="imagine-yourself" class="service__container-about services_container">
    <div class="services-about" data-aos="fade-up">
      <h1>
        <template v-for="(part, index) in splitText('imagine_yourself_quotes')" :key="index">
          <span v-if="part.class" :class="part.class">{{ part.text }}</span>
          <template v-else>{{ part.text }}</template>
        </template>
      </h1>
      <div class="about__text">
        <p>
          <template v-for="(part, index) in splitText('yourself_about')" :key="index">
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
  name: 'YourselfPage',
  inject: ['splitText'],
}
</script>

<style scoped>
  @media screen and (max-width: 1024px) {
    #imagine-yourself {
    background-image:linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/imagine-yourself-mobile.webp');
  }
  }</style>