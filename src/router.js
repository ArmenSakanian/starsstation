import { createRouter, createWebHistory } from 'vue-router';
import HomePage from './Page/HomePage.vue';
import AboutPage from './Page/AboutPage.vue';
import ContactPage from './Page/ContactPage.vue';
import YourselfPage from './Page/YourselfPage.vue';
import AdvertisingPage from './Page/AdvertisingPage.vue';
import NetworkPage from './Page/NetworkPage.vue';
import MontagePage from './Page/MontagePage.vue';
import RapPage from './Page/RapPage.vue';

const routes = [
  { path: '/', component: HomePage, name: 'Home' },
  { path: '/About', component: AboutPage, name: 'About' },
  { path: '/Contact', component: ContactPage, name: 'Contact' },
  { path: '/Yourself', component: YourselfPage, name: 'Yourself' },
  { path: '/Advertising', component: AdvertisingPage, name: 'Advertising' },
  { path: '/Network', component: NetworkPage, name: 'Network' },
  { path: '/Montage', component: MontagePage, name: 'Montage' },
  { path: '/Rap', component: RapPage, name: 'Rap' }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    // Специальное поведение прокрутки для определённых маршрутов
    if (to.name === 'contact' || to.name === 'montage') {
      return savedPosition ? savedPosition : { top: 0 };
    }
    

    // Для всех остальных маршрутов сохраняем текущее положение прокрутки
    return savedPosition;
  }
});

export default router;
