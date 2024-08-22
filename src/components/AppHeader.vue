<template>
  <header :class="headerClass">
    <div class="header-container">
      <router-link to="/">
        <img :src="logoSrc" alt="Logo" class="logo" />
      </router-link>
      <div class="menu_container">
        <nav class="menu" :style="{ left: menuPosition }">
          <div class="header__bottom"></div>
          <ul class="menu-ul">
            <li><router-link to="/about"><a @click="closeMenu()">{{ $t('about') }}</a></router-link></li>
            <li><a to="service" @click="scrollToElement($event, 'service'); closeMenu()">{{ $t('service') }}</a></li>
            <li><a @click="closeMenu()" @click.prevent="openModal">{{ $t('contact') }}</a></li>
            <li><a to="" @click="scrollToElement($event, 'feedback'); closeMenu()">{{ $t('feedback') }}</a></li>
            <li><router-link to="/ImgPage"><a @click="closeMenu()">{{ $t('our_videos') }}</a></router-link></li>
          </ul>
        </nav>
      </div>
      <nav class="language-menu">
        <ul>
          <li class="language">
            <a class="language-active" href="#" @click="toggleLanguageMenu">
              <span class="active-lang">{{ $i18n.locale.toUpperCase() }}</span>
              <i class="fas fa-angle-down" :class="{ rotated: languageMenuOpen }"></i>
            </a>
            <ul class="language-inactive" :class="{ show: languageMenuOpen }">
              <li v-for="lang in filteredLanguages" :key="lang">
                <a href="#" @click="changeLanguage($event, lang)">
                  <span>{{ getLanguageName(lang) }}</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <div class="icon" @click="toggleMenu">
        <svg :class="{ 'active': isMenuOpen }" width="30" height="30" viewBox="0 0 32 42"
          xmlns="http://www.w3.org/2000/svg">
          <g transform="matrix(1,0,0,1,-389.5,-264.004)">
            <g id="arrow_left2">
              <g transform="matrix(1,0,0,1,0,5)">
                <path id="top"
                  d="M390,270L420,270L420,270C420,270 420.195,250.19 405,265C389.805,279.81 390,279.967 390,279.967" />
              </g>
              <g transform="matrix(1,1.22465e-16,1.22465e-16,-1,0.00024296,564.935)">
                <path id="bottom"
                  d="M390,270L420,270L420,270C420,270 420.195,250.19 405,265C389.805,279.81 390,279.967 390,279.967" />
              </g>
              <path id="middle" d="M390,284.967L420,284.967" />
            </g>
          </g>
        </svg>
      </div>
      <ContactModal :isVisible="isModalOpen" @close="closeModal" />
    </div>
  </header>
</template>

<script>
import ContactModal from './ContactModal.vue';

export default {
  name: 'AppHeader',
  components: {
    ContactModal,
  },
  data() {
    return {
      menuPosition: '100%',
      isMenuVisible: false,
      languageMenuOpen: false,
      isModalOpen: false,
      headerClass: 'header-black', // Черный фон по умолчанию
      logoSrc: require('@/assets/logo/Logo-Full_white.svg'), // Логотип по умолчанию (белый)
      availableLanguages: ['en', 'fr', 'de', 'it'] // Доступные языки
    };
  },
  computed: {
    filteredLanguages() {
      return this.availableLanguages.filter(lang => lang !== this.$i18n.locale);
    },
    isMenuOpen() {
      return this.menuPosition === '0';
    }
  },
  mounted() {
    this.handleScroll(); // Проверить позицию сразу после монтирования
    document.addEventListener('click', this.handleClickOutside);
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside);
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
    handleClickOutside(event) {
      if (!this.$el.contains(event.target)) {
        this.languageMenuOpen = false;
      }
    },
    handleScroll() {
      const section2 = document.getElementById('section_2');

      if (section2 && this.isSectionInView(section2)) {
        this.headerClass = 'header-white';
        this.logoSrc = require('@/assets/logo/Logo-Full_white.svg'); // Логотип черный
      } else {
        this.headerClass = 'header-black';
        this.logoSrc = require('@/assets/logo/Logo-Full_white.svg'); // Логотип белый
      }
    },
    isSectionInView(section) {
      const sectionTop = section.getBoundingClientRect().top;
      return sectionTop <= 80 && sectionTop + section.offsetHeight > 80;
    },
    toggleMenu() {
      this.menuPosition = this.menuPosition === '100%' ? '0' : '100%';
      if (this.isMenuOpen) {
        document.body.style.overflow = 'hidden';
      } else {
        document.body.style.overflow = '';
      }
    },
    closeMenu() {
      if (this.isMenuOpen) {
        this.menuPosition = '100%';
        document.body.style.overflow = '';
      }
    },
    changeLanguage(event, lang) {
      event.preventDefault();
      this.$i18n.locale = lang;
      localStorage.setItem('language', lang);
    },
    toggleLanguageMenu(event) {
      event.preventDefault();
      this.languageMenuOpen = !this.languageMenuOpen;
    },
    getLanguageName(lang) {
      switch (lang) {
        case 'en':
          return 'English';
        case 'fr':
          return 'French';
        case 'de':
          return 'German';
        case 'it':
          return 'Italian';
        default:
          return '';
      }
    },
    scrollToElement(event, id) {
      event.preventDefault();
      this.$router.push({ name: 'Home', query: { scrollToId: id } });
    },
    scrollToElementById(id) {
      this.$nextTick(() => {
        const element = document.getElementById(id);
        if (element) {
          const yOffset = -50;
          const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
          window.scrollTo({ top: y, behavior: 'smooth' });
        }
      });
    }
  }
}
</script>





<style scoped>
.header__bottom {
  position: absolute;
  width: 100%;
  height: 1px;
  background-color: var(--br-color);
  z-index: 9999;
  display: none; 
  top: 3px;
}

header {
  position: fixed;
  top: 0;
  z-index: 9998;
  width: 100%;
  height: 80px;
  transition: top 0.5s ease-in-out, opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
}

.header-container {
  padding: 10px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: black; /* Черный фон по умолчанию */
  transition: background-color 0.5s ease-in-out, color 0.5s ease-in-out;
}

.header-white .header-container {
  background-color: #171a36;
}

.header-white .menu ul li a {
  color: rgb(255, 255, 255);
}



.logo {
  width: 150px;
}

.menu_container {
  display: flex;
  align-items: center;
}

nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
}

.menu-ul > li {
  margin-right: 20px;
}

nav ul li a,
nav li a {
  color: rgb(255, 255, 255);
  text-decoration: none;
  font-size: 20px;
  transition: 1s;
  cursor: pointer;
}

.menu ul li a::after {
  content: '';
  display: block;
  width: 0;
  height: 2px;
  background: var(--active-color);
  transition: width 0.3s ease-in-out;
}

.dropdown-content a::after {
  top: 10px;
  position: relative;
}

.menu ul li a:hover::after {
  width: 100%;
}

.menu ul li a.active::after {
  width: 100%;
}

nav ul li .router-link-active a {
  color: var(--active-color);
}

.dropdown-content {
  display: block;
  position: absolute;
  min-width: 260px;
  background-color: var(--bg-secondary-color);
  z-index: 1;
  opacity: 0;
  transform: scaleY(0);
  transform-origin: top;
  transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
}

.dropdown > a i {
  margin-left: 5px;
}

.dropdown-content.show {
  opacity: 1;
  transform: scaleY(1);
}

.dropdown-content a {
  color: var(--text-color);
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: center;
}

.dropdown-content a:hover {
  background-color: var(--bg-main-color);
  color: var(--active-color);
  transition: background-color 0.8s, color 0.8s;
}

.language {
  display: flex;
  padding-right: 35px;
}

.language a {
  cursor: pointer;
  display: flex;
  align-items: center;
   z-index: 9999;
}

.language-active .fa-angle-down {
  transition: transform 0.3s ease;
  margin-left: 5px;
}

.language-active .fa-angle-down.rotated {
  transform: rotate(180deg);
}

.language-active {
  color: var(--active-color);
  background-color: #ffffff;
  padding: 10px;
}

.active-lang {
  margin-left: 10px;
  color: black;
  text-decoration: underline
}

.language-inactive {
  display: block;
  position: absolute;
  top: 74px;
  min-width: 110px;
  background-color: #ffffff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  opacity: 0;
  transform: scaleY(0);
  transform-origin: top;
  transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
}

.language-inactive.show {
  opacity: 1;
  transform: scaleY(1);
  z-index: 9998;
}

.language-inactive li {
  margin: 0;
}

.language-inactive a {
  display: flex;
  padding: 10px;
  text-decoration: none;
  color: rgb(0, 0, 0);
}

.language-inactive a:hover {
  background-color: #191A23;
  color: white;

}

.icon {
  position: absolute;
  display: none;
}

svg {
  fill: white;
  fill-rule: evenodd;
  clip-rule: evenodd;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-miterlimit: 1.5;
  cursor: pointer;
}

svg path {
  fill: none;
  stroke: white; /* Измените на белый цвет */
  stroke-width: 1px;
}

svg+svg {
  margin-left: 1.5rem;
}

.icons {
  display: none;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
}

#top,
#bottom {
  stroke-dasharray: 30, 75.39;
  transition: all 0.6s cubic-bezier(0.6, 0.33, 0.67, 1.29);
}

svg.active #top,
svg.active #bottom {
  stroke-dasharray: 75.39;
  stroke-dashoffset: -60;
}

.rocket #top {
  stroke-dasharray: 30, 88;
}

.hidden-header {
  top: -100px;
  opacity: 0;
  transform: translateY(-20px);
}

@media screen and (max-width: 1024px) {
  
  .header__bottom {
    display: block;
  }

  .header-container {
    justify-content: space-between;
  }

  .language {
    position: relative;
    right: 0;
  }
  .language-inactive {
    top: 43px;
  }
  .icon {
    display: block;
    cursor: pointer;
    position: relative;
    z-index: 9999;
  }

  .menu {
    position: absolute;
    height: 100vh;
    width: 100%;
    background-color: black;
    top: 76px;
    transition: left 0.5s ease-in-out;
    overflow-y: scroll;
    z-index: 9999;
  }
  .header-white .menu {
  background-color: #171a36;
}
  .menu-ul {
    display: flex;
    flex-direction: column;
    text-align: center;
    padding: 0 40px 0 40px;
  }

  .menu ul li {
    padding: 20px;
    margin-right: 20px;
    position: relative;
    border-bottom: 1px solid var(--br-color);
  }

  .dropdown-content {
    background-color: transparent;
    padding: 20px 0px 200px 0;
    left: 0;
    right: 0;
    min-width: 50%;
    margin: 0 auto;
  }

  .menu ul li {
    width: 100%;
  }

  nav ul li a,
  nav li a {
    font-size: 18px;
  }
}
</style>
