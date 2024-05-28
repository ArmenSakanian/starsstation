<template>
  <div class="portfolio">
    <h1>Портфолио</h1>
    <div class="videos">
      <div class="row" v-for="(row, rowIndex) in videoRows" :key="rowIndex">
        <VideoThumbnail v-for="(video, videoIndex) in row" :key="videoIndex" :video="video" />
      </div>
    </div>
  </div>
</template>

<script>
import VideoThumbnail from '../components/VideoThumbnail.vue';

export default {
  name: 'PortfolioPage',
  components: {
    VideoThumbnail
  },
  data() {
    return {
      videoRows: [
        [
          { id: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 1' },
          { id: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 2' },
          { id: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 3' }
        ],
        [
          { id: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 4' },
          { id: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 5' },
          { id: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 6' }
        ],
        [
          { id: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 7' },
          { id: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 8' },
          { id: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 9' }
        ]
      ]
    };
  }
};
</script>

<style scoped>
.portfolio {
  background-color: var(--bg-main-color);
  color: var(--text-color);
  text-align: center;
  padding: 20px;
}

h1 {
  margin: 0;
}

.videos {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.row {
  display: flex;
  justify-content: space-around;
  margin: 20px 0;
  flex-wrap: wrap;
}

@media (max-width: 768px) {
  .video {
    width: 45%;
  }

  iframe {
    height: 200px;
  }
}

@media (max-width: 480px) {
  .video {
    width: 100%;
  }

  iframe {
    height: 200px;
  }
}
</style>
