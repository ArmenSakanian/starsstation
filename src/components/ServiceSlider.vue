<template>
    <div ref="sliderContainer" class="slider-container">
      <div class="slider" :style="{ transform: `translateX(-${currentSlide * (slideWidth + 30)}px)` }">
        <div
          v-for="(slide, index) in slides"
          :key="index"
          class="slide"
          :style="{ backgroundImage: `url(${slide.image})`, width: `${slideWidth}px` }"
        >
          <h2 class="slide-title">{{ slide.title }}</h2>
        </div>
      </div>
      <button @click="prevSlide" class="nav-button prev">‹</button>
      <button @click="nextSlide" class="nav-button next">›</button>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        currentSlide: 0,
        slideWidth: 0,
        slides: [
          { title: 'Imagine Yourself', image: require('@/assets/img/imagine-yourself.webp') },
          { title: 'Advertising Video', image: require('@/assets/img/advertising-video.webp') },
          { title: 'Social Network', image: require('@/assets/img/social-network.webp') },
          { title: 'Montage Video', image: require('@/assets/img/montage-video.webp') },
          { title: 'Rap Clip', image: require('@/assets/img/rap-clip.webp') },
        ],
      };
    },
    methods: {
      updateSlideWidth() {
        this.slideWidth = (this.$refs.sliderContainer.clientWidth - 60) / 3;
      },
      prevSlide() {
        if (this.currentSlide > 0) {
          this.currentSlide--;
        }
      },
      nextSlide() {
        if (this.currentSlide < this.slides.length - 3) {
          this.currentSlide++;
        }
      },
      goToSlide(index) {
        this.currentSlide = index;
      },
    },
    mounted() {
      this.updateSlideWidth();
      window.addEventListener('resize', this.updateSlideWidth);
    },
    beforeDestroy() {
      window.removeEventListener('resize', this.updateSlideWidth);
    },
  };
  </script>
  
  <style scoped>
  .slider-container {
    position: relative;
    overflow: hidden;
    width: 100%;
    margin: 0 auto;
  }
  
  .slider {
    display: flex;
    transition: transform 0.5s ease;
  }
  
  .slide {
    flex: 0 0 auto;
    height: 400px;
    background-size: cover;
    background-position: center;
    margin: 15px;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    border-radius: 20px;
  }
  
  .slide-title {
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    padding: 10px 20px;
    margin-bottom: 20px;
  }
  
  .nav-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
  }
  
  .prev {
    left: 10px;
  }
  
  .next {
    right: 10px;
  }
  
  

  </style>
  