<template>
  <div class="portfolio">
    <h1>{{ $t('our_videos') }}</h1>
    <div class="videos">
      <div class="row" v-for="(row, rowIndex) in videoRows" :key="rowIndex">
        <div class="video" v-for="(video, videoIndex) in row" :key="videoIndex">
          <iframe
            :src="getVideoUrl(video.id)"
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
      videos: [],
      apiKey: 'AIzaSyAxGExZeHJonEjFw2O6bDnEnsdF7HisJRE', // Ваш ключ API
      channelId: 'UCkMsST6QqVPnjkldq30ZXfw' // Ваш ID канала
    };
  },
  computed: {
    videoRows() {
      const rows = [];
      const rowSize = 3;
      for (let i = 0; i < this.videos.length; i += rowSize) {
        rows.push(this.videos.slice(i, i + rowSize));
      }
      return rows;
    }
  },
  methods: {
    getVideoUrl(videoId) {
      return `https://www.youtube.com/embed/${videoId}`;
    },
    async fetchVideos() {
      try {
        const response = await axios.get(
          `https://www.googleapis.com/youtube/v3/search?key=${this.apiKey}&channelId=${this.channelId}&part=snippet,id&order=date&maxResults=10`
        );
        this.videos = response.data.items.map(item => ({
          id: item.id.videoId,
          title: item.snippet.title
        }));
      } catch (error) {
        console.error('Error fetching videos:', error);
      }
    }
  },
  mounted() {
    this.fetchVideos();
  }
};
</script>

<style>
.portfolio {
  background-color: var(--bg-main-color);
  padding: 20px;
}

.portfolio h1 {
  text-align: center;
  color: var(--active-color);
}

.videos {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 20px;
  width: 80%;
}

.video {
  flex: 1 1 calc(33.333% - 20px);
  margin: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

iframe {
  width: 100%;
  height: 200px;
}

.video p {
  text-align: center;
    font-size: 16px;
    margin-top: 10px;
    color: #000000;
    font-weight: bold;
    background: white;
    padding: 20px;
}

/* Медиа-запросы для адаптивного дизайна */
@media (max-width: 1024px) {
  .video {
    flex: 1 1 calc(50% - 20px);
  }
}

@media (max-width: 768px) {
  .video {
    flex: 1 1 100%;
  }
}
</style>
