import { createApp } from 'vue'
import App from './App.vue'
import { createI18n } from 'vue-i18n'
import router from './router'
import AOS from 'aos'
import 'aos/dist/aos.css'

import en from './locales/en.json'
import fr from './locales/fr.json'
import de from './locales/de.json'

const savedLanguage = localStorage.getItem('language') || 'en';

const supportedLanguages = ['en', 'fr', 'de'];

const browserLanguage = (navigator.language || navigator.userLanguage).split('-')[0];
const defaultLanguage = supportedLanguages.includes(browserLanguage) ? browserLanguage : 'en';

const i18n = createI18n({
  locale: savedLanguage || defaultLanguage, 
  fallbackLocale: 'en', 
  messages: {
    en,
    fr,
    de
  }
});

const app = createApp(App)
app.use(router)
app.use(i18n)

AOS.init({
  duration: 1200, 
});

app.mount('#app')
