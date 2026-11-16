<template>
  <section class="hero" id="section_3">
    <picture class="hero-media" aria-hidden="true">
      <source media="(max-width: 700px)" :srcset="mobileHero" />
      <img :src="desktopHero" alt="" />
    </picture>

    <div class="hero-overlay"></div>
    <div class="hero-vignette"></div>

    <div class="page-shell hero-content">
      <div class="hero-copy" data-aos="fade-up" data-aos-duration="900">
        <span class="hero-kicker">STARS STATION STUDIO</span>
        <h1 class="hero-title">
          <span>{{ $t('hero_title_top') }}</span>
          <span>{{ $t('hero_title_bottom') }}</span>
        </h1>
        <div class="hero-tagline">
          <span class="hero-tagline-line"></span>
          <span>{{ $t('hero_tagline') }}</span>
        </div>

        <div class="hero-actions">
          <router-link class="primary-btn hero-primary" to="/portfolio">
            {{ $t('discover_work') }} <i class="fa-solid fa-arrow-right"></i>
          </router-link>
          <button class="showreel-btn" type="button" @click="scrollTo('section_1')">
            <span class="play-circle"><i class="fa-solid fa-play"></i></span>
            <span>{{ $t('watch_showreel') }}</span>
          </button>
        </div>
      </div>

      <div class="hero-lower-left" aria-hidden="true">
        <span>{{ $t('hero_categories_1') }}</span>
        <span>{{ $t('hero_categories_2') }}</span>
      </div>

      <div class="hero-location" aria-hidden="true">
        <span>Valais</span>
        <span>Switzerland</span>
      </div>

      <div class="hero-rail" aria-hidden="true">
        <span class="rail-number active">01</span>
        <span class="rail-line"><i></i></span>
        <span class="rail-number">02</span>
        <span class="rail-number">03</span>
      </div>
    </div>
  </section>
</template>

<script>
import desktopHero from '@/assets/img/hero-valais-desktop.webp';
import mobileHero from '@/assets/img/hero-valais-mobile.webp';

export default {
  name: 'HeroVideo',
  data() { return { desktopHero, mobileHero }; },
  methods: {
    scrollTo(id) {
      document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }
};
</script>

<style scoped>
.hero {
  position: relative;
  height: clamp(720px, 88svh, 920px);
  min-height: 720px;
  overflow: hidden;
  isolation: isolate;
  background: #091522;
}
.hero-media {
  position: absolute;
  inset: 0;
  z-index: -5;
  display: block;
}
.hero-media img {
  width: 100%;
  height: 100%;
  display: block;
  object-fit: cover;
  object-position: center 48%;
  transform: scale(1.018);
  animation: heroDrift 14s ease-out both;
}
.hero-overlay {
  position: absolute;
  inset: 0;
  z-index: -4;
  background:
    linear-gradient(90deg, rgba(4,10,18,.58) 0%, rgba(4,10,18,.25) 38%, rgba(4,10,18,.07) 67%, rgba(4,10,18,.14) 100%),
    linear-gradient(180deg, rgba(5,12,20,.24) 0%, rgba(5,12,20,.02) 42%, rgba(5,12,20,.50) 78%, #07101a 100%);
}
.hero-vignette {
  position: absolute;
  inset: 0;
  z-index: -3;
  box-shadow: inset 0 0 180px rgba(2,7,12,.26);
  pointer-events: none;
}
.hero-content {
  position: relative;
  height: 100%;
  padding-top: 154px;
  padding-bottom: 96px;
}
.hero-copy {
  width: min(720px, 62vw);
  position: relative;
  z-index: 2;
}
.hero-kicker {
  display: block;
  margin-bottom: 17px;
  color: rgba(255,255,255,.88);
  font-size: 10px;
  font-weight: 500;
  letter-spacing: .39em;
}
.hero-title {
  display: grid;
  font-family: var(--font-display);
  font-size: clamp(70px, 7vw, 112px);
  line-height: .78;
  letter-spacing: -.045em;
  font-weight: 500;
  text-shadow: 0 4px 34px rgba(0,0,0,.24);
}
.hero-title span:last-child { margin-left: 4px; }
.hero-tagline {
  display: flex;
  align-items: center;
  gap: 18px;
  margin-top: 31px;
  color: rgba(255,255,255,.88);
  font-size: 10px;
  letter-spacing: .42em;
  text-transform: uppercase;
  white-space: nowrap;
}
.hero-tagline-line { width: 52px; height: 1px; background: rgba(255,255,255,.78); }
.hero-actions { display: flex; align-items: center; gap: 18px; margin-top: 38px; }
.hero-primary { min-width: 218px; }
.showreel-btn {
  display: inline-flex;
  align-items: center;
  gap: 13px;
  border: 0;
  background: transparent;
  color: #fff;
  cursor: pointer;
  font-size: 13px;
}
.play-circle {
  width: 48px;
  height: 48px;
  display: grid;
  place-items: center;
  border: 1px solid rgba(255,255,255,.55);
  border-radius: 50%;
  background: rgba(255,255,255,.13);
  box-shadow: inset 0 1px 0 rgba(255,255,255,.20);
  backdrop-filter: blur(10px);
  transition: transform .28s ease, background .28s ease;
}
.play-circle i { margin-left: 2px; font-size: 11px; }
.showreel-btn:hover .play-circle { transform: scale(1.08); background: rgba(100,92,255,.55); }
.hero-lower-left {
  position: absolute;
  left: 0;
  bottom: 76px;
  display: grid;
  gap: 5px;
  color: rgba(255,255,255,.78);
  font-size: 9px;
  letter-spacing: .22em;
  text-transform: uppercase;
}
.hero-location {
  position: absolute;
  right: 24px;
  bottom: 74px;
  display: grid;
  transform: rotate(-7deg);
  color: rgba(255,255,255,.82);
  font-family: "Allura", cursive;
  font-size: 39px;
  line-height: .72;
  text-align: center;
  text-shadow: 0 4px 24px rgba(0,0,0,.32);
}
.hero-location span:last-child { margin-left: 34px; }
.hero-rail {
  position: absolute;
  right: -2px;
  top: 50%;
  transform: translateY(-42%);
  display: grid;
  justify-items: center;
  gap: 13px;
  color: rgba(255,255,255,.62);
  font-size: 9px;
}
.rail-number.active { color: #fff; font-size: 11px; }
.rail-line { width: 1px; height: 68px; background: rgba(255,255,255,.28); position: relative; }
.rail-line i { position: absolute; left: 0; top: 0; width: 1px; height: 31px; background: #fff; }
@keyframes heroDrift {
  from { transform: scale(1.06); }
  to { transform: scale(1.018); }
}

@media (max-width: 1050px) {
  .hero { height: max(760px, 92svh); }
  .hero-content { padding-top: 150px; }
  .hero-copy { width: min(720px, 76vw); }
  .hero-rail, .hero-location { display: none; }
}
@media (max-width: 700px) {
  .hero { height: max(760px, 100svh); min-height: 700px; }
  .hero-media img { object-position: center 61%; animation: none; transform: scale(1.01); }
  .hero-overlay {
    background:
      linear-gradient(180deg, rgba(4,10,18,.45) 0%, rgba(4,10,18,.20) 28%, rgba(4,10,18,.36) 59%, rgba(4,10,18,.88) 86%, #07101a 100%),
      linear-gradient(90deg, rgba(4,10,18,.36), transparent 70%);
  }
  .hero-content { padding-top: 136px; padding-bottom: 76px; display: flex; align-items: flex-end; }
  .hero-copy { width: 100%; padding-bottom: 115px; }
  .hero-kicker { font-size: 9px; letter-spacing: .29em; margin-bottom: 14px; }
  .hero-title { font-size: clamp(55px, 18.5vw, 82px); line-height: .82; }
  .hero-tagline { margin-top: 24px; gap: 12px; font-size: 8px; letter-spacing: .28em; white-space: normal; }
  .hero-tagline-line { width: 30px; flex-shrink: 0; }
  .hero-actions { align-items: flex-start; flex-direction: column; gap: 13px; margin-top: 28px; }
  .hero-primary { min-width: 0; width: 100%; }
  .showreel-btn { padding-left: 2px; }
  .hero-lower-left { left: 0; bottom: 40px; font-size: 7.5px; letter-spacing: .18em; }
}
@media (max-width: 420px) {
  .hero-title { font-size: clamp(50px, 17.2vw, 67px); }
  .hero-copy { padding-bottom: 105px; }
}
</style>
