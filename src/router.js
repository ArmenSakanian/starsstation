import { createRouter, createWebHistory } from 'vue-router'

const HomePage = () => import('./Page/HomePage.vue')
const AboutPage = () => import('./Page/AboutPage.vue')
const ContactPage = () => import('./Page/ContactPage.vue')
const PrivacyPage = () => import('./Page/PrivacyPage.vue')
const PortfolioPage = () => import('./Page/PortfolioPage.vue')
const NotFound = () => import('./Page/NotFound.vue')

const routes = [
  { path: '/', component: HomePage, name: 'Home', meta: { title: 'Stars Station Studio' } },
  { path: '/About', component: AboutPage, name: 'About', meta: { title: 'About' } },
  { path: '/Contact', component: ContactPage, name: 'Contact', meta: { title: 'Contact' } },
  { path: '/Privacy', component: PrivacyPage, name: 'Privacy', meta: { title: 'Privacy' } },
  { path: '/Portfolio', component: PortfolioPage, name: 'Portfolio', meta: { title: 'Portfolio' } },
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

export default router

