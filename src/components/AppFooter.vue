<template>
  <footer class="footer">
    <div class="page-shell footer-card glass">
      <div class="footer-main">
        <div class="brand-column">
          <img src="@/assets/logo/Logo-Full_white-reverse.svg" alt="Stars Station Studio" class="logo" />
          <p>{{ $t('video_description') }}</p>
          <div class="socials">
            <a v-if="contacts.socials.facebook.url && contacts.socials.facebook.url !== contacts.socials.instagram.url" :href="contacts.socials.facebook.url" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a :href="contacts.socials.instagram.url" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a :href="contacts.socials.youtube.url" target="_blank" rel="noopener" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          </div>
        </div>

        <div class="links-column">
          <span class="column-label">{{ $t('nav_label') }}</span>
          <router-link to="/about">{{ $t('about') }}</router-link>
          <button type="button" @click="goTo('service')">{{ $t('service') }}</button>
          <router-link to="/portfolio">{{ $t('our_videos') }}</router-link>
          <router-link to="/privacy">{{ $t('privacy_policy_title') }}</router-link>
        </div>

        <div class="newsletter-column">
          <span class="column-label">{{ $t('newsletter') }}</span>
          <h3>{{ $t('newsletter_text') }}</h3>
          <form @submit.prevent="subscribe">
            <label class="newsletter-input">
              <i class="fa-regular fa-envelope"></i>
              <input v-model.trim="email" type="email" placeholder="Email" required autocomplete="email" />
              <button type="submit" :disabled="submitting" :aria-label="$t('send')">
                <i :class="submitting ? 'fa-solid fa-spinner fa-spin' : 'fa-solid fa-arrow-right'"></i>
              </button>
            </label>
          </form>
        </div>
      </div>

      <div class="footer-bottom">
        <div>
          <a :href="`mailto:${contacts.email}`">{{ contacts.email }}</a>
          <span>·</span>
          <a :href="`tel:${contacts.phone}`">{{ contacts.phone }}</a>
        </div>
        <p>© {{ year }} Stars Station Studio. {{ $t('rights_reserved') }}</p>
      </div>
    </div>
  </footer>
</template>

<script>
import contacts from '@/contacts.json';

export default {
  name: 'AppFooter',
  data() {
    return { contacts, email: '', csrfToken: '', submitting: false, year: new Date().getFullYear() };
  },
  methods: {
    goTo(id) {
      if (this.$route.name === 'Home') document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
      else this.$router.push({ name: 'Home', query: { scrollToId: id } });
    },
    async ensureCsrf() {
      if (this.csrfToken) return this.csrfToken;
      const response = await fetch('/get_csrf_token.php', { credentials: 'same-origin' });
      const data = await response.json();
      this.csrfToken = data.token;
      return this.csrfToken;
    },
    async subscribe() {
      if (!this.email || this.submitting) return;
      this.submitting = true;
      try {
        const csrf = await this.ensureCsrf();
        const body = new URLSearchParams({ email: this.email, csrf_token: csrf, language: this.$i18n.locale });
        const response = await fetch('/subscribe.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8' }, body, credentials: 'same-origin' });
        const data = await response.json();
        if (!response.ok || data.status === 'error') throw new Error(data.message || 'Subscription failed');
        window.Swal?.fire({ icon: 'success', title: this.$t('success_title'), text: this.$t(data.message_id || 'email_added_successfully'), confirmButtonColor: '#7c5cff' });
        this.email = '';
      } catch (error) {
        window.Swal?.fire({ icon: 'error', title: this.$t('error_title'), text: this.$t('subscribe_error'), confirmButtonColor: '#7c5cff' });
      } finally { this.submitting = false; }
    }
  }
};
</script>

<style scoped>
.footer { padding: 30px 0 24px; }
.footer-card { padding: 44px; border-radius: 34px; background: linear-gradient(145deg, rgba(18,21,34,.84), rgba(8,10,16,.82)); }
.footer-main { display: grid; grid-template-columns: 1.1fr .55fr 1fr; gap: 70px; }
.logo { width: 190px; display: block; margin-bottom: 22px; }
.brand-column p { max-width: 390px; color: var(--text-soft); line-height: 1.65; font-size: 14px; }
.socials { display: flex; gap: 9px; margin-top: 24px; }
.socials a { width: 42px; height: 42px; display: grid; place-items: center; border: 1px solid var(--line); border-radius: 13px; text-decoration: none; background: rgba(255,255,255,.04); transition: transform .25s ease, background .25s ease; }
.socials a:hover { transform: translateY(-3px); background: rgba(124,92,255,.14); }
.column-label { display: block; margin-bottom: 18px; color: #747d97; text-transform: uppercase; letter-spacing: .14em; font-size: 11px; font-weight: 700; }
.links-column { display: flex; flex-direction: column; align-items: flex-start; gap: 11px; }
.links-column a, .links-column button { border: 0; background: none; color: #e6e9f3; text-decoration: none; cursor: pointer; font-size: 15px; transition: color .2s ease, transform .2s ease; }
.links-column a:hover, .links-column button:hover { color: var(--accent-2); transform: translateX(3px); }
.newsletter-column h3 { max-width: 420px; margin-bottom: 20px; font-size: clamp(22px, 3vw, 30px); letter-spacing: -.035em; }
.newsletter-input { height: 58px; padding: 6px 6px 6px 17px; display: flex; align-items: center; gap: 10px; border: 1px solid var(--line); border-radius: 17px; background: rgba(255,255,255,.045); }
.newsletter-input > i { color: var(--text-soft); }
.newsletter-input input { min-width: 0; flex: 1; border: 0; outline: none; background: transparent; color: #fff; }
.newsletter-input button { width: 45px; height: 45px; flex-shrink: 0; border: 0; border-radius: 13px; background: linear-gradient(135deg, var(--accent), #4387ff); color: #fff; cursor: pointer; }
.newsletter-input button:disabled { opacity: .6; cursor: wait; }
.footer-bottom { margin-top: 38px; padding-top: 22px; border-top: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; gap: 20px; color: #788097; font-size: 12px; }
.footer-bottom > div { display: flex; gap: 8px; }
.footer-bottom a { text-decoration: none; }
@media (max-width: 900px) { .footer-main { grid-template-columns: 1fr 1fr; gap: 45px; } .newsletter-column { grid-column: 1 / -1; } }
@media (max-width: 600px) { .footer { padding-top: 10px; } .footer-card { padding: 30px 20px; border-radius: 26px; } .footer-main { grid-template-columns: 1fr; gap: 36px; } .newsletter-column { grid-column: auto; } .footer-bottom { align-items: flex-start; flex-direction: column; } .footer-bottom > div { flex-wrap: wrap; } }
</style>

<style scoped>
/* Cinematic design-system alignment */
.footer { padding-top: 54px; background: #050c14; }
.footer-card { border-radius: 12px; background: rgba(255,255,255,.018); box-shadow: none; }
.socials a { border-radius: 50%; }
.newsletter-column h3 { font-family: var(--font-display); font-weight: 500; font-size: clamp(26px, 3.2vw, 36px); letter-spacing: -.025em; }
.newsletter-input { border-radius: 999px; background: rgba(255,255,255,.025); }
.newsletter-input button { border-radius: 50%; background: linear-gradient(135deg, var(--accent), var(--accent-2)); }
</style>
