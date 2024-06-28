<template>
    <div class="about-section" id="about-us">
      <img src="@/assets/img/rap-clip.webp" alt="Mountain view" class="image" />
      <div class="text-content">
        <h2>{{ $t('about') }}</h2>
        <p>
          <span v-for="(part, index) in splitText('about_about')" :key="index" :class="part.class">
            {{ part.text }}
          </span>
        </p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AboutUs',
    inject: ['splitText'],
  };
  </script>
  
  <style scoped>
  .about-section {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
  }
  
  .image {
    max-width: 50%;
    border-radius: 10px;
    margin-right: 20px;
  }
  
  .text-content {
    max-width: 50%;
  }
  
  .text-content h2 {
    margin-bottom: 10px;
    font-size: 36px;
    font-weight: bold;
  }
  
  .text-content p {
    font-size: 20px;
    font-weight: 300;
    font-style: italic;
    line-height: 1.6;
  }
  </style>
  