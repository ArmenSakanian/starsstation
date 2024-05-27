<template>
  <footer>
    <div class="footer__container">
      <div class="footer__logo footer__item">
        <img src="@/assets/logo/Logomark White.svg" alt="Logo">
      </div>
      <div class="footer__links footer__item">
        <h1>{{ $t('link') }}</h1>
        <div class="links ">
          <li><router-link to="/">{{ $t('home') }}</router-link></li>
          <li><router-link to="/About">{{ $t('about') }}</router-link></li>
          <li><router-link to="/Contact">{{ $t('contact') }}</router-link></li>
          <li><router-link to="/Privacy">{{ $t('privacy_policy_title') }}</router-link></li>
        </div>
      </div>
      <div class="footer__service footer__item">
        <h1>{{ $t('service') }}</h1>
        <div class="service">
          <router-link to="/Yourself">
            <li><a href="#">{{ $t('imagine yourself') }}</a></li>
          </router-link>
          <router-link to="/Advertising">
            <li><a href="#">{{ $t('advertising video') }}</a></li>
          </router-link>
          <router-link to="/Network">
            <li><a href="#">{{ $t('social network') }}</a></li>
          </router-link>
          <router-link to="/Montage">
            <li><a href="#">{{ $t('montage') }} {{ $t('video') }}</a></li>
          </router-link>
          <router-link to="/Rap">
            <li><a href="#">{{ $t('rap clip') }}</a></li>
          </router-link>
        </div>
      </div>
      <div class="footer__social footer__item">
        <h1>{{ $t('social') }}</h1>
        <div class="social">
          <li>
            <a href="https://www.instagram.com/starsstationstudio?igsh=cDdmczIxc2ljMzJq" aria-label="Instagram">
              <i class="fab fa-instagram custom-icon instagram-icon"></i>
            </a>
          </li>
          <li>
            <a href="#" aria-label="Facebook">
              <i class="fab fa-facebook custom-icon facebook-icon"></i>
            </a>
          </li>
          <li>
            <a href="https://wa.me/41779441743" aria-label="WhatsApp">
              <i class="fab fa-whatsapp custom-icon whatsapp-icon"></i>
            </a>
          </li>
          <li>
            <a href="https://www.youtube.com/@StarsStationStudio" aria-label="YouTube">
              <i class="fab fa-youtube custom-icon youtube-icon"></i>
            </a>
          </li>
        </div>
      </div>
      <div class="footer__video footer__item" @click="toggleVideo">
    <h1>{{ $t('intro') }}</h1>
    <div class="video-container">
      <video ref="video" controls @error="handleError">
        <source :src="videoMp4" type="video/mp4">
        <source :src="videoWebp" type="video/webp">
        Your browser does not support the video tag.
        <track src="https://starsstation.ch/subtitles.vtt" kind="captions" srclang="en" label="English">
      </video>
      <div v-if="error" class="video-error">{{ error }}</div>
    </div>
  </div>
    </div>
    <div class="copyright">
      ©2024 Stars Station Studio | All Rights Reserved
    </div>
  </footer>
</template>

<script>
export default {
  name: 'AppFooter',
  data() {
    return {
      error: null
    }
  },
  computed: {
    videoMp4() {
      return 'https://starsstation.ch/media/intro_1.b1d5cb81.mp4';
    }
    // videoWebp() {
    //   return require('@/assets/media/your-video.webp');
    // }
  },
  methods: {
    handleError() {
      this.error = 'Failed to load video. Please try again later.';
    }
  }
}
</script>
<style scoped>
.footer__video {
  position: relative;
  cursor: pointer;
  display: grid;
  place-items: center;
}


video {
  width: 100%;
  height: auto;
}





.footer__item {
  width: 100%;
  margin-bottom: 15px;
}

.footer__container {
  background-color: var(--bg-secondary-color);
  color: var(--text-color);
  padding: 20px 50px 0 50px;
  display: flex;
  justify-content: center;
  width: 100%;
  align-items: flex-start
}

.footer__container a {
  color: var(--text-color);
  text-decoration: none;
}

.footer__logo {
  display: flex;
  justify-content: center;
}

.footer__logo img {
  width: 250px;
}

.footer__links,
.footer__service,
.footer__social,
.footer__video {
  display: flex;
  flex-direction: column;
  align-items: center;
}


.footer__links h1,
.footer__service h1,
.footer__social h1,
.footer__video h1 {
  font-size: 32px;
  margin-bottom: 10px;
}

.links,
.service,
.social,
.video {
  margin-top: 30px;
  display: flex;
  flex-direction: column;
  text-align: center;
  align-items: center;
}

.video-container {
  width: 100%;
  position: relative;
}

video {
  width: 100%;
  height: auto;
  display: block;
  cursor: pointer;
  background-color: black;
  border-radius: 20px;
}

.video-error {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(255, 0, 0, 0.8);
  color: white;
  padding: 10px;
  border-radius: 4px;
}

.play-button,
.pause-button,
.fullscreen-button {
  position: absolute;
  bottom: 10px;
  background-color: rgba(0, 0, 0, 0.7);
  color: white;
  border: none;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  cursor: pointer;
}

.play-button {
  left: 10px;
}

.pause-button {
  left: 10px;
}

.fullscreen-button {
  right: 10px;
}


.copyright {
  background-color: var(--bg-main-color);
  padding: 10px;
  text-align: center;
  color: var(--text-color);
}

@media screen and (max-width: 1024px) {
  .footer__container a {
    text-decoration: underline;
  }

  .footer__container {
    flex-wrap: wrap;
  }

  .video_text {
    display: none;
  }


  .footer__item .links,
  .footer__item .service,
  .footer__item .social,
  .footer__item .video {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    flex-direction: row;
    padding: 0;
    margin: 0;
  }

  .footer__item .links li,
  .footer__item .service li,
  .footer__item .social li {
    margin-right: 10px;
    margin-bottom: 10px;
  }
}
</style>