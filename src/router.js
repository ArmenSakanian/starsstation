import { createRouter, createWebHistory } from 'vue-router';
import HomePage from './Page/HomePage.vue';
import AboutPage from './Page/AboutPage.vue';
import ContactPage from './Page/ContactPage.vue';
import YourselfPage from './Page/YourselfPage.vue';
import AdvertisingPage from './Page/AdvertisingPage.vue';
import NetworkPage from './Page/NetworkPage.vue';
import MontagePage from './Page/MontagePage.vue';
import RapPage from './Page/RapPage.vue';
import NotFound from './Page/NotFound.vue'; // Импортируем компонент NotFound

const routes = [
  { path: '/', component: HomePage, name: 'Home' },
  { path: '/About', component: AboutPage, name: 'About' },
  { path: '/Contact', component: ContactPage, name: 'Contact' },
  { path: '/Yourself', component: YourselfPage, name: 'Yourself' },
  { path: '/Advertising', component: AdvertisingPage, name: 'Advertising' },
  { path: '/Network', component: NetworkPage, name: 'Network' },
  { path: '/Montage', component: MontagePage, name: 'Montage' },
  { path: '/Rap', component: RapPage, name: 'Rap' },
  { path: '/:catchAll(.*)', component: NotFound, name: 'NotFound' } // Добавляем маршрут для несуществующих страниц
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to) {
    if (to.name === 'Home') {
      return false; // Оставляем прокрутку как есть для домашней страницы
    } else {
      return { top: 0 }; // Сбрасываем прокрутку для всех остальных страниц
    }
  }
});

export default router;
