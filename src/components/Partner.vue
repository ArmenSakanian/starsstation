<template>
  <section class="partner-section section-space">
    <div class="page-shell partner-card glass" data-aos="zoom-in">
      <div class="partner-image"></div>
      <div class="partner-gradient"></div>
      <div class="partner-grid"></div>
      <div class="partner-content">
        <span class="eyebrow">{{ $t('partnership_kicker') }}</span>
        <h2 class="section-title">{{ $t('video_title') }}</h2>
        <p class="lead">{{ $t('video_description') }}</p>
        <button class="primary-btn" type="button" @click="goToFeedback">{{ $t('contact') }} <i class="fa-solid fa-arrow-right"></i></button>
      </div>
      <div class="floating-mark"><img src="@/assets/logo/Logomark_White.svg" alt="" /></div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'PartnerComponent',
  methods: { goToFeedback() { document.getElementById('feedback')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); } }
};
</script>

<style scoped>
.partner-card { position: relative; min-height: 560px; padding: 60px; border-radius: 36px; overflow: hidden; display: flex; align-items: flex-end; isolation: isolate; }
.partner-image { position: absolute; inset: 0; z-index: -4; background: url('@/assets/icon/partner.png') center/cover no-repeat; transform: scale(1.04); filter: saturate(.65) contrast(1.1); }
.partner-gradient { position: absolute; inset: 0; z-index: -3; background: linear-gradient(90deg, rgba(5,6,10,.94), rgba(5,6,10,.56) 60%, rgba(5,6,10,.35)), linear-gradient(0deg, rgba(5,6,10,.88), transparent 65%); }
.partner-grid { position: absolute; inset: 0; z-index: -2; opacity: .16; background-image: linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px); background-size: 60px 60px; }
.partner-content { max-width: 720px; }
.partner-content h2 { margin: 22px 0; }
.partner-content .lead { margin-bottom: 30px; max-width: 620px; }
.floating-mark { position: absolute; right: 48px; top: 48px; width: 110px; height: 110px; display: grid; place-items: center; border: 1px solid var(--line); border-radius: 28px; background: rgba(255,255,255,.06); backdrop-filter: blur(18px); animation: markFloat 5s ease-in-out infinite; }
.floating-mark img { width: 65px; }
@keyframes markFloat { 50% { transform: translateY(10px) rotate(4deg); } }
@media (max-width: 700px) { .partner-card { min-height: 600px; padding: 34px 24px; } .floating-mark { width: 72px; height: 72px; right: 22px; top: 22px; border-radius: 20px; } .floating-mark img { width: 42px; } }
</style>

<style scoped>
/* Cinematic design-system alignment */
.partner-card { border-radius: 12px; border-color: rgba(255,255,255,.17); background: #0a1420; box-shadow: 0 26px 75px rgba(0,0,0,.28); }
.partner-image { filter: saturate(.72) contrast(1.06); }
.partner-gradient { background: linear-gradient(90deg, rgba(4,10,17,.92), rgba(4,10,17,.54) 58%, rgba(4,10,17,.24)), linear-gradient(0deg, rgba(4,10,17,.74), transparent 65%); }
.partner-grid { display: none; }
.floating-mark { border-radius: 50%; background: rgba(6,14,23,.42); }
</style>
