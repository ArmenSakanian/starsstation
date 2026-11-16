<template>
  <section class="showreel-section section-space">
    <div class="page-shell showreel-grid">
      <div class="showreel-copy" data-aos="fade-right">
        <span class="eyebrow">{{ $t('studio_motion') }}</span>
        <h2 class="section-title" v-html="formatText(title)"></h2>
        <p class="lead" v-html="formatText(description)"></p>
        <router-link class="secondary-btn" to="/portfolio">
          {{ $t('learn_more') }} <i class="fa-solid fa-arrow-right"></i>
        </router-link>
      </div>

      <div class="video-shell" data-aos="fade-up" data-aos-delay="100">
        <video ref="videoPlayer" class="video-player" autoplay muted loop playsinline>
          <source src="@/assets/video/intro.mp4" type="video/mp4" />
        </video>
        <div class="video-shade"></div>
        <div class="video-badge"><span></span> Stars Station / Showreel</div>
        <div class="video-corner">02</div>
      </div>
    </div>
  </section>
</template>

<script>
import { formatText } from '@/utils/textFormatter';
export default {
  name: 'InteractiveVideo',
  data() { return { title: 'video_title', description: 'video_description' }; },
  methods: { formatText(key) { return formatText(this.$i18n, key); } }
};
</script>

<style scoped>
.showreel-section { position: relative; background: #07101a; }
.showreel-grid {
  display: grid;
  grid-template-columns: .68fr 1.32fr;
  align-items: center;
  gap: clamp(48px, 6vw, 92px);
}
.showreel-copy h2 { margin: 26px 0 22px; max-width: 620px; }
.showreel-copy .lead { max-width: 560px; margin-bottom: 30px; }
.video-shell {
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.18);
  border-radius: 12px;
  background: #03070c;
  box-shadow: 0 28px 80px rgba(0,0,0,.30);
}
.video-player {
  display: block;
  width: 100%;
  aspect-ratio: 16 / 9;
  object-fit: cover;
  transform: scale(1.005);
}
.video-shade {
  position: absolute;
  inset: 0;
  pointer-events: none;
  background: linear-gradient(0deg, rgba(3,8,14,.42), transparent 44%);
}
.video-badge {
  position: absolute;
  left: 20px;
  bottom: 18px;
  display: flex;
  align-items: center;
  gap: 9px;
  padding: 9px 12px;
  border: 1px solid rgba(255,255,255,.18);
  border-radius: 999px;
  background: rgba(5,12,20,.60);
  color: #fff;
  font-size: 9px;
  letter-spacing: .12em;
  text-transform: uppercase;
  backdrop-filter: blur(12px);
}
.video-badge span { width: 6px; height: 6px; border-radius: 50%; background: #fff; box-shadow: 0 0 10px rgba(255,255,255,.85); }
.video-corner { position: absolute; right: 19px; top: 17px; color: rgba(255,255,255,.76); font-size: 10px; letter-spacing: .18em; }
@media (max-width: 900px) { .showreel-grid { grid-template-columns: 1fr; gap: 38px; } }
@media (max-width: 560px) { .showreel-copy h2 { margin-top: 20px; } .video-shell { border-radius: 10px; } }
</style>
