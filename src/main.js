import { createApp } from 'vue';
import App from './App.vue';
import { createI18n } from 'vue-i18n';
import router from './router';
import FontAwesomeIcon from './font-awesome';

// Импорт переводов
import en from './locales/en.json';
import fr from './locales/fr.json';
import de from './locales/de.json';

// Получение сохранённого языка из localStorage
const savedLanguage = localStorage.getItem('language');

// Поддерживаемые языки
const supportedLanguages = ['en', 'fr', 'de'];
// Определение языка браузера или использование сохранённого языка
const browserLanguage = (navigator.language || navigator.userLanguage).split('-')[0];
const defaultLanguage = supportedLanguages.includes(browserLanguage) ? browserLanguage : 'en';

const i18n = createI18n({
  locale: savedLanguage || defaultLanguage, // Использование сохранённого языка или языка браузера
  fallbackLocale: 'en', // Язык, который будет использоваться, если не найден перевод
  messages: {
    en,
    fr,
    de
  }
});

const app = createApp(App);
app.use(router);
app.use(i18n);
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app');
