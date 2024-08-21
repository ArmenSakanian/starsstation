import { createRouter, createWebHistory } from 'vue-router'

const HomePage = () => import('./pages/HomePage.vue')
const AboutPage = () => import('./pages/AboutPage.vue')
const PrivacyPage = () => import('./pages/PrivacyPage.vue')
const PortfolioPage = () => import('./pages/PortfolioPage.vue')
const YourselfPage = () => import ('./pages/YourselfPage.vue')
const NotFound = () => import('./pages/NotFound.vue')
const ImgPage = () => import('./pages/ImgPage.vue')

const routes = [
  { path: '/', component: HomePage, name: 'Home', meta: { title: 'Stars Station Studio' } },
  { path: '/About', component: AboutPage, name: 'About', meta: { title: 'About' } },
  { path: '/Privacy', component: PrivacyPage, name: 'Privacy', meta: { title: 'Privacy' } },
  { path: '/Portfolio', component: PortfolioPage, name: 'Portfolio', meta: { title: 'Portfolio' } },
  { path: '/Yourself', component: YourselfPage, name: 'YourselfPage', meta: { title: 'Yourself' } },
  { path: '/ImgPage', component: ImgPage, name: 'ImgPage', meta: { title: 'Img Page' } },
  { path: '/:catchAll(.*)', component: NotFound, name: 'NotFound', meta: { title: 'Not Found' } }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior (to) {
    if (to.name === 'Home') {
      return false // Оставляем прокрутку как есть для домашней страницы
    } else {
      return { top: 0 } // Сбрасываем прокрутку для всех остальных страниц
    }
  }
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title || 'Default Title';
  next();
})

router.afterEach((to) => {
  if (to.name === 'Home' && to.query.scrollToId) {
    const scrollToId = to.query.scrollToId;
    setTimeout(() => {
      const element = document.getElementById(scrollToId);
      if (element) {
        const yOffset = -50;
        const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
        window.scrollTo({ top: y, behavior: 'smooth' });

        // Удаляем параметр scrollToId из URL
        const url = new URL(window.location);
        url.searchParams.delete('scrollToId');
        window.history.replaceState({}, '', url);
      }
    }, 300); // Задержка для уверенности в полной загрузке страницы
  }
});

export default router
