<template>
  <div id="rap-clip" class="services_container">
    <div class="service_item" data-aos="fade-left">
      <h1>{{ $t('rap_clip') }}</h1>
      <router-link to="/Rap"><button class="learn-more" aria-label="Learn more about Rap Clip">{{ $t('learn_more')
          }}</button></router-link>
                <div class="quotes">
        <p>
          <template v-for="(part, index) in splitText('rap_clip_quotes')" :key="index">
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
  name: 'RapClip',
  inject: ['splitText'],
}
</script>
