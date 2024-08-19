<template>
  <div class="video-grid">
    <div class="row" v-for="(row, index) in videoRows" :key="index">
      <div class="video-wrapper" v-for="(video, idx) in row" :key="idx">
        <div class="video-thumbnail" @click="openVideo(video)">
          <img :src="getThumbnailSrc(video.thumbnail)" :alt="video.title" />
          <div class="play-button-overlay">
            <i class="fas fa-play"></i>
          </div>
        </div>
        <p class="video-title">{{ video.title }}</p>
      </div>
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
</template>

<script>
export default {
  name: 'VideoGrid',
  data() {
    return {
      videos: [
        {
          src: require('@/assets/video/intro.mp4'),
          thumbnail: require('@/assets/thumbnails/intro.png'),
          title: 'Intro Video',
        },
        {
          src: require('@/assets/video/intro.mp4'),
          thumbnail: require('@/assets/thumbnails/intro.png'),
          title: 'Intro Video',
        },
        {
          src: require('@/assets/video/intro.mp4'),
          thumbnail: require('@/assets/thumbnails/intro.png'),
          title: 'Intro Video',
        },
        {
          src: require('@/assets/video/intro.mp4'),
          thumbnail: require('@/assets/thumbnails/intro.png'),
          title: 'Intro Video',
        },
        {
          src: require('@/assets/video/intro.mp4'),
          thumbnail: require('@/assets/thumbnails/intro.png'),
          title: 'Intro Video',
        },
        {
          src: require('@/assets/video/intro.mp4'),
          thumbnail: require('@/assets/thumbnails/intro.png'),
          title: 'Intro Video',
        },
        {
          src: require('@/assets/video/Tennis Club de Valère.mp4'),
          thumbnail: require('@/assets/thumbnails/tennis.png'),
          title: 'Tennis Club de Valère',
        },
        {
          src: require('@/assets/video/KFC Conthey.mp4'),
          thumbnail: require('@/assets/thumbnails/kfc.png'),
          title: 'KFC Conthey',
        },
      ],
      width: '320',
      height: '180',
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
    videoRows() {
      if (!Array.isArray(this.videos)) {
        return [];
      }

      return this.videos.reduce((rows, video, index) => {
        if (index % 3 === 0) {
          rows.push([]);
        }
        rows[rows.length - 1].push(video);
        return rows;
      }, []);
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
    document.body.classList.add('no-scroll'); // Блокируем прокрутку
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
    document.body.classList.remove('no-scroll'); // Разблокируем прокрутку
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
    }
  },
};
</script>

<style scoped>
.video-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* 3 колонки в ряду */
  gap: 20px;
  padding: 50px
}

/* Медиа-запрос для экранов шириной менее 1024px */
@media (max-width: 1024px) {
  .video-grid {
    grid-template-columns: repeat(2, 1fr); /* 2 колонки в ряду */
    padding: 0;
  }
}

/* Медиа-запрос для экранов шириной менее 769px */
@media (max-width: 769px) {
  .video-grid {
    grid-template-columns: 1fr; /* 1 колонка в ряду */
  }
}

.video-wrapper {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.video-thumbnail {
  position: relative;
  cursor: pointer;
  transition: transform 0.3s ease;
  max-width: 390px;
  min-width: 340px;
  height: 300px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.video-thumbnail img {
  width: 100%;
  height: 100%;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  display: block; /* Убирает возможные пробелы снизу изображения */
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
  margin-top: 10px;
  font-size: 16px;
  text-align: center;
}

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
