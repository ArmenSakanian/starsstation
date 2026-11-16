<template>
  <div class="portfolio-page page-top">
    <section class="page-shell portfolio-hero">
      <div data-aos="fade-up">
        <span class="eyebrow">{{ $t('portfolio_kicker') }}</span>
        <h1 class="display-title gradient-text">{{ $t('our_videos') }}</h1>
      </div>
      <p class="lead" data-aos="fade-up" data-aos-delay="100">{{ $t('video_description') }}</p>
    </section>

    <section class="page-shell portfolio-grid section-space">
      <article v-for="(video, index) in videos" :key="video.title" class="work-card" data-aos="fade-up" :data-aos-delay="(index % 3) * 80" @click="openVideo(video)">
        <div class="thumb-wrap">
          <img :src="video.thumbnail" :alt="video.title" loading="lazy" />
          <div class="thumb-overlay"></div>
          <button type="button" class="play-btn" :aria-label="`Play ${video.title}`"><i class="fa-solid fa-play"></i></button>
          <span class="work-index">0{{ index + 1 }}</span>
        </div>
        <div class="work-meta">
          <h2>{{ video.title }}</h2>
          <span>{{ $t('video_production_label') }} <i class="fa-solid fa-arrow-up-right"></i></span>
        </div>
      </article>
    </section>

    <teleport to="body">
      <transition name="video-modal">
        <div v-if="selectedVideo" class="modal-backdrop" @click.self="closeVideo">
          <div class="video-dialog glass" role="dialog" aria-modal="true" :aria-label="selectedVideo.title">
            <div class="dialog-head">
              <div><small>{{ $t('portfolio_kicker') }}</small><strong>{{ selectedVideo.title }}</strong></div>
              <button type="button" @click="closeVideo" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <video ref="videoPlayer" :src="selectedVideo.src" controls autoplay playsinline @play="isPlaying = true" @pause="isPlaying = false"></video>
          </div>
        </div>
      </transition>
    </teleport>
  </div>
</template>

<script>
export default {
  name: 'PortfolioPage',
  data() {
    return {
      selectedVideo: null,
      isPlaying: false,
      videos: [
        { src: require('@/assets/video/Barber Dodo.mp4'), thumbnail: require('@/assets/thumbnails/Barber Dodo.png'), title: 'Barber Dodo' },
        { src: require('@/assets/video/KFC - Conthey.mp4'), thumbnail: require('@/assets/thumbnails/KFC - Conthey.png'), title: 'KFC - Conthey' },
        { src: require('@/assets/video/Restaurant Best Food Faryab.mp4'), thumbnail: require('@/assets/thumbnails/Restaurant Best Food Faryab.png'), title: 'Restaurant Best Food Faryab' },
        { src: require('@/assets/video/Restaurant Il Pulcinella.mp4'), thumbnail: require('@/assets/thumbnails/Restaurant Il Pulcinella.png'), title: 'Restaurant Il Pulcinella' },
        { src: require('@/assets/video/Restaurant Pizzeria de Valère.mp4'), thumbnail: require('@/assets/thumbnails/Restaurant Pizzeria de Valère.png'), title: 'Restaurant Pizzeria de Valère' },
        { src: require('@/assets/video/Tennis Club de Valère.mp4'), thumbnail: require('@/assets/thumbnails/Tennis Club de Valère.png'), title: 'Tennis Club de Valère' }
      ]
    };
  },
  mounted() { window.addEventListener('keydown', this.onKeydown); },
  beforeUnmount() { window.removeEventListener('keydown', this.onKeydown); document.body.style.overflow = ''; },
  methods: {
    openVideo(video) { this.selectedVideo = video; document.body.style.overflow = 'hidden'; },
    closeVideo() { if (this.$refs.videoPlayer) this.$refs.videoPlayer.pause(); this.selectedVideo = null; document.body.style.overflow = ''; },
    onKeydown(event) { if (event.key === 'Escape' && this.selectedVideo) this.closeVideo(); }
  }
};
</script>

<style scoped>
.portfolio-page { overflow: hidden; }
.portfolio-hero { min-height: 430px; padding-top: 65px; display: grid; grid-template-columns: 1.15fr .85fr; align-items: end; gap: 60px; border-bottom: 1px solid var(--line); padding-bottom: 70px; }
.portfolio-hero h1 { margin-top: 24px; }
.portfolio-hero .lead { max-width: 540px; justify-self: end; }
.portfolio-grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 18px; }
.work-card { grid-column: span 6; cursor: pointer; }
.work-card:nth-child(3n) { grid-column: span 7; }
.work-card:nth-child(3n + 1):not(:first-child) { grid-column: span 5; }
.thumb-wrap { position: relative; aspect-ratio: 16 / 10; overflow: hidden; border: 1px solid var(--line); border-radius: 27px; background: var(--surface-strong); }
.thumb-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .7s cubic-bezier(.2,.8,.2,1), filter .5s ease; }
.thumb-overlay { position: absolute; inset: 0; background: linear-gradient(0deg, rgba(5,6,10,.72), transparent 58%); opacity: .65; transition: opacity .3s ease; }
.work-card:hover .thumb-wrap img { transform: scale(1.045); filter: saturate(1.1); }
.work-card:hover .thumb-overlay { opacity: .85; }
.play-btn { position: absolute; inset: 50% auto auto 50%; transform: translate(-50%,-50%); width: 66px; height: 66px; border: 1px solid rgba(255,255,255,.22); border-radius: 50%; background: rgba(8,10,16,.58); color: #fff; cursor: pointer; backdrop-filter: blur(14px); transition: transform .3s ease, background .3s ease; }
.work-card:hover .play-btn { transform: translate(-50%,-50%) scale(1.09); background: rgba(124,92,255,.72); }
.work-index { position: absolute; left: 18px; top: 18px; padding: 7px 9px; border-radius: 9px; background: rgba(5,6,10,.62); color: #d9deea; backdrop-filter: blur(10px); font-size: 10px; letter-spacing: .12em; }
.work-meta { display: flex; justify-content: space-between; align-items: center; gap: 20px; padding: 16px 5px 28px; }
.work-meta h2 { font-size: clamp(20px, 2.4vw, 29px); letter-spacing: -.035em; }
.work-meta span { color: #6f7890; font-size: 11px; white-space: nowrap; }
.work-meta i { margin-left: 5px; }
.modal-backdrop { position: fixed; inset: 0; z-index: 5000; padding: 20px; display: grid; place-items: center; background: rgba(2,3,7,.88); backdrop-filter: blur(18px); }
.video-dialog { width: min(1100px, 100%); padding: 12px; border-radius: 28px; background: rgba(8,10,17,.94); }
.dialog-head { min-height: 68px; padding: 5px 6px 10px 12px; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
.dialog-head div { display: grid; gap: 4px; }
.dialog-head small { color: #707990; font-size: 9px; text-transform: uppercase; letter-spacing: .14em; }
.dialog-head strong { font-size: 16px; }
.dialog-head button { width: 44px; height: 44px; border: 1px solid var(--line); border-radius: 13px; background: rgba(255,255,255,.05); color: #fff; cursor: pointer; }
.video-dialog video { width: 100%; max-height: calc(100vh - 140px); display: block; border-radius: 20px; background: #000; }
.video-modal-enter-active, .video-modal-leave-active { transition: opacity .25s ease; }
.video-modal-enter-active .video-dialog, .video-modal-leave-active .video-dialog { transition: transform .3s cubic-bezier(.2,.8,.2,1), opacity .25s ease; }
.video-modal-enter-from, .video-modal-leave-to { opacity: 0; }
.video-modal-enter-from .video-dialog, .video-modal-leave-to .video-dialog { transform: scale(.96) translateY(16px); opacity: 0; }
@media (max-width: 900px) { .portfolio-hero { grid-template-columns: 1fr; align-items: start; gap: 24px; } .portfolio-hero .lead { justify-self: start; } .work-card, .work-card:nth-child(3n), .work-card:nth-child(3n + 1):not(:first-child) { grid-column: span 6; } }
@media (max-width: 650px) { .portfolio-hero { min-height: 360px; padding-top: 40px; } .portfolio-grid { grid-template-columns: 1fr; } .work-card, .work-card:nth-child(3n), .work-card:nth-child(3n + 1):not(:first-child) { grid-column: auto; } .work-meta { align-items: flex-start; flex-direction: column; gap: 6px; } .play-btn { width: 56px; height: 56px; } }
</style>

<style scoped>
/* Cinematic design-system alignment */
.portfolio-page { background: #07101a; }
.work-card { border-radius: 10px; }
.thumb-wrap { border: 1px solid rgba(255,255,255,.17); border-radius: 10px; overflow: hidden; }
.work-meta h2 { font-family: var(--font-display); font-weight: 500; letter-spacing: -.02em; }
.work-index { border-radius: 999px; background: rgba(5,12,20,.58); }
.play-btn { background: rgba(5,12,20,.44); }
.work-card:hover .play-btn { background: rgba(100,92,255,.62); }
.video-dialog { border-radius: 12px; }
.video-dialog video { border-radius: 8px; }
</style>
