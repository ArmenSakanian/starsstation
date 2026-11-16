<template>
  <transition name="float-button">
    <button v-if="visible" class="scroll-top" type="button" @click="scrollToTop" aria-label="Scroll to top">
      <span class="progress-ring" :style="{ '--scroll': `${progress * 360}deg` }"></span>
      <i class="fa-solid fa-arrow-up"></i>
    </button>
  </transition>
</template>

<script>
export default {
  name: 'ScrollToTop',
  data() { return { visible: false, progress: 0 }; },
  mounted() { window.addEventListener('scroll', this.onScroll, { passive: true }); this.onScroll(); },
  beforeUnmount() { window.removeEventListener('scroll', this.onScroll); },
  methods: {
    onScroll() {
      const total = document.documentElement.scrollHeight - window.innerHeight;
      this.visible = window.scrollY > 500;
      this.progress = total > 0 ? Math.min(1, window.scrollY / total) : 0;
    },
    scrollToTop() { window.scrollTo({ top: 0, behavior: 'smooth' }); }
  }
};
</script>

<style scoped>
.scroll-top { position: fixed; right: 24px; bottom: 24px; z-index: 900; width: 52px; height: 52px; border: 1px solid var(--line); border-radius: 16px; display: grid; place-items: center; background: rgba(9,11,18,.82); color: #fff; cursor: pointer; box-shadow: 0 12px 35px rgba(0,0,0,.32); backdrop-filter: blur(16px); overflow: hidden; }
.progress-ring { position: absolute; inset: -1px; border-radius: inherit; background: conic-gradient(var(--accent-2) var(--scroll), transparent 0); opacity: .75; mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0); -webkit-mask-composite: xor; mask-composite: exclude; padding: 1px; }
.scroll-top i { position: relative; z-index: 1; }
.float-button-enter-active, .float-button-leave-active { transition: opacity .25s ease, transform .25s ease; }
.float-button-enter-from, .float-button-leave-to { opacity: 0; transform: translateY(12px) scale(.9); }
@media (max-width: 600px) { .scroll-top { right: 14px; bottom: 14px; } }
</style>
