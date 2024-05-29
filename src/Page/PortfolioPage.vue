<template>
  <div class="portfolio">
    <h1>{{ $t('our videos') }}</h1>
    <div class="videos">
      <div class="row" v-for="(row, rowIndex) in videoRows" :key="rowIndex">
        <div class="video" v-for="(video, videoIndex) in row" :key="videoIndex">
          <iframe
            :src="getVideoUrl(video.url)"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          ></iframe>
          <p>{{ video.title }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PortfolioPage',
  data() {
    return {
      videoRows: [
        [
          { url: 'https://www.youtube.com/embed/gfxDAKyPfR8?si=KHmccuAklFHrgz30', title: 'Restaurant: Il Pulcinella' },
          { url: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Restaurant Valère Pizzeria' },
          { url: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'KFC - Conthey' }
        ],
        [
          { url: 'https://www.youtube.com/embed/GM5hAXYAVjM?si=frhS6gAQjM-pJdUf', title: 'Rap Clip' },
          { url: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 5' },
          { url: 'https://www.youtube.com/embed/nNThGvE4vSU?si=rQ14iDLpNtTV86ox', title: 'Видео 6' }
        ]
      ]
    };
  },
  methods: {
    getVideoUrl(url) {
      return url;
    }
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

.video {
  width: 30%;
  margin: 10px 0;
  text-align: center;
}

iframe {
  width: 100%;
  height: 250px;
}

p {
  margin-top: 10px;
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


