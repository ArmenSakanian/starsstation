<template>
  <div class="service__container-about all">
    <div class="services-about" data-aos="fade-up">
      <h1>{{ $t('imagine_yourself') }}<h1>{{ $t('imagine_yourself_2') }}</h1>
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

<style scoped></style>