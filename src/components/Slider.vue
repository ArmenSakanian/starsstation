<template>
    <swiper
      :style="{
        '--swiper-navigation-color': '#fff',
        '--swiper-pagination-color': '#fff',
      }"
      :spaceBetween="0"
      :navigation="true"
      :thumbs="{ swiper: thumbsSwiper }"
      :modules="modules"
      class="mySwiper2"
    >
      <swiper-slide>
        <div class="overlay"></div>
        <img src="@/assets/img/imagine-yourself.webp" />
      </swiper-slide>
      <swiper-slide>
        <div class="overlay"></div>
        <img src="@/assets/img/advertising-video.webp" />
      </swiper-slide>
      <swiper-slide>
        <div class="overlay"></div>
        <img src="@/assets/img/social-network.webp" />
      </swiper-slide>
      <swiper-slide>
        <div class="overlay"></div>
        <img src="@/assets/img/montage-video.webp" />
      </swiper-slide>
      <swiper-slide>
        <div class="overlay"></div>
        <img src="@/assets/img/rap-clip.webp" />
      </swiper-slide>
    </swiper>
    <swiper
      @swiper="setThumbsSwiper"
      :spaceBetween="10"
      :slidesPerView="3"
      :freeMode="true"
      :watchSlidesProgress="true"
      :modules="modules"
      class="mySwiper"
    >
      <swiper-slide>
        <div class="thumbnail-container">
          <img src="@/assets/img/imagine-yourself.webp" />
          <div class="slide-number">1</div>
          <div class="arrow"></div>
        </div>
      </swiper-slide>
      <swiper-slide>
        <div class="thumbnail-container">
          <img src="@/assets/img/advertising-video.webp" />
          <div class="slide-number">2</div>
          <div class="arrow"></div>
        </div>
      </swiper-slide>
      <swiper-slide>
        <div class="thumbnail-container">
          <img src="@/assets/img/social-network.webp" />
          <div class="slide-number">3</div>
          <div class="arrow"></div>
        </div>
      </swiper-slide>
      <swiper-slide>
        <div class="thumbnail-container">
          <img src="@/assets/img/montage-video.webp" />
          <div class="slide-number">4</div>
          <div class="arrow"></div>
        </div>
      </swiper-slide>
      <swiper-slide>
        <div class="thumbnail-container">
          <img src="@/assets/img/rap-clip.webp" />
          <div class="slide-number">5</div>
          <div class="arrow"></div>
        </div>
      </swiper-slide>
    </swiper>
  </template>
  
  <script>
  import { ref } from 'vue';
  import { Swiper, SwiperSlide } from 'swiper/vue';
  import 'swiper/css';
  import 'swiper/css/free-mode';
  import 'swiper/css/navigation';
  import 'swiper/css/thumbs';
  import { FreeMode, Navigation, Thumbs } from 'swiper/modules';
  
  export default {
    components: {
      Swiper,
      SwiperSlide,
    },
    setup() {
      const thumbsSwiper = ref(null);
  
      const setThumbsSwiper = (swiper) => {
        thumbsSwiper.value = swiper;
      };
  
      return {
        thumbsSwiper,
        setThumbsSwiper,
        modules: [FreeMode, Navigation, Thumbs],
      };
    },
  };
  </script>
  
  <style scoped>
  .swiper {
    width: 100%;
    height: 100%;
  }
  
  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative; /* Added to allow overlay positioning */
  }
  
  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Полупрозрачный черный слой */
    z-index: 1;
  }
  
  .mySwiper2 {
    height: 100vh;
    width: 100%;
  }
  
  .mySwiper {
    height: 200px;
    box-sizing: border-box;
    position: absolute;
    width: 70%;
    right: 30px;
    bottom: 50px;
  }
  
  .mySwiper .swiper-slide {
    width: 215px;
    height: 150px;
    border-radius: 16px;
    position: relative;
  }
  
  .mySwiper .swiper-slide img {
    border-radius: 16px;
  }
  
  .thumbnail-container {
    position: relative;
    width: 100%;
    height: 100%;
  }
  
  .slide-number {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(0, 0, 0, 0.6);
    color: #fff;
    padding: 5px 10px;
    border-radius: 16px;
    font-size: 16px;
    z-index: 2; /* Ensure it is above the overlay */
  }
  
  .arrow {
    position: absolute;
    bottom: 10px;
    right: 10px; /* Изменено с left на right */
    width: 0;
    height: 0;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-left: 15px solid #fff; /* Белая стрелочка */
    z-index: 2; /* Ensure it is above the overlay */
  }
  </style>
  