<template>
  <div id="app">
    <AppHeader />
    <main>
      <router-view />
    </main>
    <AppFooter />
  </div>
</template>

<script>
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';

export default {
  name: 'App',
  components: {
    AppHeader,
    AppFooter
  },
  methods: {
    splitText(key) {
      const text = this.$t(key);
      const parts = text.split(/(<color-bold>.*?<\/color-bold>)/g).filter(Boolean);
      return parts.map(part => {
        if (part.startsWith('<color-bold>') && part.endsWith('</color-bold>')) {
          return {
            text: part.slice(12, -13), // Убираем теги более элегантно
            class: 'color-bold'
          };
        } else {
          return {
            text: part,
            class: ''
          };
        }
      });
    },
  },
  provide() {
    return {
      splitText: this.splitText,
    };
  },
};
</script>

<style>

:root {
  --text-color: #ffffff;
  --br-color: #757575;
  --text-secondary-color: #757575;
  --bg-secondary-color: #171717;
  --bg-main-color: #222222;
  --active-color: #FF8D00;
  --active-dark-color: #ac5e00;
  --instagram-color: #cd486b;
  --facebook-color: #1877F2;
  --whatsapp-color: #128C7E;
  --youtube-color: #FF0000;
}




#imagine-yourself {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Imaginez-vous.webp');
}

#montage-video {
  background-image: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, 0.9)), url('@/assets/img/Montage-video.webp');
}

#Social-network {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Social-network.webp');
}

#advertising-video {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Advertising-video.webp');
}

#rap-clip {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Rap-clip.webp');
}


* {
  margin: 0;
  padding: 0;
  box-sizing: border-box
}

body {
  font-family: "Roboto Condensed", sans-serif;
  font-style: normal;
  font-weight: 300;

}
#app {
  display: grid;
  grid-template-rows: 80px 1fr auto;
}

h1 {
  font-size: 48px;
  font-weight: bold;
}



.learn-more, .send {
  border: 2px solid white;
  border-radius: 5px;
  background: linear-gradient(to top, var(--active-color) 50%, transparent 50%);
  background-size: 100% 200%;
  color: white;
  font-size: 20px;
  cursor: pointer;
  transition: .3s ease;
}

.learn-more:hover, .send:hover {
  border-radius: 0;
  background-position: 0 100%;
  color: black;
  border: 2px solid var(--active-color);
}



.Services_container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-end;
  background-size: cover;
  background-position: center;
  height: 100vh;
  width: 100%;
  color: white;
}

.all {
  background-attachment: fixed;
}

.Services_container:nth-child(2n) {
  align-items: flex-start;
}

.service_item h1,
.service_item h3,
.service_item button {
  text-transform: uppercase;
}

.service_item h1 {
  letter-spacing: 5px;
  margin-bottom: 50px;
}

.service_item button {
  padding: 20px 20px;
  font-style: italic;
  margin-bottom: 50px;
}

.service_item h3 {
  letter-spacing: 3px;
}

.Services_container:nth-child(even) .service_item{
  margin-left: 200px;
  text-align: start;
}

.Services_container:nth-child(odd) .service_item {
  margin-right: 200px;
  text-align: end;
}


.service__container-about {
    background-color: #222222;
    border-top: 1px solid #757575;
    border-bottom: 1px solid #757575;
}

.services-about {
    padding: 150px 0 150px 0;
    text-align: center;
    color: white;
    width: 100%;
}

.about__text {
    color: #dddddd;
    padding-top: 20px;
    font-size: 28px;
    line-height: 2;
    width: 90%;
    margin: 0 auto;
    
}

.color-bold {
  font-weight: bold;
  color: var(--active-color);
}

.arrow {
  position: absolute;
  bottom: 10px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 24px;
  animation: blink 1.5s infinite;
}

@keyframes blink {

  0%,
  100% {
    opacity: 1;
  }

  50% {
    opacity: 0;
  }
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

.social li {
  position: relative;
  transition: 0.5s;
}

.social li:hover {
  transform: translateY(-15px);
}

.links li,
.service li,
.social li {
  list-style: none;
  margin-bottom: 30px;
  font-size: 20px;
}



@media screen and (max-width: 1024px) {

  .service_item,
  .service_item:nth-child(odd) {
    margin: 0 auto;
  }

  .about__text {
        font-size: 16px;
    }


}



  .all {
    background-attachment: scroll;
  }


</style>
