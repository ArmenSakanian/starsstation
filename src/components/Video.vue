<template>
    <div class="video-container">
      <h1 data-aos="fade-right" class="video-title">{{ title }}</h1>
      <p data-aos="fade-right" class="video-description">{{ description }}</p>
      <video data-aos="fade-left"
        ref="videoPlayer"
        class="video-player"
        autoplay
        muted
        loop
        playsinline
      >
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
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
  }
  
  .video-title {
    font-size: 48px;
    margin-bottom: 20px;
  }
  
  .video-description {
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
  