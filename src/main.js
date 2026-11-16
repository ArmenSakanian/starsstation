import { createApp } from 'vue';
import App from './App.vue';
import { createI18n } from 'vue-i18n';
import router from './router';
import AOS from 'aos';
import 'aos/dist/aos.css';
import './styles/global.css';

import en from './locales/en.json';
import fr from './locales/fr.json';
import de from './locales/de.json';
import it from './locales/it.json';

const supportedLanguages = ['en', 'fr', 'de', 'it'];

function determineLanguage() {
  const saved = localStorage.getItem('language');
  if (supportedLanguages.includes(saved)) return saved;

  const browserLanguage = (navigator.language || 'fr').split('-')[0].toLowerCase();
  return supportedLanguages.includes(browserLanguage) ? browserLanguage : 'fr';
}

const i18n = createI18n({
  legacy: true,
  locale: determineLanguage(),
  fallbackLocale: 'fr',
  messages: { en, fr, de, it }
});

document.documentElement.lang = i18n.global.locale;

const app = createApp(App);
app.use(router);
app.use(i18n);
app.mount('#app');

router.afterEach(() => {
  setTimeout(() => AOS.refreshHard(), 80);
});

AOS.init({
  duration: 800,
  easing: 'ease-out-cubic',
  once: true,
  offset: 60,
  disable: window.matchMedia('(prefers-reduced-motion: reduce)').matches
});
