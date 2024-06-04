<template>
  <header>
    <router-link></router-link>
    <div class="header-container">
      <router-link to="/"><img src="@/assets/logo/Logo-Full_white.svg" alt="Logo" class="logo" /></router-link>
      <nav class="menu" :style="{ left: menuPosition }">
        <div class="header__bottom"></div>
        <ul class="menu-ul">
          <li><router-link to="/" @click="closeMenu">{{ $t('home') }}</router-link></li>
          <li><router-link to="/About" @click="closeMenu">{{ $t('about') }}</router-link></li>
          <li><router-link to="/Contact" @click="closeMenu">{{ $t('contact') }}</router-link></li>
          <li><router-link to="/Portfolio" @click="closeMenu">{{ $t('our_videos') }}</router-link></li>

          <li class="dropdown"
              @mouseover="handleMouseOver"
              @mouseleave="handleMouseLeave"
              @click="handleMobileClick">
            <a href="#services">{{ $t('service') }}</a>
            <ul class="dropdown-content dropdown-content-service" :class="{ show: isMenuVisible }">
              <li><a href="#" @click="scrollToElement($event, 'imagine-yourself'); closeMenu()">{{ $t('imagine_yourself') }}</a></li>
              <li><a href="#" @click="scrollToElement($event, 'advertising-video'); closeMenu()">{{ $t('advertising_video') }}</a></li>
              <li><a href="#" @click="scrollToElement($event, 'social-network'); closeMenu()">{{ $t('social_network') }}</a></li>
              <li><a href="#" @click="scrollToElement($event, 'montage-video'); closeMenu()">{{ $t('montage_video') }}</a></li>
              <li><a href="#" @click="scrollToElement($event, 'rap-clip'); closeMenu()">{{ $t('rap_clip') }}</a></li>
            </ul>
          </li>
        </ul>
      </nav>

      <nav class="language-menu">
  <ul>
    <li class="language">
      <a class="language-active" href="#" @click="toggleLanguageMenu">
        <img :src="getFlag($i18n.locale)" alt="Flag" class="flag-icon" />
        <span class="active-lang">{{ $i18n.locale.toUpperCase() }}</span>
        <i class="fas fa-angle-down" :class="{ rotated: languageMenuOpen }"></i>
      </a>
      <ul class="language-inactive" :class="{ show: languageMenuOpen }">
        <li v-for="lang in filteredLanguages" :key="lang">
          <a href="#" @click="changeLanguage($event, lang)">
            <img :src="getFlag(lang)" alt="Flag" class="flag-icon" />
            <span>{{ getLanguageName(lang) }}</span>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
      <div class="icon" @click="toggleMenu">
        <svg :class="{ 'active': isMenuOpen }" width="30" height="30" viewBox="0 0 32 42" xmlns="http://www.w3.org/2000/svg">
          <g transform="matrix(1,0,0,1,-389.5,-264.004)">
            <g id="arrow_left2">
              <g transform="matrix(1,0,0,1,0,5)">
                <path id="top" d="M390,270L420,270L420,270C420,270 420.195,250.19 405,265C389.805,279.81 390,279.967 390,279.967" />
              </g>
              <g transform="matrix(1,1.22465e-16,1.22465e-16,-1,0.00024296,564.935)">
                <path id="bottom" d="M390,270L420,270L420,270C420,270 420.195,250.19 405,265C389.805,279.81 390,279.967 390,279.967" />
              </g>
              <path id="middle" d="M390,284.967L420,284.967" />
            </g>
          </g>
        </svg>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: 'AppHeader',
  data() {
    return {
      availableLanguages: ['en', 'fr', 'de'],
      menuPosition: '100%',
      isMenuVisible: false,
      languageMenuOpen: false
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
    const scrollToId = this.$route.query.scrollToId;
    if (scrollToId) {
      this.$nextTick(() => {
        const element = document.getElementById(scrollToId);
        if (element) {
          const yOffset = -50;
          const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
          window.scrollTo({ top: y, behavior: 'smooth' });
        }
      });
    }
    document.addEventListener('click', this.handleClickOutside);
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside);
  },
  methods: {
    changeLanguage(event, lang) {
      event.preventDefault();
      this.$i18n.locale = lang;
      localStorage.setItem('language', lang);
    },
    toggleLanguageMenu(event) {
      event.preventDefault();
      this.languageMenuOpen = !this.languageMenuOpen;
    },
    scrollToElement(event, id) {
      event.preventDefault();
      if (this.$route.name === 'Home') {
        const element = document.getElementById(id);
        if (element) {
          const yOffset = -50;
          const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
          window.scrollTo({ top: y, behavior: 'smooth' });
        }
      } else {
        this.$router.push({ name: 'Home', query: { scrollToId: id } });
      }
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
    handleMouseOver() {
      if (window.innerWidth >= 769) {
        this.isMenuVisible = true;
      }
    },
    handleMouseLeave() {
      if (window.innerWidth >= 769) {
        this.isMenuVisible = false;
      }
    },
    handleMobileClick() {
      if (window.innerWidth < 769) {
        this.isMenuVisible = !this.isMenuVisible;
      }
    },
    closeMenu1() {
      this.isMenuVisible = false;
    },
    handleClickOutside(event) {
      if (!this.$el.contains(event.target)) {
        this.languageMenuOpen = false;
        if (window.innerWidth < 769) {
          this.closeMenu1();
        }
      }
    },
    getFlag(lang) {
      switch (lang) {
        case 'en':
          return require('@/assets/icon/en.svg');
        case 'fr':
          return require('@/assets/icon/fr.svg');
        case 'de':
          return require('@/assets/icon/de.svg');
        default:
          return '';
      }
    },
    getLanguageName(lang) {
      switch (lang) {
        case 'en':
          return 'English';
        case 'fr':
          return 'French';
        case 'de':
          return 'German';
        default:
          return '';
      }
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

.header-container {
  position: fixed;
  top: 0;
  z-index: 9998;
  width: 100%;
  display: flex;
  align-items: center;
  background-color: var(--bg-secondary-color);
  color: var(--text-color);
  padding: 8px 10px;
}

.logo {
  width: 140px;
  height: 60px;
  margin-right: 30px;
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
  color: var(--text-color);
  text-decoration: none;
  font-size: 20px;
  transition: 1s;
}

.menu ul li a::after {
  content: '';
  display: block;
  width: 0;
  height: 2px;
  background: var(--active-color);
  transition: width 0.3s ease-in-out;
}

.menu ul li a:hover::after {
  width: 100%;
}

.menu ul li a.active::after {
  width: 100%;
}




nav ul li .router-link-active {
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
  position: absolute;
  right: 90px;
}

.language a {
  cursor: pointer;
  display: flex;
  align-items: center;
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
}

.active-lang {
  margin-left: 10px;
  color: white;
  text-decoration: underline
}

.language-inactive {
  display: block;
  position: absolute;
  top: 30px;
  min-width: 110px;
  background-color: var(--bg-secondary-color);
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  opacity: 0;
  transform: scaleY(0);
  transform-origin: top;
  transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
}

.language-inactive.show {
  opacity: 1;
  transform: scaleY(1);
}

.language-inactive li {
  margin: 0;
}

.language-inactive a {
  display: flex;
  padding: 10px;
  text-decoration: none;
  color: var(--text-color);
}

.language-inactive a:hover {
  background-color: var(--bg-main-color);
}

.flag-icon {
  width: 30px;
    height: 30px;
    border-radius: 4px;
    background-color: #ffffff;
    padding: 2px;
}

.icon {
  position: absolute;
  display: none;
}

svg {
  fill-rule: evenodd;
  clip-rule: evenodd;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-miterlimit: 1.5;
  cursor: pointer;
}

svg path {
  fill: none;
  stroke: var(--text-color);
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
    background-color: var(--bg-secondary-color);
    top: 76px;
    transition: left 0.5s ease-in-out;
    overflow-y: scroll;
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
