<template>
    <div class="video-container">
      <h1 data-aos="fade-left" class="video-title">{{ title }}</h1>
      <p data-aos="fade-left" class="video-description">{{ description }}</p>
      <video data-aos="fade-right" ref="videoPlayer" class="video-player" autoplay muted loop>
        <source src="@/assets/video/intro.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
    </div>
  </template>
  
  <script>
  export default {
    name: 'InteractiveVideo',
    data() {
      return {
        title: 'Заголовок Видео',
        description: 'Это описание видео, которое будет отображаться под заголовком.'
      };
    }
  };
  </script>
  
  <style scoped>
  .video-container {
    padding: 20px;
    max-width: 1220px;
    margin: 0 auto;
  }
  
  .video-title {
    font-size: 48px;
    margin-bottom: 20px;
    color: #191A23;
  }
  
  .video-description {
    color: #474a57;
    font-size: 18px;
    margin-bottom: 20px;
  }
  
  .video-player {
    width: 100%;
    max-width: 800px; /* Ограничение ширины видео */
    height: auto;
    border: 1px solid #ccc;
    border-radius: 8px;
    object-fit: cover;
  }
  </style>
  