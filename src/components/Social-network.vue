<template>
  <div id="social-network" class="services_container scroll-change">
    <div class="service_item" data-aos="fade-left">
      <h1>{{ $t('social_network') }}</h1>
      <router-link to="/Network"><button class="learn-more" aria-label="Learn more about Social Network">{{
        $t('learn_more') }}</button></router-link>
      <div class="quotes">
        <p>
          <template v-for="(part, index) in splitText('social_network_quotes')" :key="index">
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
  name: 'SocialNetwork',
  inject: ['splitText'],
}
</script>

