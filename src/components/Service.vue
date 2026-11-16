<template>
  <section id="service" class="services section-space">
    <div class="page-shell">
      <div class="section-head" data-aos="fade-up">
        <div class="section-intro">
          <span class="services-kicker">{{ $t('services_kicker_short') }}</span>
          <h2>{{ $t('services_heading') }}</h2>
        </div>
        <button class="services-link" type="button" @click="scrollToFeedback">
          {{ $t('service_view_all') }} <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>

      <div class="service-grid">
        <article
          v-for="(service, index) in services"
          :key="service.title"
          class="service-card"
          data-aos="fade-up"
          :data-aos-delay="index * 55"
        >
          <img class="service-image" :src="service.image" :alt="plainText(service.title)" loading="lazy" />
          <div class="service-shade"></div>
          <div class="service-border"></div>

          <span class="service-index">0{{ index + 1 }}</span>
          <div class="service-copy">
            <h3 v-html="formatText(service.title)"></h3>
            <p v-html="formatText(service.description)"></p>
          </div>
          <span class="service-arrow"><i class="fa-solid fa-arrow-right"></i></span>
        </article>
      </div>
    </div>
  </section>
</template>

<script>
import imagine from '@/assets/img/imagine-yourself.webp';
import advertising from '@/assets/img/advertising-video.webp';
import network from '@/assets/img/social-network.webp';
import montage from '@/assets/img/montage-video.webp';
import clip from '@/assets/img/rap-clip.webp';
import { formatText } from '@/utils/textFormatter';

export default {
  name: 'Service',
  data() {
    return {
      services: [
        { image: imagine, title: 'imagine_yourself', description: 'imagine_yourself_quotes' },
        { image: advertising, title: 'advertising_video', description: 'advertising_video_quotes' },
        { image: network, title: 'social_network', description: 'social_network_quotes' },
        { image: montage, title: 'montage_video', description: 'montage_video_quotes' },
        { image: clip, title: 'rap_clip', description: 'rap_clip_quotes' }
      ]
    };
  },
  methods: {
    formatText(key) { return formatText(this.$i18n, key); },
    plainText(key) {
      const html = this.formatText(key);
      return String(html).replace(/<[^>]+>/g, '');
    },
    scrollToFeedback() {
      document.getElementById('feedback')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }
};
</script>

<style scoped>
.services {
  position: relative;
  padding-top: 58px;
  padding-bottom: 104px;
  overflow: hidden;
  background:
    linear-gradient(180deg, #07101a 0%, #07101a 100%);
}
.section-head {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  gap: 40px;
  margin-bottom: 28px;
}
.section-intro { text-align: center; margin: 0 auto; }
.services-kicker {
  display: inline-block;
  margin-bottom: 10px;
  color: rgba(255,255,255,.66);
  font-size: 9px;
  font-weight: 500;
  letter-spacing: .42em;
  text-transform: uppercase;
}
.section-intro h2 {
  font-family: var(--font-display);
  font-size: clamp(40px, 4.25vw, 65px);
  line-height: .94;
  letter-spacing: -.03em;
  font-weight: 500;
}
.services-link {
  position: absolute;
  right: max(48px, calc((100vw - 1480px) / 2));
  margin-bottom: 5px;
  min-height: 42px;
  display: inline-flex;
  align-items: center;
  gap: 24px;
  padding: 0 18px;
  border: 1px solid rgba(255,255,255,.25);
  border-radius: 999px;
  background: rgba(255,255,255,.035);
  color: #fff;
  font-size: 10px;
  cursor: pointer;
  backdrop-filter: blur(10px);
  transition: background .25s ease, border-color .25s ease, transform .25s ease;
}
.services-link:hover { transform: translateY(-2px); border-color: rgba(255,255,255,.42); background: rgba(255,255,255,.07); }
.service-grid {
  display: grid;
  grid-template-columns: repeat(5, minmax(0, 1fr));
  gap: 14px;
}
.service-card {
  position: relative;
  min-height: 310px;
  border-radius: 10px;
  overflow: hidden;
  isolation: isolate;
  cursor: default;
  background: #0b1521;
  transform: translateZ(0);
}
.service-image {
  position: absolute;
  inset: 0;
  z-index: -4;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform .7s cubic-bezier(.2,.75,.2,1), filter .7s ease;
}
.service-shade {
  position: absolute;
  inset: 0;
  z-index: -3;
  background:
    linear-gradient(180deg, rgba(3,8,14,.02) 18%, rgba(4,10,17,.23) 50%, rgba(4,10,17,.92) 100%),
    linear-gradient(90deg, rgba(4,10,17,.20), transparent 58%);
}
.service-border {
  position: absolute;
  inset: 0;
  z-index: 4;
  border: 1px solid rgba(255,255,255,.22);
  border-radius: inherit;
  pointer-events: none;
  transition: border-color .35s ease, box-shadow .35s ease;
}
.service-index {
  position: absolute;
  left: 21px;
  bottom: 91px;
  color: rgba(255,255,255,.86);
  font-size: 9px;
  letter-spacing: .1em;
}
.service-copy {
  position: absolute;
  left: 21px;
  right: 62px;
  bottom: 18px;
  z-index: 2;
}
.service-copy h3 {
  margin-bottom: 7px;
  font-family: var(--font-display);
  font-size: clamp(24px, 1.9vw, 32px);
  line-height: .92;
  letter-spacing: -.02em;
  font-weight: 500;
}
.service-copy p {
  color: rgba(255,255,255,.66);
  font-size: 8px;
  line-height: 1.35;
  letter-spacing: .17em;
  text-transform: uppercase;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.service-copy :deep(.color-bold) { color: inherit; font-weight: inherit; }
.service-arrow {
  position: absolute;
  right: 18px;
  bottom: 18px;
  z-index: 2;
  width: 39px;
  height: 39px;
  display: grid;
  place-items: center;
  border: 1px solid rgba(255,255,255,.72);
  border-radius: 50%;
  color: #fff;
  font-size: 11px;
  transition: transform .35s ease, background .35s ease;
}
.service-card:hover .service-image { transform: scale(1.065); filter: saturate(1.06) contrast(1.03); }
.service-card:hover .service-border { border-color: rgba(255,255,255,.42); box-shadow: inset 0 0 0 1px rgba(255,255,255,.05); }
.service-card:hover .service-arrow { transform: rotate(-35deg); background: rgba(100,92,255,.66); }

@media (max-width: 1260px) {
  .service-grid { grid-template-columns: repeat(3, 1fr); }
  .service-card:nth-child(4), .service-card:nth-child(5) { min-height: 290px; }
  .services-link { right: 26px; }
}
@media (max-width: 860px) {
  .services { padding-top: 54px; }
  .section-head { align-items: center; flex-direction: column; margin-bottom: 24px; }
  .services-link { position: static; margin: 0; }
  .service-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px) {
  .services { padding-top: 45px; padding-bottom: 80px; }
  .section-head { gap: 20px; }
  .section-intro h2 { font-size: clamp(39px, 12vw, 52px); }
  .service-grid { grid-template-columns: 1fr; gap: 12px; }
  .service-card { min-height: 255px; border-radius: 9px; }
  .service-card:nth-child(4), .service-card:nth-child(5) { min-height: 255px; }
  .service-copy h3 { font-size: 29px; }
}
</style>
