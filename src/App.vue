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
  background: #191A23;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(90deg, #0059bc, #009aba);
  border-radius: 10px;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box
}

body {
  font-family: "Space Grotesk", sans-serif;

}

#app {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

section > div:first-child {
  padding-top: 100px;
}



.video-container, .services-container, .contact, .partner-container, .footer-container, .footer-lower {
 overflow: hidden;
}

.modal-body a , .contact-item a {
  color: white; 
}

.contact-item {
  margin: 25px 0;
  font-size: 20px;
}
.social-icons {
  display: flex;
  gap: 10px;
}


.social-icons a {
  display: inline-block;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  overflow: hidden;
  background-color: #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.social-icons a {
  display: inline-flex;       /* Используем flexbox для центрирования иконки */
  align-items: center;        /* Выравнивание по вертикали */
  justify-content: center;    /* Выравнивание по горизонтали */
  width: 30px;                /* Ширина круга */
  height: 30px;               /* Высота круга */
  background-color: white;    /* Белый фон */
  border-radius: 50%;         /* Скругляем углы, чтобы сделать круг */
  margin-right: 10px;         /* Отступ между иконками */
  text-decoration: none;      /* Убираем подчеркивание ссылок */
  color: inherit;             /* Цвет иконок наследуется */
}
.social-icons i {
  font-size: 20px;            /* Размер иконки внутри круга */
  color: #000;                /* Цвет иконки */
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
}
.button:hover::before {
  background-position: left;
}


.title {
  margin: 0;
  font-size: 40px;
  color: black;
  background-color: #FF9900;
  padding: 7px;
  border-radius: 7px;
  display: inline-block;
}

.title_section {
  margin-left: 100px;
  margin-top: 50px;
}


.color-bold {
  font-weight: bold;
  color: var(--active-color);
}




@media screen and (max-width: 769px) { 
  .contact-item {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .title {
    font-size: 32px;
  }

  .contact-item {
    font-size: 18px;
  }
}

@media screen and (max-width: 1024px) {
  .title_section {
    text-align: center;
    max-width: 300px;
    margin: 0 auto;
  }
   .contact {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
}
</style>
