import { createRouter, createWebHistory } from 'vue-router';
import HomePage from './Page/HomePage.vue';
import AboutPage from './Page/AboutPage.vue';
import ContactPage from './Page/ContactPage.vue';
import MontagePage from './Page/MontagePage.vue';
import NetworkPage from './Page/NetworkPage.vue';

const routes = [
  { path: '/', component: HomePage, name: 'home' },
  { path: '/about', component: AboutPage, name: 'about' },
  { path: '/contact', component: ContactPage, name: 'contact' },
  { path: '/montage', component: MontagePage, name: 'montage' },
  { path: '/network', component: NetworkPage, name: 'network' }
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
