<template>
  <div class="about-page page-top">
    <section class="page-shell about-hero">
      <div class="about-copy" data-aos="fade-up">
        <span class="eyebrow">Stars Station / {{ $t('about') }}</span>
        <h1 class="display-title">{{ $t('about') }}</h1>
        <p class="lead" v-html="formatText('about_about')"></p>
        <div class="about-actions">
          <router-link to="/portfolio" class="primary-btn">{{ $t('our_videos') }} <i class="fa-solid fa-arrow-right"></i></router-link>
          <a :href="`mailto:${contacts.email}`" class="secondary-btn">{{ $t('contact') }}</a>
        </div>
      </div>

      <div class="about-visual" data-aos="fade-left" data-aos-delay="100">
        <img src="@/assets/img/about.webp" alt="Stars Station Studio" />
        <div class="visual-shade"></div>
        <div class="visual-number">01</div>
        <div class="visual-label">{{ $t('creative_studio') }}</div>
      </div>
    </section>

    <section class="page-shell info-strip" data-aos="fade-up">
      <div><small>{{ $t('email') }}</small><a :href="`mailto:${contacts.email}`">{{ contacts.email }}</a></div>
      <div><small>{{ $t('tel') }}</small><a :href="`tel:${contacts.phone}`">{{ contacts.phone }}</a></div>
      <div class="social-row"><small>{{ $t('social') }}</small><span>
        <a v-if="contacts.socials.facebook.url && contacts.socials.facebook.url !== contacts.socials.instagram.url" :href="contacts.socials.facebook.url" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
        <a :href="contacts.socials.instagram.url" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
        <a :href="contacts.socials.youtube.url" target="_blank" rel="noopener"><i class="fa-brands fa-youtube"></i></a>
      </span></div>
    </section>

    <section class="page-shell about-manifesto section-space">
      <div class="manifesto-index" data-aos="fade-right">02 — {{ $t('studio_label') }}</div>
      <div data-aos="fade-left">
        <h2 class="section-title" v-html="formatText('video_title')"></h2>
        <p class="lead" v-html="formatText('video_description')"></p>
      </div>
    </section>
  </div>
</template>

<script>
import contacts from '@/contacts.json';
import { formatText } from '@/utils/textFormatter';
export default {
  name: 'AboutPage',
  data() { return { contacts }; },
  methods: { formatText(key) { return formatText(this.$i18n, key); } }
};
</script>

<style scoped>
.about-page { overflow: hidden; }
.about-hero {
  min-height: calc(100vh - 118px);
  display: grid;
  grid-template-columns: .83fr 1.17fr;
  gap: clamp(48px, 6vw, 90px);
  align-items: center;
  padding-bottom: 72px;
}
.about-copy h1 { margin: 28px 0 26px; }
.about-copy .lead { max-width: 620px; }
.about-copy :deep(.color-bold) { color: #fff; font-weight: 600; }
.about-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 32px; }
.about-visual {
  position: relative;
  min-height: 610px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.18);
  border-radius: 12px;
  background: #0a1420;
}
.about-visual img { width: 100%; height: 100%; min-height: 610px; object-fit: cover; display: block; filter: saturate(.88) contrast(1.04); }
.visual-shade { position: absolute; inset: 0; background: linear-gradient(180deg, transparent 50%, rgba(4,10,17,.72)); pointer-events: none; }
.visual-number { position: absolute; right: 20px; top: 18px; color: rgba(255,255,255,.78); font-size: 10px; letter-spacing: .18em; }
.visual-label { position: absolute; left: 22px; bottom: 20px; color: #fff; font-size: 9px; letter-spacing: .23em; text-transform: uppercase; }
.info-strip { display: grid; grid-template-columns: 1fr 1fr 1fr; border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); }
.info-strip > div { min-height: 105px; padding: 20px 24px; display: flex; flex-direction: column; justify-content: center; gap: 7px; border-right: 1px solid var(--line); }
.info-strip > div:last-child { border-right: 0; }
.info-strip small { color: var(--text-dim); font-size: 9px; text-transform: uppercase; letter-spacing: .18em; }
.info-strip a { text-decoration: none; font-size: 13px; }
.social-row span { display: flex; gap: 16px; }
.social-row span a:hover { color: var(--accent-2); }
.about-manifesto { display: grid; grid-template-columns: .3fr 1fr; gap: 80px; }
.manifesto-index { color: var(--text-dim); font-size: 10px; letter-spacing: .16em; text-transform: uppercase; }
.about-manifesto h2 { max-width: 820px; margin-bottom: 24px; }
.about-manifesto .lead { max-width: 760px; }
@media (max-width: 900px) { .about-hero { grid-template-columns: 1fr; padding-top: 36px; } .about-visual, .about-visual img { min-height: 430px; } .about-manifesto { grid-template-columns: 1fr; gap: 24px; } }
@media (max-width: 620px) { .about-hero { gap: 36px; } .about-actions { display: grid; } .about-visual, .about-visual img { min-height: 340px; } .info-strip { grid-template-columns: 1fr; } .info-strip > div { min-height: 82px; border-right: 0; border-bottom: 1px solid var(--line); } .info-strip > div:last-child { border-bottom: 0; } }
</style>
