import { createRouter, createWebHistory } from 'vue-router';

const HomePage = () => import('./pages/HomePage.vue');
const AboutPage = () => import('./pages/AboutPage.vue');
const PrivacyPage = () => import('./pages/PrivacyPage.vue');
const PortfolioPage = () => import('./pages/PortfolioPage.vue');
const NotFound = () => import('./pages/NotFound.vue');
const ImgPage = () => import('./pages/ImgPage.vue');

const routes = [
  { path: '/', component: HomePage, name: 'Home', meta: { title: 'Stars Station Studio' } },
  { path: '/about', alias: '/About', component: AboutPage, name: 'About', meta: { title: 'About — Stars Station Studio' } },
  { path: '/privacy', alias: ['/Privacy', '/privacy-policy'], component: PrivacyPage, name: 'Privacy', meta: { title: 'Privacy — Stars Station Studio' } },
  { path: '/portfolio', alias: '/Portfolio', component: PortfolioPage, name: 'Portfolio', meta: { title: 'Portfolio — Stars Station Studio' } },
  { path: '/imagine-yourself', alias: '/ImgPage', component: ImgPage, name: 'ImgPage', meta: { title: 'Imagine Yourself — Stars Station Studio' } },
  { path: '/:catchAll(.*)', component: NotFound, name: 'NotFound', meta: { title: '404 — Stars Station Studio' } }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) return savedPosition;
    if (to.hash) return { el: to.hash, top: 96, behavior: 'smooth' };
    return { top: 0 };
  }
});

router.afterEach((to) => {
  document.title = to.meta.title || 'Stars Station Studio';
  if (to.name === 'Home' && to.query.scrollToId) {
    requestAnimationFrame(() => {
      setTimeout(() => {
        document.getElementById(to.query.scrollToId)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 250);
    });
  }
});

export default router;
