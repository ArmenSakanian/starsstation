<template>
  <footer>
    <div class="footer__container">
      <div class="footer__logo footer__item">
        <img src="@/assets/logo/Logomark White.svg" alt="Logo">
      </div>
      <div class="footer__links footer__item">
        <h1>Links</h1>
        <div class="links ">
          <li><router-link to="/">{{ $t('home') }}</router-link></li>
          <li><router-link to="/About">{{ $t('about') }}</router-link></li>
          <li><router-link to="/Contact">{{ $t('contact') }}</router-link></li>
        </div>
      </div>
      <div class="footer__service footer__item">
        <h1>Service</h1>
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
        <h1>Social</h1>
        <div class="social">
          <li><a href="https://www.instagram.com/starsstationstudio?igsh=cDdmczIxc2ljMzJq"><font-awesome-icon
                :icon="['fab', 'instagram']" class="custom-icon instagram-icon" /></a></li>
          <li><a href="#"><font-awesome-icon :icon="['fab', 'facebook']" class="custom-icon facebook-icon" /></a></li>
          <li><a href="https://wa.me/41779441743"><font-awesome-icon :icon="['fab', 'whatsapp']"
                class="custom-icon whatsapp-icon" /></a></li>
          <li><a href="https://www.youtube.com/@StarsStationStudio"><font-awesome-icon :icon="['fab', 'youtube']"
                class="custom-icon youtube-icon" /></a></li>
        </div>
      </div>
      <div class="footer__video footer__item" @click="toggleVideo">
        <h1>INTRO</h1>

        <div class="video">
          <iframe width="100%" height="auto" src="https://www.youtube.com/embed/DzXGOEEFdG4?control=0"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
  methods: {
    scrollToElement(event, id) {
      event.preventDefault();
      const element = document.getElementById(id);
      if (element) {
        const yOffset = -50;
        const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
        window.scrollTo({ top: y, behavior: 'smooth' });
      }
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


.copyright {
  background-color: var(--bg-main-color);
  padding: 10px;
  text-align: center;
  color: var(--text-secondary-color);
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