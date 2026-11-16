<template>
  <section class="not-found page-top">
    <div class="page-shell error-shell">
      <div class="error-copy" data-aos="fade-up">
        <span class="error-code">404</span>
        <span class="eyebrow">{{ $t('lost_orbit') }}</span>
        <h1 class="display-title">{{ $t('notfound') }}</h1>
        <p class="lead">{{ $t('notfound_text') }}</p>
        <router-link to="/" class="primary-btn"><i class="fa-solid fa-arrow-left"></i> Stars Station</router-link>
      </div>
      <div class="error-visual" data-aos="zoom-in">
        <div class="orbit orbit-one"></div><div class="orbit orbit-two"></div>
        <img src="@/assets/notfound.png" alt="Page not found" />
      </div>
    </div>
  </section>
</template>

<script>export default { name: 'NotFound' };</script>

<style scoped>
.not-found { min-height: 100vh; display: flex; align-items: center; overflow: hidden; }
.error-shell { display: grid; grid-template-columns: .8fr 1.2fr; align-items: center; gap: 30px; padding-bottom: 80px; }
.error-copy { position: relative; z-index: 2; }
.error-code { display: block; font-size: clamp(90px, 18vw, 210px); line-height: .75; letter-spacing: -.08em; font-weight: 700; color: rgba(255,255,255,.035); margin-bottom: -10px; }
.error-copy h1 { margin: 22px 0; }
.error-copy .lead { margin-bottom: 30px; max-width: 530px; }
.error-visual { position: relative; min-height: 560px; display: grid; place-items: center; }
.error-visual img { position: relative; z-index: 2; max-width: min(520px, 90%); filter: drop-shadow(0 30px 70px rgba(0,0,0,.55)); animation: float 6s ease-in-out infinite; }
.orbit { position: absolute; border: 1px solid rgba(255,255,255,.1); border-radius: 50%; }
.orbit-one { width: 480px; height: 480px; animation: spin 20s linear infinite; }
.orbit-two { width: 330px; height: 330px; border-style: dashed; border-color: rgba(46,230,214,.16); animation: spin 13s linear infinite reverse; }
@keyframes spin { to { transform: rotate(360deg); } }
@keyframes float { 50% { transform: translateY(-18px) rotate(2deg); } }
@media (max-width: 850px) { .error-shell { grid-template-columns: 1fr; padding-top: 35px; } .error-visual { min-height: 390px; } .orbit-one { width: 340px; height: 340px; } .orbit-two { width: 240px; height: 240px; } }
</style>
