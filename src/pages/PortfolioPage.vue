<template>
  <div class="video-grid-container">
    <h1 class="services-header title">{{ $t('our_videos') }}</h1>
    <div class="video-grid">
      <div class="video-wrapper" v-for="(video, index) in videos" :key="index">
        <div class="video-thumbnail" @click="openVideo(video)">
          <p class="video-title" @click="openVideo(video)">
            {{ video.title }}
          </p>
          <img :src="getThumbnailSrc(video.thumbnail)" :alt="video.title" />
          <div class="play-button-overlay">
            <i class="fas fa-play"></i>
          </div>
        </div>
        <!-- Обновляем элемент с названием видео -->
      </div>
  
      <!-- Модальное окно для видео -->
      <div v-if="selectedVideo" class="video-modal">
        <div class="video-modal-content">
          <button class="close-button" @click="closeVideo">
            <i class="fas fa-times"></i>
          </button>
          <video
            ref="videoPlayer"
            :src="selectedVideo.src"
            :controls="false"
            autoplay
            @timeupdate="updateProgress"
            @loadedmetadata="initializeProgress"
            @click="handleVideoClick"
          ></video>
          <div class="custom-controls">
            <button @click="togglePlayPause">
              <i :class="isPlaying ? 'fas fa-pause' : 'fas fa-play'"></i>
            </button>
            <div class="progress-container">
              <input
                type="range"
                ref="progressBar"
                min="0"
                :max="videoDuration"
                step="0.1"
                v-model="currentTime"
                @input="onRangeInput"
                class="progress-bar"
                @change="updateRangeBackground"
              />
            </div>
            <span class="time-display">{{ formattedCurrentTime }} / {{ formattedDuration }}</span>
            <button @click="toggleMute">
              <i :class="isMuted || volume === 0 ? 'fas fa-volume-mute' : (volume > 0.5 ? 'fas fa-volume-up' : 'fas fa-volume-down')"></i>
            </button>
            <input
              type="range"
              min="0"
              max="1"
              step="0.01"
              v-model="volume"
              @input="setVolume"
              class="volume-slider"
            />
            <button @click="toggleFullscreen">
              <i class="fas fa-expand"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: 'VideoGrid',
  data() {
    return {
      videos: [
        {
          src: require('@/assets/video/Barber Dodo.mp4'),
          thumbnail: require('@/assets/thumbnails/Barber Dodo.png'),
          title: 'Barber Dodo',
        },
        {
          src: require('@/assets/video/KFC - Conthey.mp4'),
          thumbnail: require('@/assets/thumbnails/KFC - Conthey.png'),
          title: 'KFC - Conthey',
        },
        {
          src: require('@/assets/video/Restaurant Best Food Faryab.mp4'),
          thumbnail: require('@/assets/thumbnails/Restaurant Best Food Faryab.png'),
          title: 'Restaurant Best Food Faryab',
        },
        {
          src: require('@/assets/video/Restaurant Il Pulcinella.mp4'),
          thumbnail: require('@/assets/thumbnails/Restaurant Il Pulcinella.png'),
          title: 'Restaurant Il Pulcinella',
        },
        {
          src: require('@/assets/video/Restaurant Pizzeria de Valère.mp4'),
          thumbnail: require('@/assets/thumbnails/Restaurant Pizzeria de Valère.png'),
          title: 'Restaurant Pizzeria de Valère',
        },
        {
          src: require('@/assets/video/Tennis Club de Valère.mp4'),
          thumbnail: require('@/assets/thumbnails/Tennis Club de Valère.png'),
          title: 'Tennis Club de Valère',
        },
      ],
      selectedVideo: null,
      isPlaying: true,
      isMuted: false,
      videoDuration: 0,
      currentTime: 0,
      volume: 1, // Добавляем громкость, по умолчанию 100%
    };
  },
  watch: {
    volume(newVolume) {
      this.setVolume();
      this.isMuted = newVolume === 0; // Обновляем состояние isMuted
    },
  },
  computed: {
    formattedCurrentTime() {
      return this.formatTime(this.currentTime);
    },
    formattedDuration() {
      return this.formatTime(this.videoDuration);
    },
  },
  methods: {
    formatTime(timeInSeconds) {
      const minutes = Math.floor(timeInSeconds / 60);
      const seconds = Math.floor(timeInSeconds % 60);
      return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    },
    getThumbnailSrc(thumbnailPath) {
      return thumbnailPath;
    },
    openVideo(video) {
      this.selectedVideo = video;
      this.isPlaying = true;

      // Блокируем прокрутку
      document.body.style.overflow = 'hidden';
      document.body.style.position = 'fixed';
      document.body.style.width = '100%';

      // Добавляем обработчик для клавиш
      window.addEventListener('keydown', this.handleKeydown);

      setTimeout(() => {
        this.$refs.videoPlayer.play();
        this.updateRangeBackground();
      }, 100);
    },
    closeVideo() {
      if (this.$refs.videoPlayer) {
        this.$refs.videoPlayer.pause();
      }
      this.selectedVideo = null;

      // Разблокируем прокрутку
      document.body.style.overflow = '';
      document.body.style.position = '';
      document.body.style.width = '';

      // Удаляем обработчик для клавиш
      window.removeEventListener('keydown', this.handleKeydown);
    },
    togglePlayPause() {
      const videoElement = this.$refs.videoPlayer;
      if (videoElement.paused) {
        videoElement.play();
        this.isPlaying = true;
      } else {
        videoElement.pause();
        this.isPlaying = false;
      }
    },
    toggleMute() {
      this.isMuted = !this.isMuted;
      this.volume = this.isMuted ? 0 : 0.5; // Устанавливаем громкость на 50% при включении звука
      this.setVolume();
    },
    setVolume() {
      const videoElement = this.$refs.videoPlayer;
      videoElement.volume = this.volume;
    },
    toggleFullscreen() {
      const videoElement = this.$refs.videoPlayer;
      if (videoElement.requestFullscreen) {
        videoElement.requestFullscreen();
      } else if (videoElement.webkitRequestFullscreen) {
        videoElement.webkitRequestFullscreen();
      } else if (videoElement.msRequestFullscreen) {
        videoElement.msRequestFullscreen();
      }
    },
    updateProgress() {
      const videoElement = this.$refs.videoPlayer;
      if (videoElement) {  // Проверяем, существует ли элемент videoPlayer
        this.currentTime = videoElement.currentTime;
        this.updateRangeBackground();
      }
    },
    initializeProgress() {
      this.videoDuration = this.$refs.videoPlayer.duration;
      this.updateRangeBackground();
    },
    seek(event) {
      this.$refs.videoPlayer.currentTime = event.target.value;
      this.updateRangeBackground();
    },
    updateRangeBackground() {
      const percentage = (this.currentTime / this.videoDuration) * 100;
      const rangeInput = this.$refs.progressBar;
      if (rangeInput) {
        rangeInput.style.background = `linear-gradient(to right, #0059bc 0%, #009aba ${percentage}%, white ${percentage}%, white 100%)`;
      }
    },
    onRangeInput(event) {
      this.seek(event);
      this.updateRangeBackground();
    },
    handleKeydown(event) {
      if (event.code === 'Space') {
        event.preventDefault(); // предотвращаем прокрутку страницы при нажатии на пробел
        this.togglePlayPause();
      } else if (event.code === 'Escape') {
        this.closeVideo();
      }
    },
    handleVideoClick() {
      this.togglePlayPause();
    },
  },
};
</script>

<style scoped>
.video-grid-container {
  padding-top: 50px;
}

.video-grid {
  display: flex;
  flex-wrap: wrap;
  align-content: flex-start; 
  min-height: 100vh; 
  padding: 0 50px 0 50px;
}

.video-wrapper {
  flex: 1 0 33%; /* По умолчанию 3 видеоролика в колонке */
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-bottom: 50px;
}

.video-thumbnail {
  position: relative;
  cursor: pointer;
  transition: transform 0.3s ease;
  width: 100%;
  height: 300px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.video-thumbnail img {
  width: auto;
  height: 100%;
  border-radius: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.video-thumbnail:hover {
  transform: scale(1.05);
}

.play-button-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 48px;
  color: white;
  opacity: 0.8;
  transition: opacity 0.3s ease;
}

.video-thumbnail:hover .play-button-overlay {
  opacity: 1;
}

.video-title {
  cursor: pointer;
  font-size: 16px;
  bottom: 0;
  position: absolute;
  width: 50%;
  text-align: center;
  font-weight: bold;
  background-color: white;
  color: black;
  padding: 20px 10px;
  box-shadow: 0 4px 6px rgb(0 0 0 / 39%);
  border-radius: 5px;
  margin: 15px;
  text-transform: uppercase;
}

/* Медиа-запросы для изменения количества видео в колонке */
@media (max-width: 1024px) {
  .video-wrapper {
    flex: 1 0 50%; /* Два видео в колонке */
  }
}

@media (max-width: 768px) {
  .video-wrapper {
    flex: 1 0 100%; /* Одно видео в колонке */
  }
  .video-grid {
    padding: 0 10px 0 10px;
  }
  .video-thumbnail img {
    width: 100%;
    object-fit: cover;
  }
}

/* Остальные стили остаются без изменений */
.video-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.9);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  padding: 20px;
  box-sizing: border-box;
}

.video-modal-content {
  position: relative;
  width: 100%;
  max-width: 900px;
}

.video-modal-content video {
  width: 100%;
  height: auto;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.custom-controls {
  display: flex;
  align-items: center;
  position: absolute;
  bottom: 20px;
  left: 0;
  right: 0;
  padding: 10px;
  background-color: rgba(0, 0, 0, 0.6);
}

.time-display {
  color: white;
  font-size: 14px;
  margin: 0 10px;
  text-align: center;
  flex-shrink: 0;
  width: 80px; /* Достаточно места для отображения времени */
}

.custom-controls button {
  background: none;
  border: none;
  color: white;
  margin: 0 10px;
  cursor: pointer;
  font-size: 18px;
}

.custom-controls i {
  font-size: 20px;
}

.progress-container {
  flex: 1;
  margin: 0 10px;
  position: relative;
}

.progress-bar {
  width: 100%;
  height: 8px;
  appearance: none;
  background: linear-gradient(to right, white 0%, white 0%) no-repeat, 
              linear-gradient(to right, red 0%, red 100%);
  border-radius: 5px;
  outline: none;
  position: relative;
}

.progress-bar::-webkit-slider-runnable-track {
  width: 100%;
  height: 8px;
  background: transparent;
}

.progress-bar::-webkit-slider-thumb {
  appearance: none;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: transparent;
  cursor: pointer;
  border: none;
  position: relative;
  z-index: 2;
}

.progress-bar::-moz-range-thumb {
  width: 0;
  height: 0;
  border-radius: 50%;
  background: transparent;
  cursor: pointer;
  border: none;
  position: relative;
  z-index: 2;
}

.progress-bar::-moz-range-track {
  width: 100%;
  height: 8px;
  background: transparent;
}

.progress-bar::-ms-fill-lower {
  background: transparent;
}

.progress-bar::-ms-fill-upper {
  background: transparent;
}

.progress-bar::-ms-track {
  background: linear-gradient(to right, white 0%, white 0%, red 0%, red 100%);
  border-color: transparent;
  color: transparent;
}

.volume-slider {
  width: 100px; /* Ширина ползунка громкости */
  margin: 0 10px;
}

.close-button {
  position: absolute;
  top: 10px;
  right: 10px;
  background: none;
  border: none;
  color: white;
  font-size: 24px;
  cursor: pointer;
  z-index: 1001; /* Убедитесь, что кнопка отображается поверх всего */
}

/* Блокировка прокрутки */
.no-scroll {
  overflow: hidden;
}
</style>
