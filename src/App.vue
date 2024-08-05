<template>
    <AppHeader />
    <main>
      <router-view />
    </main>
    <!-- <AppFooter /> -->
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
    ScrollToTop
  },
  methods: {
    splitText(key) {
      const text = this.$t(key);
      const parts = text.split(/(<color-bold>.*?<\/color-bold>)/g).filter(Boolean);
      return parts.map(part => {
        if (part.startsWith('<color-bold>') && part.endsWith('</color-bold>')) {
          return { text: part.slice(12, -13), class: 'color-bold' };
        } else {
          return { text: part, class: '' };
        }
      });
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
  padding: 0 100px 0 100px;

}

#app {
  display: flex;
  flex-direction: column;
  height: 100vh;
}


main>div {
  margin-top: 50px;
}


#imagine-yourself {
  background-image: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url('@/assets/img/imagine-yourself.webp');
}

#montage-video {
  background-image: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0,  .7)), url('@/assets/img/montage-video.webp');
}

#social-network {
  background-image: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url('@/assets/img/social-network.webp');
}

#advertising-video {
  background-image: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url('@/assets/img/advertising-video.webp');
}

#rap-clip {
  background-image: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url('@/assets/img/rap-clip.webp');
}
#about {
  background-image: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url('@/assets/img/about.webp');
}


#portfolio {
  background-image: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url('@/assets/img/portfolio.webp');

}

.learn-more,
.send,
.subscribe {
  border: 2px solid rgb(0, 0, 0);
  border-radius: 5px;
  background: linear-gradient(to right, var(--active-color) 50%, transparent 50%);
  background-size: 200% 100%;
  background-position: 100% 0;
  color: rgb(0, 0, 0);
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: .3s ease;
}

.learn-more:hover,
.send:hover,
.subscribe:hover {
  border-radius: 0;
  background-position: 0 0;
  color: rgb(255, 255, 255);
  border: 2px solid var(--active-color);
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


</style>
