<template>
  <div id="app">
    <!-- <LoadingScreen v-if="isLoading" /> -->
    <AppHeader />
    <main>
      <router-view />
    </main>
    <AppFooter />
  </div>
</template>

<script>
// import LoadingScreen from './components/LoadingScreen.vue';
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';

export default {
  name: 'App',
  components: {
    // LoadingScreen,
    AppHeader,
    AppFooter
  },

}
</script>

<style>
@font-face {
  font-family: Cinzel;
  src: url(/src/assets/fonts/Cinzel-VariableFont_wght.ttf),
    url(/src/assets/fonts/static/Cinzel-Bold.ttf),
    url(/src/assets/fonts/static/Cinzel-Regular.ttf);
}


#imaginez-vous {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Imaginez-vous.webp');
}

#montage-video {
  background-image: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, 0.9)), url('@/assets/img/Montage-video.webp');
}

#reseau-social {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Reseau-social.webp');
}

#video-publicitaire {
  background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img/Video-publicitaire.webp');
}


* {
  margin: 0;
  padding: 0;
  box-sizing: border-box
}

body {
  font-family: "Cinzel", serif;

}

li {
  font-weight: 100;
  font-style: italic;
}

h1 {
  font-size: 48px;
  font-weight: bold;
}

button {
  border: 2px solid white;
  background: linear-gradient(to top, rgb(255, 255, 255) 50%, transparent 50%);
  border-radius: 100px 0 100px 10px;
  background-size: 100% 200%;
  color: white;
  font-size: 20px;
  cursor: pointer;
  transition: .4s ease;
}

button:hover {
  border-radius: 0;
  background-position: 0 100%;
  color: black;
}



.Services_container {
  display: flex;
  background-size: cover;
  flex-direction: column;
  justify-content: center;
  align-items: flex-end;
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
.service_item button {
  text-transform: uppercase;
}

.service_item h1 {
  margin-bottom: 50px;
}

.service_item button {
  padding: 20px 70px;
  font-style: italic;
}

.service_item {
  margin-right: 200px;
  text-align: center;
}

.service_item:nth-child(odd) {
  margin-left: 200px;
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


.fa-brands {
  font-size: 30px;
}

.fa-youtube:hover {
  color: #c4302b;
}

.fa-whatsapp:hover {
  color: #25D366;
}

.fa-instagram:hover {
  background: linear-gradient(45deg, #405DE6, #5B51D8, #833AB4, #C13584, #E1306C, #FD1D1D, #F56040, #777737, #FCAF45, #FFDC80);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.fa-facebook:hover {
  color: #3b5998;
}

.social li {
  position: relative;
  transition: 0.5s;
}

.social li:hover {
  transform: translateY(-15px);
}

.links li,
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


}

@media screen and (max-width: 769px) {
  #imaginez-vous {
    background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Imaginez-vous-mobile.png');
  }

  #montage-video {
    background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Montage-video-mobile.png');
  }

  #reseau-social {
    background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Reseau-social-mobile.png');
  }

  #video-publicitaire {
    background-image: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, 0.5)), url('@/assets/img-mobile/Video-publicitaire-mobile.png');
  }

  .all {
    background-attachment: scroll;
  }


}
</style>
