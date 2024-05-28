import { createRouter, createWebHistory } from 'vue-router'

const HomePage = () => import('./Page/HomePage.vue')
const AboutPage = () => import('./Page/AboutPage.vue')
const ContactPage = () => import('./Page/ContactPage.vue')
const YourselfPage = () => import('./Page/YourselfPage.vue')
const AdvertisingPage = () => import('./Page/AdvertisingPage.vue')
const NetworkPage = () => import('./Page/NetworkPage.vue')
const MontagePage = () => import('./Page/MontagePage.vue')
const RapPage = () => import('./Page/RapPage.vue')
const PrivacyPage = () => import('./Page/PrivacyPage.vue')
const PortfolioPage = () => import('./Page/PortfolioPage.vue')
const NotFound = () => import('./Page/NotFound.vue')

const routes = [
  { path: '/', component: HomePage, name: 'Home' },
  { path: '/About', component: AboutPage, name: 'About' },
  { path: '/Contact', component: ContactPage, name: 'Contact' },
  { path: '/Yourself', component: YourselfPage, name: 'Yourself' },
  { path: '/Advertising', component: AdvertisingPage, name: 'Advertising' },
  { path: '/Network', component: NetworkPage, name: 'Network' },
  { path: '/Montage', component: MontagePage, name: 'Montage' },
  { path: '/Rap', component: RapPage, name: 'Rap' },
  { path: '/Privacy', component: PrivacyPage, name: 'Privacy' },
  { path: '/Portfolio', component: PortfolioPage, name: 'Portfolio' },
  { path: '/:catchAll(.*)', component: NotFound, name: 'NotFound' }
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

export default router
