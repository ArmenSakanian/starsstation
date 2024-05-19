<template>
  <header>
    <router-link></router-link>
    <div class="header-container">
      <router-link to="/"><img src="@/assets/logo/Logo-Full_white.svg" alt="Stars Station Logo" class="logo" /></router-link>
      <nav class="menu" :style="{ left: menuPosition }">
        <div class="header__bottom"></div>
        <ul class="menu-ul">
          <li><router-link to="/" @click="closeMenu">{{ $t('home') }}</router-link></li>
          <li><router-link to="/" @click="closeMenu">{{ $t('about') }}</router-link></li>
          <li><router-link to="/contact" @click="closeMenu">{{ $t('contact') }}</router-link></li>
          <li class="dropdown" 
              @mouseover="handleMouseOver" 
              @mouseleave="handleMouseLeave" 
              @click="handleMobileClick">
            <a href="#services">{{ $t('services') }}</a>
            <ul class="dropdown-content dropdown-content-service" :class="{ show: isMenuVisible }">
              <li><a href="#" @click="scrollToElement($event, 'imagine-yourself'); closeMenu()">{{ $t('imagine yourself') }}</a></li>
              <li><a href="#" @click="scrollToElement($event, 'video-publicitaire'); closeMenu()">{{ $t('advertising video') }}</a></li>
              <li><a href="#" @click="scrollToElement($event, 'reseau-social'); closeMenu()">{{ $t('social network') }}</a></li>
              <li><a href="#" @click="scrollToElement($event, 'montage-video'); closeMenu()">{{ $t('montage') }} {{ $t('video') }}</a></li>
            </ul>
          </li>
        </ul>
      </nav>
      <nav class="language-menu">
        <li class="language">
          <a class="language-active" href="#" @click="handleActiveLanguageClick($event)">{{ $i18n.locale.toUpperCase() }}</a>
          <ul class="language-inactive">
            <li v-for="lang in filteredLanguages" :key="lang">
              <a href="#" @click="changeLanguage($event, lang)">{{ lang.toUpperCase() }}</a>
            </li>
          </ul>
        </li>
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
      menuPosition: '100%',  // Добавлено начальное значение для позиции меню
      isMenuVisible: false
    };
  },
  computed: {
    filteredLanguages() {
      return this.availableLanguages.filter(lang => lang !== this.$i18n.locale);
    },
    isMenuOpen() {
      return this.menuPosition === '0'; // возвращает true, если меню открыто
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
    handleActiveLanguageClick(event) {
      event.preventDefault();
    },
    scrollToElement(event, id) {
      event.preventDefault();
      if (this.$route.name === 'home') {
        const element = document.getElementById(id);
        if (element) {
          const yOffset = -50;
          const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
          window.scrollTo({ top: y, behavior: 'smooth' });
        }
      } else {
        this.$router.push({ name: 'home', query: { scrollToId: id } });
      }
    },
    changeLanguage(event, lang) {
      event.preventDefault();
      const scrollTop = window.pageYOffset;
      this.$i18n.locale = lang;
      localStorage.setItem('language', lang);

      this.$nextTick(() => {
        window.scrollTo(0, scrollTop);
      });
    },
    toggleMenu() {
      this.menuPosition = this.menuPosition === '100%' ? '0' : '100%';
    },
    closeMenu() {
      if (this.isMenuOpen) {
        this.menuPosition = '100%';
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
      if (!this.$el.contains(event.target) && window.innerWidth < 769) {
        this.closeMenu1();
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
  background-color: rgb(112, 112, 112);
  z-index: 9999;
  display: none; 
  top: 00;
}

.header-container {
  position: fixed;
  top: 0;
  z-index: 9998;
  width: 100%;
  display: flex;
  align-items: center;
  background-color: black;
  color: white;
  padding: 10px 20px;
}

.logo {
  height: 50px;
  margin-right: 30px;
}

nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
}

.menu ul li {
  margin-right: 20px;
  position: relative;
}

nav ul li a,
nav li a {
  color: white;
  text-decoration: none;
  font-size: 20px;
}

.dropdown-content {
  display: block;
  position: absolute;
  min-width: 260px;
  background-color: black;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: center;
}

.dropdown-content a:hover {
  background-color: #fff;
  color: black;
  transition: background-color 0.8s, color 0.8s;
}





.language {
  display: flex;
  position: absolute;
  right: 20px;
}

.language a {
  margin-right: 20px;
}

.language-active {
  text-decoration: underline;
  color: yellow;
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
  stroke: white;
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

  .language a {
    margin-right: 20px;
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
  }

  .menu-ul {
    display: flex;
    flex-direction: column;
    text-align: center;
    padding: 0 40px 0 40px;
  }

  .menu ul li {
    padding: 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.6);
  }


  .dropdown-content {
    background-color: transparent;
    padding-top: 20px;
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
    font-size: 14px;
  }

}


</style>
