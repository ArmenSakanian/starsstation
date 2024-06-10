import { createApp } from 'vue'
import App from './App.vue'
import { createI18n } from 'vue-i18n'
import router from './router'
import AOS from 'aos'
import 'aos/dist/aos.css'

import en from './locales/en.json'
import fr from './locales/fr.json'
import de from './locales/de.json'
import it from './locales/it.json'  // добавляем итальянский язык

// Функция для определения языка по местоположению
async function getLanguageByLocation() {
  try {
    const response = await fetch('https://ipapi.co/json/');
    const data = await response.json();
    const countryCode = data.country_code;

    // Сопоставление страны с языком
    const countryToLanguageMap = {
      FR: 'fr',
      DE: 'de',
      IT: 'it',  // добавляем Италию
      US: 'en',
      GB: 'en'
      // добавьте больше сопоставлений по необходимости
    };

    return countryToLanguageMap[countryCode] || 'fr';
  } catch (error) {
    console.error('Error fetching location data:', error);
    return 'fr'; // если не удаётся определить местоположение, используем французский по умолчанию
  }
}

async function determineLanguage() {
  const savedLanguage = localStorage.getItem('language');
  if (savedLanguage) {
    return savedLanguage;
  }

  const supportedLanguages = ['en', 'fr', 'de', 'it'];  // добавляем итальянский в поддерживаемые языки
  const browserLanguage = (navigator.language || navigator.userLanguage).split('-')[0];
  if (supportedLanguages.includes(browserLanguage)) {
    return browserLanguage;
  }

  const locationLanguage = await getLanguageByLocation();
  return locationLanguage;
}

(async () => {
  const locale = await determineLanguage();

  const i18n = createI18n({
    locale,
    fallbackLocale: 'fr',
    messages: {
      en,
      fr,
      de,
      it  // добавляем итальянский язык
    }
  });

  const app = createApp(App);
  app.use(router);
  app.use(i18n);

  AOS.init({
    duration: 1200,
  });

  app.mount('#app');
})();
