<template>
    <div class="video" @click="loadVideo">
      <div v-if="!loaded" class="thumbnail">
        <img :src="thumbnailUrl" alt="Video thumbnail" />
        <div class="title-overlay">
          <p>{{ video.title }}</p>
        </div>
        <div class="icon-overlay">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960">
            <path d="M392 770V382q0-14 12.5-22.5T436 361l306 195q12 8 12 22t-12 22L436 795q-12 8-24.5.5T392 774Z"/>
          </svg>
        </div>
      </div>
      <div v-else class="iframe-container">
        <iframe
          :src="videoUrl"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
        ></iframe>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'VideoThumbnail',
    props: {
      video: Object
    },
    data() {
      return {
        loaded: false
      };
    },
    computed: {
      thumbnailUrl() {
        return `https://restaurant-pizzeria-valere.ch/media/2022/09/cropped-Logo-Pizzeria-de-valere-3.png`;
      },
      videoUrl() {
        return `https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox`;
      }
    },
    methods: {
      loadVideo() {
        this.loaded = true;
      }
    }
  };
  </script>
  
  <style scoped>
  .video {
    width: 45%; /* Увеличиваем ширину */
    margin: 10px 0;
    text-align: center;
    cursor: pointer;
  }
  
  .thumbnail,
  .iframe-container {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
    background-color: #e0e0e0; /* Светло-серый фон */
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .title-overlay {
    position: absolute;
    bottom: 0;
    width: 100%;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    text-align: center;
    padding: 10px;
  }
  
  .icon-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgb(255, 255, 255);
    border-radius: 50%;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
  }
  
  .icon-overlay svg {
    fill: var(--active-color);
    width: 24px;
    height: 24px;
  }
  
  iframe {
    width: 100%;
    height: 100%;
  }
  </style>