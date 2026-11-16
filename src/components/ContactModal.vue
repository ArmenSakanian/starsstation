<template>
  <teleport to="body">
    <transition name="modal-fade">
      <div v-if="isVisible" class="modal-overlay" @click.self="close">
        <div class="modal-card glass" role="dialog" aria-modal="true" :aria-label="$t('contact')">
          <button class="close-btn" type="button" @click="close" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
          <div class="modal-orb"></div>
          <span class="eyebrow">Stars Station Studio</span>
          <h2>{{ $t('contact') }}</h2>
          <p class="intro">{{ $t('video_description') }}</p>
          <div class="contact-grid">
            <a :href="`tel:${contacts.phone}`" class="contact-link">
              <span><i class="fa-solid fa-phone"></i></span>
              <div><small>{{ $t('tel') }}</small><strong>{{ contacts.phone }}</strong></div>
            </a>
            <a :href="`mailto:${contacts.email}`" class="contact-link">
              <span><i class="fa-regular fa-envelope"></i></span>
              <div><small>{{ $t('email') }}</small><strong>{{ contacts.email }}</strong></div>
            </a>
          </div>
          <div class="modal-bottom">
            <div class="socials">
              <a v-if="contacts.socials.facebook.url && contacts.socials.facebook.url !== contacts.socials.instagram.url" :href="contacts.socials.facebook.url" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
              <a :href="contacts.socials.instagram.url" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
              <a :href="contacts.socials.youtube.url" target="_blank" rel="noopener"><i class="fa-brands fa-youtube"></i></a>
            </div>
            <button class="primary-btn" type="button" @click="goToForm">{{ $t('feedback') }} <i class="fa-solid fa-arrow-right"></i></button>
          </div>
        </div>
      </div>
    </transition>
  </teleport>
</template>

<script>
import contacts from '@/contacts.json';

export default {
  name: 'ContactModal',
  props: { isVisible: { type: Boolean, default: false } },
  emits: ['close'],
  data() { return { contacts }; },
  watch: {
    isVisible(value) {
      document.body.style.overflow = value ? 'hidden' : '';
      if (value) window.addEventListener('keydown', this.onKeydown);
      else window.removeEventListener('keydown', this.onKeydown);
    }
  },
  beforeUnmount() {
    document.body.style.overflow = '';
    window.removeEventListener('keydown', this.onKeydown);
  },
  methods: {
    close() { this.$emit('close'); },
    onKeydown(event) { if (event.key === 'Escape') this.close(); },
    goToForm() {
      this.close();
      if (this.$route.name === 'Home') setTimeout(() => document.getElementById('feedback')?.scrollIntoView({ behavior: 'smooth' }), 100);
      else this.$router.push({ name: 'Home', query: { scrollToId: 'feedback' } });
    }
  }
};
</script>

<style scoped>
.modal-overlay { position: fixed; inset: 0; z-index: 5000; display: grid; place-items: center; padding: 20px; background: rgba(2,3,8,.78); backdrop-filter: blur(14px); }
.modal-card { position: relative; width: min(650px, 100%); padding: 42px; overflow: hidden; border-radius: 30px; background: linear-gradient(145deg, rgba(20,23,38,.96), rgba(8,10,17,.96)); }
.modal-orb { position: absolute; width: 240px; height: 240px; border-radius: 50%; right: -90px; top: -110px; background: linear-gradient(135deg, var(--accent), var(--accent-2)); filter: blur(18px); opacity: .23; }
.close-btn { position: absolute; right: 18px; top: 18px; z-index: 2; width: 42px; height: 42px; border: 1px solid var(--line); border-radius: 13px; background: rgba(255,255,255,.05); color: #fff; cursor: pointer; }
h2 { margin-top: 24px; font-size: clamp(38px, 7vw, 64px); letter-spacing: -.05em; }
.intro { margin: 14px 0 28px; color: var(--text-soft); line-height: 1.65; max-width: 520px; }
.contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.contact-link { display: flex; align-items: center; gap: 13px; min-width: 0; padding: 16px; border: 1px solid var(--line); border-radius: 18px; background: rgba(255,255,255,.035); text-decoration: none; transition: border-color .25s ease, transform .25s ease; }
.contact-link:hover { transform: translateY(-2px); border-color: rgba(46,230,214,.35); }
.contact-link > span { width: 40px; height: 40px; border-radius: 12px; display: grid; place-items: center; background: rgba(124,92,255,.18); color: #c8bfff; flex-shrink: 0; }
.contact-link div { min-width: 0; display: grid; gap: 3px; }
.contact-link small { color: var(--text-soft); }
.contact-link strong { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 14px; }
.modal-bottom { margin-top: 24px; padding-top: 22px; border-top: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; gap: 20px; }
.socials { display: flex; gap: 9px; }
.socials a { width: 42px; height: 42px; display: grid; place-items: center; border: 1px solid var(--line); border-radius: 13px; text-decoration: none; background: rgba(255,255,255,.04); transition: transform .25s ease, background .25s ease; }
.socials a:hover { transform: translateY(-2px); background: rgba(124,92,255,.14); }
.modal-fade-enter-active, .modal-fade-leave-active { transition: opacity .25s ease; }
.modal-fade-enter-active .modal-card, .modal-fade-leave-active .modal-card { transition: transform .32s cubic-bezier(.2,.8,.2,1), opacity .25s ease; }
.modal-fade-enter-from, .modal-fade-leave-to { opacity: 0; }
.modal-fade-enter-from .modal-card, .modal-fade-leave-to .modal-card { transform: translateY(20px) scale(.96); opacity: 0; }
@media (max-width: 620px) { .modal-card { padding: 30px 20px 22px; border-radius: 24px; } .contact-grid { grid-template-columns: 1fr; } .modal-bottom { align-items: stretch; flex-direction: column; } .primary-btn { width: 100%; } }
</style>
