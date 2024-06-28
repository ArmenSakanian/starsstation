<template>
    <div class="about-section" id="about-us">
      <img src="@/assets/img/rap-clip.webp" alt="Mountain view" class="image" />
      <div class="text-content">
        <h2>À propos</h2>
        <p>
          {{ $t('about_about') }}
        </p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AboutUs',
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
    max-width: 20%;
    border-radius: 10px;
    margin-right: 20px;
  }
  
  .text-content {
    max-width: 50%;
  }
  
  .text-content h2 {
    margin-bottom: 10px;
  }
  
  .text-content p {
    line-height: 1.6;
  }
  </style>
  