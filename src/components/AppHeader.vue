<template>
  <header class="site-header" :class="{ 'site-header--compact': isScrolled }">
    <div class="header-inner">
      <router-link to="/" class="brand" aria-label="Stars Station Studio">
        <img src="@/assets/logo/Logo-Full_white.svg" alt="Stars Station Studio" />
      </router-link>

      <nav class="desktop-nav" aria-label="Main navigation">
        <router-link to="/">{{ $t('home') }}</router-link>
        <router-link to="/about">{{ $t('about') }}</router-link>
        <button type="button" @click="goToSection('service')">{{ $t('service') }}</button>
        <router-link to="/portfolio">{{ $t('our_videos') }}</router-link>
        <router-link to="/imagine-yourself">{{ $t('imagine_yourself') }}</router-link>
        <button type="button" @click="goToSection('feedback')">{{ $t('contact') }}</button>
      </nav>

      <div class="header-actions">
        <div class="language-wrap" ref="languageWrap">
          <button class="language-trigger" type="button" @click="languageOpen = !languageOpen" :aria-expanded="languageOpen">
            <img :src="flags[$i18n.locale]" alt="" />
            <span>{{ $i18n.locale.toUpperCase() }}</span>
            <i class="fa-solid fa-chevron-down" :class="{ rotated: languageOpen }"></i>
          </button>
          <transition name="dropdown">
            <div v-if="languageOpen" class="language-menu">
              <button v-for="lang in availableLanguages" :key="lang" type="button" :class="{ active: lang === $i18n.locale }" @click="changeLanguage(lang)">
                <img :src="flags[lang]" alt="" />
                <span>{{ languageNames[lang] }}</span>
                <i v-if="lang === $i18n.locale" class="fa-solid fa-check"></i>
              </button>
            </div>
          </transition>
        </div>

        <button class="contact-cta" type="button" @click="isModalOpen = true">
          <span>{{ $t('contact_us') }}</span>
          <i class="fa-solid fa-arrow-right"></i>
        </button>

        <button class="menu-toggle" type="button" @click="toggleMenu" :aria-expanded="menuOpen" aria-label="Menu">
          <span></span><span></span>
        </button>
      </div>
    </div>

    <transition name="mobile-menu">
      <div v-if="menuOpen" class="mobile-panel">
        <router-link to="/" @click="closeMenu">{{ $t('home') }}</router-link>
        <router-link to="/about" @click="closeMenu">{{ $t('about') }}</router-link>
        <button type="button" @click="goToSection('service')">{{ $t('service') }}</button>
        <router-link to="/portfolio" @click="closeMenu">{{ $t('our_videos') }}</router-link>
        <router-link to="/imagine-yourself" @click="closeMenu">{{ $t('imagine_yourself') }}</router-link>
        <button class="mobile-contact" type="button" @click="openContactFromMenu">{{ $t('contact_us') }}</button>
      </div>
    </transition>

    <ContactModal :is-visible="isModalOpen" @close="isModalOpen = false" />
  </header>
</template>

<script>
import ContactModal from './ContactModal.vue';
import fr from '@/assets/icon/fr.svg';
import en from '@/assets/icon/en.svg';
import de from '@/assets/icon/de.svg';
import it from '@/assets/icon/it.svg';

export default {
  name: 'AppHeader',
  components: { ContactModal },
  data() {
    return {
      isScrolled: false,
      menuOpen: false,
      languageOpen: false,
      isModalOpen: false,
      availableLanguages: ['fr', 'en', 'de', 'it'],
      languageNames: { fr: 'Français', en: 'English', de: 'Deutsch', it: 'Italiano' },
      flags: { fr, en, de, it }
    };
  },
  mounted() {
    window.addEventListener('scroll', this.onScroll, { passive: true });
    document.addEventListener('click', this.onOutsideClick);
    this.onScroll();
  },
  beforeUnmount() {
    window.removeEventListener('scroll', this.onScroll);
    document.removeEventListener('click', this.onOutsideClick);
    document.body.style.overflow = '';
  },
  methods: {
    onScroll() { this.isScrolled = window.scrollY > 28; },
    onOutsideClick(event) {
      if (this.$refs.languageWrap && !this.$refs.languageWrap.contains(event.target)) this.languageOpen = false;
    },
    changeLanguage(lang) {
      this.$i18n.locale = lang;
      localStorage.setItem('language', lang);
      document.documentElement.lang = lang;
      this.languageOpen = false;
    },
    toggleMenu() {
      this.menuOpen = !this.menuOpen;
      document.body.style.overflow = this.menuOpen ? 'hidden' : '';
    },
    closeMenu() {
      this.menuOpen = false;
      document.body.style.overflow = '';
    },
    openContactFromMenu() {
      this.closeMenu();
      this.isModalOpen = true;
    },
    goToSection(id) {
      this.closeMenu();
      if (this.$route.name === 'Home') {
        document.getElementById(id)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
      } else {
        this.$router.push({ name: 'Home', query: { scrollToId: id } });
      }
    }
  }
};
</script>

<style scoped>
.site-header {
  position: fixed;
  inset: 0 0 auto;
  z-index: 1000;
  padding: 18px 34px 0;
  transition: padding .35s ease;
}
.header-inner {
  width: min(1540px, 100%);
  min-height: 70px;
  margin: 0 auto;
  padding: 0 10px;
  display: flex;
  align-items: center;
  gap: 34px;
  border: 1px solid transparent;
  border-radius: 22px;
  transition: min-height .35s ease, background .35s ease, border-color .35s ease, box-shadow .35s ease, padding .35s ease;
}
.site-header--compact { padding-top: 10px; }
.site-header--compact .header-inner {
  min-height: 62px;
  padding: 0 12px 0 18px;
  background: rgba(5, 12, 20, .80);
  border-color: rgba(255,255,255,.10);
  box-shadow: 0 14px 50px rgba(0,0,0,.22);
  backdrop-filter: blur(22px) saturate(140%);
}
.brand { display: flex; align-items: center; flex-shrink: 0; }
.brand img { width: 176px; display: block; }
.desktop-nav { display: flex; align-items: center; justify-content: center; gap: 2px; margin-left: auto; }
.desktop-nav a,
.desktop-nav button {
  position: relative;
  border: 0;
  background: transparent;
  color: rgba(255,255,255,.86);
  text-decoration: none;
  cursor: pointer;
  padding: 12px 13px;
  font-size: 12px;
  font-weight: 500;
  white-space: nowrap;
  transition: color .25s ease;
}
.desktop-nav a::after,
.desktop-nav button::after {
  content: "";
  position: absolute;
  left: 13px;
  right: 13px;
  bottom: 5px;
  height: 1px;
  background: #fff;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform .25s ease;
}
.desktop-nav a:hover,
.desktop-nav button:hover,
.desktop-nav a.router-link-exact-active { color: #fff; }
.desktop-nav a:hover::after,
.desktop-nav button:hover::after,
.desktop-nav a.router-link-exact-active::after { transform: scaleX(1); }
.header-actions { display: flex; align-items: center; gap: 10px; }
.language-wrap { position: relative; }
.language-trigger {
  height: 42px;
  min-width: 86px;
  padding: 0 13px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  border: 1px solid rgba(255,255,255,.14);
  border-radius: 999px;
  background: rgba(255,255,255,.075);
  color: #fff;
  cursor: pointer;
  font-size: 12px;
  font-weight: 600;
  backdrop-filter: blur(14px);
}
.language-trigger img { width: 18px; height: 12px; object-fit: cover; border-radius: 2px; }
.language-trigger i { font-size: 9px; opacity: .72; transition: transform .25s ease; }
.language-trigger i.rotated { transform: rotate(180deg); }
.language-menu {
  position: absolute;
  top: calc(100% + 11px);
  right: 0;
  width: 190px;
  padding: 8px;
  border: 1px solid var(--line);
  border-radius: 18px;
  background: rgba(6, 14, 23, .96);
  box-shadow: 0 22px 60px rgba(0,0,0,.34);
  backdrop-filter: blur(22px);
}
.language-menu button {
  width: 100%;
  min-height: 42px;
  display: grid;
  grid-template-columns: 22px 1fr 14px;
  align-items: center;
  gap: 9px;
  padding: 0 10px;
  border: 0;
  border-radius: 11px;
  background: transparent;
  color: #fff;
  cursor: pointer;
  text-align: left;
  font-size: 12px;
}
.language-menu button:hover,
.language-menu button.active { background: rgba(255,255,255,.07); }
.language-menu img { width: 18px; height: 12px; object-fit: cover; border-radius: 2px; }
.language-menu i { color: var(--accent-2); font-size: 10px; }
.contact-cta {
  height: 42px;
  min-width: 154px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 13px;
  padding: 0 18px;
  border: 1px solid rgba(255,255,255,.26);
  border-radius: 999px;
  background: linear-gradient(110deg, #5f52ff 0%, #6b5eff 50%, #5eb7ff 100%);
  color: #fff;
  cursor: pointer;
  font-size: 12px;
  font-weight: 600;
  box-shadow: 0 10px 28px rgba(72, 92, 255, .28), inset 0 1px 0 rgba(255,255,255,.22);
  transition: transform .25s ease, box-shadow .25s ease;
}
.contact-cta:hover { transform: translateY(-2px); box-shadow: 0 16px 38px rgba(72, 92, 255, .40); }
.contact-cta i { font-size: 10px; }
.menu-toggle {
  display: none;
  width: 44px;
  height: 44px;
  border: 1px solid rgba(255,255,255,.17);
  border-radius: 50%;
  background: rgba(255,255,255,.06);
  cursor: pointer;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  gap: 6px;
  backdrop-filter: blur(14px);
}
.menu-toggle span { width: 18px; height: 1.5px; background: #fff; }
.mobile-panel {
  position: absolute;
  top: 88px;
  left: 20px;
  right: 20px;
  padding: 14px;
  border: 1px solid var(--line);
  border-radius: 24px;
  background: rgba(5,12,20,.96);
  box-shadow: 0 24px 70px rgba(0,0,0,.42);
  backdrop-filter: blur(24px);
  display: grid;
  gap: 4px;
}
.mobile-panel a,
.mobile-panel button {
  width: 100%;
  padding: 15px 14px;
  border: 0;
  border-radius: 14px;
  background: transparent;
  color: #fff;
  text-decoration: none;
  text-align: left;
  font-size: 17px;
  cursor: pointer;
}
.mobile-panel a:hover,
.mobile-panel button:hover { background: rgba(255,255,255,.055); }
.mobile-panel .mobile-contact {
  margin-top: 7px;
  text-align: center;
  background: linear-gradient(110deg, #5f52ff, #5eb7ff);
  font-weight: 600;
}
.dropdown-enter-active, .dropdown-leave-active { transition: opacity .2s ease, transform .2s ease; }
.dropdown-enter-from, .dropdown-leave-to { opacity: 0; transform: translateY(-6px) scale(.98); }
.mobile-menu-enter-active, .mobile-menu-leave-active { transition: opacity .25s ease, transform .25s ease; }
.mobile-menu-enter-from, .mobile-menu-leave-to { opacity: 0; transform: translateY(-10px) scale(.985); }

@media (max-width: 1220px) {
  .desktop-nav a, .desktop-nav button { padding-left: 9px; padding-right: 9px; }
  .brand img { width: 156px; }
  .contact-cta { min-width: 132px; padding: 0 14px; }
}
@media (max-width: 1050px) {
  .desktop-nav, .contact-cta { display: none; }
  .header-actions { margin-left: auto; }
  .menu-toggle { display: flex; }
}
@media (max-width: 560px) {
  .site-header { padding: 10px 10px 0; }
  .header-inner,
  .site-header--compact .header-inner { min-height: 58px; padding: 0 8px 0 12px; border-radius: 18px; }
  .brand img { width: 134px; }
  .language-trigger { min-width: 75px; height: 40px; padding: 0 10px; }
  .language-trigger img { width: 17px; }
  .menu-toggle { width: 40px; height: 40px; }
  .mobile-panel { top: 76px; left: 10px; right: 10px; }
}
</style>
