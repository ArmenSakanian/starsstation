<template>
    <head>
    <title>Stars Station Studio</title>
    <meta name="description"
      content="IMAGINE YOURSELF, EXPRESS YOUR ART IN VIDEO, SOCIAL NETWORK, MONTAGE VIDEO, RAP CLIP">
  </head> 
    <AppHeader />
    <main>
      <router-view />
    </main>
  <AppFooter />
    <ScrollToTop /> 

</template>

<script>
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';
import ScrollToTop from './components/ScrollToTop.vue';

export default {
  name: 'App',
  components: {
    AppHeader,
    AppFooter,
    ScrollToTop,
  },
  methods: {
    formatText(key) {
      return textFormatter.formatText(this.$i18n, key);
    },
    scrollTo(sectionId) {
      document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
    }
  },
  provide() {
    return {
      splitText: this.splitText,
    };
  },
};
</script>

<style>

.hidden-header {
  top: -100px;
}
:root {
  --text-color: #000000;
  --br-color: #757575;
  --text-secondary-color: #757575;
  --bg-secondary-color: #171717;
  --bg-main-color: #222222;
  --active-color: #FF9900;
  --active-dark-color: #ac5e00;
  --instagram-color: #cd486b;
  --facebook-color: #1877F2;
  --whatsapp-color: #128C7E;
  --youtube-color: #FF0000;
}


::-webkit-scrollbar {
  width: 12px;
}


::-webkit-scrollbar-track {
  background: var(--bg-main-color);
}

::-webkit-scrollbar-thumb {
  background: var(--active-color);
  border-radius: 10px;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box
}

body {
  font-family: "Space Grotesk", sans-serif;
  /* padding: 0 100px 0 100px; */

}

#app {
  display: flex;
  flex-direction: column;
  height: 100vh;
}


main > div:first-child {
  margin-top: 100px;
}
section > div {
  padding-top: 100px;
}

.video-container, .services-container, .contact, .partner-container {
 overflow: hidden;
}
.button {
  background: linear-gradient(90deg, #0059bc, #009aba);
  color: white;
  border: none;
  padding: 10px 40px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 20px;
  position: relative;
  z-index: 2;
  overflow: hidden;
  transition: background-position 0.5s ease; /* Плавный переход */
  background-size: 200%; /* Увеличиваем размер фона, чтобы была возможность для движения */
  background-position: left; /* Начальная позиция градиента */
  transition: 1s;
}

.button:hover {
  background-position: right;
  transform: scale(1.2) /* При наведении градиент движется вправо */
}

.button:hover::before {
  background-position: left;
}


.title_section {
  background-color: var(--active-color);
  padding: 7px;
  border-radius: 7px;
  display: inline-block;
  margin-left: 100px;
  margin-top: 50px;
}

.title_section h1 {
  font-size: 32px;
}

.color-bold {
  font-weight: bold;
  color: var(--active-color);
}

.custom-icon {
  font-size: 30px;
}

.instagram-icon:hover {
  color: var(--instagram-color);
}

.facebook-icon:hover {
  color: var(--facebook-color);
}

.whatsapp-icon:hover {
  color: var(--whatsapp-color);
}

.youtube-icon:hover {
  color: var(--youtube-color);
}

@media screen and (max-width: 769px) { 

}

@media screen and (max-width: 1024px) {
  .title_section {
    text-align: center;
    max-width: 200px;
    margin: 0 auto;
  }

  .service_container, .contact {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
}
</style>
