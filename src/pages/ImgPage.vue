<template>
  <div class="detail-page page-top">
    <section class="page-shell detail-hero">
      <div data-aos="fade-up">
        <span class="eyebrow">Stars Station / Story</span>
        <h1 class="display-title" v-html="combinedText"></h1>
        <p class="lead" v-html="formatText('imagine_yourself_quotes')"></p>
      </div>
      <div class="detail-image glass" data-aos="zoom-in" data-aos-delay="100"><img src="@/assets/img/imagine-yourself.webp" alt="Imagine Yourself" /></div>
    </section>

    <section class="page-shell detail-story section-space">
      <div class="story-image glass" data-aos="fade-right"><img src="@/assets/img/advertising-video.webp" alt="Stars Station video production" /></div>
      <div class="story-copy" data-aos="fade-left">
        <span class="eyebrow">{{ $t('story_kicker') }}</span>
        <p class="lead" v-html="formatText('yourself_about')"></p>
        <router-link to="/portfolio" class="primary-btn">{{ $t('our_videos') }} <i class="fa-solid fa-arrow-right"></i></router-link>
      </div>
    </section>
  </div>
</template>

<script>
import { formatText } from '@/utils/textFormatter';
export default {
  name: 'ImgPage',
  computed: { combinedText() { return `${this.formatText('imagine_yourself')}<br>${this.formatText('imagine_yourself_2')}`; } },
  methods: { formatText(key) { return formatText(this.$i18n, key); } }
};
</script>

<style scoped>
.detail-page { overflow: hidden; }
.detail-hero { min-height: 760px; display: grid; grid-template-columns: .8fr 1.2fr; align-items: center; gap: 55px; padding-bottom: 80px; }
.detail-hero h1 { margin: 22px 0; }
.detail-image, .story-image { padding: 9px; border-radius: 32px; overflow: hidden; }
.detail-image img, .story-image img { width: 100%; display: block; object-fit: cover; border-radius: 24px; }
.detail-image img { min-height: 570px; }
.detail-story { display: grid; grid-template-columns: 1fr 1fr; gap: 70px; align-items: center; }
.story-image img { min-height: 520px; }
.story-copy .lead { margin: 22px 0 30px; }
@media (max-width: 900px) { .detail-hero, .detail-story { grid-template-columns: 1fr; } .detail-hero { padding-top: 40px; min-height: auto; } .detail-image img, .story-image img { min-height: 380px; } }
@media (max-width: 560px) { .detail-image img, .story-image img { min-height: 300px; } }
</style>

<style scoped>
/* Cinematic design-system alignment */
.detail-image, .story-image { padding: 0; border-radius: 12px; background: transparent; box-shadow: none; }
.detail-image img, .story-image img { border: 1px solid rgba(255,255,255,.17); border-radius: 12px; }
</style>
